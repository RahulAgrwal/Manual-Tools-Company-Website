"""Check every page for the SEO and markup invariants this site relies on.

There are no tests, so this is the regression oracle for the UI redesign: run it
against production to capture a baseline, run it against localhost after a change,
and diff the two reports. A difference that is not deliberate is a bug.

    python tools/check_pages.py                          # against localhost:8080
    python tools/check_pages.py --base https://www.manualtoolsco.com
    python tools/check_pages.py --json reports/after.json
    python tools/check_pages.py --diff reports/before.json

Exits non-zero when any FAIL-level check fails, so it can gate a commit.
"""
import argparse
import json
import re
import sys
from html.parser import HTMLParser
from urllib.parse import urljoin

import requests

CANONICAL_HOST = "https://www.manualtoolsco.com"

# Paths as the sitemap lists them. "" is the home page.
PAGES = [
    "", "about", "products", "coal-crusher",
    "coal-crusher-5-No-single-disc", "coal-crusher-5-No-double-disc",
    "coke-cutter-double-drive", "coke-cutter-double-drive-ring-type",
    "haulage", "power-winch", "vibrator-screen", "conveyor-materials",
    "pusher-with-stamping-arrangement", "coal-charging-car",
    "photo-gallery", "contact",
]

PRODUCT_PAGES = {
    "coal-crusher-5-No-single-disc", "coal-crusher-5-No-double-disc",
    "coke-cutter-double-drive", "coke-cutter-double-drive-ring-type",
    "haulage", "power-winch", "vibrator-screen", "conveyor-materials",
    "pusher-with-stamping-arrangement", "coal-charging-car",
}

# Names that must 404: include-only partials and infrastructure.
BLOCKED = [
    "header", "footer", "common-head", "page-helpers", "global-products",
    "our-products", "related-products", "sidebar-quote-form", "clients",
    "load-secrets", "webcounter", "router", "secrets.example",
]

# PHP renders errors as "<b>Warning</b>: msg in <b>file</b> on line <b>12</b>".
# Matching the bare word would hit page copy such as a maintenance "Warning:" heading.
PHP_ERROR_RE = re.compile(
    r"<b>(Fatal error|Parse error|Warning|Notice|Deprecated)</b>:"
    r"|(Fatal error|Parse error|Warning|Notice|Deprecated):[^<]{0,200} on line \d+"
)


class PageParser(HTMLParser):
    """Collects just the facts the checks below need."""

    def __init__(self):
        super().__init__(convert_charrefs=True)
        self.title = None
        self.description = None
        self.canonical = None
        self.og = {}
        self.h1s = []
        self.imgs = []
        self.stylesheets = []
        self.scripts = []
        self.jsonld_raw = []
        self.links = []
        self.fetchpriority_high = 0
        self.has_keywords = False
        self._in_title = False
        self._in_jsonld = False
        self._h1_depth = 0

    def handle_starttag(self, tag, attrs):
        a = dict(attrs)
        if tag == "title":
            self._in_title = True
        elif tag == "meta":
            name = (a.get("name") or "").lower()
            prop = (a.get("property") or "").lower()
            if name == "description":
                self.description = a.get("content", "")
            elif name == "keywords":
                self.has_keywords = True
            elif prop.startswith("og:"):
                self.og[prop] = a.get("content", "")
        elif tag == "link":
            rel = (a.get("rel") or "").lower()
            if "canonical" in rel:
                self.canonical = a.get("href", "")
            elif "stylesheet" in rel:
                self.stylesheets.append(a.get("href", ""))
        elif tag == "script":
            if (a.get("type") or "").lower() == "application/ld+json":
                self._in_jsonld = True
                self.jsonld_raw.append("")
            elif a.get("src"):
                self.scripts.append(a["src"])
        elif tag == "h1":
            self._h1_depth += 1
            self.h1s.append("")
        elif tag == "img":
            self.imgs.append({
                "src": a.get("src", ""),
                "alt": a.get("alt"),
                "width": a.get("width"),
                "height": a.get("height"),
                "loading": a.get("loading"),
            })
            if a.get("fetchpriority") == "high":
                self.fetchpriority_high += 1
        elif tag == "a" and a.get("href"):
            self.links.append(a["href"])

    def handle_endtag(self, tag):
        if tag == "title":
            self._in_title = False
        elif tag == "script":
            self._in_jsonld = False
        elif tag == "h1" and self._h1_depth:
            self._h1_depth -= 1

    def handle_data(self, data):
        if self._in_title:
            self.title = (self.title or "") + data
        if self._in_jsonld and self.jsonld_raw:
            self.jsonld_raw[-1] += data
        if self._h1_depth and self.h1s:
            self.h1s[-1] += data


def flatten_jsonld(blocks):
    """Yield every JSON-LD node, walking @graph and arrays."""
    for raw in blocks:
        try:
            data = json.loads(raw)
        except json.JSONDecodeError:
            yield {"@type": "__INVALID__", "_raw": raw[:120]}
            continue
        stack = [data]
        while stack:
            node = stack.pop()
            if isinstance(node, list):
                stack.extend(node)
            elif isinstance(node, dict):
                if "@graph" in node:
                    stack.append(node["@graph"])
                yield node


def check_page(base, path, session):
    """Return (facts, issues) for one page. Issues are (level, message)."""
    url = urljoin(base + "/", path)
    issues = []
    facts = {"path": path, "url": url}

    try:
        r = session.get(url, timeout=20)
    except requests.RequestException as exc:
        return facts, [("FAIL", f"request failed: {exc}")]

    facts["status"] = r.status_code
    if r.status_code != 200:
        return facts, [("FAIL", f"HTTP {r.status_code}")]

    html = r.text
    facts["bytes"] = len(html)

    err = PHP_ERROR_RE.search(html)
    if err:
        issues.append(("FAIL", f"PHP error in output: {err.group(0)}"))

    p = PageParser()
    p.feed(html)

    # --- title / description -------------------------------------------------
    title = (p.title or "").strip()
    facts["title"] = title
    facts["title_len"] = len(title)
    if not title:
        issues.append(("FAIL", "no <title>"))
    elif len(title) > 65:
        issues.append(("WARN", f"title is {len(title)} chars (guideline is 65)"))

    desc = (p.description or "").strip()
    facts["description"] = desc
    facts["description_len"] = len(desc)
    if not desc:
        issues.append(("FAIL", "no meta description"))
    elif not 140 <= len(desc) <= 155:
        issues.append(("WARN", f"description is {len(desc)} chars (guideline is 140-155)"))

    # --- canonical -----------------------------------------------------------
    canonical = (p.canonical or "").strip()
    facts["canonical"] = canonical
    expected = CANONICAL_HOST + "/" + path
    if not canonical:
        issues.append(("FAIL", "no canonical link"))
    else:
        if not canonical.startswith(CANONICAL_HOST):
            issues.append(("FAIL", f"canonical is not on {CANONICAL_HOST}: {canonical}"))
        if canonical.endswith(".php"):
            issues.append(("FAIL", f"canonical ends in .php: {canonical}"))
        if canonical != expected:
            issues.append(("FAIL", f"canonical {canonical!r} != expected {expected!r}"))

    # --- headings ------------------------------------------------------------
    h1s = [h.strip() for h in p.h1s if h.strip()]
    facts["h1"] = h1s[0] if h1s else None
    facts["h1_count"] = len(h1s)
    if len(h1s) != 1:
        issues.append(("FAIL", f"{len(h1s)} <h1> elements, expected exactly 1"))

    # --- Open Graph ----------------------------------------------------------
    facts["og_title"] = p.og.get("og:title", "")
    facts["og_description"] = p.og.get("og:description", "")
    if p.og.get("og:title") and title and p.og["og:title"].strip() != title:
        issues.append(("WARN", "og:title does not match <title>"))
    if p.og.get("og:description") and desc and p.og["og:description"].strip() != desc:
        issues.append(("WARN", "og:description does not match meta description"))

    if p.has_keywords:
        issues.append(("FAIL", "<meta name=keywords> present (search engines ignore it)"))

    # --- structured data -----------------------------------------------------
    nodes = list(flatten_jsonld(p.jsonld_raw))
    types = []
    for n in nodes:
        t = n.get("@type")
        types.extend(t if isinstance(t, list) else [t] if t else [])
    facts["jsonld_types"] = sorted(set(types))

    if "__INVALID__" in types:
        issues.append(("FAIL", "a JSON-LD block does not parse"))

    breadcrumbs = [n for n in nodes if n.get("@type") == "BreadcrumbList"]
    facts["breadcrumb_count"] = len(breadcrumbs)
    # Home is the breadcrumb root, so it carries LocalBusiness/WebSite instead.
    if path and len(breadcrumbs) != 1:
        issues.append(("FAIL", f"{len(breadcrumbs)} BreadcrumbList blocks, expected 1"))
    elif canonical and breadcrumbs:
        items = breadcrumbs[0].get("itemListElement", [])
        if items:
            last = items[-1].get("item")
            last_url = last.get("@id") if isinstance(last, dict) else last
            if last_url and last_url.rstrip("/") != canonical.rstrip("/"):
                issues.append(("WARN", f"breadcrumb tail {last_url!r} != canonical"))

    products = [n for n in nodes if n.get("@type") == "Product"]
    facts["product_count"] = len(products)
    if path in PRODUCT_PAGES:
        if len(products) != 1:
            issues.append(("FAIL", f"{len(products)} Product blocks, expected 1"))
        else:
            prod = products[0]
            props = prod.get("additionalProperty", [])
            facts["product_props"] = len(props)
            if len(props) != 4:
                issues.append(("WARN", f"Product has {len(props)} additionalProperty, expected 4"))
            for key in ("brand", "manufacturer", "url", "image"):
                if not prod.get(key):
                    issues.append(("WARN", f"Product is missing {key}"))
            if prod.get("url") and canonical and prod["url"].rstrip("/") != canonical.rstrip("/"):
                issues.append(("FAIL", "Product.url != canonical"))

    for banned in ("aggregateRating", "review", "FAQPage"):
        if banned in types or any(banned in n for n in nodes):
            issues.append(("FAIL", f"{banned} markup present (deliberately not used on this site)"))

    # --- images --------------------------------------------------------------
    facts["img_count"] = len(p.imgs)
    missing_alt = [i["src"] for i in p.imgs if not (i["alt"] or "").strip()]
    missing_dim = [i["src"] for i in p.imgs if not (i["width"] and i["height"])]
    facts["img_missing_alt"] = len(missing_alt)
    facts["img_missing_dim"] = len(missing_dim)
    if missing_alt:
        issues.append(("WARN", f"{len(missing_alt)} img without alt, e.g. {missing_alt[0]}"))
    if missing_dim:
        issues.append(("WARN", f"{len(missing_dim)} img without width/height, e.g. {missing_dim[0]}"))

    facts["fetchpriority_high"] = p.fetchpriority_high
    if p.fetchpriority_high > 1:
        issues.append(("WARN", f"{p.fetchpriority_high} images marked fetchpriority=high"))

    # --- assets --------------------------------------------------------------
    facts["stylesheets"] = p.stylesheets
    facts["stylesheet_count"] = len(p.stylesheets)
    facts["scripts"] = p.scripts
    third_party_css = [h for h in p.stylesheets if h.startswith("http")]
    facts["third_party_css"] = len(third_party_css)

    # --- internal links ------------------------------------------------------
    php_links = [
        h for h in p.links
        if h.endswith(".php") and not h.startswith(("http", "//", "mailto:", "tel:"))
        and not h.startswith("forms/")
    ]
    if php_links:
        issues.append(("FAIL", f"internal link ends in .php: {php_links[0]}"))

    return facts, issues


def check_blocked(base, session):
    """Every include-only name must 404."""
    issues = []
    for name in BLOCKED:
        url = urljoin(base + "/", name)
        try:
            r = session.get(url, timeout=20, allow_redirects=False)
        except requests.RequestException as exc:
            issues.append(("FAIL", f"{name}: request failed: {exc}"))
            continue
        if r.status_code != 404:
            issues.append(("FAIL", f"/{name} returned {r.status_code}, expected 404"))
    return issues


def main():
    ap = argparse.ArgumentParser(description=__doc__)
    ap.add_argument("--base", default="http://localhost:8080",
                    help="site root to check (default: the local dev server)")
    ap.add_argument("--json", help="write the full report here")
    ap.add_argument("--diff", help="compare against a report written earlier")
    ap.add_argument("--skip-blocked", action="store_true",
                    help="skip the include-only 404 checks")
    args = ap.parse_args()

    base = args.base.rstrip("/")
    session = requests.Session()
    session.headers["User-Agent"] = "mtc-check-pages/1.0"

    report = {}
    fails = warns = 0

    for path in PAGES:
        facts, issues = check_page(base, path, session)
        report[path] = facts
        label = "/" + path
        bad = [i for i in issues if i[0] == "FAIL"]
        soft = [i for i in issues if i[0] == "WARN"]
        fails += len(bad)
        warns += len(soft)
        mark = "FAIL" if bad else ("warn" if soft else "ok  ")
        print(f"{mark}  {label}")
        for level, msg in issues:
            print(f"        {level}: {msg}")

    # Site-wide uniqueness.
    for field in ("title", "description"):
        seen = {}
        for path, facts in report.items():
            value = (facts.get(field) or "").strip()
            if value:
                seen.setdefault(value, []).append(path or "/")
        for value, paths in seen.items():
            if len(paths) > 1:
                fails += 1
                print(f"FAIL  duplicate {field} on {', '.join(paths)}: {value[:60]!r}")

    if not args.skip_blocked:
        for level, msg in check_blocked(base, session):
            fails += 1
            print(f"FAIL  {msg}")

    print(f"\n{len(PAGES)} pages checked - {fails} failures, {warns} warnings")

    if args.json:
        with open(args.json, "w", encoding="utf-8") as fh:
            json.dump(report, fh, indent=2, sort_keys=True)
        print(f"Report written to {args.json}")

    if args.diff:
        with open(args.diff, encoding="utf-8") as fh:
            before = json.load(fh)
        print(f"\nDiff against {args.diff}:")
        changed = False
        # Compare only the fields a redesign must not change.
        watched = ("title", "canonical", "h1", "description",
                   "jsonld_types", "h1_count", "product_props")
        for path in sorted(set(before) | set(report)):
            a, b = before.get(path, {}), report.get(path, {})
            for field in watched:
                if a.get(field) != b.get(field):
                    changed = True
                    print(f"  /{path} {field}:\n    - {a.get(field)!r}\n    + {b.get(field)!r}")
        if not changed:
            print("  no changes to title, canonical, h1, description or JSON-LD types")

    return 1 if fails else 0


if __name__ == "__main__":
    sys.exit(main())

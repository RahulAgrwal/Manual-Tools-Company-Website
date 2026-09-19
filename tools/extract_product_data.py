"""Extract the ten product detail pages into one product-data.php.

The pages are near-literal clones: a normalised tag-skeleton diff of
power-winch.php against vibrator-screen.php is twelve hunks, of which six are
only Font Awesome icon-class swaps. Everything that differs between them is
content, so it can be data.

Mechanical, repeated structures (spec grid, parameter table, timeline steps,
application cards, maintenance lists, FAQ, trust badges) are pulled apart into
real fields. Bespoke prose stays as an HTML string, because reproducing it
exactly matters more than modelling it.

Run once, from the repo root:

    python tools/extract_product_data.py

It writes product-data.php and prints anything it could not parse. Nothing is
deleted; the original pages are left alone so the output can be diffed against
them before they are replaced.
"""
import html
import json
import re
import sys
from pathlib import Path

SLUGS = [
    "coal-crusher-5-No-single-disc",
    "coal-crusher-5-No-double-disc",
    "coke-cutter-double-drive",
    "coke-cutter-double-drive-ring-type",
    "haulage",
    "power-winch",
    "vibrator-screen",
    "conveyor-materials",
    "pusher-with-stamping-arrangement",
    "coal-charging-car",
]

OUT = Path("product-data.php")


def grab(pattern, text, flags=re.S, group=1, required=True, label=""):
    m = re.search(pattern, text, flags)
    if not m:
        if required:
            raise ValueError(f"no match for {label or pattern[:60]}")
        return None
    return m.group(group)


def clean(s):
    """Collapse whitespace in a single-line value."""
    return re.sub(r"\s+", " ", s).strip() if s else s


def text(s):
    """A single-line value the template will escape, so store it decoded.

    The source markup holds HTML entities ("Rollers &amp; Pulleys"). Storing
    those verbatim and then escaping again in the template double-escapes them.
    """
    return html.unescape(clean(s)) if s else s


def block(s):
    """Tidy a multi-line HTML block without changing its meaning."""
    if s is None:
        return None
    s = re.sub(r"\n\s*", "\n", s.strip())
    return s


def php_value(v, indent=4):
    """Render a Python value as PHP array syntax."""
    pad = " " * indent
    if v is None:
        return "null"
    if isinstance(v, bool):
        return "true" if v else "false"
    if isinstance(v, (int, float)):
        return str(v)
    if isinstance(v, str):
        return "'" + v.replace("\\", "\\\\").replace("'", "\\'") + "'"
    if isinstance(v, (list, tuple)):
        if not v:
            return "[]"
        v = list(v)
        inner = ",\n".join(pad + "    " + php_value(x, indent + 4) for x in v)
        return "[\n" + inner + "\n" + pad + "]"
    if isinstance(v, dict):
        if not v:
            return "[]"
        inner = ",\n".join(
            pad + "    " + php_value(k, indent + 4) + " => " + php_value(x, indent + 4)
            for k, x in v.items()
        )
        return "[\n" + inner + "\n" + pad + "]"
    raise TypeError(type(v))


# ---------------------------------------------------------------- section cuts

def section(text, start_marker, end_marker):
    i = text.index(start_marker)
    j = text.index(end_marker, i)
    return text[i:j]


# ---------------------------------------------------------------- parsers

def parse_head(t, slug):
    jsonld_raw = grab(r'<script type="application/ld\+json">\s*(\{.*?\})\s*</script>',
                      t, label="Product JSON-LD")
    data = json.loads(jsonld_raw)
    props = [(p["name"], p["value"]) for p in data.get("additionalProperty", [])]
    return {
        "title": text(grab(r"<title>(.*?)</title>", t, label="title")),
        "description": text(grab(r'<meta name="description"\s*\n?\s*content="(.*?)">', t,
                                  label="meta description")),
        "og_image": text(grab(r'<meta property="og:image"\s*\n?\s*content="https://www\.manualtoolsco\.com/(.*?)">',
                               t, label="og:image")),
        "schema_name": data.get("name"),
        "schema_description": data.get("description"),
        "sku": data.get("sku"),
        "schema_props": props,
    }


def parse_crumbs(t):
    sec = section(t, '<section id="breadcrumbs"', "</section>")
    trail = re.findall(r"<li>(?:<a href=\"[^\"]*\">)?(.*?)(?:</a>)?</li>", sec, re.S)
    return {
        "crumb_heading": text(grab(r"<h2>(.*?)</h2>", sec, label="breadcrumb h2")),
        "crumb_last": text(trail[-1]) if trail else None,
    }


def parse_hero(t, slug):
    sec = section(t, '<section class="mtc-product-hero"', '<!-- ======= Overview')
    out = {}

    # Eight pages name the lead image as $specificMainImage; the two with video
    # build a $mediaList instead and pass the path straight to mtc_img().
    out["main_image"] = clean(
        grab(r'\$specificMainImage\s*=\s*"(.*?)"', sec, required=False, label="main image")
        or grab(r"'src'\s*=>\s*mtc_img\('(.*?)'\)", sec, required=False, label="media src"))
    out["gallery_dir"] = clean(grab(r'\$directory\s*=\s*"(.*?)"', sec, label="gallery dir"))
    out["has_video"] = "mp4" in sec
    frame = section(sec, 'mtc-product-main-frame', '</div>')
    out["hero_alt"] = text(grab(r'alt="(.*?)"', frame, label="hero alt"))
    out["thumb_alt"] = text(grab(r"htmlspecialchars\('(.*?) photo '", sec,
                                  required=False, label="thumb alt")) or out["hero_alt"]

    out["eyebrow"] = text(grab(r'class="mtc-product-eyebrow">(.*?)</div>', sec, label="eyebrow"))
    h1 = grab(r'class="mtc-product-title">(.*?)</h1>', sec, label="h1")
    parts = re.split(r"<br\s*/?>", h1, maxsplit=1)
    out["h1_lead"] = text(re.sub(r"<[^>]+>", "", parts[0]))
    out["h1_accent"] = text(re.sub(r"<[^>]+>", "", parts[1])) if len(parts) > 1 else ""

    # "Model: MTC-PW-DL" on nine pages, "Category: MTC-CM-SERIES" on conveyor.
    mm = re.search(r"<span>(Model|Category):\s*(.*?)</span>", sec, re.S)
    out["model_label"] = mm.group(1) if mm else "Model"
    out["model"] = text(mm.group(2)) if mm else None
    out["stock"] = text(grab(r'mtc-product-stock-badge">(.*?)</span>', sec,
                              required=False, label="stock")) or "In Stock"

    intro = grab(r'<p style="line-height: 1\.6; color: #555;">(.*?)</p>', sec,
                 required=False, label="intro")
    out["intro_html"] = block(intro)

    out["specs"] = [
        [text(i), text(lbl), text(val)]
        for i, lbl, val in re.findall(
            r'<i class="fas (fa-[a-z0-9-]+) mtc-product-spec-icon"></i>\s*'
            r'<div class="mtc-product-spec-text">\s*<span>(.*?)</span>\s*<strong>(.*?)</strong>',
            sec, re.S)
    ]

    out["brochure"] = clean(grab(r'href="(brochure/[^"]+\.pdf)"', sec, required=False,
                                 label="brochure"))
    out["trust"] = [
        [text(i), text(txt)]
        for i, txt in re.findall(
            r'<span><i class="fas (fa-[a-z0-9-]+)"></i>\s*(.*?)</span>',
            section(sec, 'mtc-product-trust-badges', '</div>'), re.S)
    ]
    return out


def parse_overview(t):
    sec = section(t, '<section class="mtc-product-overview"', '<section class="section-bg"')
    body = grab(r'<div class="col-lg-8">(.*?)</div>', sec, label="overview body")
    related = grab(r'<p class="mtc-overview-related">(.*?)</p>', body, required=False,
                   label="related link")
    paras = re.findall(r"<p>(.*?)</p>", body, re.S)
    buyer = [clean(li) for li in re.findall(r"<li>(.*?)</li>", sec, re.S)]
    return {
        "overview_heading": text(grab(r'class="mtc-overview-title">(.*?)</h2>', sec,
                                       label="overview heading")),
        "overview_paras": [block(p) for p in paras],
        "overview_related_html": block(related),
        "buyer_items": buyer,
    }


def parse_tabs(t):
    sec = t[t.index('<section class="section-bg"'):]
    tabs = []
    # Attribute whitespace varies line to line: one button breaks before
    # type="button", the rest break before role="tab".
    for tab_id, label in re.findall(
            r'data-bs-target="#([a-z0-9-]+)"\s+type="button"\s+role="tab"\s*>(.*?)</button>',
            sec, re.S):
        tabs.append({"id": tab_id, "label": text(label)})
    return tabs


def parse_desc_tab(t):
    try:
        pane = section(t, '<div class="tab-pane fade show active" id=',
                       '<div class="tab-pane fade" id=')
    except ValueError:
        return {"tech_heading": None, "tech_paras": [], "tech_table_heading": None,
                "tech_rows": []}
    heads = re.findall(r'class="mtc-tech-heading"[^>]*>(.*?)</h3>', pane, re.S)
    paras = re.findall(r'<p class="mtc-tech-paragraph">(.*?)</p>', pane, re.S)
    rows = [[text(re.sub(r"<[^>]+>", "", k)), text(re.sub(r"<[^>]+>", "", v))]
            for k, v in re.findall(r"<td>(.*?)</td>\s*<td>(.*?)</td>", pane, re.S)]
    return {
        "tech_heading": text(heads[0]) if heads else None,
        "tech_paras": [block(p) for p in paras],
        "tech_table_heading": text(heads[1]) if len(heads) > 1 else "Technical Parameters",
        "tech_rows": rows,
    }


def parse_flow_tab(t):
    m = re.search(r'<div class="tab-pane fade" id="(operationalflow|process|flow)"(.*?)'
                  r'<div class="tab-pane fade" id=', t, re.S)
    if not m:
        return {"flow_heading_accent": None, "flow_heading_rest": None,
                "flow_step_word": "Step", "flow_steps": [],
                "process_diagram": None, "process_diagram_alt": None,
                "process_diagram_caption": None}
    pane = m.group(2)
    # Three pages put a process diagram beside the timeline, in this tab (not
    # the description tab), with a caption in an overlay. The src is a plain
    # path in the original markup, not an mtc_img() call.
    # ring-type has an HTML comment between the box and the <img>.
    dm = re.search(r'<div class="mtc-flow-image-box">.*?<img src="([^"]+)"\s*alt="([^"]*)"',
                   pane, re.S)
    diagram = dm.group(1) if dm else None
    diagram_alt = dm.group(2) if dm else None
    diagram_caption = grab(r'<div class="mtc-flow-image-overlay">\s*<i[^>]*></i>\s*(.*?)\s*</div>',
                           pane, required=False, label="diagram caption")
    # Most pages number the timeline "Step 01"; haulage says "Stage 01".
    step_word = grab(r'<span class="mtc-timeline-number">\s*([A-Za-z]+)\s+\d', pane,
                     required=False, label="step word") or "Step"
    accent = grab(r'<span style="color: var\(--primary-color\);">(.*?)</span>', pane,
                  required=False, label="flow accent")
    rest = grab(r'</span>\s*(.*?)\s*</h3>', pane, required=False, label="flow rest")
    steps = [
        [text(i), text(title), block(desc)]
        for i, title, desc in re.findall(
            r'<h4 class="mtc-timeline-title"><i class="fas (fa-[a-z0-9-]+)"></i>\s*(.*?)</h4>\s*'
            r'<p class="mtc-timeline-desc">\s*(.*?)\s*</p>', pane, re.S)
    ]
    return {
        "flow_heading_accent": text(accent),
        "flow_heading_rest": text(rest),
        "flow_step_word": text(step_word),
        "flow_steps": steps,
        "process_diagram": clean(diagram),
        "process_diagram_alt": text(diagram_alt),
        "process_diagram_caption": text(diagram_caption),
    }


def parse_apps_tab(t):
    m = re.search(r'<div class="tab-pane fade" id="apps"(.*?)<div class="tab-pane fade" id=',
                  t, re.S)
    if not m:
        return {"apps": []}
    pane = m.group(1)
    return {"apps": [
        [text(i), text(title), block(desc)]
        for i, title, desc in re.findall(
            r'<i class="fas (fa-[a-z0-9-]+)"></i>\s*</div>\s*'
            r'<h4 class="mtc-app-title">(.*?)</h4>\s*'
            r'<p class="mtc-app-description">(.*?)</p>', pane, re.S)
    ]}


def parse_maint_tab(t):
    m = re.search(r'<div class="tab-pane fade" id="maint"(.*?)<div class="tab-pane fade" id=',
                  t, re.S)
    if not m:
        return {"maint_alert": None, "maint_cols": []}
    pane = m.group(1)
    alert_t = grab(r'<strong>(.*?)</strong>', pane, required=False, label="alert title")
    alert_b = grab(r'<strong>.*?</strong>\s*(.*?)\s*</div>', pane, required=False,
                   label="alert body")
    alert_icon = grab(r'<div class="mtc-maintenance-alert">\s*<i class="fas (fa-[a-z0-9-]+)">',
                      pane, required=False, label="alert icon")
    cols = []
    for title, body in re.findall(
            r'<h5 class="mtc-maintenance-col-title">(.*?)</h5>\s*'
            r'<ul class="mtc-maintenance-list">(.*?)</ul>', pane, re.S):
        items = [block(li) for li in re.findall(r"<li>(.*?)</li>", body, re.S)]
        cols.append({"title": text(title), "items": items})
    return {
        "maint_alert": ([text(alert_icon), text(alert_t), alert_b]
                        if alert_t else None),
        "maint_cols": cols,
    }


KNOWN_TABS = {"desc", "operationalflow", "process", "flow", "apps", "maint", "faq"}


def parse_custom_tabs(t, tabs):
    """Capture the raw pane for any tab the structured parsers do not cover.

    conveyor-materials is the only page that needs this: it has three tabs
    (a component grid and a materials table instead of the usual five), and
    reproducing that markup exactly matters more than modelling it.
    """
    out = {}
    for tab in tabs:
        tid = tab["id"]
        if tid in KNOWN_TABS:
            continue
        pat = (r'<div class="tab-pane fade(?: show active)?" id="' + re.escape(tid) +
               r'" role="tabpanel">(.*?)\n              </div>\n')
        body = grab(pat, t, required=False, label=f"custom tab {tid}")
        if body:
            out[tid] = block(body)
    return {"custom_tabs": out}


def parse_faqs(t):
    raw = grab(r"\$product_faqs\s*=\s*\[(.*?)\];", t, required=False, label="faqs")
    if not raw:
        return {"faqs": []}
    return {"faqs": [
        [html.unescape(q), html.unescape(a)]
        for q, a in re.findall(r'"q"\s*=>\s*"((?:[^"\\]|\\.)*)"\s*,\s*"a"\s*=>\s*"((?:[^"\\]|\\.)*)"',
                               raw)
    ]}


def parse_footerish(t, slug):
    return {
        "quote_title": clean(grab(r"\$_GET\['page_title'\]\s*=\s*'(.*?)'", t,
                                  required=False, label="quote title")),
        "related_slug": clean(grab(r"\$current_page_slug\s*=\s*\"(.*?)\"", t,
                                   required=False, label="related slug")) or slug,
    }


# ---------------------------------------------------------------- main

def extract(slug):
    t = Path(slug + ".php").read_text(encoding="utf-8")
    d = {"slug": slug}
    d.update(parse_head(t, slug))
    d.update(parse_crumbs(t))
    d.update(parse_hero(t, slug))
    d.update(parse_overview(t))
    d["tabs"] = parse_tabs(t)
    d.update(parse_desc_tab(t))
    d.update(parse_flow_tab(t))
    d.update(parse_apps_tab(t))
    d.update(parse_maint_tab(t))
    d.update(parse_custom_tabs(t, d["tabs"]))
    d.update(parse_faqs(t))
    d.update(parse_footerish(t, slug))
    return d


def main():
    # Guard: this reads the original hand-written pages. Once they have been
    # replaced by stubs there is nothing to extract, and writing anyway would
    # overwrite product-data.php with an empty array. That happened once.
    stubs = [s for s in SLUGS
             if "product-page.php" in Path(s + ".php").read_text(encoding="utf-8")]
    if stubs:
        sys.exit(f"refusing to run: {len(stubs)} page(s) are already stubs "
                 f"({stubs[0]}.php, ...). product-data.php is now maintained by hand; "
                 f"restore the originals from git first if you really mean to re-extract.")

    products, failures = {}, []
    for slug in SLUGS:
        try:
            products[slug] = extract(slug)
        except Exception as exc:                       # noqa: BLE001 - report and continue
            failures.append((slug, f"{type(exc).__name__}: {exc}"))

    lines = [
        "<?php",
        "/**",
        " * Every product detail page, as data.",
        " *",
        " * Generated once from the ten hand-written pages by",
        " * tools/extract_product_data.py, then maintained by hand. The pages were",
        " * near-literal clones -- a normalised skeleton diff of two of them was",
        " * twelve hunks, six of which were only Font Awesome icon swaps -- so the",
        " * differences between them are content, and content belongs here.",
        " *",
        " * product-page.php renders this. Each <slug>.php is a three-line stub.",
        " */",
        "$MTC_PRODUCTS = [",
    ]
    for slug, d in products.items():
        lines.append("  " + php_value(slug, 2) + " => " + php_value(d, 2) + ",")
    lines.append("];")
    OUT.write_text("\n".join(lines) + "\n", encoding="utf-8")

    print(f"{len(products)}/{len(SLUGS)} products -> {OUT} ({OUT.stat().st_size / 1024:.0f} KB)")
    for slug, why in failures:
        print(f"  FAILED {slug}: {why}")

    # Report anything structurally surprising, so gaps are visible rather than silent.
    for slug, d in products.items():
        notes = []
        if len(d["specs"]) != 4:
            notes.append(f"{len(d['specs'])} hero specs")
        if len(d["schema_props"]) != 4:
            notes.append(f"{len(d['schema_props'])} JSON-LD properties")
        if len(d["tabs"]) != 5:
            notes.append(f"{len(d['tabs'])} tabs")
        if not d["faqs"]:
            notes.append("no FAQs")
        if not d["intro_html"]:
            notes.append("no intro paragraph")
        if not d["tech_rows"]:
            notes.append("no parameter table")
        if notes:
            print(f"  note {slug}: {', '.join(notes)}")
    return 1 if failures else 0


if __name__ == "__main__":
    sys.exit(main())

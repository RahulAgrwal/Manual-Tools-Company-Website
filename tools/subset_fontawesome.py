"""Rebuild assets/fontawesome/css/icons.css from the icons the site actually uses.

Font Awesome's full fontawesome.min.css maps ~1600 icons and is 58 KB; this site
uses under a hundred. This script scans the PHP and JS for `fa-*` class names and
writes only the matching `.fa-x::before{content:"\\fXXX"}` rules, plus the core
`.fa`/`.fas`/`.fab` rules and the two @font-face blocks (woff2 only -- the .eot,
.woff, .ttf and .svg fallbacks shipped by upstream are not deployed).

Run it from the repo root after adding an icon to any page, or the new icon will
render as a blank box:

    python tools/subset_fontawesome.py

Source files come from the upstream 5.15.4 download in assets/fontawesome/css/.
"""
import re
import sys
from pathlib import Path

CSS_DIR = Path("assets/fontawesome/css")
UPSTREAM = CSS_DIR / "fontawesome.min.css"
OUTPUT = CSS_DIR / "icons.css"

# Where icon classes can appear.
SCAN_GLOBS = ("*.php", "forms/*.php", "assets/js/*.js")

# Style shorthands and sizing/animation helpers, which are not icon glyphs.
NOT_GLYPHS = {
    "fa-solid", "fa-regular", "fa-brands", "fa-light", "fa-duotone",
    "fa-fw", "fa-lg", "fa-xs", "fa-sm", "fa-spin", "fa-pulse", "fa-border",
    "fa-li", "fa-ul", "fa-stack", "fa-inverse", "fa-flip-horizontal",
    "fa-flip-vertical", "fa-rotate-90", "fa-rotate-180", "fa-rotate-270",
}
SIZE_RE = re.compile(r"^fa-\d+x$")

FONT_FACE = """\
/* Font Awesome Free 5.15.4 by @fontawesome - https://fontawesome.com
   License: https://fontawesome.com/license/free
   (Icons: CC BY 4.0, Fonts: SIL OFL 1.1) */
@font-face {
  font-family: "Font Awesome 5 Free";
  font-style: normal;
  font-weight: 900;
  font-display: block;
  src: url(../webfonts/fa-solid-900.woff2) format("woff2");
}
@font-face {
  font-family: "Font Awesome 5 Brands";
  font-style: normal;
  font-weight: 400;
  font-display: block;
  src: url(../webfonts/fa-brands-400.woff2) format("woff2");
}
.fa, .fas, .fab {
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
  display: inline-block;
  font-style: normal;
  font-variant: normal;
  text-rendering: auto;
  line-height: 1;
}
.fa, .fas { font-family: "Font Awesome 5 Free"; font-weight: 900; }
.fab { font-family: "Font Awesome 5 Brands"; font-weight: 400; }
.fa-fw { text-align: center; width: 1.25em; }
.fa-spin { animation: fa-spin 2s infinite linear; }
@keyframes fa-spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
@media (prefers-reduced-motion: reduce) { .fa-spin { animation: none; } }
"""


def used_icons():
    """Every fa-* glyph class referenced anywhere in the site."""
    found = set()
    pattern = re.compile(r"\bfa-[a-z0-9]+(?:-[a-z0-9]+)*")
    for glob in SCAN_GLOBS:
        for path in Path(".").glob(glob):
            text = path.read_text(encoding="utf-8", errors="ignore")
            found.update(pattern.findall(text))
    return {n for n in found if n not in NOT_GLYPHS and not SIZE_RE.match(n)}


def glyph_map(css):
    """Parse `.fa-name:before{content:"\\fXXX"}` rules out of the upstream CSS."""
    mapping = {}
    for selectors, content in re.findall(
        r"((?:\.fa-[a-z0-9-]+:{1,2}before\s*,?\s*)+)\{content:\"(\\[0-9a-f]+)\"\}", css
    ):
        for name in re.findall(r"\.(fa-[a-z0-9-]+):{1,2}before", selectors):
            mapping[name] = content
    return mapping


def main():
    if not UPSTREAM.exists():
        sys.exit(f"{UPSTREAM} not found - download Font Awesome 5.15.4 first")

    icons = used_icons()
    mapping = glyph_map(UPSTREAM.read_text(encoding="utf-8"))

    missing = sorted(n for n in icons if n not in mapping)
    resolved = sorted(n for n in icons if n in mapping)

    lines = [FONT_FACE, "", "/* Icons used by this site - regenerate with tools/subset_fontawesome.py */"]
    for name in resolved:
        lines.append(f'.{name}::before {{ content: "{mapping[name]}"; }}')
    OUTPUT.write_text("\n".join(lines) + "\n", encoding="utf-8")

    before = UPSTREAM.stat().st_size
    after = OUTPUT.stat().st_size
    print(f"{len(resolved)} icons -> {OUTPUT} ({after / 1024:.1f} KB, was {before / 1024:.1f} KB)")
    if missing:
        print(f"\nNot found in Font Awesome 5.15.4 ({len(missing)}):")
        for name in missing:
            print(f"  {name}")
        print("These will render as blank boxes. Check for typos or free/pro mismatches.")
        return 1
    return 0


if __name__ == "__main__":
    sys.exit(main())

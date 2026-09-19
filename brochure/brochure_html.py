"""Page furniture, stylesheet and printing for the product brochures.

The counterpart of the range catalogues' own layout code: HTML printed by
headless Chrome, so the brochures, the catalogues and the website all read
in the same typeface (Archivo) and the same palette. It replaced an fpdf2
layout that could only use Helvetica.

Kept separate from generate_range_catalogue*.py on purpose, the same way
those two are kept separate from each other: a brochure is four A4 pages
with its own furniture, and sharing a stylesheet with a 32-page catalogue
would make both harder to change. The tokens below are the shared part and
must be kept in step with `:root` in the catalogues and with
`assets/css/mtc.css`.
"""

import os
import re
import shutil
import subprocess
import sys
from pathlib import Path

from PIL import Image

ROOT = Path(__file__).resolve().parent.parent
FONTS = ROOT / "brochure" / "fonts"
FA_WOFF = ROOT / "assets" / "fontawesome" / "webfonts" / "fa-solid-900.woff2"
ICON_CSS = ROOT / "assets" / "fontawesome" / "css" / "icons.css"
LOGO = ROOT / "assets" / "img" / "MTC Logo.png"
FULL_LOGO_SVG = ROOT / "assets" / "img" / "mtc-logo-full.svg"
BADGE = ROOT / "brochure" / "30yearss.png"

PHONE = "+91 9430707348"
EMAIL = "manualtoolsco.dhn@gmail.com"
# www is the canonical host; the bare domain only 301-redirects to it.
SITE = "www.manualtoolsco.com"
PLACE = "Dhanbad, Jharkhand, India"

_icon_map = None


def icon_char(name):
    """'fa-bolt' -> the glyph, read from the site's own subset stylesheet so a
    spec shows the same icon here as on its product page."""
    global _icon_map
    if _icon_map is None:
        css = ICON_CSS.read_text(encoding="utf-8")
        _icon_map = {m[0]: m[1] for m in re.findall(
            r'\.(fa-[a-z0-9-]+)::?before\s*\{\s*content:\s*"\\([0-9a-f]+)"', css)}
    code = _icon_map.get(name)
    return f'<i class="ico">&#x{code};</i>' if code else ""


def esc(text):
    """Escape copy, then apply the house dashes. Copy that already carries
    markup (&amp; or <br>) is only typeset."""
    text = str(text)
    if "&amp;" in text or "<br>" in text or "&#" in text:
        return _nice(text)
    out = (text.replace("&", "&amp;").replace("<", "&lt;").replace(">", "&gt;"))
    return _nice(out)


def _nice(text):
    text = re.sub(r"(?<=\w) - (?=\w)", " – ", text)
    text = re.sub(r"(?<=[\d'.PH]) ?x ?(?=[\d])", " × ", text)
    return text


class Images:
    """Downsized copies in the build folder, so the PDF stays small."""

    def __init__(self, build):
        self.build = build
        self.n = 0

    def _name(self, ext):
        self.n += 1
        return f"img{self.n:02d}.{ext}"

    def photo(self, src, max_px=1600, bg=(255, 255, 255)):
        im = Image.open(src)
        if im.mode in ("P", "LA", "RGBA"):
            im = im.convert("RGBA")
            flat = Image.new("RGB", im.size, bg)
            flat.paste(im, mask=im.split()[-1])
            im = flat
        im = im.convert("RGB").copy()
        im.thumbnail((max_px, max_px), Image.LANCZOS)
        name = self._name("jpg")
        im.save(self.build / name, quality=86, optimize=True, progressive=True)
        return name

    def cutout(self, src, max_px=1500, bg=None):
        """Trimmed to the machine. Transparent PNG for the dark cover, or
        flattened onto a known flat colour, which keeps the PDF lighter."""
        im = Image.open(src)
        if im.mode != "RGBA":
            im = im.convert("RGBA")
        box = im.split()[-1].point(lambda v: 255 if v > 8 else 0).getbbox()
        if box:
            im = im.crop(box)
        im.thumbnail((max_px, max_px), Image.LANCZOS)
        if bg is None:
            name = self._name("png")
            im.save(self.build / name, optimize=True)
        else:
            flat = Image.new("RGB", im.size, bg)
            flat.paste(im, mask=im.split()[-1])
            name = self._name("jpg")
            flat.save(self.build / name, quality=88)
        return name

    def has_alpha(self, src):
        im = Image.open(src)
        if im.mode not in ("RGBA", "LA", "P"):
            return False
        im = im.convert("RGBA")
        return im.split()[-1].getextrema()[0] < 250


def full_logo_svg(badge="#FFFFFF", mark="#D40000", words="#FFFFFF"):
    """The owner's full logo (badge, name and tagline as outlines), recoloured
    for the red box on the cover: in the file the badge disc and the lettering
    are red, and the badge ring and MTC letters are white. Same treatment the
    range catalogues use, so the covers match."""
    svg = FULL_LOGO_SVG.read_text(encoding="utf-8")
    svg = re.sub(r"<metadata>.*?</metadata>", "", svg, flags=re.S)
    svg = re.sub(r"<title>.*?</title>", "", svg, flags=re.S)
    svg = re.sub(r"<!--.*?-->", "", svg, flags=re.S)
    svg = svg.replace('"#FFFFFF"', '"MARK"')
    svg = svg.replace('fill="#FF0000"', 'fill="BADGE"', 1).replace('fill="#FF0000"', 'fill="WORDS"', 1)
    svg = svg.replace("BADGE", badge).replace("WORDS", words).replace("MARK", mark)
    svg = re.sub(r'\swidth="1600" height="260"', "", svg)
    return svg


def folio(n, dark=False):
    cls = "folio on-dark" if dark else "folio"
    return f'<div class="{cls}">{n} &nbsp;|&nbsp; {SITE}</div>'


def brand_bar():
    """The running head: the logo, then the product name on the right."""
    return f'<img class="hd-logo" src="{LOGO.as_uri()}" alt="">'


def css():
    f = FONTS.as_uri()
    fa = FA_WOFF.as_uri()
    return f"""
@font-face {{ font-family: Archivo; font-style: normal; font-weight: 100 900; font-stretch: 62% 125%;
  src: url({f}/Archivo-Variable.woff2) format("woff2"); }}
@font-face {{ font-family: Archivo; font-style: italic; font-weight: 100 900; font-stretch: 62% 125%;
  src: url({f}/Archivo-Italic-Variable.woff2) format("woff2"); }}
@font-face {{ font-family: FA; font-weight: 900; src: url({fa}) format("woff2"); }}

/* Kept in step with :root in the range catalogues and assets/css/mtc.css. */
:root {{
  --red: #D40000; --red-dk: #A80000; --ink: #111821; --body: #2D343D; --soft: #6B7480;
  --rule: #D9DDE2; --panel: #EEF0F2; --band: #F6F7F8; --tint: #FFF0F0;
}}
@page {{ size: 210mm 297mm; margin: 0; }}
* {{ box-sizing: border-box; margin: 0; padding: 0; }}
html, body {{ font-family: Archivo, Arial, sans-serif; color: var(--body); font-size: 10pt;
  line-height: 1.45; -webkit-print-color-adjust: exact; print-color-adjust: exact; }}
.page {{ width: 210mm; height: 297mm; position: relative; overflow: hidden; background: #fff;
  break-after: page; }}
.page:last-child {{ break-after: auto; }}
.pad {{ padding: 26mm 15mm 0; position: relative; }}
img {{ display: block; }}
.ico {{ font-family: FA; font-style: normal; font-weight: 900; }}
p {{ margin-bottom: 3mm; }}

/* running head and folio */
.hd-logo {{ position: absolute; left: 15mm; top: 9mm; width: 46mm; }}
.hd-name {{ position: absolute; right: 15mm; top: 13mm; font-size: 8pt; color: var(--soft); }}
.hd-rule {{ position: absolute; left: 15mm; right: 15mm; top: 21mm; height: .3mm;
  background: var(--rule); }}
.folio {{ position: absolute; left: 15mm; bottom: 9mm; font-size: 7.5pt; color: var(--soft); }}
.folio.on-dark {{ color: rgba(255,255,255,.6); }}
.foot-r {{ position: absolute; right: 15mm; bottom: 9mm; font-size: 7.5pt; color: var(--soft);
  text-align: right; }}

/* headings */
.red-h {{ color: var(--red); font-weight: 850; font-stretch: 118%; text-transform: uppercase;
  font-size: 22pt; line-height: 1.02; letter-spacing: -.01em; margin-bottom: 4mm; }}
.grey-h {{ color: #555C66; font-weight: 800; font-stretch: 115%; font-size: 11pt;
  text-transform: uppercase; letter-spacing: .04em; margin-bottom: 3mm; }}
.sec {{ color: var(--red); font-weight: 800; font-stretch: 112%; font-size: 9.5pt;
  text-transform: uppercase; letter-spacing: .08em; margin: 7mm 0 3mm;
  padding-bottom: 1.6mm; border-bottom: .4mm solid var(--rule); }}
.sec:first-child {{ margin-top: 0; }}
.body {{ font-size: 10pt; color: var(--body); }}
.fine {{ font-size: 7.6pt; color: var(--soft); line-height: 1.35; }}
.lede {{ font-size: 11pt; color: var(--body); }}

/* cover */
.cover {{ background: radial-gradient(120% 90% at 50% 38%, #1B2530 0%, #0D1319 70%);
  color: #fff; }}
.cv-logo {{ position: absolute; left: 15mm; top: 14mm; background: var(--red); padding: 4mm 5mm; }}
.cv-logo svg {{ width: 52mm; height: auto; display: block; }}
.cv-art {{ position: absolute; left: 0; right: 0; top: 52mm; height: 118mm;
  display: flex; align-items: center; justify-content: center; }}
.cv-art img {{ max-width: 168mm; max-height: 118mm; object-fit: contain; }}
.cv-text {{ position: absolute; left: 15mm; right: 15mm; top: 182mm; }}
.cv-eyebrow {{ display: inline-block; background: var(--red); color: #fff; font-size: 8pt;
  font-weight: 800; letter-spacing: .1em; text-transform: uppercase; padding: 1.6mm 3mm; }}
.cv-h1 {{ font-weight: 900; font-stretch: 118%; font-size: 34pt; line-height: .98;
  letter-spacing: -.02em; margin: 5mm 0 2mm; text-transform: uppercase; }}
.cv-sub {{ color: rgba(255,255,255,.72); font-size: 11pt; }}
.cv-stats {{ position: absolute; left: 15mm; right: 15mm; bottom: 26mm; display: flex;
  border-top: .4mm solid rgba(255,255,255,.22); padding-top: 5mm; }}
.cv-stats div {{ flex: 1; }}
.cv-stats b {{ display: block; font-weight: 850; font-stretch: 115%; font-size: 17pt;
  line-height: 1.1; }}
.cv-stats span {{ font-size: 7.6pt; text-transform: uppercase; letter-spacing: .07em;
  color: rgba(255,255,255,.55); }}
.cv-foot {{ position: absolute; left: 15mm; right: 15mm; bottom: 11mm; font-size: 8pt;
  color: rgba(255,255,255,.5); display: flex; justify-content: space-between; }}

/* two columns */
.cols {{ display: flex; gap: 9mm; align-items: flex-start; }}
.col {{ flex: 1; min-width: 0; }}

/* hero panel on page 2 */
.hero {{ background: var(--band); border-radius: 2mm; height: 62mm; display: flex;
  align-items: center; justify-content: center; }}
.hero img {{ max-width: 88%; max-height: 88%; object-fit: contain; }}

/* key specifications */
.keys {{ display: flex; gap: 3mm; margin: 6mm 0 0; }}
.keys div {{ flex: 1; border: .3mm solid var(--rule); border-radius: 2mm; padding: 3.5mm 3mm;
  text-align: center; }}
.keys .ico {{ color: var(--red); font-size: 12pt; }}
.keys b {{ display: block; font-weight: 800; font-size: 10pt; color: var(--ink);
  margin-top: 1.5mm; }}
.keys span {{ display: block; font-size: 7.4pt; text-transform: uppercase;
  letter-spacing: .05em; color: var(--soft); margin-top: .8mm; }}

/* specification table */
table {{ border-collapse: collapse; width: 100%; }}
.spec td {{ padding: 2mm 2.5mm; font-size: 9pt; border-bottom: .25mm solid #fff; }}
.spec tr:nth-child(odd) td {{ background: var(--band); }}
.spec td:first-child {{ color: var(--soft); width: 45%; }}
.spec td:last-child {{ color: var(--ink); font-weight: 700; }}

/* feature list */
.feat li {{ list-style: none; font-size: 9pt; padding: 0 0 2.4mm 6mm; position: relative;
  color: var(--body); }}
.feat li::before {{ content: ""; position: absolute; left: 0; top: 1.7mm; width: 2.2mm;
  height: 2.2mm; background: var(--red); border-radius: 50%; }}

/* buying information */
.buy {{ background: var(--band); border-radius: 2mm; padding: 5mm 6mm; margin-top: 6mm; }}
.buy h4 {{ color: var(--red); font-size: 8.5pt; font-weight: 800; letter-spacing: .08em;
  text-transform: uppercase; margin-bottom: 2.5mm; }}
.buy p {{ font-size: 8.6pt; margin-bottom: 1.6mm; }}
.buy b {{ color: var(--ink); }}

/* how it works */
.steps {{ counter-reset: s; }}
.steps .step {{ display: flex; gap: 5mm; padding-bottom: 3.5mm; margin-bottom: 3.5mm;
  border-bottom: .25mm solid var(--rule); }}
.steps .step:last-child {{ border-bottom: 0; }}
.steps .n {{ color: var(--red); font-weight: 850; font-stretch: 115%; font-size: 15pt;
  width: 11mm; flex: none; line-height: 1; }}
.steps h4 {{ font-size: 10pt; color: var(--ink); margin-bottom: 1mm; }}
.steps p {{ font-size: 9pt; margin: 0; }}

/* applications */
.apps .app {{ display: flex; gap: 4mm; margin-bottom: 2.6mm; }}
.apps b {{ width: 42mm; flex: none; font-size: 9pt; color: var(--ink); }}
.apps p {{ font-size: 9pt; margin: 0; }}

/* questions */
.faq p.q {{ font-size: 9.5pt; font-weight: 700; color: var(--ink); margin-bottom: 1mm; }}
.faq p.a {{ font-size: 9pt; margin-bottom: 4mm; }}

/* spare parts */
.spares {{ display: flex; flex-wrap: wrap; gap: 4mm 9mm; }}
.spare {{ width: calc(50% - 4.5mm); display: flex; gap: 3.5mm; }}
.spare .pic {{ width: 26mm; height: 20mm; flex: none; background: var(--band);
  border-radius: 1.5mm; display: flex; align-items: center; justify-content: center; }}
.spare .pic img {{ max-width: 86%; max-height: 86%; object-fit: contain; }}
.spare b {{ display: block; font-size: 8.8pt; color: var(--ink); line-height: 1.25; }}
.spare span {{ display: block; font-size: 8pt; color: var(--soft); margin-top: .6mm; }}

/* gallery */
.gal {{ display: flex; flex-wrap: wrap; gap: 4mm; }}
.gal .shot {{ border: .25mm solid var(--rule); border-radius: 2mm; overflow: hidden;
  display: flex; align-items: center; justify-content: center; background: var(--band);
  padding: 3mm; }}
/* contain, not cover: these are whole machines, and cover decapitates them */
.gal .shot img {{ max-width: 100%; max-height: 100%; object-fit: contain; }}
.gal .lead {{ width: 100%; height: 72mm; }}
.gal .small {{ width: calc(50% - 2mm); height: 44mm; }}

/* the rest of the range */
.range {{ display: flex; flex-wrap: wrap; gap: 2.6mm 9mm; }}
.range .r {{ width: calc(50% - 4.5mm); border-left: .6mm solid var(--red); padding-left: 3mm; }}
.range b {{ display: block; font-size: 8.6pt; color: var(--ink); }}
.range span {{ display: block; font-size: 8pt; color: var(--soft); }}

/* quotation panel */
.quote {{ position: absolute; left: 15mm; right: 15mm; bottom: 18mm; background: var(--ink);
  color: #fff; border-radius: 2mm; padding: 6mm 7mm; display: flex;
  justify-content: space-between; align-items: center; }}
.quote .q-l h4 {{ color: var(--red); font-size: 8.5pt; font-weight: 800; letter-spacing: .09em;
  text-transform: uppercase; margin-bottom: 2mm; }}
.quote .q-l b {{ font-size: 17pt; font-weight: 850; font-stretch: 112%; }}
.quote .q-r {{ text-align: right; font-size: 8.6pt; color: rgba(255,255,255,.75);
  line-height: 1.6; }}
"""


OVERFLOW_JS = """
addEventListener("load", () => document.fonts.ready.then(() => {
  const mm = 96 / 25.4, bad = [];
  document.querySelectorAll(".page:not(.cover)").forEach((pg, i) => {
    const limit = pg.getBoundingClientRect().bottom - 13 * mm;
    for (const el of pg.querySelectorAll(".pad *")) {
      const r = el.getBoundingClientRect();
      if (r.height && r.bottom > limit + 1) { bad.push(i + 2); break; }
    }
  });
  document.body.setAttribute("data-overflow", bad.join(","));
}));
"""


def find_browser():
    for c in (os.environ.get("CHROME"),
              r"C:\Program Files\Google\Chrome\Application\chrome.exe",
              r"C:\Program Files (x86)\Google\Chrome\Application\chrome.exe",
              r"C:\Program Files (x86)\Microsoft\Edge\Application\msedge.exe",
              shutil.which("google-chrome"), shutil.which("chromium"), shutil.which("chrome")):
        if c and os.path.exists(c):
            return c
    sys.exit("Chrome or Edge is needed to print the brochures (set CHROME to its path).")


def check_overflow(browser, page, label):
    dom = subprocess.run([browser, "--headless=new", "--disable-gpu",
                          "--allow-file-access-from-files", "--virtual-time-budget=15000",
                          "--dump-dom", page.as_uri()],
                         capture_output=True, text=True, encoding="utf-8").stdout
    m = re.search(r'data-overflow="([^"]*)"', dom)
    if m is None:
        print(f"warning: could not run the overflow check on {label}")
    elif m.group(1):
        sys.exit(f"{label}: text runs into the footer on page(s) {m.group(1)}; shorten the copy")


def print_pdf(browser, page, out):
    subprocess.run([browser, "--headless=new", "--disable-gpu", "--no-pdf-header-footer",
                    "--allow-file-access-from-files", "--virtual-time-budget=15000",
                    f"--print-to-pdf={out}", page.as_uri()],
                   check=True, capture_output=True)

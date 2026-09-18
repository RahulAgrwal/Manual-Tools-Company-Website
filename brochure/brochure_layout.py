"""Layout engine for the Manual Tools Company product brochures.

Holds the page furniture (cover, running header/footer, section headers,
spec tables, feature lists, FAQ) so the product scripts only carry copy.

Design notes:
- A4, 16 mm side margins, 178 mm text column.
- Two type sizes do most of the work: 9.5 pt body and 21 pt page titles.
  Section labels are small, letterspaced and red; everything else is ink.
- Helvetica is a core PDF font, so no text font ships with the repo. It only
  covers Latin-1, which is why copy goes through clean() first. The one font
  file is brochure/fonts/fa-solid-900.ttf, for the Key specifications icons.
"""
import re

from fpdf import FPDF
from PIL import Image, ImageChops, ImageDraw, ImageFilter

FONT_FAMILY = "Helvetica"

# --- Palette -------------------------------------------------------------
INK = (17, 24, 33)          # headings, cover background
INK_BODY = (45, 52, 61)     # body copy
INK_SOFT = (122, 131, 142)  # captions, labels, footer
RED = (194, 24, 7)          # brand accent (matches --primary-color family)
RULE = (223, 227, 232)      # hairlines
PANEL = (246, 247, 249)     # spec table banding
RED_TINT = (252, 234, 229)  # icon badge behind a red glyph
WHITE = (255, 255, 255)

# --- Geometry ------------------------------------------------------------
PAGE_W, PAGE_H = 210.0, 297.0
MARGIN = 16.0
CONTENT_W = PAGE_W - 2 * MARGIN   # 178
COL_W = (CONTENT_W - 10) / 2      # 84, two columns with a 10 mm gutter
COL_R_X = MARGIN + COL_W + 10
HEADER_H = 22.0
FOOTER_Y = PAGE_H - 16.0

LOGO = "assets/img/MTC Logo.png"
# Font Awesome 5.15.4 Solid, converted from the site's own woff2 (fpdf2 needs
# TTF). The font is SIL OFL 1.1, so it may ship in the repo. Icon code points
# come from the site's subset stylesheet, so a spec uses the same icon in the
# brochure as on its product page.
ICON_FONT = "brochure/fonts/fa-solid-900.ttf"
ICON_CSS = "assets/fontawesome/css/icons.css"
BADGE = "brochure/30yearss.png"
PHONE = "+91 9430707348"
# www is the canonical host; the bare domain only 301-redirects to it.
SITE = "www.manualtoolsco.com"
PROP = "Ravindra Kr. Agarwal, Proprietor"
PLACE = "Dhanbad, Jharkhand, India"

# Helvetica (core font) only covers Latin-1.
_ASCII = str.maketrans({"–": "-", "—": "-", "‘": "'", "’": "'", "“": '"', "”": '"', "×": "x", "·": "-"})


def clean(text):
    return str(text).translate(_ASCII)


def load_image(path, max_px=1400):
    """Downscale before embedding so the PDF stays small."""
    im = Image.open(path)
    im.thumbnail((max_px, max_px))
    if im.mode not in ("RGB", "L"):
        background = Image.new("RGB", im.size, WHITE)
        background.paste(im, mask=im.convert("RGBA").split()[-1])
        im = background
    return im


def fit_image(pdf, path, x, y, box_w, box_h):
    """Draw the image centred inside the box, preserving aspect ratio."""
    im = load_image(path)
    scale = min(box_w / im.width, box_h / im.height)
    w, h = im.width * scale, im.height * scale
    pdf.image(im, x + (box_w - w) / 2, y + (box_h - h) / 2, w, h)


def cutout_image(path, bg, tolerance=38):
    """Product photo composited onto bg with its plain backdrop removed.

    Cover shots come in three kinds: true cutouts that already carry an alpha
    channel, studio shots on a plain white sweep, and ordinary photographs of
    a machine in a yard. Only the first two can sit directly on the dark cover.
    Returns None for the third so the caller can fall back to a light panel.
    """
    src = Image.open(path)
    if src.mode == "P":
        src = src.convert("RGBA")
    src.thumbnail((1600, 1600))

    if src.mode == "RGBA" and src.split()[-1].getextrema()[0] < 250:
        mask = src.split()[-1]
    else:
        src = src.convert("RGB")
        w, h = src.size
        corners = [(1, 1), (w - 2, 1), (1, h - 2), (w - 2, h - 2)]
        px = [src.getpixel(c) for c in corners]

        # A studio sweep meets all four corners in roughly one colour, whether
        # that is white, black or a green screen. A photograph of a machine in
        # a yard does not, and keying one would tear it apart.
        spread = max(max(p[i] for p in px) - min(p[i] for p in px) for i in range(3))
        if spread > 26:
            return None

        # Flood the backdrop from each corner with a colour no photo contains,
        # then keep everything the flood did not reach. Filling from the border
        # rather than thresholding on colour protects matching highlights and
        # lettering inside the machine itself.
        sentinel = (255, 0, 255)
        flood = src.copy()
        for c in corners:
            ImageDraw.floodfill(flood, c, sentinel, thresh=tolerance)

        r, g, b = flood.split()
        hit = ImageChops.multiply(
            ImageChops.multiply(r.point(lambda v: 255 if v == 255 else 0),
                                g.point(lambda v: 255 if v == 0 else 0)),
            b.point(lambda v: 255 if v == 255 else 0),
        )

        # If the flood escaped into the machine, or barely spread at all, the
        # backdrop was not uniform after all.
        covered = sum(hit.histogram()[128:]) / float(w * h)
        if not 0.05 < covered < 0.92:
            return None

        mask = ImageChops.invert(hit).filter(ImageFilter.GaussianBlur(0.8))

    flat = Image.new("RGB", src.size, bg)
    flat.paste(src.convert("RGB"), mask=mask)

    # Crop to the machine itself so no keyed-out margin is carried into the
    # page; any leftover border would show as a faint box on the dark cover.
    box = mask.point(lambda v: 255 if v > 8 else 0).getbbox()
    if box:
        flat = flat.crop(box)
    return flat


_logo_cache = {}


def logo_image(bg):
    """The logo flattened onto bg.

    The PNG is transparent, but photos are stored with the JPEG filter
    (set_image_filter("DCTDecode")), which has no alpha channel and would
    render the transparent area black. Compositing first keeps the logo clean
    on both the dark cover and the light interior pages.
    """
    if bg not in _logo_cache:
        src = Image.open(LOGO).convert("RGBA")
        src.thumbnail((1200, 1200))
        flat = Image.new("RGB", src.size, bg)
        flat.paste(src, mask=src.split()[-1])
        _logo_cache[bg] = flat
    return _logo_cache[bg]


_icon_map = None


def icon_char(name):
    """'fa-bolt' -> the glyph's character, or None if the site CSS lacks it."""
    global _icon_map
    if _icon_map is None:
        with open(ICON_CSS, encoding="utf-8") as fh:
            css = fh.read()
        _icon_map = {m[0]: chr(int(m[1], 16)) for m in
                     re.findall(r'\.(fa-[a-z0-9-]+)::?before\s*\{\s*content:\s*"\\([0-9a-f]+)"', css)}
    return _icon_map.get(name)


class MTCBrochure(FPDF):
    """A4 product brochure with a dark cover and a light interior."""

    def __init__(self, product_name=""):
        super().__init__()
        self.product_name = clean(product_name)
        self.on_cover = False
        self.set_image_filter("DCTDecode")   # store photos as JPEG
        self.set_title(f"{self.product_name} - Manual Tools Company")
        self.set_author("Manual Tools Company")
        self.set_creator("Manual Tools Company brochure generator")
        self.set_margins(MARGIN, HEADER_H + 8, MARGIN)
        self.set_auto_page_break(True, margin=24)

    # -- page furniture ---------------------------------------------------
    def header(self):
        # page 1 is the cover; fpdf draws the footer at page close, by which
        # point the on_cover flag is already cleared, so test the page number.
        if self.on_cover or self.page_no() == 1:
            return
        self.set_y(11)
        try:
            self.image(logo_image(WHITE), MARGIN, 7, 58)
        except Exception:
            self.set_font(FONT_FAMILY, "B", 11)
            self.set_text_color(*INK)
            self.text(MARGIN, 15, "MANUAL TOOLS COMPANY")

        if self.product_name:
            self.set_font(FONT_FAMILY, "", 8)
            self.set_text_color(*INK_SOFT)
            self.set_xy(PAGE_W / 2, 13)
            self.cell(PAGE_W / 2 - MARGIN, 5, self.product_name, align="R")

        self.set_draw_color(*RULE)
        self.set_line_width(0.2)
        self.line(MARGIN, HEADER_H, PAGE_W - MARGIN, HEADER_H)

    def footer(self):
        if self.on_cover or self.page_no() == 1:
            return
        self.set_draw_color(*RULE)
        self.set_line_width(0.2)
        self.line(MARGIN, FOOTER_Y, PAGE_W - MARGIN, FOOTER_Y)

        self.set_font(FONT_FAMILY, "", 7.5)
        self.set_text_color(*INK_SOFT)
        self.set_xy(MARGIN, FOOTER_Y + 2.5)
        self.cell(CONTENT_W / 2, 5, f"Manual Tools Company  |  {PLACE}")
        self.set_xy(MARGIN + CONTENT_W / 2, FOOTER_Y + 2.5)
        self.cell(CONTENT_W / 2, 5, f"{PHONE}   |   {SITE}   |   {self.page_no() - 1}", align="R")

    # -- primitives -------------------------------------------------------
    def label(self, text, x=None, y=None, color=RED):
        """Small letterspaced caps used above a block."""
        if x is not None:
            self.set_xy(x, y if y is not None else self.get_y())
        self.set_font(FONT_FAMILY, "B", 7.5)
        self.set_text_color(*color)
        self.set_char_spacing(1.1)
        self.cell(0, 4, clean(text).upper(), new_x="LMARGIN", new_y="NEXT")
        self.set_char_spacing(0)

    def section(self, title, gap_before=7):
        """Red letterspaced section label over a full-width hairline."""
        self.ln(gap_before)
        y = self.get_y()
        self.set_font(FONT_FAMILY, "B", 9)
        self.set_text_color(*RED)
        self.set_char_spacing(1.4)
        self.set_xy(MARGIN, y)
        self.cell(CONTENT_W, 6, clean(title).upper(), new_x="LMARGIN", new_y="NEXT")
        self.set_char_spacing(0)
        y2 = self.get_y()
        self.set_draw_color(*INK)
        self.set_line_width(0.5)
        self.line(MARGIN, y2, MARGIN + 18, y2)
        self.set_draw_color(*RULE)
        self.set_line_width(0.2)
        self.line(MARGIN + 18, y2, PAGE_W - MARGIN, y2)
        self.ln(4)

    def body(self, text, w=CONTENT_W, size=9.5, height=5, color=INK_BODY, x=None):
        if x is not None:
            self.set_x(x)
        self.set_font(FONT_FAMILY, "", size)
        self.set_text_color(*color)
        self.multi_cell(w, height, clean(text), new_x="LMARGIN", new_y="NEXT")

    def spec_table(self, rows, x, y, w, row_h=7.4):
        """Label/value rows with alternating banding. Returns the bottom y."""
        self.set_font(FONT_FAMILY, "", 8.5)
        label_w = w * 0.52
        for i, (name, value) in enumerate(rows):
            if i % 2 == 0:
                self.set_fill_color(*PANEL)
                self.rect(x, y, w, row_h, "F")
            self.set_xy(x + 2.5, y)
            self.set_font(FONT_FAMILY, "", 8.5)
            self.set_text_color(*INK_SOFT)
            self.cell(label_w, row_h, clean(name))
            self.set_xy(x + label_w, y)
            self.set_text_color(*INK)
            value_w = w - label_w - 2.5
            # Values are single-line, so shrink rather than overflow the column.
            size = 8.5
            self.set_font(FONT_FAMILY, "B", size)
            while size > 6.0 and self.get_string_width(clean(value)) > value_w - 1:
                size -= 0.25
                self.set_font(FONT_FAMILY, "B", size)
            self.cell(value_w, row_h, clean(value), align="R")
            y += row_h
        return y

    def feature_list(self, items, x, y, w, line_h=4.6):
        """Red tick + wrapped text. Returns the bottom y."""
        self.set_y(y)
        for item in items:
            top = self.get_y()
            self.set_draw_color(*RED)
            self.set_line_width(0.5)
            self.line(x + 0.5, top + 2.6, x + 1.9, top + 4.0)
            self.line(x + 1.9, top + 4.0, x + 4.3, top + 1.3)
            self.set_xy(x + 6.5, top)
            self.set_font(FONT_FAMILY, "", 8.5)
            self.set_text_color(*INK_BODY)
            self.multi_cell(w - 6.5, line_h, clean(item), new_x="LMARGIN", new_y="NEXT")
            self.set_y(self.get_y() + 2.2)
        return self.get_y()

    def key_specs(self, specs, y):
        """The product page's spec grid as one card: a red icon badge, a label
        and the figure for each spec. `specs` is [(icon, label, value)], read
        from product-data.php so the two cannot drift. Returns the bottom y."""
        if not specs:
            return y
        if "fasolid" not in self.fonts:
            self.add_font("FASolid", "", ICON_FONT)

        self.label("Key specifications", MARGIN, y)
        y += 6
        n = len(specs)
        h = 19.0
        cell_w = CONTENT_W / n
        self.set_draw_color(*RULE)
        self.set_line_width(0.25)
        self.set_fill_color(*WHITE)
        self.rect(MARGIN, y, CONTENT_W, h, "DF", round_corners=True, corner_radius=2.5)
        # red accent along the top edge, like the section rules
        self.set_fill_color(*RED)
        self.rect(MARGIN + 5, y, 14, 0.8, "F")

        badge = 8.0
        for i, (icon, label, value) in enumerate(specs):
            x = MARGIN + i * cell_w
            if i:
                self.set_draw_color(*RULE)
                self.set_line_width(0.2)
                self.line(x, y + 4, x, y + h - 4)
            bx, by = x + 4.5, y + (h - badge) / 2
            self.set_fill_color(*RED_TINT)
            self.rect(bx, by, badge, badge, "F", round_corners=True, corner_radius=1.6)
            glyph = icon_char(icon)
            if glyph:
                self.set_font("FASolid", "", 10)
                self.set_text_color(*RED)
                self.set_xy(bx, by)
                self.cell(badge, badge, glyph, align="C")

            tx = bx + badge + 3
            tw = x + cell_w - tx - 4.5
            self.set_xy(tx, y + 4.6)
            self.set_font(FONT_FAMILY, "", 6.5)
            self.set_text_color(*INK_SOFT)
            self.set_char_spacing(0.6)
            self.cell(tw, 3.6, clean(label).upper())
            self.set_char_spacing(0)
            # one line: shrink a long figure rather than wrap it
            size = 10.5
            self.set_font(FONT_FAMILY, "B", size)
            while size > 7.5 and self.get_string_width(clean(value)) > tw:
                size -= 0.25
                self.set_font(FONT_FAMILY, "B", size)
            self.set_text_color(*INK)
            self.set_xy(tx, y + 9.2)
            self.cell(tw, 5.5, clean(value))
        return y + h

    def stat_strip(self, stats, y, dark=False):
        """Three or four headline numbers in a row. Returns the bottom y."""
        if not stats:
            return y
        n = len(stats)
        cell_w = CONTENT_W / n
        for i, (value, caption) in enumerate(stats):
            x = MARGIN + i * cell_w
            if i:
                self.set_draw_color(*(INK_SOFT if dark else RULE))
                self.set_line_width(0.2)
                self.line(x, y + 1, x, y + 14)
            self.set_xy(x + (4 if i else 0), y)
            self.set_font(FONT_FAMILY, "B", 14)
            self.set_text_color(*(WHITE if dark else INK))
            self.cell(cell_w - 4, 7, clean(value), new_x="LMARGIN", new_y="NEXT")
            self.set_xy(x + (4 if i else 0), y + 7.5)
            self.set_font(FONT_FAMILY, "", 7)
            self.set_text_color(*(RULE if dark else INK_SOFT))
            self.set_char_spacing(0.8)
            self.cell(cell_w - 4, 4, clean(caption).upper())
            self.set_char_spacing(0)
        return y + 16

    # -- cover ------------------------------------------------------------
    def cover(self, title, subtitle, hero_image, stats=()):
        self.on_cover = True
        self.set_auto_page_break(False)
        self.add_page()

        # Dark field with a red spine on the left edge.
        self.set_fill_color(*INK)
        self.rect(0, 0, PAGE_W, PAGE_H, "F")
        self.set_fill_color(*RED)
        self.rect(0, 0, 4, PAGE_H, "F")

        try:
            self.image(logo_image(INK), MARGIN, 16, 80)
        except Exception:
            self.set_xy(MARGIN, 22)
            self.set_font(FONT_FAMILY, "B", 18)
            self.set_text_color(*WHITE)
            self.cell(0, 10, "MANUAL TOOLS COMPANY")

        self.set_xy(PAGE_W - MARGIN - 60, 24)
        self.set_font(FONT_FAMILY, "", 8)
        self.set_text_color(*INK_SOFT)
        self.set_char_spacing(1.0)
        self.cell(60, 5, "PRODUCT BROCHURE", align="R")
        self.set_char_spacing(0)

        # Hero photo. Where the backdrop can be keyed out the machine sits
        # straight on the dark cover; a photograph of a real scene keeps a
        # light panel instead, because keying one would tear it apart.
        panel_y, panel_h = 50.0, 108.0
        try:
            art = cutout_image(hero_image, INK)
        except Exception:
            art = None

        if art is not None:
            scale = min((CONTENT_W - 4) / art.width, panel_h / art.height)
            w, h = art.width * scale, art.height * scale
            # Lossless for this one image: JPEG ringing around the cut edge
            # would not match the flat cover colour and would read as a box.
            self.set_image_filter("FlateDecode")
            self.image(art, MARGIN + (CONTENT_W - w) / 2, panel_y + (panel_h - h) / 2, w, h)
            self.set_image_filter("DCTDecode")
        else:
            try:
                im = load_image(hero_image)
                pad = 5.0
                scale = min((CONTENT_W - 2 * pad) / im.width, (panel_h - 2 * pad) / im.height)
                w, h = im.width * scale, im.height * scale
                # Size the panel to the photo so it reads as a mount, not as a
                # white slab with a picture floating somewhere inside it.
                px = MARGIN + (CONTENT_W - w) / 2 - pad
                py = panel_y + (panel_h - h) / 2 - pad
                self.set_fill_color(*WHITE)
                self.rect(px, py, w + 2 * pad, h + 2 * pad, "F",
                          round_corners=True, corner_radius=2)
                self.image(im, px + pad, py + pad, w, h)
            except Exception:
                self.set_xy(MARGIN, panel_y + panel_h / 2)
                self.set_font(FONT_FAMILY, "I", 9)
                self.set_text_color(*INK_SOFT)
                self.cell(CONTENT_W, 5, "[ product image ]", align="C")

        # Title block.
        y = panel_y + panel_h + 24
        self.set_draw_color(*RED)
        self.set_line_width(1.2)
        self.line(MARGIN, y, MARGIN + 26, y)

        self.set_xy(MARGIN, y + 6)
        self.set_font(FONT_FAMILY, "B", 27)
        self.set_text_color(*WHITE)
        self.multi_cell(CONTENT_W, 11.5, clean(title).upper(), new_x="LMARGIN", new_y="NEXT")

        self.set_x(MARGIN)
        self.set_font(FONT_FAMILY, "", 10)
        self.set_text_color(*INK_SOFT)
        self.set_char_spacing(0.5)
        self.multi_cell(CONTENT_W, 5.5, clean(subtitle), new_x="LMARGIN", new_y="NEXT")
        self.set_char_spacing(0)

        # Headline specs above the contact rule.
        strip_y = PAGE_H - 62
        self.set_draw_color(70, 78, 88)
        self.set_line_width(0.2)
        self.line(MARGIN, strip_y - 6, PAGE_W - MARGIN, strip_y - 6)
        self.stat_strip(stats, strip_y, dark=True)

        try:
            badge = Image.open(BADGE).convert("RGBA")
            flat = Image.new("RGB", badge.size, INK)
            flat.paste(badge, mask=badge.split()[-1])
            self.image(flat, MARGIN, PAGE_H - 34, 34)
        except Exception:
            pass

        self.set_xy(PAGE_W - MARGIN - 110, PAGE_H - 30)
        self.set_font(FONT_FAMILY, "B", 9)
        self.set_text_color(*WHITE)
        self.cell(110, 5, clean(PROP), align="R", new_x="LMARGIN", new_y="NEXT")
        self.set_x(PAGE_W - MARGIN - 110)
        self.set_font(FONT_FAMILY, "", 8.5)
        self.set_text_color(*INK_SOFT)
        self.cell(110, 5, f"{PLACE}  |  {PHONE}", align="R", new_x="LMARGIN", new_y="NEXT")
        self.set_x(PAGE_W - MARGIN - 110)
        self.cell(110, 5, SITE, align="R")

        self.on_cover = False
        self.set_auto_page_break(True, margin=24)

    def product_index(self, items, y=None):
        """Two-column list of the other machines, for cross-selling."""
        if y is not None:
            self.set_y(y)
        y = self.get_y()
        rows = (len(items) + 1) // 2
        row_h = 9.5
        for i, (name, sub) in enumerate(items):
            col, row = divmod(i, rows)
            x = MARGIN + col * (COL_W + 10)
            ry = y + row * row_h
            self.set_draw_color(*RED)
            self.set_line_width(0.5)
            self.line(x, ry + 1.5, x, ry + 6.5)
            self.set_xy(x + 3.5, ry)
            self.set_font(FONT_FAMILY, "B", 8.5)
            self.set_text_color(*INK)
            self.cell(COL_W - 3.5, 4.4, clean(name), new_x="LMARGIN", new_y="NEXT")
            self.set_xy(x + 3.5, ry + 4.2)
            self.set_font(FONT_FAMILY, "", 8)
            self.set_text_color(*INK_SOFT)
            self.cell(COL_W - 3.5, 4.2, clean(sub))
        self.set_y(y + rows * row_h)
        return self.get_y()

    def buying_info(self, rows, y=None):
        """Panel of purchase terms. Same wording as the product pages."""
        if y is not None:
            self.set_y(y)
        y = self.get_y()
        row_h = 5.6
        h = 11 + row_h * len(rows)
        self.set_fill_color(*PANEL)
        self.rect(MARGIN, y, CONTENT_W, h, "F", round_corners=True, corner_radius=2)

        self.set_xy(MARGIN + 6, y + 4)
        self.set_font(FONT_FAMILY, "B", 7.5)
        self.set_text_color(*RED)
        self.set_char_spacing(1.1)
        self.cell(CONTENT_W - 12, 4, "BUYING INFORMATION", new_x="LMARGIN", new_y="NEXT")
        self.set_char_spacing(0)

        ry = y + 9.5
        for name, value in rows:
            self.set_xy(MARGIN + 6, ry)
            self.set_font(FONT_FAMILY, "B", 8.5)
            self.set_text_color(*INK)
            self.cell(30, row_h, clean(name))
            self.set_xy(MARGIN + 36, ry)
            self.set_font(FONT_FAMILY, "", 8.5)
            self.set_text_color(*INK_BODY)
            self.cell(CONTENT_W - 42, row_h, clean(value))
            ry += row_h

        self.set_y(y + h)
        return y + h

    # -- closing block ----------------------------------------------------
    def quote_block(self, y=None):
        """Dark 'request a quotation' panel pinned above the footer."""
        h = 26.0
        y = FOOTER_Y - h - 6 if y is None else y
        self.set_fill_color(*INK)
        self.rect(MARGIN, y, CONTENT_W, h, "F", round_corners=True, corner_radius=2)
        self.set_fill_color(*RED)
        self.rect(MARGIN, y, 2.5, h, "F")

        self.set_xy(MARGIN + 9, y + 5)
        self.set_font(FONT_FAMILY, "B", 7.5)
        self.set_text_color(*RED)
        self.set_char_spacing(1.1)
        self.cell(100, 4, "REQUEST A QUOTATION", new_x="LMARGIN", new_y="NEXT")
        self.set_char_spacing(0)
        self.set_xy(MARGIN + 9, y + 10.5)
        self.set_font(FONT_FAMILY, "B", 15)
        self.set_text_color(*WHITE)
        self.cell(100, 8, PHONE)

        self.set_xy(PAGE_W - MARGIN - 78, y + 8)
        self.set_font(FONT_FAMILY, "", 8.5)
        self.set_text_color(*RULE)
        self.cell(70, 5, "Custom sizes and capacities built to order.", align="R",
                  new_x="LMARGIN", new_y="NEXT")
        self.set_x(PAGE_W - MARGIN - 78)
        self.cell(70, 5, f"{SITE}  |  {PLACE}", align="R")
        return y + h

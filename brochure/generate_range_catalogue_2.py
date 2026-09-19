"""Build catalogue 2 of the full product range, laid out like the Honda
generator brochure as it is actually printed: a single-page cover, inside
pages that are double-page spreads printed on one sheet, and a single-page
back cover. Scaled up for Manual Tools Company:

    cover and back cover   A4 portrait  (210 x 297 mm)
    every inside sheet     A3 landscape (420 x 297 mm), a left and a right page

    python brochure/generate_range_catalogue_2.py            # PDF
    python brochure/generate_range_catalogue_2.py --html     # also keep the HTML

Run from the repo root. Output: brochure/Manual_Tools_Co_Catalogue_2.pdf

This is a separate script from generate_range_catalogue.py (catalogue 1, all
A4 pages); the two share no code and can be changed independently. Like
catalogue 1, all product copy comes from PRODUCTS in
generate_product_brochures.py and the four "Key specifications" per machine
from product-data.php, so neither catalogue can drift from the website.

What the spread format adds over catalogue 1: a cover with the whole range
lined up on a dark stage, and a photograph running across both pages of a
spread with a panel set over it (Honda's "Caravan & Camping" spread).

Pages are numbered as Honda numbers them, per page side: the cover is 1, the
first spread 2-3, and so on. Headless Chrome (or Edge) prints the mixed A4 /
A3 sheets into one PDF through CSS named pages.
"""
import html
import os
import re
import shutil
import subprocess
import sys
import tempfile
from pathlib import Path

from PIL import Image, ImageFilter

sys.path.insert(0, os.path.dirname(os.path.abspath(__file__)))
from generate_product_brochures import BUYING_INFO, PRODUCTS, site_specs  # noqa: E402

ROOT = Path.cwd()
OUT = ROOT / "brochure" / "Manual_Tools_Co_Catalogue_2.pdf"
FONTS = ROOT / "brochure" / "fonts"
FA_WOFF = ROOT / "assets" / "fontawesome" / "webfonts" / "fa-solid-900.woff2"
LOGO_SVG = ROOT / "assets" / "img" / "mtc-logo.svg"
FULL_LOGO_SVG = ROOT / "assets" / "img" / "mtc-logo-full.svg"
BADGE_30 = ROOT / "brochure" / "30yearss.png"
IMG = "assets/img/"
PIMG = IMG + "product-images/"

PHONE = "+91 9430707348"
PHONE_TEL = "+919430707348"
EMAIL = "manualtoolsco.dhn@gmail.com"
SITE = "www.manualtoolsco.com"
ADDRESS = "Bastacolla, P.O. Dhansar, Dhanbad – 828106, Jharkhand, India"

# Font Awesome 5.15.4 Solid code points. The woff2 in assets/ is the full
# font; only the site's CSS is subset, so any solid icon can be used here.
FA = {
    "fa-tachometer-alt": "f3fd", "fa-bolt": "f0e7", "fa-filter": "f0b0",
    "fa-arrow-down": "f063", "fa-arrow-up": "f062", "fa-ruler-horizontal": "f547",
    "fa-cogs": "f085", "fa-weight-hanging": "f5cd", "fa-truck-loading": "f4de",
    "fa-layer-group": "f5fd", "fa-ruler-combined": "f546", "fa-circle-notch": "f1ce",
    "fa-industry": "f275", "fa-truck-moving": "f4df", "fa-shield-alt": "f3ed",
    "fa-phone-alt": "f879", "fa-envelope": "f0e0", "fa-globe": "f0ac",
    "fa-map-marker-alt": "f3c5", "fa-hard-hat": "f807", "fa-tools": "f7d9",
    "fa-drafting-compass": "f568", "fa-certificate": "f0a3", "fa-history": "f1da",
    "fa-users-cog": "f4fe", "fa-wrench": "f0ad", "fa-fire": "f06d",
    "fa-headset": "f590", "fa-hammer": "f6e3", "fa-check": "f00c",
}

# Product keys (as in PRODUCTS) -> short names used in charts and the selector.
SHORT = {
    "coal-crusher-single": "Coal Crusher<br>Single Disc",
    "coal-crusher-double": "Coal Crusher<br>Double Disc",
    "coke-cutter-double-drive": "Coke Cutter<br>Drum Type",
    "coke-cutter-ring-type": "Coke Cutter<br>Ring Type",
    "vibrator-screen": "Vibrator<br>Screen",
    "pusher": "Pusher<br>Machine",
    "charging-car": "Coal Charging<br>Car",
    "power-winch": "Door Lifting<br>Power Winch",
    "haulage": "Haulage<br>Machine",
}

CUTOUT = {
    "coal-crusher-single": IMG + "slide/Coal-Crusher.png",
    "coal-crusher-double": IMG + "slide/Coal-Crusher-Double-disc.png",
    "coke-cutter-double-drive": IMG + "slide/Coke-Cutter-Machine.png",
    "coke-cutter-ring-type": IMG + "slide/Coke-Cutter-Machine-Ring-Type.png",
    "haulage": IMG + "slide/Haulage-Machine.png",
    "power-winch": IMG + "slide/Power-Winch.png",
    "vibrator-screen": PIMG + "vibrator-screen/Vibrator-Screen-3.png",
    "pusher": IMG + "slide/Pusher-with-stamping-arrangement.png",
    "charging-car": IMG + "slide/Coal-Charging-Car.png",
    "conveyor-materials": IMG + "slide/Conveyor-Materials.png",
}

# Hero spreads. `photo` is either a real photograph cropped to the frame
# (crop = fractions x0, y0, x1, y1 of the source) or a cutout staged on a dark
# backdrop. Call-outs carry a marker position (fractions of the frame) only
# where the part can actually be seen in that picture.
HEROES = [
    {
        "key": "pusher",
        "category": "Pushing &amp;<br>Stamping",
        "photo": {"src": PIMG + "pusher-machine-with-stamping-arrangement/pusher-1.png",
                  "crop": (0.12, 0.06, 0.88, 1.0)},
        "callouts": [
            ("Pusher beam", "A 20 m heavy fabricated beam, driven by the 40 H.P. main motor "
             "through a helical gearbox and chain drive, rams the finished coke out of the oven.", None),
            ("Roller stamping", "The 7.5 H.P. roller stamping system compacts coal fines into a "
             "high-density cake: faster and lower-maintenance than drop-hammer systems.", None),
            ("Leveller beam", "A 20 m rack and pinion leveller beam, for ovens up to 11 m long. "
             "Custom lengths are available.", None),
            ("Long travel", "A 15 H.P. drive moves the machine on rails along the battery to line "
             "up with each oven.", None),
        ],
    },
    {
        "key": "charging-car",
        "category": "Top<br>Charging",
        "photo": {"src": PIMG + "coal-charging-car/coal-charging-car-3.jpg",
                  "crop": (0.10, 0.0, 0.86, 1.0)},
        "callouts": [
            ("Conical hoppers", "Two, three or four 8 mm plate hoppers, in 8, 15 or 20 ton "
             "capacities. The steep "
             "cones help wet coal flow.", None),
            ("Motorised slide gates", "3 H.P. slide gates open to let coal fall into the oven by "
             "gravity, with a manual override wheel.", None),
            ("Rail travel", "Track wheels driven by a 15 H.P. motor through a worm reducer, at "
             "60 - 80 m/min.", None),
            ("Telescopic sleeves", "They line up with the charging holes and limit smoke leakage "
             "while the oven is charged.", None),
        ],
    },
    {
        "key": "coal-crusher-single",
        "category": "Coal<br>Crushing",
        "photo": {"cutout": CUTOUT["coal-crusher-single"]},
        "callouts": [
            ("Mild steel hammers", "Six hammers throw the coal against manganese steel liner "
             "plates. They are replaced through the side access door without dismantling the "
             "rotor.", None),
            ("Single-side feeding mouth", "Takes coal lumps up to 150 mm straight from the "
             "conveyor into the crushing chamber.", None),
            ("Spherical roller bearings", "Double row spherical roller bearings carry the rotor "
             "shaft.", None),
            ("Extra-wide disc", "Keeps the output size uniform, below 2 mm, across the full "
             "8 - 12 TPH range.", None),
        ],
    },
    {
        "key": "coal-crusher-double",
        "category": "Coal<br>Crushing",
        "photo": {"cutout": CUTOUT["coal-crusher-double"]},
        "callouts": [
            ("Double disc rotor", "Two discs fitted with 12 mild steel hammers, creating "
             "a dense impact zone for 20 - 25 TPH.", None),
            ("Replaceable hammers", "Each hammer can be replaced or reversed.", None),
            ("16 mm fabricated housing", "Heavy steel body built to take the impact of lumps "
             "up to 200 mm.", None),
            ("Manganese steel liner jaw plates", "Bolted top and side plates take the wear "
             "instead of the body, and are swapped without cutting.", None),
        ],
    },
    {
        "key": "coke-cutter-double-drive",
        "category": "Coke<br>Cutting",
        # AI-rendered from the machine photo; kept outside product-images so the
        # website gallery does not pick it up.
        "photo": {"cutout": "brochure/images/coke-cutter-drum-render.png"},
        "callouts": [
            ("Feed hopper", "Coke lumps up to 200 mm are delivered by conveyor straight into the "
             "intake hopper.", None),
            ("Double drive", "Two 20 H.P. motors drive the cutting drums from both ends: "
             "balanced torque, no jamming.", None),
            ("Cast steel gears", "Machine-cut cast steel gears on both sides of the drums.", None),
            ("Adjustable drums", "Drum distance adjusts by up to 30 mm, setting the output "
             "between 40 mm and 60 mm.", None),
        ],
    },
    {
        "key": "coke-cutter-ring-type",
        "category": "Coke<br>Cutting",
        "photo": {"cutout": CUTOUT["coke-cutter-ring-type"]},
        "callouts": [
            ("Segmented toothed rings", "Rings are keyed to the shaft one by one, so a damaged "
             "section is replaced on its own instead of relining the whole drum.", None),
            ("High manganese steel", "The rings work-harden in use and stand up to abrasive "
             "metallurgical coke.", None),
            ("Double drive", "Two 25 H.P. motors give equal torque on both ends of the cutting "
             "shaft, preventing jamming on large or hard lumps and extending gear life.", None),
            ("Adjustable gap", "The gap between the ring shafts adjusts from 40 mm to 60 mm.", None),
        ],
    },
    {
        "key": "vibrator-screen",
        "category": "Screening &amp;<br>Grading",
        "photo": {"cutout": CUTOUT["vibrator-screen"]},
        "callouts": [
            ("Eccentric shaft", "An eccentric shaft mechanism gives strong vibration and high "
             "screening efficiency.", None),
            ("1 to 4 decks", "Each deck discharges its own size grade: a 3-deck machine gives 4 "
             "output sizes (oversize + 3 grades).", None),
            ("Interchangeable mesh", "High carbon steel wire mesh in different aperture sizes "
             "changes the output size.", None),
            ("Adjustable amplitude", "Changing the counterweights on the flywheels / eccentric "
             "shaft adjusts the vibration. Heavy coil springs carry the screen.", None),
        ],
    },
    {
        "key": "power-winch",
        "category": "Door<br>Lifting",
        "photo": {"cutout": CUTOUT["power-winch"]},
        "callouts": [
            ("Worm reducer gearbox", "A high reduction ratio in a single compact stage, so a "
             "5 - 7.5 H.P. motor lifts up to 5 tons.", None),
            ("Gears", "The worm gearing cuts speed and multiplies "
             "torque for a smooth, non-jerky lift at about 2 - 4 m/min.", None),
            ("Grooved steel drum / steel drum", "Winds the wire rope evenly. A standard rope length is included; "
             "length and diameter can be customised.", None),
        ],
    },
    {
        "key": "haulage",
        "category": "Haulage &amp;<br>Pulling",
        # The owner's own high-resolution transparent cut-out (assets/img/slide),
        # the same one the site and the covers use.
        "photo": {"cutout": CUTOUT["haulage"]},
        "callouts": [
            ("Worm reducer gearbox", "A high-torque, non-reversible worm drive: the gear action "
             "helps prevent the load slipping back.", None),
            ("Cast steel gears", "Machine-cut cast steel gears for a steady 10-ton horizontal "
             "pull.", None),
            ("MS Channel base frame", "A fabricated MS Channel steel base, with a manual or "
             "electro-hydraulic thruster brake as an option.", None),
            ("Pulling, not lifting", "Designed for horizontal pulling or inclined dragging, not "
             "as a vertical lifting hoist.", None),
        ],
    },
    {
        "key": "conveyor-materials",
        "category": "Belt<br>Conveying",
        "photo": {"cutout": CUTOUT["conveyor-materials"]},
        "callouts": [
            ("Carrying idlers", "30 degree troughing sets shape the belt into a trough so it holds "
             "its load.", None),
            ("Impact rollers", "Rubber rings absorb the shock of falling lumps at hopper loading "
             "points.", None),
            ("Return rollers", "A smooth surface supports the empty underside of the belt without "
             "wearing it.", None),
            ("Head and tail pulleys", "Plain steel or rubber lagged (diamond groove or plain) for "
             "traction in wet conditions, with key-based locking assemblies.", None),
        ],
    },
]

CHART_OVEN = {
    "title": "Coke oven &amp; handling machines",
    "cols": ["pusher", "charging-car", "power-winch", "haulage"],
    "groups": [
        ("Duty", [
            ("Job", ["Pushes coke, stamps the coal cake", "Top-charges coal into ovens",
                     "Lifts oven doors", "Horizontal pulling"]),
            ("Capacity", ["Ovens up to 11 m", "8 / 15 / 20 T hopper", "2.5 - 5 T lift", "10 T pull"]),
            ("Speed", ["-", "60 - 80 m/min travel", "2 - 4 m/min lift", "-"]),
        ]),
        ("Drive", [
            ("Main motor", ["40 H.P. pusher", "15 H.P. travel", "5 - 7.5 H.P.", "10 H.P., 440 V"]),
            ("Other drives", ["15 H.P. travel, 7.5 H.P. stamping", "3 H.P. slide gates", "-", "-"]),
            ("Connected load", ["Approx. 65 - 70 H.P.", "-", "-", "-"]),
            ("Gearbox", ["Helical, with chain drive", "Worm reducer (travel)",
                         "Worm reducer gearbox", "Heavy duty worm reducer"]),
            ("Brake", ["-", "-", "-", "Manual or thruster (optional)"]),
        ]),
        ("Build", [
            ("Mounting", ["Rail-mounted", "Rail-mounted", "Fixed base", "MS Channel base frame"]),
            ("Main parts", ["20 m pusher and leveller beams", "2, 3 or 4 conical hoppers, 8 mm plate",
                            "Grooved steel drum / steel drum", "Cast steel, machine-cut gears"]),
        ]),
    ],
}

CHART_SIZING = {
    "title": "Crushing, cutting &amp; screening",
    "cols": ["coal-crusher-single", "coal-crusher-double", "coke-cutter-double-drive",
             "coke-cutter-ring-type", "vibrator-screen"],
    "groups": [
        ("Performance", [
            ("Capacity", ["8 - 12 TPH", "20 - 25 TPH", "12 - 15 TPH", "15 - 20 TPH", "1 - 4 decks"]),
            ("Feed size", ["Up to 150 mm", "Up to 200 mm", "Up to 200 mm", "Up to 200 mm", "Mixed feed"]),
            ("Output size", ["Below 2 mm", "Below 2 mm", "40 - 60 mm", "40 - 60 mm",
                             "One grade per deck"]),
            ("Material", ["Coal", "Coal", "Coke", "Coke", "Coke, coal, ore"]),
        ]),
        ("Drive", [
            ("Motor", ["80 - 120 H.P.", "150 - 180 H.P.", "20 H.P. x 2", "25 H.P. x 2", "7.5 - 15 H.P."]),
            ("Drive", ["Single disc", "Double disc", "Double drive", "Double drive", "Eccentric shaft"]),
            ("Adjustment", ["-", "-", "Drum distance, up to 30 mm", "Ring gap, 40 - 60 mm",
                            "Mesh and counterweights"]),
        ]),
        ("Build", [
            ("Wear parts", ["6 mild steel hammers", "12 mild steel hammers",
                            "Manganese steel liner teeth", "High manganese steel rings",
                            "High carbon steel mesh"]),
            ("Body", ["12 mm fabricated steel", "16 mm fabricated steel", "Cast steel gears both sides",
                      "Segmented rings, keyed", "Coil spring suspension"]),
        ]),
    ],
}

SELECTOR = [
    ("Coal preparation", [
        ("coal-crusher-single", "8 - 12 TPH, coal to below 2 mm"),
        ("coal-crusher-double", "20 - 25 TPH, coal to below 2 mm"),
    ]),
    ("Coke sizing &amp; screening", [
        ("coke-cutter-double-drive", "12 - 15 TPH, coke to 40 - 60 mm"),
        ("coke-cutter-ring-type", "15 - 20 TPH, coke to 40 - 60 mm"),
        ("vibrator-screen", "1 - 4 decks, up to 5' x 16'"),
    ]),
    ("Oven operation", [
        ("pusher", "Ovens up to 11 m, roller stamping"),
        ("charging-car", "8 - 20 T hopper, 2, 3 or 4 mouths"),
        ("power-winch", "2.5 - 5 T door lift"),
    ]),
    ("Material handling", [
        ("haulage", "10 T horizontal pull"),
        ("conveyor-materials", "Belts 600 - 1400 mm"),
    ]),
]

SPARES = [
    ("Crusher hammers", PIMG + "coal-crusher-double-disc/coal-crusher-6.png",
     "Mild steel hammers, replaced through the side access door without dismantling the rotor.",
     "Coal crushers: 6 per single disc, 12 per double disc"),
    ("Crusher rotors", PIMG + "coal-crusher-double-disc/coal-crusher-7.png",
     "Disc rotors that carry the hammers, built to the same drawings as the machine.",
     "Coal crushers, single and double disc"),
    ("Toothed cutter rings", PIMG + "coke-cutter-ring-teeth/6.png",
     "High manganese steel rings, keyed to the shaft one by one, so a damaged section is "
     "replaced on its own.",
     "Ring type coke cutter"),
    ("Idlers &amp; rollers", PIMG + "conveyor-materials/Conveyor-9.png",
     "Seamless steel pipe on EN-8 bright steel shafts, running on sealed ball bearings "
     "(6204, 6205, 6305).",
     "Belt widths 600 - 1400 mm"),
    ("Head &amp; tail pulleys", PIMG + "conveyor-materials/Conveyor-7.png",
     "Plain steel face or rubber lagged (diamond groove or plain), with key-based locking "
     "assemblies.",
     "Belt conveyors"),
    ("Travel wheel sets", PIMG + "pusher-machine-with-stamping-arrangement/pusher-5.png",
     "Flanged wheels on machined axles for machines that run on rails along the battery.",
     "Rail-mounted oven machines"),
]

CLIENTS = [
    "Akash Coke Industries", "Brahma Refractories", "Jindal Saw IPU", "Kalimati Metalik",
    "Krishna Coke (India)", "Krishna Hydrocarbon", "Mahalaxmi Group", "Metalik Fuel",
    "Narsingh Ispat", "Nilachal Carbo Metalicks", "Ramco Cement", "Saurashtra Fuels",
    "SBQ Steel", "Shree Satya Group", "Simplex Coke &amp; Refractory", "Su Mangala Coke",
    "Surya Cement Udyog", "Vivan Overseas", "C.I. Milpa S.A. (international)",
]


# --- text helpers ----------------------------------------------------------

def nice(text):
    """Typographic dashes and multiplication signs for copy written in ASCII."""
    text = re.sub(r"(?<=\w) - (?=\w)", " – ", text)
    text = re.sub(r"(?<=[\d'.PH]) ?x ?(?=[\d])", " × ", text)
    return text


def t(text):
    """Escape plain copy, then typeset it. Copy that already holds markup
    (&amp; or <br>) goes through nice() only."""
    if "&amp;" in text or "<br>" in text:
        return nice(text)
    return nice(html.escape(text))


def icon(name, cls="ico"):
    return f'<i class="{cls}">&#x{FA[name]};</i>'


def title_of(key):
    p = PRODUCTS[key]
    return p["title"]


# --- images ----------------------------------------------------------------

class Images:
    """Writes downsized copies into the build folder so the PDF stays small."""

    def __init__(self, build):
        self.build = build
        self.n = 0

    def _name(self, ext):
        self.n += 1
        return f"img{self.n:02d}.{ext}"

    def photo(self, src, crop=None, ratio=None, max_px=2000, bg=(255, 255, 255)):
        im = Image.open(src)
        if im.mode in ("P", "LA") or (im.mode == "RGBA"):
            im = im.convert("RGBA")
            flat = Image.new("RGB", im.size, bg)
            flat.paste(im, mask=im.split()[-1])
            im = flat
        im = im.convert("RGB")
        if crop:
            w, h = im.size
            box = [crop[0] * w, crop[1] * h, crop[2] * w, crop[3] * h]
            if ratio:
                # Trim the crop box to the frame's aspect ratio, keeping its centre.
                bw, bh = box[2] - box[0], box[3] - box[1]
                if bw / bh > ratio:
                    nw = bh * ratio
                    cx = (box[0] + box[2]) / 2
                    box[0], box[2] = cx - nw / 2, cx + nw / 2
                else:
                    nh = bw / ratio
                    cy = (box[1] + box[3]) / 2
                    box[1], box[3] = cy - nh / 2, cy + nh / 2
            im = im.crop(tuple(int(round(v)) for v in box))
        im.thumbnail((max_px, max_px), Image.LANCZOS)
        name = self._name("jpg")
        im.save(self.build / name, quality=86, optimize=True, progressive=True)
        return name

    def cutout(self, src, max_px=1600, bg=None):
        """Product cutout, trimmed to the machine. Kept transparent (PNG) for
        the gradient stage; flattened to JPEG on a known flat background,
        which keeps the PDF several megabytes lighter."""
        im = Image.open(src).convert("RGBA")
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
        return name, im.width / im.height

    def keyed(self, src, max_px=1600):
        """A studio shot on a plain pale backdrop, cut out by colour
        saturation: the machines are saturated blue and red, the backdrop
        and floor are near-grey. Returns (file, aspect ratio) like cutout()."""
        import numpy as np
        im = Image.open(src).convert("RGB")
        a = np.asarray(im).astype(float) / 255
        mx, mn = a.max(2), a.min(2)
        sat = (mx - mn) / np.maximum(mx, 1e-6)
        from scipy import ndimage as ndi
        m = (sat > 0.5) | ((mx < 0.25) & (sat > 0.2))
        # Pale highlights on the machine (the gearbox top, lit edges) are
        # less saturated; take them where they touch the machine.
        m |= (sat > 0.22) & ndi.binary_dilation(m, iterations=6)
        # Seal hairline notches, then fill enclosed holes that are too small
        # to be real openings. The large gaps inside the base frame stay
        # see-through.
        m = ndi.binary_closing(m, structure=np.ones((9, 9)))
        lab, count = ndi.label(~m)
        border = set(np.unique(np.concatenate([lab[0], lab[-1], lab[:, 0], lab[:, -1]])))
        sizes = ndi.sum(np.ones_like(lab), lab, range(1, count + 1))
        for i, size in enumerate(sizes, 1):
            if i not in border and size < 0.004 * m.size:
                m[lab == i] = True
        mask = Image.fromarray((m * 255).astype(np.uint8)).filter(ImageFilter.GaussianBlur(1))
        im.putalpha(mask)
        im = im.crop(mask.point(lambda v: 255 if v > 128 else 0).getbbox())
        im.thumbnail((max_px, max_px), Image.LANCZOS)
        name = self._name("png")
        im.save(self.build / name, optimize=True)
        return name, im.width / im.height

    def lineup(self, rows, size=(2600, 1733), margin=0.05,
               top=(238, 240, 243), bottom=(204, 209, 215), shade=(70, 78, 88)):
        """Machines standing on a light studio floor, in rows for depth.

        rows: (floor line, height, [product keys]) or (..., row margin),
        floor and height as fractions of the canvas height, listed back row
        first. Each row is spread evenly across the width with equal gaps
        (shrunk if it would not fit), so no two machines touch. A row margin
        pulls a short row in from the edges, for a staggered line-up.
        """
        from PIL import ImageDraw
        W, H = size
        canvas = Image.new("RGB", (W, H))
        for y in range(H):
            f = y / (H - 1)
            c = tuple(int(top[i] + (bottom[i] - top[i]) * f) for i in range(3))
            canvas.paste(c, (0, y, W, y + 1))
        for row in rows:
            floor_f, height, keys = row[:3]
            row_margin = row[3] if len(row) > 3 else margin
            span = W * (1 - 2 * row_margin)
            # a key may be (key, scale) to draw one machine larger or smaller
            # than the rest of its row
            items = [k if isinstance(k, tuple) else (k, 1.0) for k in keys]
            ims = []
            for key, _scale in items:
                im = Image.open(CUTOUT[key]).convert("RGBA")
                ims.append(im.crop(im.split()[-1].point(lambda v: 255 if v > 8 else 0).getbbox()))
            scales = [sc for _k, sc in items]
            h = height * H
            widths = [im.width * h * sc / im.height for im, sc in zip(ims, scales)]
            min_gap = W * 0.04
            fit = min(1.0, (span - min_gap * (len(ims) - 1)) / sum(widths))
            h *= fit
            widths = [w * fit for w in widths]
            gap = (span - sum(widths)) / max(1, len(ims) - 1) if len(ims) > 1 else 0
            x = W * row_margin if len(ims) > 1 else (W - widths[0]) / 2
            floor = int(floor_f * H)
            for im, w, sc in zip(ims, widths, scales):
                ih = h * sc
                im = im.resize((int(w), int(ih)), Image.LANCZOS)
                shadow = Image.new("L", (W, H), 0)
                ImageDraw.Draw(shadow).ellipse(
                    [x + w * 0.03, floor - ih * 0.045, x + w * 0.97, floor + ih * 0.045], fill=130)
                canvas.paste(shade, (0, 0), shadow.filter(ImageFilter.GaussianBlur(20)))
                canvas.paste(im, (int(x), floor - im.height), im)
                x += w + gap
        name = self._name("jpg")
        canvas.save(self.build / name, quality=88)
        return name


# --- page parts ------------------------------------------------------------

def logo_svg(badge="#FFFFFF", mark="#D40000"):
    svg = LOGO_SVG.read_text(encoding="utf-8")
    svg = re.sub(r"<metadata>.*?</metadata>", "", svg, flags=re.S)
    svg = re.sub(r"<title>.*?</title>", "", svg, flags=re.S)
    svg = re.sub(r"<!--.*?-->", "", svg, flags=re.S)
    svg = svg.replace('fill="#FF0000"', 'fill="BADGE"').replace('"#FFFFFF"', '"MARK"')
    svg = svg.replace("BADGE", badge).replace("MARK", mark)
    svg = re.sub(r'\swidth="256" height="256"', "", svg)
    return svg

def full_logo_svg(badge="#FFFFFF", mark="#D40000", words="#FFFFFF"):
    """The full logo (badge, name and tagline, all outlines), recoloured for
    the red logo box: in the file the badge disc and the lettering are red
    and the badge's ring and MTC letters are white."""
    svg = FULL_LOGO_SVG.read_text(encoding="utf-8")
    svg = re.sub(r"<metadata>.*?</metadata>", "", svg, flags=re.S)
    svg = re.sub(r"<title>.*?</title>", "", svg, flags=re.S)
    svg = re.sub(r"<!--.*?-->", "", svg, flags=re.S)
    svg = svg.replace('"#FFFFFF"', '"MARK"')
    # first red fill is the badge disc, second the name and tagline
    svg = svg.replace('fill="#FF0000"', 'fill="BADGE"', 1).replace('fill="#FF0000"', 'fill="WORDS"', 1)
    svg = svg.replace("BADGE", badge).replace("WORDS", words).replace("MARK", mark)
    svg = re.sub(r'\swidth="1600" height="260"', "", svg)
    return svg


def folio(n, dark=False):
    side = "l" if n % 2 == 0 else "r"
    cls = f"folio folio-{side}" + (" on-dark" if dark else "")
    return f'<div class="{cls}">{n} &nbsp;|&nbsp; {SITE}</div>'


def icon_row(key, dark=False, extra=True):
    items = [(ic, value, label) for ic, label, value in site_specs(key)]
    if extra:
        items.append(("fa-shield-alt", "1 Year", "Warranty"))
    cells = "".join(
        f'<div class="ir-cell">{icon(ic if ic in FA else "fa-cogs")}'
        f'<b>{t(value)}</b><span>{t(label)}</span></div>'
        for ic, value, label in items)
    return f'<div class="icon-row{" dark" if dark else ""}">{cells}</div>'


def bullets(items, cls="bul"):
    return f'<ul class="{cls}">' + "".join(f"<li>{t(i)}</li>" for i in items) + "</ul>"


# --- pages -----------------------------------------------------------------

def page_cover(img):
    # Honda's cover is the whole range lined up in one picture; here every
    # machine stands on a dark stage, long oven machines at the back.
    art = img.lineup([
        (0.30, 0.15, [("pusher", 1.45), "charging-car"], 0.05),
        (0.53, 0.18, ["vibrator-screen", ("conveyor-materials", 0.7), "haulage"]),
        (0.76, 0.20, ["coke-cutter-ring-type", "power-winch"], 0.24),
        (0.985, 0.23, ["coal-crusher-single", "coal-crusher-double", "coke-cutter-double-drive"]),
    ], size=(2600, 2080), top=(20, 27, 36), bottom=(52, 63, 76), shade=(0, 0, 0))
    lines = ["Coal crushers", "Coke cutters", "Vibrator screens", "Pusher machines",
             "Charging cars", "Power winches", "Haulages", "Conveyor parts"]
    return f"""
<section class="page sheet-a4 cover">
  <img class="cover-art" src="{art}" alt="">
  <div class="cover-glow"></div>
  <div class="logo-box">
    <div class="logo-full">{full_logo_svg()}</div>
  </div>
  <div class="cover-title">
    <div class="cover-tag"><span>PRODUCT RANGE</span></div>
    <h1>BUILT FOR THE<br>COKE OVEN</h1>
    <p class="cover-list">{" &nbsp;·&nbsp; ".join(lines)}</p>
    <img class="years-badge" src="{BADGE_30.as_uri()}" alt="30+ years of excellence">
  </div>
  <div class="cover-foot">
    <span>Dhanbad, Jharkhand &nbsp;·&nbsp; Since 1995 &nbsp;·&nbsp; ISO 9001:2015 certified</span>
    <span>{SITE}</span>
  </div>
</section>"""


def page_intro_left(img, n):
    photo = img.lineup([
        # all ten machines: the long, low oven machines at the back,
        # the compact ones in front
        (0.285, 0.15, ["pusher", "charging-car", "conveyor-materials"]),
        (0.585, 0.22, ["vibrator-screen", "coke-cutter-ring-type", "haulage"]),
        (0.93, 0.26, ["coal-crusher-single", "coal-crusher-double",
                      "coke-cutter-double-drive", "power-winch"]),
    ])
    steps = [
        ("Tell us about<br>your plant",
         "What material do you handle, coal or coke? Which stage of the plant is the machine "
         "for: crushing, sizing, screening, charging, pushing or hauling? And how many tons "
         "per hour must it handle?"),
        ("Match the<br>capacity",
         "Use the machine selector opposite and the specification charts to shortlist a model "
         "by capacity, feed size, output size and motor power. Allow for the wettest, hardest "
         "material you expect, not the average."),
        ("We build it<br>to order",
         "Every machine is fabricated in our Dhanbad workshop, with capacity, motor power and "
         "dimensions matched to your plant and drawings. Installation supervision and "
         "commissioning are available."),
    ]
    cols = "".join(
        f'<div class="step"><div class="step-h"><span class="step-n">{i}.</span>'
        f'<b>{h}</b></div><p>{t(b)}</p></div>' for i, (h, b) in enumerate(steps, 1))
    return f"""
<section class="page intro-l">
  <img class="intro-photo" src="{photo}" alt="">
  <div class="pad">
    <h2 class="red-h">3 STEPS TO THE<br>RIGHT MACHINE</h2>
    <div class="steps">{cols}</div>
    <p class="unsure">Not sure which machine fits? Call us on {PHONE} and talk it through with
    the people who build it.</p>
  </div>
  {folio(n)}
</section>"""


def page_intro_right(n):
    rows = []
    for group, items in SELECTOR:
        rows.append(f'<tr class="grp"><td colspan="2">{group}</td></tr>')
        for key, what in items:
            rows.append(
                f'<tr><td>{t(title_of(key))}'
                f'<small>{t(PRODUCTS[key]["subtitle"])}</small></td>'
                f'<td class="c">{t(what)}</td></tr>')
    facts = [("Years experience", "30+"), ("Happy clients", "150+"),
             ("Projects done", "500+"), ("Experienced staff", "15+")]
    fact_rows = "".join(f"<tr><td>{a}</td><td>{b}</td></tr>" for a, b in facts)
    return f"""
<section class="page intro-r">
  <div class="pad">
    <p class="lede">Manual Tools Company has built heavy-duty coke oven machinery in Dhanbad
    since 1995. Coke, steel, refractory and cement companies across India, and abroad, run
    our crushers, cutters, screens and oven machines.</p>
    <p class="body">Founded by the late Shobha Ram Agarwal and run today by Ravindra Kr.
    Agarwal, we design and fabricate every machine in our own workshop at Bastacolla,
    Dhansar. The liners, teeth and rings that take the wear are manganese steel; the parts
    that carry the load are cast
    steel gears and worm reducers. We also supervise installation, commission the machine
    and supply its spare parts.</p>
    <div class="sel-wrap">
      <div class="sel-main">
        <h3 class="grey-h">MACHINE SELECTOR</h3>
        <table class="sel">
          <thead><tr><th>Machine</th><th>Duty</th></tr></thead>
          <tbody>{"".join(rows)}</tbody>
        </table>
      </div>
      <div class="sel-side">
        <table class="facts">
          <thead><tr><th colspan="2">At a glance</th></tr></thead>
          <tbody>{fact_rows}</tbody>
        </table>
        <div class="iso">{icon("fa-certificate")}<b>ISO 9001:2015</b><span>certified quality
        management</span></div>
      </div>
    </div>
    <p class="fine">Figures are typical. Every machine is built to order, so final figures are
    confirmed on the quotation.</p>
  </div>
  {folio(n)}
</section>"""


def page_engineering_left(n):
    return f"""
<section class="page eng-l">
  <div class="pad">
    <h2 class="red-h">BUILT FOR<br>COKE OVEN DUTY</h2>
    <h3 class="grey-h big">WEAR PARTS &amp; DRIVES</h3>
    <p class="body">Coal and coke are abrasive, and oven machines work next to heat and dust.
    Our machines separate the two jobs: the parts that take the wear are made to be worn and
    replaced, and the parts that carry the load are made to last the life of the machine.</p>
    <p class="body">The following will help you understand the terms used for each machine in
    this catalogue.</p>
    <div class="grey-box">
      <div class="gb-h">{icon("fa-hammer", "ico box-ico")}<b>MANGANESE STEEL</b></div>
      <p>Crusher liner plates, cutter teeth and toothed rings are high manganese steel, which
      work-hardens as it is struck. It stands up to abrasive metallurgical coke, and each
      wearing part is replaceable on its own. Crusher hammers are mild steel, replaced
      through the side access door when worn.</p>
      <div class="gb-h">{icon("fa-cogs", "ico box-ico")}<b>DRIVES</b></div>
      <p><b>Worm reducer</b> – a gearbox whose worm cannot be driven backwards by the load,
      so a lifted door or a loaded wagon cannot run back if the power fails.</p>
      <p><b>Double drive</b> – a motor on each end of the cutting shaft for equal torque, so
      hard or large lumps do not jam the drums, and the gears last longer.</p>
      <p><b>Cast steel gears</b> – machine-cut gears on haulages, winches and coke cutters.</p>
      <div class="gb-h">{icon("fa-industry", "ico box-ico")}<b>FABRICATION</b></div>
      <p>Bodies and frames are fabricated from heavy steel: 12 and 16 mm plate on the coal crushers,
      8 mm plate on the charging car hoppers, MS Channel base frames under the haulages, and
      heavy coil springs under the vibrator screens.</p>
    </div>
  </div>
  {folio(n)}
</section>"""


def page_photo(img, n, src, crop, title, caption):
    photo = img.photo(src, crop=crop, ratio=210 / 297, max_px=2400)
    return f"""
<section class="page full-photo">
  <img src="{photo}" alt="">
  <div class="fp-shade"></div>
  <h2 class="photo-h">{title}</h2>
  <p class="fp-cap">{caption}</p>
  {folio(n, dark=True)}
</section>"""


def spread_battery(img, n):
    """A photograph across both pages of the spread, with a white panel set
    over its lower left corner, like Honda's "Caravan & Camping" spread."""
    photo = img.photo(PIMG + "pusher-machine-with-stamping-arrangement/pusher-1.webp",
                      crop=(0.0, 0.0, 1.0, 1.0), ratio=420 / 297, max_px=3000)
    rows = [
        ("pusher", "Pushes the coke out, stamps the coal cake", "Ovens up to 11 m"),
        ("charging-car", "Top-charges coal into the ovens", "8 - 20 T hopper, 2, 3 or 4 mouths"),
        ("power-winch", "Lifts the oven doors", "2.5 - 5 T lift"),
        ("haulage", "Pulls wagons and coke cakes", "10 T pull"),
    ]
    body = "".join(
        f'<tr><td>{t(title_of(k))}</td><td>{t(duty)}</td>'
        f'<td class="c">{t(fig)}</td></tr>' for k, duty, fig in rows)
    return f"""
<section class="spread full-spread battery">
  <img class="wide-photo" src="{photo}" alt="">
  <div class="wide-shade"></div>
  <h2 class="wide-h">AT THE<br>BATTERY</h2>
  <div class="panel">
    <h3 class="grey-h big">OVEN MACHINES AT A GLANCE</h3>
    <div class="panel-cols">
      <table class="sel">
        <thead><tr><th>Machine</th><th>Duty</th><th>Size</th></tr></thead>
        <tbody>{body}</tbody>
      </table>
      <div class="panel-note">
        <div class="gb-h">{icon("fa-ruler-combined", "ico box-ico")}<b>SIZING FOR<br>YOUR BATTERY</b></div>
        <p>Standard coke oven doors usually need a 2.5 to 5 ton winch, depending on the battery
        height and the door weight.</p>
        <p>The standard 20 m pusher beam suits ovens up to 11 m long; custom lengths are
        available.</p>
        <p>The charging car is built with 2, 3 or 4 mouths, to match the charging holes on
        your oven top.</p>
      </div>
    </div>
  </div>
  <div class="folio folio-l on-dark">{n} &nbsp;|&nbsp; {SITE}</div>
  <div class="folio folio-r on-dark">{n + 1} &nbsp;|&nbsp; {SITE}</div>
</section>"""


INDEX_GROUPS = [
    ("Coal preparation", ["coal-crusher-single", "coal-crusher-double"]),
    ("Coke sizing &amp; screening", ["coke-cutter-double-drive", "coke-cutter-ring-type",
                                   "vibrator-screen"]),
    ("Oven operation", ["pusher", "charging-car", "power-winch"]),
    ("Material handling", ["haulage", "conveyor-materials"]),
]


def page_index(img, n, where, sections):
    """Contents page: every machine under its duty group with a thumbnail and
    its page number, then the other sections. `where` maps product key to
    page number, `sections` is [(title, page)]; both come from the same
    order that builds the pages, so the numbers cannot go stale."""
    rows = []
    for group, keys in INDEX_GROUPS:
        rows.append(f'<div class="ix-grp">{group}</div>')
        for key in keys:
            p = PRODUCTS[key]
            thumb, _r = img.cutout(CUTOUT[key], max_px=320, bg=(246, 247, 248))
            rows.append(
                f'<div class="ix-row"><div class="ix-thumb"><img src="{thumb}" alt=""></div>'
                f'<div class="ix-name">{t(p["title"])}<small>{t(p["subtitle"])}</small></div>'
                f'<div class="ix-dots"></div><div class="ix-pg">{where[key]}</div></div>')
    other = "".join(
        f'<div class="ix-sec"><span>{title}</span><i></i><b>{pg}</b></div>' for title, pg in sections)
    return f"""
<section class="page index">
  <div class="pad">
    <h2 class="red-h">IN THIS<br>CATALOGUE</h2>
    <div class="ix-list">{"".join(rows)}</div>
    <div class="ix-grp">Also inside</div>
    <div class="ix-other">{other}</div>
  </div>
  {folio(n)}
</section>"""


def page_hero_left(hero, n):
    key = hero["key"]
    p = PRODUCTS[key]
    calls = "".join(
        f'<div class="call"><span class="num">{i}</span><b>{t(h).upper()}</b>'
        f'<p>{t(b)}</p></div>' for i, (h, b, _m) in enumerate(hero["callouts"], 1))
    buying = p.get("buying", BUYING_INFO)
    buy = "".join(f"<div><b>{t(a)}:</b> {t(b)}</div>" for a, b in buying)
    steps = "".join(
        f'<div><span>{i:02d}</span><b>{t(h)}</b><p>{t(b)}</p></div>'
        for i, (h, b) in enumerate(p["steps"], 1))
    return f"""
<section class="page hero-l">
  <div class="pad">
    <h2 class="model">{t(p["title"])}</h2>
    <div class="model-sub">{t(p["subtitle"]).upper()}</div>
    {bullets(p["features"])}
    {icon_row(key)}
    <div class="calls">{calls}</div>
    <h4 class="flow-h">HOW IT WORKS</h4>
    <div class="flow">{steps}</div>
    <div class="buy"><h4>BUYING INFORMATION</h4>{buy}</div>
  </div>
  {folio(n)}
</section>"""


def page_hero_right(img, hero, n):
    key = hero["key"]
    p = PRODUCTS[key]
    ph = hero["photo"]
    markers = "".join(
        f'<span class="marker" style="left:{m[0] * 100:.1f}%;top:{m[1] * 100:.1f}%">{i}</span>'
        for i, (_h, _b, m) in enumerate(hero["callouts"], 1) if m)
    if "src" in ph:
        photo = img.photo(ph["src"], crop=ph["crop"], ratio=210 / 222, max_px=2200)
        figure = f'<div class="hero-fig photo"><img src="{photo}" alt="">{markers}</div>'
    else:
        # Size the art box to the cutout itself, so marker percentages land on
        # the machine and not on letterboxing around it.
        name, ratio = img.keyed(ph["cutout"]) if ph.get("key") else img.cutout(ph["cutout"])
        w = min(180.0, 140.0 * ratio)
        h = w / ratio
        figure = (f'<div class="hero-fig stage"><div class="stage-art" '
                  f'style="width:{w:.1f}mm;height:{h:.1f}mm">'
                  f'<img src="{name}" alt="">{markers}</div></div>')
    stats = "".join(f'<div><b>{t(v)}</b><span>{t(c)}</span></div>' for v, c in p["stats"])
    return f"""
<section class="page hero-r">
  {figure}
  <div class="hero-shade"></div>
  <h2 class="photo-h">{hero["category"]}</h2>
  <div class="hero-band">
    <div class="hb-name">{t(p["title"])}<span>{t(p["subtitle"])}</span></div>
    <div class="hb-stats">{stats}</div>
  </div>
  {folio(n, dark=True)}
</section>"""


def page_range(img, keys, title, n):
    blocks = []
    for key in keys:
        p = PRODUCTS[key]
        name, _r = img.cutout(CUTOUT[key], max_px=1100, bg=(246, 247, 248))
        blocks.append(f"""
    <div class="rng">
      <div class="rng-img"><img src="{name}" alt=""></div>
      <div class="rng-txt">
        <h3 class="model sm">{t(p["title"])}</h3>
        <div class="model-sub">{t(p["subtitle"]).upper()}</div>
        {bullets(p["features"][:4])}
        {icon_row(key)}
      </div>
    </div>""")
    return f"""
<section class="page range n{len(keys)}">
  <div class="pad">
    <h2 class="red-h">{title}</h2>
    {"<hr>".join(blocks)}
  </div>
  {folio(n)}
</section>"""


def page_chart(img, chart, n, note):
    cols = chart["cols"]
    head = "".join(f"<th>{SHORT[k]}</th>" for k in cols)
    thumbs = "".join(f'<td><img src="{img.cutout(CUTOUT[k], max_px=500, bg=(255, 255, 255))[0]}" alt=""></td>' for k in cols)
    body = []
    for group, rows in chart["groups"]:
        body.append(f'<tr class="grp"><td colspan="{len(cols) + 1}">{group.upper()}</td></tr>')
        for label, vals in rows:
            cells = "".join(f"<td>{'&bull;' if v == '-' else t(v)}</td>" for v in vals)
            body.append(f"<tr><th>{label}</th>{cells}</tr>")
    return f"""
<section class="page chart">
  <div class="pad">
    <h2 class="red-h">SPECIFICATION<br>CHART</h2>
    <h3 class="grey-h big">{chart["title"].upper()}</h3>
    <table class="spec cols{len(cols)}">
      <thead><tr class="thumbs"><td></td>{thumbs}</tr><tr><th>Model</th>{head}</tr></thead>
      <tbody>{"".join(body)}</tbody>
    </table>
    <p class="fine">&bull; Not applicable. {note} Capacities depend on the material and feed
    conditions; every machine is built to order, and final figures are confirmed on the
    quotation. Warranty: 1 year on all our machinery.</p>
  </div>
  {folio(n)}
</section>"""


def page_spares(img, n):
    cards = []
    for title, src, desc, fits in SPARES:
        photo = img.photo(src, max_px=900, bg=(246, 247, 248))
        # cutouts sit whole on the grey panel; photographs fill the frame
        fit = " fit" if Image.open(src).mode in ("RGBA", "P", "LA") else ""
        cards.append(f"""
      <div class="sp">
        <div class="sp-img{fit}"><img src="{photo}" alt=""></div>
        <h4>{title.upper()}</h4>
        <p>{t(desc)}</p>
        <small>Fits: {t(fits)}</small>
      </div>""")
    return f"""
<section class="page spares">
  <div class="pad">
    <h2 class="red-h">SPARES &amp; WEAR PARTS</h2>
    <p class="body">We supply spare parts for the machines we build, made to the same drawings.
    Tell us the machine and, if you have it, the old part's size, and we will quote.</p>
    <div class="sp-grid">{"".join(cards)}</div>
    <div class="order">
      <h4>ORDERING A SPARE</h4>
      <div class="order-steps">
        <div><span>1</span>Name the machine and, if it is ours, roughly when it was supplied.</div>
        <div><span>2</span>Send the old part's size, or a photo of it beside a tape measure.</div>
        <div><span>3</span>We quote the part, made to the same drawings as the machine.</div>
      </div>
    </div>
  </div>
  {folio(n)}
</section>"""


def page_why(img, n):
    tiles = [
        img.photo(IMG + "flames-fire-heat-3092318-1024x669.jpg", crop=(0.2, 0, 0.8, 1), ratio=1.0, max_px=800),
        img.photo(PIMG + "coal-charging-car/coal-charging-car-4.jpg", crop=(0.1, 0.05, 0.75, 0.95), ratio=1.0, max_px=900),
        img.photo(PIMG + "coal-crusher-double-disc/coal-crusher-8.png", crop=(0, 0.1, 1, 0.85), ratio=1.0, max_px=900),
        img.photo(IMG + "ISO.jpg", crop=(0.05, 0.02, 0.95, 0.66), ratio=1.0, max_px=900),
    ]
    values = [
        ("Since 1995", "Founded in Dhanbad by the late Shobha Ram Agarwal and run today by "
         "Ravindra Kr. Agarwal. More than 30 years of building machinery for coke ovens."),
        ("Built in our own workshop", "Every machine is designed and fabricated at Bastacolla, "
         "Dhansar, by a team of 15+ experienced engineers and technicians."),
        ("Built to your drawings", "Capacity, motor power and dimensions are matched to your "
         "plant, so the machine fits the battery, the belt or the bunker it serves."),
        ("ISO 9001:2015 certified", "A certified quality management system, and compliance "
         "with Indian Factory Act standards."),
    ]
    vals = "".join(f'<div class="val"><h4>{a.upper()}</h4><p>{t(b)}</p></div>' for a, b in values)
    tile_html = "".join(f'<div class="tile"><img src="{s}" alt=""></div>' for s in tiles)
    clients = "".join(f"<li>{c}</li>" for c in CLIENTS)
    return f"""
<section class="page why">
  <div class="why-top">
    <div class="pad">
      <h2 class="red-h">WHY MANUAL<br>TOOLS COMPANY</h2>
      <div class="vals">{vals}</div>
    </div>
  </div>
  <div class="tiles">{tile_html}</div>
  <div class="figs"><div><b>30+</b><span>Years experience</span></div><div><b>150+</b><span>Happy clients</span></div>
    <div><b>500+</b><span>Projects done</span></div><div><b>15+</b><span>Experienced staff</span></div></div>
  <div class="pad clients">
    <h3 class="grey-h">CLIENTS ACROSS INDIA AND ABROAD INCLUDE</h3>
    <ul>{clients}</ul>
  </div>
  {folio(n)}
</section>"""


def page_back(img, qr_name):
    photo = img.photo(IMG + "flames-fire-heat-3092318-1024x669.jpg", crop=(0, 0, 1, 1),
                      ratio=210 / 160, max_px=1400)
    items = [
        ("fa-headset", "ENQUIRIES", "Call or email with your material, capacity and site. "
         "We reply with a recommendation and a quotation."),
        ("fa-hard-hat", "SITE SUPPORT", "Installation supervision and commissioning are "
         "available for every machine we build."),
        ("fa-tools", "SPARES", "Hammers, liner plates, rings, rollers, pulleys and gears for "
         "the machines we build, made to the same drawings."),
    ]
    its = "".join(f'<div class="bk-item"><div class="bk-h">{icon(i)}<b>{h}</b></div>'
                  f'<p>{t(b)}</p></div>' for i, h, b in items)
    return f"""
<section class="page sheet-a4 back">
  <div class="bk-top">
    <img src="{photo}" alt="">
    <div class="bk-shade"></div>
    <div class="pad">
      <h2 class="bk-h1">TALK TO THE<br>PEOPLE WHO<br>BUILD IT</h2>
      <p class="bk-lede">EVERY MACHINE IN THIS CATALOGUE IS DESIGNED AND BUILT IN OUR
      WORKSHOP IN DHANBAD.</p>
      {its}
    </div>
    <div class="bk-logo">{full_logo_svg()}</div>
  </div>
  <div class="bk-band">
    <div class="pad">
      <p class="disc">Specifications and figures in this catalogue are typical and may change
      without notice. Every machine is made to order: capacity, motor power and dimensions are
      confirmed on the quotation. Capacities depend on the material and feed conditions.
      Warranty: 1 year on all our machinery.</p>
      <div class="bk-contact">
        <div>
          <h3>CALL {PHONE} OR VISIT {SITE.upper()}</h3>
          <div class="bk-lines">
            <span>{icon("fa-phone-alt")} {PHONE}</span>
            <span>{icon("fa-envelope")} {EMAIL}</span>
            <span>{icon("fa-map-marker-alt")} {ADDRESS}</span>
          </div>
        </div>
        <div class="qr"><img src="{qr_name}" alt=""><span>Scan for the website</span></div>
      </div>
    </div>
  </div>
  <div class="pad bk-form">
    <h4>YOUR REQUIREMENT</h4>
    <div class="form-grid">
      <div><span>Machine</span></div><div><span>Capacity (TPH / tons)</span></div>
      <div><span>Material &amp; feed size</span></div><div><span>Output size</span></div>
      <div class="wide"><span>Plant / site</span></div>
      <div class="wide"><span>Notes</span></div>
    </div>
  </div>
</section>"""


# --- stylesheet ------------------------------------------------------------

def css():
    f = FONTS.as_uri()
    fa = FA_WOFF.as_uri()
    return f"""
@font-face {{ font-family: Archivo; font-style: normal; font-weight: 100 900; font-stretch: 62% 125%;
  src: url({f}/Archivo-Variable.woff2) format("woff2"); }}
@font-face {{ font-family: Archivo; font-style: italic; font-weight: 100 900; font-stretch: 62% 125%;
  src: url({f}/Archivo-Italic-Variable.woff2) format("woff2"); }}
@font-face {{ font-family: FA; font-weight: 900; src: url({fa}) format("woff2"); }}

:root {{
  --red: #D40000; --red-dk: #A80000; --ink: #111821; --body: #2D343D; --soft: #6B7480;
  --rule: #D9DDE2; --panel: #EEF0F2; --band: #F6F7F8;
}}
@page {{ size: 210mm 297mm; margin: 0; }}
@page a4 {{ size: 210mm 297mm; margin: 0; }}
@page a3 {{ size: 420mm 297mm; margin: 0; }}
* {{ box-sizing: border-box; margin: 0; padding: 0; }}
html, body {{ font-family: Archivo, Arial, sans-serif; color: var(--body); font-size: 10pt;
  line-height: 1.45; -webkit-print-color-adjust: exact; print-color-adjust: exact; }}
.page {{ width: 210mm; height: 297mm; position: relative; overflow: hidden; background: #fff; }}
.sheet-a4 {{ page: a4; break-after: page; }}
.sheet-a4:last-child {{ break-after: auto; }}
.spread {{ page: a3; width: 420mm; height: 297mm; display: flex; position: relative; overflow: hidden;
  break-after: page; }}
.spread > .page {{ flex: none; }}
.pad {{ padding: 16mm 15mm 0; position: relative; }}
img {{ display: block; }}
.ico {{ font-family: FA; font-style: normal; font-weight: 900; }}

/* headings */
.red-h {{ color: var(--red); font-weight: 850; font-stretch: 118%; text-transform: uppercase;
  font-size: 34pt; line-height: .98; letter-spacing: -.3pt; margin-bottom: 7mm; }}
.grey-h {{ color: #555C66; font-weight: 800; font-stretch: 115%; font-size: 12pt;
  letter-spacing: .2pt; margin-bottom: 3mm; }}
.grey-h.big {{ font-size: 17pt; margin-bottom: 5mm; }}
.photo-h {{ position: absolute; top: 14mm; right: 14mm; text-align: right; color: #fff;
  font-weight: 850; font-stretch: 118%; text-transform: uppercase; font-size: 34pt;
  line-height: .98; text-shadow: 0 1mm 6mm rgba(0,0,0,.35); z-index: 3; }}
.body {{ font-size: 10.6pt; margin-bottom: 3.5mm; color: var(--body); }}
.fine {{ font-size: 7.4pt; color: var(--soft); margin-top: 4mm; line-height: 1.35; }}

/* folio */
.folio {{ position: absolute; bottom: 8mm; font-size: 7.5pt; color: var(--soft); z-index: 5; }}
.folio-l {{ left: 15mm; }} .folio-r {{ right: 15mm; }}
.folio.on-dark {{ color: rgba(255,255,255,.8); }}

/* cover */
.cover {{ background: var(--ink); }}
.cover-photo {{ position: absolute; top: 0; left: 0; width: 210mm; height: 228mm; object-fit: cover; }}
.cover-shade {{ position: absolute; inset: 0; background:
  linear-gradient(180deg, rgba(17,24,33,.55) 0, rgba(17,24,33,0) 30mm, rgba(17,24,33,0) 120mm,
  rgba(17,24,33,.88) 205mm, var(--ink) 228mm); }}
.logo-box {{ position: absolute; top: 0; left: 50%; transform: translateX(-50%); background: var(--red);
  padding: 6mm 8mm 5.5mm; z-index: 3; }}
.logo-full svg {{ width: 128mm; height: auto; display: block; }}
.cover-title {{ position: absolute; left: 13mm; right: 13mm; top: 186mm; z-index: 3; }}
.cover-tag {{ display: inline-block; background: #fff; padding: 1.8mm 7mm 1.8mm 6mm;
  transform: skewX(-14deg); margin-left: 2mm; }}
.cover-tag span {{ display: inline-block; transform: skewX(14deg); font-weight: 800; font-stretch: 118%;
  font-style: italic; font-size: 13pt; color: var(--red); letter-spacing: .3pt; }}
.cover-tag em {{ color: var(--red); }}
.cover h1 {{ color: #fff; font-style: italic; font-weight: 900; font-stretch: 125%; font-size: 54pt;
  line-height: .9; letter-spacing: -.6pt; margin-top: 4mm; }}
.cover-list {{ color: rgba(255,255,255,.72); font-size: 8.4pt; margin-top: 6mm; letter-spacing: .2pt; }}
.cover-foot {{ position: absolute; left: 15mm; right: 15mm; bottom: 9mm; display: flex;
  justify-content: space-between; color: rgba(255,255,255,.6); font-size: 7.5pt;
  border-top: .3mm solid rgba(255,255,255,.18); padding-top: 3mm; }}

/* cover art: the range on a dark stage */
.cover-art {{ position: absolute; left: 0; top: 30mm; width: 210mm; height: 168mm; object-fit: cover; }}
.cover-glow {{ position: absolute; inset: 0; background:
  linear-gradient(180deg, var(--ink) 0, var(--ink) 30mm, rgba(17,24,33,0) 58mm, rgba(17,24,33,0) 178mm,
  var(--ink) 198mm); }}
.cover .cover-title {{ top: 204mm; }}
.cover h1 {{ font-size: 42pt; }}
/* the owner's "30+ Years of Excellence" badge beside the headline */
.years-badge {{ display: block; width: 52mm; height: auto; margin-top: 7mm; }}

/* full-width spread */
.full-spread {{ background: var(--ink); }}
.wide-photo {{ position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }}
.wide-shade {{ position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,.5) 0,
  rgba(0,0,0,0) 80mm), linear-gradient(0deg, rgba(0,0,0,.35) 0, rgba(0,0,0,0) 60mm); }}
.wide-h {{ position: absolute; left: 15mm; top: 14mm; color: #fff; font-weight: 850; font-stretch: 118%;
  font-size: 40pt; line-height: .98; text-shadow: 0 1mm 6mm rgba(0,0,0,.4); }}
.panel {{ position: absolute; left: 12mm; bottom: 17mm; width: 232mm; background: #fff;
  padding: 7mm 8mm 7mm; box-shadow: 0 2mm 8mm rgba(0,0,0,.3); }}
.panel-cols {{ display: flex; gap: 7mm; align-items: flex-start; }}
.panel .sel {{ flex: 1; }}
.panel .sel td.mine {{ width: 26mm; }}
.panel-note {{ width: 62mm; }}
.panel-note .gb-h b {{ font-size: 10.5pt; line-height: 1.1; }}
.panel-note p {{ font-size: 9pt; margin-bottom: 2.5mm; }}
.full-spread .folio {{ bottom: 7mm; }}

/* intro */
.intro-photo {{ width: 210mm; height: 140mm; object-fit: cover; }}
.intro-l .pad {{ padding-top: 11mm; }}
.steps {{ display: grid; grid-template-columns: repeat(3, 1fr); gap: 6mm; }}
.step-h {{ display: flex; gap: 2mm; align-items: flex-start; margin-bottom: 3.5mm; min-height: 11mm; }}
.step-n {{ color: var(--red); font-weight: 900; font-stretch: 115%; font-size: 26pt; line-height: .8; }}
.step-h b {{ font-weight: 800; font-stretch: 112%; text-transform: uppercase; color: var(--ink);
  font-size: 10.4pt; line-height: 1.12; }}
.step p {{ font-size: 10pt; }}
.unsure {{ margin-top: 9mm; font-weight: 700; color: var(--ink); font-size: 10.6pt;
  border-left: 1.2mm solid var(--red); padding-left: 3.5mm; }}
.lede {{ font-size: 13.4pt; line-height: 1.38; color: var(--ink); font-weight: 500; margin-bottom: 4mm; }}
.sel-wrap {{ display: flex; gap: 4mm; margin-top: 6mm; align-items: flex-start; }}
.sel-main {{ flex: 1; }}
.sel-side {{ width: 38mm; padding-top: 8.5mm; }}
table {{ border-collapse: collapse; width: 100%; }}
.sel th, .facts th {{ background: var(--red); color: #fff; text-align: left; font-weight: 800;
  font-stretch: 110%; text-transform: uppercase; font-size: 7.4pt; padding: 2mm 2mm; letter-spacing: .2pt; }}
.sel td {{ border-bottom: .25mm solid #fff; background: var(--band); padding: 2.1mm 2mm;
  font-size: 8.8pt; vertical-align: middle; color: var(--ink); }}
.sel td small {{ display: block; color: var(--soft); font-size: 7.2pt; line-height: 1.2; }}
.sel td.c {{ color: var(--body); }}
.sel tr.grp td {{ background: #DEE1E5; font-weight: 800; font-stretch: 110%; text-transform: uppercase;
  font-size: 8pt; padding: 1.8mm 2mm; color: var(--ink); }}
.sel td.cb {{ width: 6mm; padding-right: 0; }}
.sel td.cb span {{ display: block; width: 3.2mm; height: 3.2mm; border: .3mm solid #7A828C; background: #fff; }}
.sel td.mine {{ width: 30mm; background: #fff; border: .35mm solid #C7CCD2; }}
.facts td {{ font-size: 8.4pt; padding: 2mm 2mm; border-bottom: .25mm solid var(--rule); }}
.facts td:last-child {{ text-align: right; font-weight: 800; color: var(--ink); }}
.iso {{ margin-top: 5mm; background: var(--panel); padding: 3mm; text-align: center; }}
.iso .ico {{ color: var(--red); font-size: 16pt; display: block; margin-bottom: 1.5mm; }}
.iso b {{ display: block; font-weight: 800; color: var(--ink); font-size: 9pt; }}
.iso span {{ font-size: 7pt; color: var(--soft); }}

/* engineering */
.grey-box {{ background: var(--panel); padding: 7mm 8mm 5mm; margin-top: 9mm; }}
.gb-h {{ display: flex; align-items: center; gap: 3mm; margin: 0 0 3mm; }}
.gb-h + p {{ margin-bottom: 6mm; }}
.box-ico {{ color: var(--red); border: .4mm solid var(--red); width: 9mm; height: 7mm;
  display: inline-flex; align-items: center; justify-content: center; font-size: 9pt; }}
.gb-h b {{ font-weight: 800; font-stretch: 112%; color: var(--ink); font-size: 11.5pt; }}
.grey-box p {{ font-size: 10.4pt; margin-bottom: 3.5mm; }}
.grey-box p b {{ font-weight: 800; color: var(--ink); }}

/* full-page photo */
.full-photo img {{ position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }}
.fp-shade {{ position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,.45) 0,
  rgba(0,0,0,0) 70mm, rgba(0,0,0,0) 220mm, rgba(0,0,0,.55) 297mm); }}
.fp-cap {{ position: absolute; left: 15mm; right: 40mm; bottom: 16mm; color: #fff; font-size: 9pt;
  z-index: 3; }}

/* hero spreads */
.model {{ font-weight: 850; font-stretch: 115%; color: var(--ink); font-size: 27pt; line-height: 1.02; }}
.model.sm {{ font-size: 16.5pt; }}
.model-sub {{ font-size: 9pt; color: #555C66; margin-top: 1.5mm; letter-spacing: .3pt; }}
.bul {{ list-style: none; margin: 5mm 0 5mm; }}
.bul li {{ position: relative; padding-left: 3.5mm; font-size: 10pt; margin-bottom: .6mm; }}
.bul li::before {{ content: ""; position: absolute; left: .4mm; top: 1.9mm; width: 1.1mm; height: 1.1mm;
  border-radius: 50%; background: var(--soft); }}
.icon-row {{ display: flex; gap: 1mm; margin: 2mm 0 7mm; }}
.ir-cell {{ flex: 1; text-align: center; font-size: 8pt; line-height: 1.2; color: var(--body); }}
.ir-cell .ico {{ display: block; color: var(--red); font-size: 17pt; margin-bottom: 1.6mm; }}
.ir-cell b {{ display: block; font-weight: 700; color: var(--ink); }}
.calls .call {{ position: relative; padding-left: 9mm; margin-bottom: 5.2mm; }}
.hero-l .pad {{ display: flex; flex-direction: column; height: 275mm; }}
.hero-l .buy {{ margin-top: auto; }}
.num {{ position: absolute; left: 0; top: -.4mm; width: 5.6mm; height: 5.6mm; border-radius: 50%;
  background: var(--ink); color: #fff; font-weight: 800; font-size: 8pt; display: flex;
  align-items: center; justify-content: center; }}
.call b {{ display: block; font-weight: 800; font-stretch: 112%; color: var(--ink); font-size: 10pt;
  margin-bottom: 1mm; }}
.call p {{ font-size: 9.8pt; }}
.buy {{ background: var(--panel); padding: 4.5mm 5mm 3.5mm; margin-top: 6mm; font-size: 9pt; }}
.flow-h {{ color: var(--red); font-weight: 800; font-stretch: 112%; font-size: 9.4pt;
  letter-spacing: .3pt; border-top: .3mm solid var(--rule); padding-top: 4.5mm; margin-top: 2mm; }}
.flow {{ display: grid; grid-template-columns: repeat(3, 1fr); gap: 5mm; margin-top: 3.5mm; }}
.flow-h {{ margin-top: 4mm; }}
.flow span {{ display: block; color: var(--red); font-weight: 900; font-stretch: 115%; font-size: 15pt;
  line-height: 1; margin-bottom: 1.5mm; }}
.flow b {{ display: block; color: var(--ink); font-weight: 800; font-size: 9.2pt; margin-bottom: 1mm; }}
.flow p {{ font-size: 8.6pt; line-height: 1.38; }}
.buy h4 {{ color: var(--red); font-weight: 800; font-stretch: 112%; font-size: 8.6pt; margin-bottom: 1.5mm; }}
.buy b {{ color: var(--ink); font-weight: 700; }}
.buy div {{ margin-bottom: .6mm; }}

.hero-r {{ background: var(--ink); }}
.hero-fig {{ position: absolute; left: 0; top: 0; width: 210mm; height: 222mm; }}
.hero-fig.photo img {{ width: 100%; height: 100%; object-fit: cover; }}
.hero-fig.stage {{ background: radial-gradient(ellipse 120mm 90mm at 50% 58%, #2F3E4E 0, #1A2430 55%, var(--ink) 100%);
  display: flex; align-items: center; justify-content: center; padding: 48mm 14mm 16mm; }}
.stage-art {{ position: relative; }}
.stage-art img {{ width: 100%; height: 100%;
  filter: drop-shadow(0 6mm 6mm rgba(0,0,0,.55)); }}
.hero-shade {{ position: absolute; left: 0; top: 0; width: 210mm; height: 222mm; background:
  linear-gradient(180deg, rgba(0,0,0,.42) 0, rgba(0,0,0,0) 60mm, rgba(17,24,33,0) 165mm, var(--ink) 222mm); }}
.hero-fig.stage + .hero-shade {{ background: none; }}
.marker {{ position: absolute; width: 7mm; height: 7mm; margin: -3.5mm 0 0 -3.5mm; border-radius: 50%;
  background: #fff; color: var(--red); font-weight: 900; font-size: 10pt; display: flex;
  align-items: center; justify-content: center; box-shadow: 0 .6mm 2mm rgba(0,0,0,.45); z-index: 2; }}
.hero-band {{ position: absolute; left: 15mm; right: 15mm; top: 226mm; color: #fff; z-index: 3; }}
.hb-name {{ font-weight: 850; font-stretch: 115%; font-size: 17pt; line-height: 1.05;
  border-left: 1.4mm solid var(--red); padding-left: 4mm; }}
.hb-name span {{ display: block; font-weight: 400; font-stretch: 100%; font-size: 8.8pt;
  color: rgba(255,255,255,.7); margin-top: 1.5mm; }}
.hb-stats {{ display: flex; margin-top: 7mm; border-top: .3mm solid rgba(255,255,255,.2); padding-top: 6mm; }}
.hb-stats div {{ flex: 1; padding-right: 4mm; }}
.hb-stats div + div {{ border-left: .3mm solid rgba(255,255,255,.2); padding-left: 5mm; }}
.hb-stats b {{ display: block; font-weight: 850; font-stretch: 112%; font-size: 17pt; line-height: 1.05; }}
.hb-stats span {{ display: block; font-size: 7.4pt; text-transform: uppercase; letter-spacing: .6pt;
  color: rgba(255,255,255,.65); margin-top: 1.5mm; }}

/* range */
.range hr {{ border: 0; border-top: .3mm solid var(--rule); margin: 6.5mm 0; }}
.rng {{ display: flex; gap: 7mm; align-items: flex-start; }}
.rng-img {{ width: 68mm; height: 64mm; flex: none; display: flex; align-items: center;
  justify-content: center; background: var(--band); }}
.rng-img img {{ max-width: 62mm; max-height: 60mm; object-fit: contain; }}
.rng-txt {{ flex: 1; }}
.rng .bul {{ margin: 3mm 0 3mm; }}
.rng .bul li {{ font-size: 9.6pt; }}
.rng .icon-row {{ margin: 1mm 0 0; }}
.rng .ir-cell {{ font-size: 7.3pt; }}
.rng .ir-cell .ico {{ font-size: 14pt; margin-bottom: 1.2mm; }}

/* a range page with only two machines gets larger blocks */
.range.n2 hr {{ margin: 14mm 0; }}
.range.n2 .rng {{ gap: 9mm; }}
.range.n2 .rng-img {{ width: 84mm; height: 92mm; }}
.range.n2 .rng-img img {{ max-width: 78mm; max-height: 84mm; }}
.range.n2 .model.sm {{ font-size: 19pt; }}
.range.n2 .bul {{ margin: 5mm 0 6mm; }}
.range.n2 .bul li {{ font-size: 10.2pt; margin-bottom: 1mm; }}
.range.n2 .ir-cell {{ font-size: 7.8pt; }}
.range.n2 .ir-cell .ico {{ font-size: 16pt; }}

/* index */
.index .red-h {{ margin-bottom: 5mm; }}
.ix-grp {{ background: #DEE1E5; color: var(--ink); font-weight: 800; font-stretch: 110%; text-transform: uppercase;
  font-size: 8pt; letter-spacing: .3pt; padding: 1.6mm 2.5mm; margin-top: 3mm; }}
.ix-row {{ display: flex; align-items: center; gap: 3.5mm; padding: 1.3mm 0; border-bottom: .25mm solid var(--rule); }}
.ix-thumb {{ width: 17mm; height: 12.5mm; flex: none; background: var(--band); display: flex;
  align-items: center; justify-content: center; }}
.ix-thumb img {{ max-width: 15mm; max-height: 11mm; }}
.ix-name {{ font-weight: 700; color: var(--ink); font-size: 9.6pt; line-height: 1.2; }}
.ix-name small {{ display: block; font-weight: 400; color: var(--soft); font-size: 7.4pt; margin-top: .3mm; }}
.ix-dots {{ flex: 1; border-bottom: .35mm dotted #B5BBC2; margin: 0 1mm 1.4mm; align-self: flex-end; }}
.ix-pg {{ color: var(--red); font-weight: 900; font-stretch: 115%; font-size: 14pt; min-width: 9mm; text-align: right; }}
.ix-other {{ display: grid; grid-template-columns: 1fr 1fr; gap: 0 8mm; margin-top: 1mm; }}
.ix-sec {{ display: flex; align-items: flex-end; gap: 1.5mm; padding: 1.6mm 0; border-bottom: .25mm solid var(--rule);
  font-size: 8.8pt; color: var(--ink); }}
.ix-sec i {{ flex: 1; border-bottom: .35mm dotted #B5BBC2; margin-bottom: 1mm; }}
.ix-sec b {{ color: var(--red); font-weight: 900; font-size: 10.5pt; }}

/* chart */
.spec th, .spec td {{ border: .25mm solid #C9CED4; font-size: 8.9pt; padding: 3.3mm 1.8mm;
  text-align: center; vertical-align: middle; line-height: 1.22; }}
.spec thead th {{ background: var(--red); color: #fff; font-weight: 800; font-stretch: 108%;
  text-transform: uppercase; font-size: 8.6pt; line-height: 1.1; padding: 4mm 1.4mm; }}
.spec thead th:first-child {{ text-align: left; }}
.spec tbody th {{ text-align: left; font-weight: 500; color: var(--body); background: #fff; width: 25mm; }}
.spec tbody td {{ color: var(--ink); }}
.spec tbody tr:nth-child(even) td, .spec tbody tr:nth-child(even) th {{ background: var(--band); }}
.spec tr.grp td {{ background: var(--red) !important; color: #fff; text-align: left; font-weight: 800;
  font-stretch: 110%; font-size: 9.6pt; padding: 2.6mm 1.8mm; }}

.spec {{ table-layout: fixed; }}
.spec tr.thumbs td:first-child {{ width: 25mm; }}
.spec tr.thumbs td {{ border: 0; background: #fff !important; padding: 0 1.5mm 3mm; height: 30mm;
  vertical-align: bottom; }}
.spec tr.thumbs img {{ max-width: 100%; max-height: 27mm; margin: 0 auto; }}

/* spares */
.sp-grid {{ display: grid; grid-template-columns: repeat(3, 1fr); gap: 7mm 7mm; margin-top: 6mm; }}
.sp-img {{ height: 54mm; background: var(--band); display: flex; align-items: center; justify-content: center;
  overflow: hidden; margin-bottom: 4mm; }}
.sp-img img {{ width: 100%; height: 100%; object-fit: cover; }}
.sp-img.fit img {{ object-fit: contain; }}
.sp h4 {{ font-weight: 850; font-stretch: 115%; color: #444B55; font-size: 12pt; line-height: 1.05;
  margin-bottom: 2mm; }}
.sp p {{ font-size: 9.5pt; margin-bottom: 2.5mm; }}
.sp small {{ display: block; font-size: 8pt; color: var(--soft); }}

.order {{ background: var(--panel); padding: 5mm 6mm; margin-top: 7mm; }}
.order h4 {{ color: var(--red); font-weight: 800; font-stretch: 112%; font-size: 9.6pt; margin-bottom: 3mm; }}
.order-steps {{ display: grid; grid-template-columns: repeat(3, 1fr); gap: 6mm; font-size: 9.4pt; }}
.order-steps span {{ display: block; color: var(--ink); font-weight: 900; font-stretch: 115%; font-size: 16pt;
  line-height: 1; margin-bottom: 1.5mm; }}

/* why */
.figs {{ display: grid; grid-template-columns: repeat(4, 1fr); background: var(--ink); color: #fff;
  padding: 7mm 15mm; }}
.figs div + div {{ border-left: .3mm solid rgba(255,255,255,.2); padding-left: 5mm; }}
.figs b {{ display: block; font-weight: 900; font-stretch: 118%; font-size: 26pt; line-height: 1; color: #fff; }}
.figs span {{ display: block; font-size: 7.6pt; letter-spacing: .6pt; text-transform: uppercase;
  color: rgba(255,255,255,.7); margin-top: 2mm; }}
.why-top {{ background: var(--panel); padding-bottom: 7mm; }}
.vals {{ display: grid; grid-template-columns: repeat(2, 1fr); gap: 5mm 9mm; }}
.val h4 {{ color: var(--red); font-weight: 850; font-stretch: 112%; font-size: 10.4pt; margin-bottom: 1.5mm; }}
.val p {{ font-size: 9.8pt; }}
.tiles {{ display: grid; grid-template-columns: repeat(4, 1fr); }}
.tile {{ aspect-ratio: 1; overflow: hidden; }}
.tile img {{ width: 100%; height: 100%; object-fit: cover; }}
.clients {{ padding-top: 8mm; }}
.clients ul {{ list-style: none; columns: 3; column-gap: 6mm; }}
.clients li {{ font-size: 9.2pt; padding: 1.9mm 0 1.9mm 3mm; border-bottom: .25mm solid var(--rule);
  break-inside: avoid; position: relative; color: var(--ink); }}
.clients li::before {{ content: ""; position: absolute; left: 0; top: 3.9mm; width: 1.2mm; height: 1.2mm;
  background: var(--red); }}

/* back cover */
.bk-top {{ position: relative; height: 160mm; background: var(--ink); color: #fff; }}
.bk-top > img {{ position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }}
.bk-shade {{ position: absolute; inset: 0; background: linear-gradient(90deg, rgba(17,24,33,.94) 0,
  rgba(17,24,33,.86) 120mm, rgba(17,24,33,.35) 210mm); }}
.bk-top .pad {{ padding-top: 15mm; max-width: 140mm; }}
.bk-h1 {{ font-weight: 900; font-stretch: 120%; font-size: 30pt; line-height: .98; }}
.bk-lede {{ font-weight: 400; font-size: 11pt; line-height: 1.3; margin: 5mm 0 7mm; letter-spacing: .2pt; }}
.bk-item {{ margin-bottom: 5mm; }}
.bk-item .bk-h {{ display: flex; align-items: center; gap: 2.5mm; margin-bottom: 1mm; }}
.bk-item .ico {{ color: var(--red); font-size: 12pt; }}
.bk-item b {{ font-weight: 800; font-stretch: 112%; font-size: 10.5pt; }}
.bk-item p {{ font-size: 10pt; color: rgba(255,255,255,.86); }}
.bk-logo {{ position: absolute; left: 13.2mm; bottom: 10mm; z-index: 2; }}
.bk-logo svg {{ width: 92mm; height: auto; display: block; }}
.bk-band {{ background: var(--red); color: #fff; height: 72mm; }}
.bk-band .pad {{ padding-top: 7mm; }}
.disc {{ font-size: 7.8pt; line-height: 1.35; max-width: 120mm; opacity: .95; }}
.bk-contact {{ display: flex; justify-content: space-between; align-items: flex-end; margin-top: 6mm; gap: 6mm; }}
.bk-contact h3 {{ font-weight: 850; font-stretch: 112%; font-size: 13pt; line-height: 1.1; margin-bottom: 4mm; }}
.bk-lines span {{ display: block; font-size: 9.8pt; margin-bottom: 1.4mm; }}
.bk-lines .ico {{ width: 5mm; display: inline-block; font-size: 8.5pt; }}
.qr {{ background: #fff; padding: 2.5mm; text-align: center; flex: none; }}
.qr img {{ width: 27mm; height: 27mm; }}
.qr span {{ display: block; color: var(--ink); font-size: 6.4pt; margin-top: 1mm; }}
.bk-form {{ padding-top: 7mm; }}
.bk-form h4 {{ color: #555C66; font-weight: 850; font-stretch: 112%; font-size: 10pt; margin-bottom: 3mm; }}
.form-grid {{ display: grid; grid-template-columns: 1fr 1fr; gap: 0 8mm; }}
.form-grid div {{ border-bottom: .3mm solid #9AA1AA; height: 9.5mm; display: flex; align-items: flex-end;
  padding-bottom: .8mm; }}
.form-grid div.wide {{ grid-column: 1 / -1; }}
.form-grid span {{ font-size: 7pt; color: var(--soft); text-transform: uppercase; letter-spacing: .4pt; }}
"""


# --- build -----------------------------------------------------------------

# Marks every page whose text block runs into the folio strip, so a copy
# change that pushes a page over is caught at build time, not at the printer.
OVERFLOW_JS = """
addEventListener("load", () => document.fonts.ready.then(() => {
  const mm = 96 / 25.4, bad = [];
  document.querySelectorAll(".page:not(.back)").forEach((pg, i) => {
    const limit = pg.getBoundingClientRect().bottom - 14 * mm;
    for (const el of pg.querySelectorAll(".pad *")) {
      const r = el.getBoundingClientRect();
      if (r.height && r.bottom > limit + 1) { bad.push(i + 1); break; }
    }
  });
  document.body.setAttribute("data-overflow", bad.join(","));
}));
"""


def check_overflow(browser, page):
    dom = subprocess.run([browser, "--headless=new", "--disable-gpu", "--allow-file-access-from-files",
                          "--virtual-time-budget=15000", "--dump-dom", page.as_uri()],
                         capture_output=True, text=True, encoding="utf-8").stdout
    m = re.search(r'data-overflow="([^"]*)"', dom)
    if m is None:
        print("warning: could not run the overflow check")
    elif m.group(1):
        sys.exit(f"text runs into the footer on page(s) {m.group(1)}; shorten the copy")


def find_browser():
    for c in (os.environ.get("CHROME"),
              r"C:\Program Files\Google\Chrome\Application\chrome.exe",
              r"C:\Program Files (x86)\Google\Chrome\Application\chrome.exe",
              r"C:\Program Files (x86)\Microsoft\Edge\Application\msedge.exe",
              shutil.which("google-chrome"), shutil.which("chromium"), shutil.which("chrome")):
        if c and os.path.exists(c):
            return c
    sys.exit("Chrome or Edge is needed to print the catalogue (set CHROME to its path).")


def make_qr(build):
    import qrcode
    qr = qrcode.QRCode(border=0, box_size=12, error_correction=qrcode.constants.ERROR_CORRECT_M)
    qr.add_data(f"https://{SITE}/")
    qr.make(fit=True)
    qr.make_image(fill_color="#111821", back_color="white").save(build / "qr.png")
    return "qr.png"


def spread(left, right):
    """One A3 landscape sheet: a left and a right A4 page side by side."""
    return f'<div class="spread">{left}{right}</div>'


def build_html(build):
    img = Images(build)
    sheets = [
        page_cover(img),
        spread(page_intro_left(img, 2), page_intro_right(3)),
    ]
    hero = {h["key"]: h for h in HEROES}
    # Same order as the machine selector: coal preparation, coke sizing and
    # screening, oven operation, material handling.
    order = ["coal-crusher-single", "coal-crusher-double", "coke-cutter-double-drive",
             "coke-cutter-ring-type", "vibrator-screen",
             "pusher", "charging-car", "power-winch",
             "haulage", "conveyor-materials"]
    where, n = {}, 6
    for key in order:
        if key == "pusher":
            battery_at = n
            n += 2
        where[key] = n
        n += 2
    sections = [("Choosing the right machine", 2), ("Built for coke oven duty", 4),
                ("At the battery", battery_at), ("Specification charts", n),
                ("Spares &amp; wear parts", n + 2), ("Why Manual Tools Company", n + 3),
                ("Contact &amp; your requirement", n + 4)]
    sheets.append(spread(page_engineering_left(4), page_index(img, 5, where, sections)))
    n = 6
    for key in order:
        # the full-width battery photo opens the oven machines
        if key == "pusher":
            sheets.append(spread_battery(img, n))
            n += 2
        sheets.append(spread(page_hero_left(hero[key], n), page_hero_right(img, hero[key], n + 1)))
        n += 2
    sheets.append(spread(
        page_chart(img, CHART_SIZING, n,
                   "The vibrator screen's capacity depends on the deck count, screen size and mesh."),
        page_chart(img, CHART_OVEN, n + 1, "Conveyor components have their own pages.")))
    n += 2
    sheets.append(spread(page_spares(img, n), page_why(img, n + 1)))
    sheets.append(page_back(img, make_qr(build)))
    pages = sheets

    doc = f"""<!doctype html>
<html lang="en"><head><meta charset="utf-8">
<title>Manual Tools Company – Product Range (Catalogue 2)</title>
<style>{css()}</style>
<script>{OVERFLOW_JS}</script></head>
<body>{"".join(pages)}</body></html>"""
    path = build / "catalogue.html"
    path.write_text(doc, encoding="utf-8")
    return path, len(sheets)


def main():
    keep_html = "--html" in sys.argv
    build = Path(tempfile.mkdtemp(prefix="mtc-catalogue-2-"))
    try:
        page, count = build_html(build)
        browser = find_browser()
        check_overflow(browser, page)
        subprocess.run([browser, "--headless=new", "--disable-gpu", "--no-pdf-header-footer",
                        "--allow-file-access-from-files", "--virtual-time-budget=15000",
                        f"--print-to-pdf={OUT}", page.as_uri()],
                       check=True, capture_output=True)
        print(f"wrote {OUT.relative_to(ROOT)} ({count} sheets: A4 cover, {count - 2} A3 spreads, A4 back; {OUT.stat().st_size / 1e6:.1f} MB)")
        if keep_html:
            dest = ROOT / "brochure" / "catalogue-2-build"
            shutil.rmtree(dest, ignore_errors=True)
            shutil.copytree(build, dest)
            print(f"kept the HTML in {dest.relative_to(ROOT)}")
    finally:
        shutil.rmtree(build, ignore_errors=True)


if __name__ == "__main__":
    main()

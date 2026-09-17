"""Build the product brochures that have no dedicated script.

Reuses the layout from generate_brochure_coke_cutter.py. All copy is taken
from the matching product page, so keep the two in sync when specs change.

Run from the repo root:
    python brochure/generate_product_brochures.py            # all
    python brochure/generate_product_brochures.py haulage    # one
"""
import glob
import sys

from PIL import Image

from generate_brochure_coke_cutter import COLORS, FONT_FAMILY, MTCStyleBrochure

PRODUCTS = {
    "haulage": {
        "output": "Manual_Tools_Co_Haulage_Machine.pdf",
        "title": "HAULAGE MACHINE",
        "subtitle": "10 HP / 10 TON - COKE OVEN EXTRACTION SERIES",
        "main_image": "assets/img/about-us-products/Haulage Machine.jpg",
        "gallery": "assets/img/product-images/haulage/",
        "summary": "A heavy-duty haulage machine for coke ovens and mines. A 10 HP motor drives a high-torque worm reducer gearbox for steady, controlled pulling of up to 10 tons.",
        "left_title": "PERFORMANCE",
        "left": ["Pulling Capacity: 10 Tons (Horizontal)", "Motor: 10 H.P. (3-Phase, 440V)", "Gearbox: Heavy Duty Worm Reducer", "Application: Coke Oven / Mining"],
        "right_title": "DURABILITY & DESIGN",
        "right": ["Cast Steel Gears (Machine Cut)", "Fabricated C-Channel Steel Base Frame", "Manual / Electro-Hydraulic Thruster Brake (Optional)", "Non-reversible worm drive resists back-slip"],
        "steps": [
            ("1. Electrical Input", "The 10 HP motor starts; a flexible coupling transmits power to the gearbox input shaft and absorbs start-up shock."),
            ("2. Speed Reduction", "The worm reducer lowers the RPM and multiplies torque. The non-reversible gear action helps prevent load back-slip."),
            ("3. Drum Traction", "The output shaft turns the rope drum, coiling the steel wire rope and applying a steady 10-ton pull on the connected load."),
        ],
        "apps": [
            ("Coke Ovens", "Extracting heavy coke cakes and operating heavy door mechanisms."),
            ("Rail Shunting", "Moving wagons or material trolleys where locomotives cannot reach."),
            ("Underground Mines", "Pulling tubs of coal or minerals up inclined planes."),
        ],
        "faqs": [
            ("What is the maximum pulling capacity?", "This model is rated for 10 Tons of horizontal pulling force."),
            ("Can it be used for lifting?", "No. It is designed for horizontal pulling or inclined dragging, not as a vertical lifting hoist."),
            ("What oil does the gearbox need?", "Heavy-duty gear oil such as Servo Mesh SP 320 or SAE 140, depending on ambient temperature."),
            ("Does it come with wire rope?", "The machine is supplied with the drum. Wire rope length and diameter are customised to your requirement."),
            ("Is the motor included?", "Yes, the standard unit comes with a 10 HP electric motor pre-mounted and aligned."),
        ],
    },
    "power-winch": {
        "output": "Manual_Tools_Co_Power_Winch.pdf",
        "title": "DOOR LIFTING POWER WINCH",
        "subtitle": "COKE OVEN MAINTENANCE EQUIPMENT",
        "main_image": "assets/img/about-us-products/Power Winchh.jpg",
        "gallery": "assets/img/product-images/power-winch/",
        "summary": "A power winch for lifting heavy coke oven doors. Its self-locking worm reducer gearbox holds the load steady even during a power failure. 5 - 7.5 HP motor, up to 5 tons.",
        "left_title": "PERFORMANCE",
        "left": ["Lifting Capacity: 2.5 - 5 Tons", "Motor: 5 - 7.5 HP (3-Phase)", "Operation: Vertical Lift", "Lifting Speed: approx. 2 - 4 m/min"],
        "right_title": "SAFETY & DESIGN",
        "right": ["Self-Locking Worm Reducer Gearbox", "Cast Steel / Phosphor Bronze Gears", "Grooved Steel Drum for Wire Rope", "Electro-Magnetic Motor Brake Available"],
        "steps": [
            ("1. Drive Activation", "The electric motor engages and drives the worm gearbox input shaft through a coupling."),
            ("2. Torque Multiplication", "The worm shaft drives the worm wheel, cutting speed and multiplying torque for a smooth, non-jerky lift."),
            ("3. Vertical Lift", "The output shaft turns the grooved drum, winding the wire rope and lifting the oven door to the required height."),
        ],
        "apps": [
            ("Coke Oven Doors", "Lifting and positioning heavy oven doors during charging."),
            ("Heavy Dampers", "Lifting isolation dampers in flue gas ducts in power plants and steel mills."),
            ("Maintenance Bays", "General vertical lifting where overhead cranes are not available."),
        ],
        "faqs": [
            ("Why a worm gearbox instead of helical?", "Worm gearboxes are self-locking: if power fails, the door's weight cannot drive the motor backwards."),
            ("What is the lifting speed?", "Slow and controlled, approximately 2 - 4 metres/minute, for safety."),
            ("Does it come with a brake?", "We recommend and supply an electro-magnetic brake on the motor shaft for double safety."),
            ("What capacity do I need for a coke oven?", "Standard coke oven doors usually need 2.5 to 5 tons, depending on battery height and door weight."),
            ("Is the wire rope included?", "Yes, a standard length is included; rope length and diameter can be customised."),
        ],
    },
    "vibrator-screen": {
        "output": "Manual_Tools_Co_Vibrator_Screen.pdf",
        "title": "VIBRATOR SCREEN MACHINE",
        "subtitle": "MULTI-DECK SERIES - INDUSTRIAL GRADING & SORTING",
        "main_image": "assets/img/about-us-products/Vibrator Screen Machine.jpg",
        "gallery": "assets/img/product-images/vibrator-screen/",
        "summary": "A heavy-duty vibrating screen for coke and coal. An eccentric shaft gives strong vibration and high screening efficiency, in 1 to 4 deck configurations.",
        "left_title": "CONFIGURATION",
        "left": ["Decks: 1, 2, 3 or 4 (Customisable)", "Screen Sizes: 4'x12', 4'x16', 5'x16'", "Motor: 7.5 - 15 HP (Based on Load)", "Mesh: High Carbon Steel"],
        "right_title": "DESIGN",
        "right": ["Eccentric Shaft Vibration Mechanism", "Heavy Coil Spring Suspension", "Interchangeable Mesh Decks", "Adjustable Amplitude (Counterweights)"],
        "steps": [
            ("1. Material Feed", "Mixed material is fed onto the top deck and spread across the full width of the screen cloth."),
            ("2. Stratification", "Fines pass through the mesh to lower decks while oversize lumps ride over the top to the discharge chute."),
            ("3. Multi-Output", "Each deck discharges its own size grade (e.g. +40mm, 20-40mm, -20mm) to separate hoppers or conveyors."),
        ],
        "apps": [
            ("Coke Oven Plants", "Separating coke breeze from usable blast furnace coke lumps."),
            ("Coal Washeries", "Sizing raw coal before washing and dewatering clean coal."),
            ("Stone Crushing", "Grading aggregates, gravel and sand."),
        ],
        "faqs": [
            ("What materials can it handle?", "Mainly coke, coal and iron ore; also stone aggregates and other minerals."),
            ("Can I change the output size?", "Yes. The wire mesh screens are interchangeable with different aperture sizes."),
            ("How many sizes can I get at once?", "A 3-deck machine gives 4 output sizes (oversize + 3 grades)."),
            ("What motor does it use?", "Typically a 1440 RPM, 3-phase induction motor from 7.5 HP to 15 HP."),
            ("Is the vibration adjustable?", "Yes, by changing the counterweights on the flywheels / eccentric shaft."),
        ],
    },
    "pusher": {
        "output": "Manual_Tools_Co_Pusher_Machine.pdf",
        "title": "PUSHER MACHINE",
        "subtitle": "WITH ROLLER STAMPING ARRANGEMENT",
        "main_image": "assets/img/about-us-products/Pusher Machine With Stamping Arrangement.jpg",
        "gallery": "assets/img/product-images/pusher-machine-with-stamping-arrangement/",
        "summary": "A rail-mounted pusher machine for stamp-charged coke ovens. It combines a 20-metre pusher beam (40 HP drive) with a roller stamping system for uniform coal cake density.",
        "left_title": "DRIVES",
        "left": ["Main Pusher Motor: 40 HP", "Long Travel Motor: 15 HP", "Stamping Drive: 7.5 HP", "Total Connected Load: approx. 65 - 70 HP"],
        "right_title": "CONSTRUCTION",
        "right": ["Pusher Beam: 20 m (Heavy Fabrication)", "Leveller Beam: 20 m (Rack & Pinion)", "Helical Gearbox & Chain Drive", "Suits ovens up to 11 m long"],
        "steps": [
            ("1. Coal Stamping", "Coal fines are fed in and the roller stamping system compacts them into a high-density cake."),
            ("2. Charging", "The machine travels on rails along the battery and aligns with the oven."),
            ("3. Coke Ejection", "After carbonisation, the pusher beam rams the finished coke mass out of the oven."),
        ],
        "apps": [
            ("Coke Ovens", "Horizontal coke ovens that use stamping technology."),
            ("Steel Plants", "Producing high-density metallurgical coke for blast furnaces."),
            ("Coal Carbonisation", "Consistent coal cake density for uniform carbonisation."),
        ],
        "faqs": [
            ("What is the maximum oven size?", "The standard 20-metre beam suits ovens up to 11 metres long. Custom lengths are available."),
            ("Why roller stamping?", "It is faster and needs less maintenance than drop-hammer systems, with continuous compaction."),
            ("What is the power requirement?", "About 65 - 70 HP connected load (40 HP main + 15 HP travel + 7.5 HP stamping + auxiliaries)."),
            ("Is the operation automated?", "Semi-automatic: travel and alignment are motorised, stamping and pushing are panel-controlled."),
            ("Does it include the charging box?", "It is usually part of the oven structure, but we can fabricate a mobile charging box if required."),
        ],
    },
    "charging-car": {
        "output": "Manual_Tools_Co_Charging_Car.pdf",
        "title": "COAL CHARGING CAR",
        "subtitle": "TOP FEED - COKE OVEN MACHINERY SERIES",
        "main_image": "assets/img/about-us-products/Coal-Charging-Car.jpg",
        "gallery": "assets/img/product-images/coal-charging-car/",
        "summary": "A rail-mounted charging car (larry car) for top charging of coke ovens. Four conical hoppers deliver measured coal into the oven chambers.",
        "left_title": "PERFORMANCE",
        "left": ["Hopper Capacity: 4 / 8 / 15 / 20 Tons", "Long Travel Motor: 15 HP", "Travel Speed: 60 - 80 m/min", "Charging Mouths: 4 Nos."],
        "right_title": "CONSTRUCTION",
        "right": ["4 Conical Hoppers, 8 mm Plate", "Worm Reducer Travel Gearbox", "Motorised Slide Gates (3 HP)", "Manual Override for Power Failure"],
        "steps": [
            ("1. Bunker Filling", "The car stops under the coal tower and its 4 hoppers are filled with a measured coal blend."),
            ("2. Alignment", "The car travels to the empty oven; telescopic sleeves align with the charging holes to limit smoke leakage."),
            ("3. Gravity Discharge", "The bottom slide gates open and coal flows into the oven by gravity."),
        ],
        "apps": [
            ("Coke Ovens", "Top-charged by-product recovery coke oven batteries."),
            ("Steel Plants", "Continuous production of metallurgical coke."),
        ],
        "faqs": [
            ("What travel system is used?", "Rail-mounted track wheels driven by a 15 HP slip-ring or squirrel cage motor."),
            ("How many charging mouths?", "Standard configuration is 4, matching the 4 charging holes on the oven top."),
            ("Is the discharge automated?", "Slide gates are motorised (3 HP) for semi-automatic operation, with a manual override wheel."),
            ("What safety features are included?", "Hydraulic buffers, electromagnetic brakes, travel alarms and operator cabin heat shields."),
            ("Can it handle wet coal?", "Yes, the steep conical hoppers help wet coal flow."),
        ],
    },
    "coal-crusher-double": {
        "output": "Manual_Tools_Co_Coal_Crusher_Double_Disc.pdf",
        "title": "COAL CRUSHER (5 NO.)",
        "subtitle": "DOUBLE DISC - HIGH CAPACITY DISINTEGRATOR",
        "main_image": "assets/img/about-us-products/Coal Crusher Double Disc.jpg",
        "gallery": "assets/img/product-images/coal-crusher-double-disc/",
        "summary": "A double disc coal crusher for high-volume plants: up to 25 TPH, with 12 manganese steel hammers that reduce coal lumps up to 150 mm to below 2 mm.",
        "left_title": "PERFORMANCE",
        "left": ["Capacity: 20 - 25 Tons / Hour", "Motor: 160 - 200 HP", "Input Feed Size: below 150 mm", "Output Size: below 2 mm"],
        "right_title": "DURABILITY & DESIGN",
        "right": ["Double Disc Rotor, 12 Manganese Hammers", "Individually Replaceable Hammers", "12 mm Fabricated Steel Housing", "Handles moisture up to 10 - 12%"],
        "steps": [
            ("1. Large Feed Intake", "Accepts lumps up to 150 mm; the wide hopper spreads material across both discs."),
            ("2. Dual Rotor Impact", "Two discs carrying 12 manganese hammers create a dense impact zone."),
            ("3. High Volume Discharge", "Crushed coal passes the calibrated grate bars at up to 25 TPH, below 2 mm."),
        ],
        "apps": [
            ("Large Coke Ovens", "High-capacity recovery ovens needing continuous feed."),
            ("Thermal Power", "Consistent fuel for larger FBC boilers."),
            ("Briquetting Plants", "High volumes of fines for fuel briquettes."),
        ],
        "faqs": [
            ("How does it differ from the Single Disc?", "Two rotors and 12 hammers give 20 - 25 TPH and accept 150 mm feed, versus 8 - 10 TPH for the Single Disc."),
            ("What motor is required?", "A slip-ring or squirrel cage motor between 160 HP and 200 HP."),
            ("Can it handle wet coal?", "Up to 10 - 12% moisture; clean the grate bars more often for sticky coal."),
            ("Are the hammers replaceable individually?", "Yes, each hammer can be replaced or reversed without dismantling the rotor."),
            ("What is the delivery timeline?", "Made to order; fabrication usually takes 4 - 5 weeks depending on the production queue."),
        ],
    },
}

# Helvetica (core font) only covers Latin-1.
_ASCII = str.maketrans({"–": "-", "—": "-", "‘": "'", "’": "'", "“": '"', "”": '"'})


def clean(text):
    return text.translate(_ASCII)


def load_image(path, max_px=1400):
    """Downscale before embedding so the PDF stays small."""
    im = Image.open(path)
    im.thumbnail((max_px, max_px))
    if im.mode not in ("RGB", "L"):
        background = Image.new("RGB", im.size, (255, 255, 255))
        background.paste(im, mask=im.convert("RGBA").split()[-1])
        im = background
    return im


def fit_image(pdf, path, x, y, box_w, box_h):
    im = load_image(path)
    scale = min(box_w / im.width, box_h / im.height)
    w, h = im.width * scale, im.height * scale
    pdf.image(im, x + (box_w - w) / 2, y + (box_h - h) / 2, w, h)


class ProductBrochure(MTCStyleBrochure):
    def __init__(self):
        super().__init__()
        self.set_image_filter("DCTDecode")  # store photos as JPEG

    def draw_gallery(self, folder):
        images = sorted(
            f for f in glob.glob(folder + "*")
            if f.lower().endswith((".jpg", ".jpeg", ".png")) and "process-diagram" not in f
        )[:3]
        if not images:
            return
        top = self.get_y() + 5
        self.draw_section_header("PRODUCT GALLERY", top)
        margin, gap, img_h = 10, 15, 40
        img_w = (210 - 2 * margin - 2 * gap) / 3
        y = top + 15
        for i, path in enumerate(images):
            fit_image(self, path, margin + i * (img_w + gap), y, img_w, img_h)


def build(key):
    p = PRODUCTS[key]
    pdf = ProductBrochure()
    pdf.drawer_first_page()

    # Page 2: overview and specs
    pdf.set_auto_page_break(auto=True, margin=20)
    pdf.add_page()
    pdf.set_y(35)
    pdf.set_font(FONT_FAMILY, "B", 24)
    pdf.set_text_color(*COLORS["text_main"])
    pdf.cell(0, 14, clean(p["title"]), new_x="LMARGIN", new_y="NEXT")
    pdf.set_font(FONT_FAMILY, "B", 12)
    pdf.set_text_color(120)
    pdf.cell(0, 8, clean(p["subtitle"]), new_x="LMARGIN", new_y="NEXT")
    pdf.ln(5)

    y_hero = pdf.get_y()
    fit_image(pdf, p["main_image"], 10, y_hero, 105, 65)

    pdf.set_xy(125, y_hero)
    pdf.set_font(FONT_FAMILY, "B", 10)
    pdf.set_text_color(*COLORS["accent_red"])
    pdf.cell(0, 10, "KEY CAPABILITY:", new_x="LMARGIN", new_y="NEXT")
    pdf.set_x(125)
    pdf.set_font(FONT_FAMILY, "", 10)
    pdf.set_text_color(*COLORS["text_main"])
    pdf.multi_cell(75, 6, clean(p["summary"]))

    y_cols = y_hero + 75
    for x, title, items in ((10, p["left_title"], p["left"]), (110, p["right_title"], p["right"])):
        pdf.set_xy(x, y_cols)
        pdf.set_font(FONT_FAMILY, "B", 11)
        pdf.set_text_color(*COLORS["text_main"])
        pdf.set_draw_color(194, 24, 7)
        pdf.set_line_width(0.4)
        pdf.cell(90, 10, title, border="B")
    bottom = y_cols + 12
    for x, items in ((10, p["left"]), (110, p["right"])):
        pdf.add_bullet_list([clean(i) for i in items], x, y_cols + 12)
        bottom = max(bottom, pdf.get_y())
    pdf.set_y(bottom)

    pdf.draw_gallery(p["gallery"])
    pdf.request_A_quotation()

    # Page 3: process, applications, FAQ
    pdf.add_page()
    pdf.set_y(38)
    pdf.draw_section_header("HOW IT WORKS", pdf.get_y())
    pdf.ln(3)
    for title, desc in p["steps"]:
        pdf.set_font(FONT_FAMILY, "B", 10)
        pdf.set_text_color(*COLORS["accent_red"])
        pdf.cell(0, 6, clean(title), new_x="LMARGIN", new_y="NEXT")
        pdf.set_font(FONT_FAMILY, "", 10)
        pdf.set_text_color(*COLORS["text_main"])
        pdf.multi_cell(0, 5, clean(desc), new_x="LMARGIN", new_y="NEXT")
        pdf.ln(2)

    pdf.ln(2)
    pdf.draw_section_header("APPLICATIONS", pdf.get_y())
    pdf.ln(3)
    for title, desc in p["apps"]:
        pdf.set_font(FONT_FAMILY, "B", 10)
        pdf.set_text_color(*COLORS["text_main"])
        pdf.cell(45, 6, clean(title))
        pdf.set_font(FONT_FAMILY, "", 10)
        pdf.multi_cell(0, 6, clean(desc), new_x="LMARGIN", new_y="NEXT")

    faqs = [{"q": clean(q), "a": clean(a)} for q, a in p["faqs"]]
    pdf.create_faq_section(faqs, y_start=pdf.get_y() + 5)
    pdf.request_A_quotation()

    out = "brochure/" + p["output"]
    pdf.output(out)
    print("wrote", out)


if __name__ == "__main__":
    for key in sys.argv[1:] or PRODUCTS:
        build(key)

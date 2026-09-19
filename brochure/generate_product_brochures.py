"""Build every Manual Tools Company product brochure from one data table.

Layout lives in brochure_layout.py; this file is copy only. All copy is taken
from the matching product page, so keep the two in sync when specs change.

Run from the repo root (image paths are relative):
    python brochure/generate_product_brochures.py            # all nine
    python brochure/generate_product_brochures.py haulage    # one

Each entry needs:
    output        file name written into brochure/
    title         product name, printed in caps on the cover
    subtitle      one line under the title
    main_image    hero photo for page 2
    cover_image   cover art, normally the home-page carousel cutout for this
                  product (defaults to main_image)
    gallery       folder scanned for up to three gallery photos
    summary       130-170 words condensed to two or three sentences
    stats         three headline figures for the cover, (value, caption)
    specs         (label, value) rows for the specification table
    features      design and durability points
    steps         (title, description) process flow
    apps          (sector, description)
    faqs          (question, answer)

The "Key specifications" box on page 2 is not copied here: it is read from
the product page's `specs` in product-data.php (via the php CLI), so the
brochure always shows the same four figures as the website.
"""
import glob
import json
import shutil
import subprocess
import sys

from brochure_layout import (
    COL_R_X, COL_W, CONTENT_W, FONT_FAMILY, INK, INK_BODY, INK_SOFT, MARGIN,
    FOOTER_Y, PANEL, RED, RULE, MTCBrochure, clean, cutout_image, fit_image,
)

# Brochure key -> product page slug in product-data.php.
SITE_SLUG = {
    "coal-crusher-single": "coal-crusher-5-No-single-disc",
    "coal-crusher-double": "coal-crusher-5-No-double-disc",
    "coke-cutter-double-drive": "coke-cutter-double-drive",
    "coke-cutter-ring-type": "coke-cutter-double-drive-ring-type",
    "haulage": "haulage",
    "power-winch": "power-winch",
    "vibrator-screen": "vibrator-screen",
    "pusher": "pusher-with-stamping-arrangement",
    "charging-car": "coal-charging-car",
    "conveyor-materials": "conveyor-materials",
}

_site_specs = None


def site_specs(key):
    """[(icon, label, value)] from the product page's spec grid."""
    global _site_specs
    if _site_specs is None:
        php = shutil.which("php")
        if not php:
            sys.exit("php is needed to read product-data.php (the Key specifications box).")
        out = subprocess.run(
            [php, "-r", 'include "product-data.php"; echo json_encode(array_map('
                        'fn($p) => $p["specs"], $MTC_PRODUCTS));'],
            capture_output=True, text=True, check=True, encoding="utf-8")
        _site_specs = json.loads(out.stdout)
    return [tuple(s) for s in _site_specs[SITE_SLUG[key]]]


# Same wording as the "Buying information" box on every product page.
# Keep the two in sync: the contact-page FAQ has to agree with these terms.
BUYING_INFO = [
    ("Lead time", "Made to order. Ask us for the current lead time."),
    ("Warranty", "1 year, as on all our machinery."),
    ("Installation", "Installation supervision and commissioning available."),
    ("Custom builds", "Capacity, motor power and dimensions matched to your plant and drawings."),
]

PRODUCTS = {
    "coal-crusher-single": {
        "output": "Manual_Tools_Co_Coal_Crusher_Single_Disc.pdf",
        "title": "Coal Crusher (5 No.)",
        "subtitle": "Single Disc - Coal Disintegrator",
        "main_image": "assets/img/product-images/coal-crusher-single-disc/coal-crusher-2.png",
        "cover_image": "assets/img/slide/Coal-Crusher.png",
        "gallery": "assets/img/product-images/coal-crusher-single-disc/",
        "summary": "A single disc coal crusher that pulverises coal to below 2 mm for coke oven and boiler feed. Six mild steel hammers run inside a 12 mm fabricated body, and the extra-wide disc keeps the output size uniform across the full 8 - 12 TPH range.",
        "stats": [("8 - 12 TPH", "Crushing capacity"), ("80 - 120 HP", "Motor range"), ("< 2 mm", "Output size")],
        "specs": [
            ("Crushing Capacity", "8 - 12 Tons / Hour"),
            ("Motor", "80 - 120 H.P."),
            ("Input Feed Size", "Up to 125 mm"),
            ("Output Size", "Below 2 mm"),
            ("Hammers", "6 Nos., Mild Steel"),
            ("Body Thickness", "12 mm Fabricated Steel"),
        ],
        "features": [
            "Manganese steel side and top liner jaw plates",
            "Double row spherical roller bearings",
            "Single-side easy feeding mouth",
            "Extra-wide disc for uniform output",
            "Hammers replaceable through the side access door",
        ],
        "steps": [
            ("Gravity Feed", "Raw coal lumps up to 125 mm are delivered by conveyor and drop into the crushing chamber through the top hopper."),
            ("High-Speed Impact", "The single disc rotates at speed. Six mild steel hammers throw the coal against the liner plates and shatter it on contact."),
            ("Fine Discharge", "The pulverised coal passes the grate bars below 2 mm and discharges onto the outgoing conveyor, ready for the oven or boiler."),
        ],
        "apps": [
            ("Coke Ovens", "Preparing the fine coal blend charged into stamp and top-charged batteries."),
            ("Thermal Power", "Consistent sub-2 mm fuel for fluidised bed combustion boilers."),
            ("Coal Washeries", "Reducing raw coal ahead of washing and blending."),
        ],
        "faqs": [
            ("What is the output size?", "The single disc crusher is calibrated to produce a fine output below 2 mm."),
            ("What is the motor capacity?", "An electrical motor between 80 H.P. and 120 H.P., depending on the tons per hour you need."),
            ("Are the hammers replaceable?", "Yes. The six mild steel hammers are replaced through the side access door without dismantling the rotor."),
            ("What is the delivery time?", "Made to order; fabrication usually takes 3 - 4 weeks depending on the production queue."),
            ("What maintenance does it need?", "Check the liner plates and grease the bearings routinely. Replace the hammers when worn."),
        ],
    },
    "coal-crusher-double": {
        "output": "Manual_Tools_Co_Coal_Crusher_Double_Disc.pdf",
        "title": "Coal Crusher (5 No.)",
        "subtitle": "Double Disc - High Capacity Disintegrator",
        "main_image": "assets/img/product-images/coal-crusher-double-disc/coal-crusher-2.png",
        "cover_image": "assets/img/slide/Coal-Crusher-Double-disc.png",
        "gallery": "assets/img/product-images/coal-crusher-double-disc/",
        "summary": "A double disc coal crusher for high-volume plants: up to 25 TPH, with 12 mild steel hammers that reduce coal lumps up to 150 mm to below 2 mm.",
        "stats": [("20 - 25 TPH", "Crushing capacity"), ("150 - 180 HP", "Motor range"), ("< 2 mm", "Output size")],
        "specs": [
            ("Crushing Capacity", "20 - 25 Tons / Hour"),
            ("Motor", "150 - 180 H.P."),
            ("Input Feed Size", "Below 150 mm"),
            ("Output Size", "Below 2 mm"),
            ("Hammers", "12 Nos., Mild Steel"),
            ("Body Thickness", "12 mm Fabricated Steel"),
        ],
        "features": [
            "Double disc rotor carrying 12 mild steel hammers",
            "Individually replaceable hammers",
            "12 mm fabricated steel housing",
            "Handles moisture up to 10 - 12%",
        ],
        "steps": [
            ("Large Feed Intake", "Accepts lumps up to 150 mm; the wide hopper spreads material across both discs."),
            ("Dual Rotor Impact", "Two discs carrying 12 mild steel hammers create a dense impact zone."),
            ("High Volume Discharge", "Crushed coal passes the calibrated grate bars at up to 25 TPH, below 2 mm."),
        ],
        "apps": [
            ("Large Coke Ovens", "High-capacity recovery ovens needing continuous feed."),
            ("Thermal Power", "Consistent fuel for larger FBC boilers."),
            ("Briquetting Plants", "High volumes of fines for fuel briquettes."),
        ],
        "faqs": [
            ("How does it differ from the Single Disc?", "Two rotors and 12 hammers give 20 - 25 TPH and accept 150 mm feed, versus 8 - 12 TPH for the Single Disc."),
            ("What motor is required?", "A slip-ring or squirrel cage motor between 150 HP and 180 HP."),
            ("Can it handle wet coal?", "Up to 10 - 12% moisture; clean the grate bars more often for sticky coal."),
            ("Are the hammers replaceable individually?", "Yes, each hammer can be replaced or reversed without dismantling the rotor."),
            ("What is the delivery timeline?", "Made to order; fabrication usually takes 4 - 5 weeks depending on the production queue."),
        ],
    },
    "coke-cutter-double-drive": {
        "output": "Manual_Tools_Co_Coke_Cutter_Double_Drive.pdf",
        "title": "Coke Cutter Machine",
        "subtitle": "Double Drive, Drum Type - Industrial Series",
        "main_image": "assets/img/product-images/coke-cutter/4.png",
        "cover_image": "assets/img/slide/Coke-Cutter-Machine.png",
        "gallery": "assets/img/product-images/coke-cutter/",
        "summary": "A double drive coke cutter built for torque. Two 20 HP motors drive cast steel gears on both ends of the cutting drums, and the adjustable drum distance holds output between 40 mm and 60 mm. Manganese steel liner teeth take the wear and are replaceable.",
        "stats": [("12 - 15 TPH", "Breaking capacity"), ("20 HP x 2", "Double drive"), ("40 - 60 mm", "Output size")],
        "specs": [
            ("Breaking Capacity", "12 - 15 Tons / Hour"),
            ("Motor", "20 H.P. x 2 (Double Drive)"),
            ("Input Feed Size", "Below 200 mm"),
            ("Output Size", "40 - 60 mm"),
            ("Drum Adjustment", "Up to 30 mm"),
            ("Teeth", "Manganese Steel Liner"),
        ],
        "features": [
            "Manganese steel liner teeth, replaceable",
            "Cast steel gears on both sides",
            "Adjustable drum distance up to 30 mm",
            "Double drive system prevents jamming",
        ],
        "steps": [
            ("Material Feed", "Coke lumps up to 200 mm are delivered by the upper conveyor belt directly into the intake hopper."),
            ("Double Drive Cutting", "The dual 20 HP motors power the cutting drums from both ends, breaking the material down without jamming."),
            ("Sized Output", "Uniformly sized coke, 40 - 60 mm, discharges onto the lower conveyor belt for immediate transport."),
        ],
        "apps": [
            ("Steel Plants", "Sizing metallurgical coke for blast furnace charging."),
            ("Cupola Furnaces", "Consistent coke sizes for foundry melting rates."),
            ("Coke Oven Plants", "Cutting oven-discharged coke to customer grades."),
        ],
        "faqs": [
            ("What is the advantage of the Double Drive system?", "20 HP motors on both sides give balanced torque and consistent power, preventing jamming and cutting hard coke lumps uniformly."),
            ("Can I adjust the output size?", "Yes. The adjustable drum distance lets you tune the finished coke size between 40 mm and 60 mm."),
            ("What is the maximum feed size?", "This heavy-duty cutter accepts coke lumps up to 200 mm."),
            ("How durable are the cutting teeth?", "High-grade manganese steel liner teeth, wear-resistant and fully replaceable."),
            ("What is the delivery timeline?", "Made to order; fabrication usually takes 4 - 5 weeks depending on the production queue."),
        ],
    },
    "coke-cutter-ring-type": {
        "output": "Manual_Tools_Co_Coke_Cutter_Ring_Type.pdf",
        "title": "Ring Type Coke Cutter",
        "subtitle": "Double Drive - Segmented Manganese Steel Rings",
        "main_image": "assets/img/product-images/coke-cutter-ring-teeth/2.png",
        "cover_image": "assets/img/slide/Coke-Cutter-Machine-Ring-Type.png",
        "gallery": "assets/img/product-images/coke-cutter-ring-teeth/",
        "summary": "A double drive coke cutter whose shafts carry separate toothed rings of high manganese steel instead of one lined drum. Two 25 HP motors, 15 - 20 TPH, adjustable 40 - 60 mm output.",
        "stats": [("15 - 20 TPH", "Cutting capacity"), ("25 HP x 2", "Double drive"), ("40 - 60 mm", "Output size")],
        "specs": [
            ("Cutting Capacity", "15 - 20 Tons / Hour"),
            ("Motor", "25 H.P. + 25 H.P. (Total 50 HP)"),
            ("Input Feed Size", "Below 200 mm"),
            ("Output Size", "40 - 60 mm (Adjustable)"),
            ("Cutting Element", "Segmented Toothed Rings"),
            ("Ring Material", "High Manganese Steel"),
        ],
        "features": [
            "Segmented toothed rings, keyed individually",
            "High manganese steel that work-hardens in use",
            "Individually replaceable rings",
            "Double drive: equal torque, less jamming",
        ],
        "steps": [
            ("Feed Intake", "Large coke lumps fall into the cutting chamber. The robust housing is designed to withstand impact from heavy material."),
            ("Ring Shearing", "As the shafts rotate, the toothed rings engage the coke. The segmented design concentrates force for cleaner cuts with less dust."),
            ("Sized Output", "Sized coke (40 - 60 mm) passes through the gap. Oversized pieces remain until cut, for consistent furnace-grade coke."),
        ],
        "apps": [
            ("Steel Plants", "Metallurgical coke for blast furnaces, where air flow permeability is key."),
            ("Cupola Furnaces", "Consistent coke sizes for foundries: stable temperatures and melting rates."),
            ("Ferro Alloys", "Specific carbon sizing for reduction processes."),
        ],
        "faqs": [
            ("What is the benefit of the Ring Type design?", "Rings are keyed to the shaft individually, so a damaged section is replaced on its own instead of relining the whole drum. The cutting is also very aggressive on hard coke."),
            ("Why are there two motors (Double Drive)?", "Equal torque on both ends of the cutting shaft prevents jamming on large or hard lumps and extends gear life."),
            ("Can I adjust the output size?", "Yes. The gap between the ring shafts is adjustable from 40 mm to 60 mm."),
            ("How durable are the rings?", "They are cast from High Manganese Steel, which work-hardens in use and withstands abrasive metallurgical coke."),
            ("What capacity does this machine handle?", "This model is designed for 15 to 20 Tons Per Hour (TPH)."),
        ],
    },
    "haulage": {
        "output": "Manual_Tools_Co_Haulage_Machine.pdf",
        "title": "Haulage Machine",
        "subtitle": "10 HP / 10 Ton - Coke Oven Extraction Series",
        "main_image": "assets/img/product-images/haulage/haulage-2.png",
        "cover_image": "assets/img/slide/Haulage-Machine.png",
        "gallery": "assets/img/product-images/haulage/",
        "summary": "A heavy-duty haulage machine for coke ovens and mines. A 10 HP motor drives a high-torque worm reducer gearbox for steady, controlled pulling of up to 10 tons.",
        "stats": [("10 Tons", "Pulling capacity"), ("10 HP", "Motor"), ("440 V", "3-phase supply")],
        "specs": [
            ("Pulling Capacity", "10 Tons (Horizontal)"),
            ("Motor", "10 H.P. (3-Phase, 440V)"),
            ("Gearbox", "Heavy Duty Worm Reducer"),
            ("Base Frame", "Fabricated C-Channel Steel"),
            ("Gears", "Cast Steel, Machine Cut"),
            ("Application", "Coke Oven / Mining"),
        ],
        "features": [
            "Cast steel gears, machine cut",
            "Fabricated C-channel steel base frame",
            "Manual or electro-hydraulic thruster brake (optional)",
            "Non-reversible worm drive resists back-slip",
        ],
        "steps": [
            ("Electrical Input", "The 10 HP motor starts; a flexible coupling transmits power to the gearbox input shaft and absorbs start-up shock."),
            ("Speed Reduction", "The worm reducer lowers the RPM and multiplies torque. The non-reversible gear action helps prevent load back-slip."),
            ("Drum Traction", "The output shaft turns the rope drum, coiling the steel wire rope and applying a steady 10-ton pull on the connected load."),
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
        "title": "Door Lifting Power Winch",
        "subtitle": "Coke Oven Gate Lifting Equipment",
        "main_image": "assets/img/product-images/power-winch/power-winch-2.png",
        "cover_image": "assets/img/slide/Power-Winch.png",
        "gallery": "assets/img/product-images/power-winch/",
        "summary": "A power winch for lifting heavy coke oven doors. Its self-locking worm reducer gearbox holds the load steady even during a power failure. 5 - 7.5 HP motor, up to 5 tons.",
        "stats": [("2.5 - 5 T", "Lifting capacity"), ("5 - 7.5 HP", "Motor"), ("2 - 4 m/min", "Lifting speed")],
        "specs": [
            ("Lifting Capacity", "2.5 - 5 Tons"),
            ("Motor", "5 - 7.5 H.P. (3-Phase)"),
            ("Operation", "Vertical Lift"),
            ("Lifting Speed", "Approx. 2 - 4 m / min"),
            ("Gearbox", "Self-Locking Worm Reducer"),
            ("Drum", "Grooved Steel Drum / Steel Drum"),
        ],
        "features": [
            "Self-locking worm reducer gearbox",
            "Gears for a smooth, non-jerky lift",
            "Grooved steel drum or steel drum for wire rope",
        ],
        "steps": [
            ("Drive Activation", "The electric motor engages and drives the worm gearbox input shaft through a coupling."),
            ("Torque Multiplication", "The worm shaft drives the worm wheel, cutting speed and multiplying torque for a smooth, non-jerky lift."),
            ("Vertical Lift", "The output shaft turns the grooved drum, winding the wire rope and lifting the oven door to the required height."),
        ],
        "apps": [
            ("Coke Oven Doors", "Lifting and positioning heavy oven doors during charging."),
            ("Heavy Dampers", "Lifting isolation dampers in flue gas ducts in power plants and steel mills."),
            ("Maintenance Bays", "General vertical lifting where overhead cranes are not available."),
        ],
        "faqs": [
            ("Why a worm gearbox instead of helical?", "Worm gearboxes are self-locking: if power fails, the door's weight cannot drive the motor backwards."),
            ("What is the lifting speed?", "Slow and controlled, approximately 2 - 4 metres/minute, for safety."),
            ("Does it come with a brake?", "The worm reducer gearbox is self-locking, so the door's weight cannot drive the motor backwards if the power fails."),
            ("What capacity do I need for a coke oven?", "Standard coke oven doors usually need 2.5 to 5 tons, depending on battery height and door weight."),
            ("Is the wire rope included?", "Yes, a standard length is included; rope length and diameter can be customised."),
        ],
    },
    "vibrator-screen": {
        "output": "Manual_Tools_Co_Vibrator_Screen.pdf",
        "title": "Vibrator Screen Machine",
        "subtitle": "Multi-Deck Series - Industrial Grading & Sorting",
        "main_image": "assets/img/product-images/vibrator-screen/Vibrator-Screen-3.png",
        "cover_image": "assets/img/product-images/vibrator-screen/Vibrator-Screen-3.png",
        "gallery": "assets/img/product-images/vibrator-screen/",
        "summary": "A heavy-duty vibrating screen for coke and coal. An eccentric shaft gives strong vibration and high screening efficiency, in 1 to 4 deck configurations.",
        "stats": [("1 - 4", "Screening decks"), ("7.5 - 15 HP", "Motor range"), ("5' x 16'", "Max screen size")],
        "specs": [
            ("Decks", "1, 2, 3 or 4 (Customisable)"),
            ("Screen Sizes", "4'x12', 4'x16', 5'x16'"),
            ("Motor", "7.5 - 15 H.P. (Based on Load)"),
            ("Mesh", "High Carbon Steel"),
            ("Vibration", "Eccentric Shaft Mechanism"),
            ("Suspension", "Heavy Coil Spring"),
        ],
        "features": [
            "Eccentric shaft vibration mechanism",
            "Heavy coil spring suspension",
            "Interchangeable mesh decks",
            "Adjustable amplitude via counterweights",
        ],
        "steps": [
            ("Material Feed", "Mixed material is fed onto the top deck and spread across the full width of the screen cloth."),
            ("Stratification", "Fines pass through the mesh to lower decks while oversize lumps ride over the top to the discharge chute."),
            ("Multi-Output", "Each deck discharges its own size grade (e.g. +40mm, 20-40mm, -20mm) to separate hoppers or conveyors."),
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
        "title": "Pusher Machine",
        "subtitle": "With Roller Stamping Arrangement",
        "main_image": "assets/img/product-images/pusher-machine-with-stamping-arrangement/pusher-1.png",
        "cover_image": "assets/img/slide/Pusher-with-stamping-arrangement.png",
        "gallery": "assets/img/product-images/pusher-machine-with-stamping-arrangement/",
        "summary": "A rail-mounted pusher machine for stamp-charged coke ovens. It combines a 20-metre pusher beam (40 HP drive) with a roller stamping system for uniform coal cake density.",
        "stats": [("65 - 70 HP", "Connected load"), ("20 m", "Pusher beam"), ("11 m", "Max oven length")],
        "specs": [
            ("Main Pusher Motor", "40 H.P."),
            ("Long Travel Motor", "15 H.P."),
            ("Stamping Drive", "7.5 H.P."),
            ("Total Connected Load", "Approx. 65 - 70 H.P."),
            ("Pusher Beam", "20 m (Heavy Fabrication)"),
            ("Leveller Beam", "20 m (Rack & Pinion)"),
        ],
        "features": [
            "Helical gearbox and chain drive",
            "Rack and pinion leveller beam",
            "Suits ovens up to 11 m long",
            "Rail-mounted travel along the battery",
        ],
        "steps": [
            ("Coal Stamping", "Coal fines are fed in and the roller stamping system compacts them into a high-density cake."),
            ("Charging", "The machine travels on rails along the battery and aligns with the oven."),
            ("Coke Ejection", "After carbonisation, the pusher beam rams the finished coke mass out of the oven."),
        ],
        "apps": [
            ("Coke Ovens", "Stamp-charged horizontal coke ovens."),
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
        "title": "Coal Charging Car",
        "subtitle": "Top Feed - Coke Oven Machinery Series",
        "main_image": "assets/img/product-images/coal-charging-car/coal-charging-car-2.jpg",
        "cover_image": "assets/img/slide/Coal-Charging-Car.png",
        "gallery": "assets/img/product-images/coal-charging-car/",
        "summary": "A rail-mounted charging car (larry car) for top charging of coke ovens. Two, three or four conical hoppers deliver measured coal into the oven chambers.",
        "stats": [("8 - 20 T", "Hopper capacity"), ("2, 3 & 4", "Charging mouths"), ("60 - 80 m/min", "Travel speed")],
        "specs": [
            ("Hopper Capacity", "8 / 15 / 20 Tons"),
            ("Long Travel Motor", "15 H.P."),
            ("Travel Speed", "60 - 80 m / min"),
            ("Charging Mouths", "2, 3 & 4 Nos."),
            ("Hopper Plate", "8 mm, Conical"),
            ("Slide Gates", "Motorised, 3 H.P."),
        ],
        "features": [
            "Two, three or four conical hoppers in 8 mm plate",
            "Worm reducer travel gearbox",
            "Motorised slide gates with manual override",
            "Telescopic sleeves limit smoke leakage",
        ],
        "steps": [
            ("Bunker Filling", "The car stops under the coal tower and its 4 hoppers are filled with a measured coal blend."),
            ("Alignment", "The car travels to the empty oven; telescopic sleeves align with the charging holes to limit smoke leakage."),
            ("Gravity Discharge", "The bottom slide gates open and coal flows into the oven by gravity."),
        ],
        "apps": [
            ("Coke Ovens", "Top-charged by-product recovery coke oven batteries."),
            ("Steel Plants", "Continuous production of metallurgical coke."),
        ],
        "faqs": [
            ("What travel system is used?", "Rail-mounted track wheels driven by a 15 HP slip-ring or squirrel cage motor."),
            ("How many charging mouths?", "Standard configuration is 4, matching the 4 charging holes on the oven top."),
            ("Is the discharge automated?", "Slide gates are motorised (3 HP) for semi-automatic operation, with a manual override wheel."),
            ("What safety features are included?", "Hydraulic buffers, travel alarms and operator cabin heat shields."),
            ("Can it handle wet coal?", "Yes, the steep conical hoppers help wet coal flow."),
        ],
    },
    "conveyor-materials": {
        "output": "Manual_Tools_Co_Conveyor_Components.pdf",
        "title": "Conveyor Components",
        "subtitle": "Idlers, Rollers & Pulleys - Industrial Handling Systems",
        "main_image": "assets/img/product-images/conveyor-materials/Conveyor-2.png",
        "cover_image": "assets/img/slide/Conveyor-Materials.png",
        "gallery": "assets/img/product-images/conveyor-materials/",
        "summary": "Components for belt conveyors in coke oven plants, coal washeries and power plants: carrying idlers, return rollers, rubber-ringed impact rollers, and head and tail pulleys in plain steel or with rubber lagging. Rollers use seamless pipe on bright steel (EN-8) shafts with sealed ball bearings to keep dust out.",
        "stats": [("600 - 1400 mm", "Belt widths"), ("EN-8", "Shaft material"), ("Sealed", "Ball bearings")],
        "specs": [
            ("Belt Width Compatibility", "600 - 1400 mm"),
            ("Shaft Material", "Bright Steel Bar (EN-8)"),
            ("Bearings", "Ball Bearings (6204, 6205, 6305)"),
            ("Roller Pipe", "Heavy Gauge Seamless Steel"),
            ("Pulley Lagging", "Diamond Groove or Plain"),
            ("Idler Frames", "With Rollers or as Spares"),
        ],
        "features": [
            "Carrying idlers in 30 degree troughing sets",
            "Return rollers with a smooth surface to prevent belt wear",
            "Impact rollers with shock-absorbing rubber rings",
            "Head and tail pulleys with key-based locking assemblies",
            "Coupling pair available for the head pulley",
            "Bulk orders taken for plant-wide replacement",
        ],
        "steps": [
            ("Loading Point", "Material drops onto the belt over impact rollers, whose rubber rings absorb the shock and stop falling lumps damaging the belt."),
            ("Carrying Run", "Carrying idlers in 30 degree troughing sets shape the belt into a trough so it holds its load, running on sealed bearings that keep dust out."),
            ("Return Run and Drive", "Return rollers support the empty underside of the belt with a smooth face, while the head pulley drives the belt and the tail pulley keeps it tensioned."),
        ],
        "apps": [
            ("Coke Oven Plants", "Belt conveyors carrying coal to the ovens and coke away from them."),
            ("Coal Washeries", "Abrasive, wet duty where sealed bearings and lagged pulleys hold up."),
            ("Power Plants", "Continuous fuel handling from the yard to the bunkers."),
        ],
        "faqs": [
            ("What belt sizes do you support?", "We manufacture components for all standard belt widths: 600 mm, 750 mm, 800 mm, 900 mm, 1000 mm, 1200 mm and 1400 mm."),
            ("Are the impact rollers rubberized?", "Yes. Our impact rollers have robust rubber rings designed to absorb the shock of falling material at hopper loading points."),
            ("Do pulleys come with lagging?", "We offer both plain steel face pulleys and rubber-lagged pulleys (diamond groove or plain) for better traction in wet conditions."),
            ("Can you supply brackets?", "Yes. We can supply the idler frames (brackets) along with the rollers or separately as spares."),
            ("What is the delivery time?", "Standard sizes such as 800 mm and 1000 mm rollers are often in stock. Custom pulleys typically take 2 - 3 weeks."),
        ],
        "buying": [
            ("Lead time", "Standard sizes (800 mm and 1000 mm rollers) are often in stock. Custom pulleys usually take 2 - 3 weeks."),
            ("Warranty", "1 year, as on all our machinery."),
            ("Bulk orders", "Taken for plant-wide replacement of idlers, rollers and pulleys."),
            ("Custom builds", "Sizes and lagging matched to your plant and drawings."),
        ],
    },
}


def gallery_images(folder, limit=3):
    return sorted(
        f for f in glob.glob(folder + "*")
        if f.lower().endswith((".jpg", ".jpeg", ".png"))
        and "process-diagram" not in f
        and ".thumb." not in f
    )[:limit]


def page_overview(pdf, p, key):
    """Page 2: title, summary, hero shot, key specifications, full table."""
    pdf.add_page()
    pdf.set_y(30)

    pdf.set_font(FONT_FAMILY, "B", 21)
    pdf.set_text_color(*INK)
    pdf.multi_cell(CONTENT_W, 9.5, clean(p["title"]), new_x="LMARGIN", new_y="NEXT")
    pdf.set_font(FONT_FAMILY, "", 9.5)
    pdf.set_text_color(*INK_SOFT)
    pdf.multi_cell(CONTENT_W, 5, clean(p["subtitle"]), new_x="LMARGIN", new_y="NEXT")

    top = pdf.get_y() + 7
    hero_h = 58.0
    pdf.set_fill_color(*PANEL)
    pdf.rect(COL_R_X, top, COL_W, hero_h, "F", round_corners=True, corner_radius=2)
    try:
        art = cutout_image(p["main_image"], PANEL)
        if art is not None:
            scale = min((COL_W - 8) / art.width, (hero_h - 8) / art.height)
            w, h = art.width * scale, art.height * scale
            pdf.image(art, COL_R_X + (COL_W - w) / 2, top + (hero_h - h) / 2, w, h)
        else:
            fit_image(pdf, p["main_image"], COL_R_X + 4, top + 4, COL_W - 8, hero_h - 8)
    except Exception:
        pass

    pdf.label("At a glance", MARGIN, top)
    pdf.set_xy(MARGIN, top + 5.5)
    pdf.set_font(FONT_FAMILY, "", 9.5)
    pdf.set_text_color(*INK_BODY)
    pdf.multi_cell(COL_W, 5.2, clean(p["summary"]), new_x="LMARGIN", new_y="NEXT")

    # The cover already carries the three headline figures; this box shows
    # the product page's own four specs instead of repeating them.
    y = max(pdf.get_y(), top + hero_h) + 8
    y = pdf.key_specs(site_specs(key), y)

    pdf.set_y(y)
    pdf.section("Specifications")
    y = pdf.get_y()
    left_bottom = pdf.spec_table(p["specs"], MARGIN, y, COL_W)

    pdf.label("Design & Durability", COL_R_X, y - 0.5, color=INK_SOFT)
    right_bottom = pdf.feature_list(p["features"], COL_R_X, y + 5.5, COL_W)

    pdf.set_y(max(left_bottom, right_bottom) + 8)
    bottom = pdf.buying_info(p.get("buying", BUYING_INFO))
    # No quotation panel here: the last page carries it, and dropping it gives
    # the specifications room. Stop rather than let the page spill over.
    if bottom > FOOTER_Y - 8:
        sys.exit(f"{key}: page 2 content ends at {bottom:.1f} mm, into the footer at {FOOTER_Y:.1f} mm")


def page_process(pdf, p):
    """Page 3: process flow, applications, common questions."""
    pdf.add_page()
    pdf.set_y(28)
    pdf.section("How it works", gap_before=0)

    for i, (title, desc) in enumerate(p["steps"], 1):
        top = pdf.get_y()
        pdf.set_xy(MARGIN, top)
        pdf.set_font(FONT_FAMILY, "B", 16)
        pdf.set_text_color(*RED)
        pdf.cell(14, 8, f"{i:02d}")

        pdf.set_xy(MARGIN + 16, top)
        pdf.set_font(FONT_FAMILY, "B", 10)
        pdf.set_text_color(*INK)
        pdf.cell(CONTENT_W - 16, 5.5, clean(title), new_x="LMARGIN", new_y="NEXT")
        pdf.set_x(MARGIN + 16)
        pdf.set_font(FONT_FAMILY, "", 9)
        pdf.set_text_color(*INK_BODY)
        pdf.multi_cell(CONTENT_W - 16, 4.8, clean(desc), new_x="LMARGIN", new_y="NEXT")
        pdf.ln(3.5)
        if i < len(p["steps"]):
            pdf.set_draw_color(*RULE)
            pdf.set_line_width(0.2)
            pdf.line(MARGIN + 16, pdf.get_y(), MARGIN + CONTENT_W, pdf.get_y())
            pdf.ln(3.5)

    pdf.section("Applications")
    for name, desc in p["apps"]:
        top = pdf.get_y()
        pdf.set_xy(MARGIN, top)
        pdf.set_font(FONT_FAMILY, "B", 9)
        pdf.set_text_color(*INK)
        pdf.cell(44, 5.2, clean(name))
        pdf.set_xy(MARGIN + 44, top)
        pdf.set_font(FONT_FAMILY, "", 9)
        pdf.set_text_color(*INK_BODY)
        pdf.multi_cell(CONTENT_W - 44, 5.2, clean(desc), new_x="LMARGIN", new_y="NEXT")
        pdf.ln(1.8)

    pdf.section("Common questions")
    for q, a in p["faqs"]:
        pdf.set_x(MARGIN)
        pdf.set_font(FONT_FAMILY, "B", 9.5)
        pdf.set_text_color(*INK)
        pdf.multi_cell(CONTENT_W, 5, clean(q), new_x="LMARGIN", new_y="NEXT")
        pdf.set_x(MARGIN)
        pdf.set_font(FONT_FAMILY, "", 9)
        pdf.set_text_color(*INK_BODY)
        pdf.multi_cell(CONTENT_W, 4.8, clean(a), new_x="LMARGIN", new_y="NEXT")
        pdf.ln(4)


def frame(pdf, path, x, y, w, h):
    pdf.set_draw_color(*RULE)
    pdf.set_line_width(0.2)
    pdf.rect(x, y, w, h, "D", round_corners=True, corner_radius=2)
    try:
        fit_image(pdf, path, x + 3, y + 3, w - 6, h - 6)
    except Exception:
        pass


def page_gallery(pdf, p, key):
    """Page 4: gallery spread, the rest of the range, and the closing CTA."""
    pdf.add_page()
    pdf.set_y(28)

    others = [(q["title"], q["subtitle"]) for k, q in PRODUCTS.items() if k != key]

    # Work out what the range list needs, then give the gallery the rest. The
    # list grows with every new product, so fixed image heights would collide
    # with the quotation panel.
    index_h = 14 + ((len(others) + 1) // 2) * 9.5 if others else 0
    quote_top = FOOTER_Y - 32
    available = quote_top - 28 - index_h - 10

    images = gallery_images(p["gallery"], limit=3)
    if images:
        pdf.section("Product gallery", gap_before=0)
        y = pdf.get_y()
        gap = 6.0
        room = max(50.0, available - (pdf.get_y() - 28))
        if len(images) == 1:
            h = min(120.0, room)
            frame(pdf, images[0], MARGIN, y, CONTENT_W, h)
            y += h
        else:
            # One lead shot across the column, the rest side by side below it.
            lead = min(88.0, room * 0.6)
            small = min(55.0, room - lead - gap)
            frame(pdf, images[0], MARGIN, y, CONTENT_W, lead)
            y += lead + gap
            rest = images[1:]
            w = (CONTENT_W - gap * (len(rest) - 1)) / len(rest)
            for i, path in enumerate(rest):
                frame(pdf, path, MARGIN + i * (w + gap), y, w, small)
            y += small
        pdf.set_y(y)

    if others:
        pdf.section("Also from Manual Tools Company")
        pdf.product_index(others)

    pdf.quote_block()


def build(key):
    p = PRODUCTS[key]
    pdf = MTCBrochure(product_name=f"{p['title']} - {p['subtitle']}")
    pdf.cover(p["title"], p["subtitle"], p.get("cover_image", p["main_image"]), p["stats"])
    page_overview(pdf, p, key)
    page_process(pdf, p)
    page_gallery(pdf, p, key)

    out = "brochure/" + p["output"]
    pdf.output(out)
    print("wrote", out)


if __name__ == "__main__":
    for key in sys.argv[1:] or PRODUCTS:
        build(key)

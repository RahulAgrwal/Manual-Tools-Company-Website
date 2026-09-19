<?php
// Global product cards array for reuse across pages
$GLOBAL_PRODUCT_CARDS = [
  [
    "image_path" => "assets/img/slide/Coal-Crusher.png",
    "title" => "Coal Crusher 5 No. Size",
    "subtitle" => "Single Disc",
    "link" => "coal-crusher-5-No-single-disc",
    "short_description" => "Engineered for consistent fine coal disintegration with adjustable output size below 2mm.",
    "long_description" => "High-efficiency single disc pulverizer designed to crush coal to below 2mm. Features 6 mild steel hammers and a heavy-duty body for consistent industrial performance.",
    "category" => "coal-crusher",
    "eyebrow" => "Coal Disintegrator",
    "mini_specs" => [
      ["fa-bolt", "80 - 120 HP Motor"],
      ["fa-filter", "Output < 2mm"],
      ["fa-weight-hanging", "8 - 12 TPH"],
      ["fa-hammer", "6 Hammers"]
    ]
  ],
  [
    "image_path" => "assets/img/slide/Coal-Crusher-Double-disc.png",
    "title" => "Coal Crusher 5 No. Size",
    "subtitle" => "Double Disc",
    "link" => "coal-crusher-5-No-double-disc",
    "short_description" => "Dual-action crushing mechanism offering higher throughput and superior material reduction efficiency.",
    "long_description" => "Double-disc configuration for high-volume operations. Capable of processing up to 25 Tons Per Hour with 12 hammers, ideal for large coke oven batteries.",
    "category" => "coal-crusher",
    "eyebrow" => "High Capacity Disintegrator",
    "mini_specs" => [
      ["fa-bolt", "150 - 180 HP Motor"],
      ["fa-filter", "Output < 2mm"],
      ["fa-tachometer-alt", "20 - 25 TPH"],
      ["fa-hammer", "12 Hammers"]
    ]
  ],
  [
    "image_path" => "assets/img/slide/Coke-Cutter-Machine.png",
    "title" => "Coke Cutter Machine",
    "subtitle" => "Double Drive, Drum Type",
    "link" => "coke-cutter-double-drive",
    "short_description" => "Heavy-duty double drive system designed for precise coke cutting and specific sizing requirements.",
    "long_description" => "Specialized double-drive cutter for sizing metallurgical coke. Features adjustable drums for 40-60mm output and manganese steel teeth for longevity.",
    "category" => "coke-cutter",
    "eyebrow" => "Precision Sizing",
    "mini_specs" => [
      ["fa-bolt", "20 HP x 2 Motors"],
      ["fa-ruler", "40-60mm Output"],
      ["fa-weight-hanging", "12 - 15 TPH"],
      ["fa-cogs", "Cast Steel Gears"]
    ]
  ],
  [
    "image_path" => "assets/img/slide/Coke-Cutter-Machine-Ring-Type.png",
    "title" => "Coke Cutter Machine Ring Type Teeth",
    "subtitle" => "Double Drive Ring Type",
    "link" => "coke-cutter-double-drive-ring-type",
    "short_description" => "Heavy-duty double drive system with ring type teeth designed for precise coke cutting and specific sizing requirements.",
    "long_description" => "Specialized double-drive cutter for sizing metallurgical coke. Features segmented manganese steel toothed rings and an adjustable ring gap for 40-60mm output.",
    "category" => "coke-cutter",
    "eyebrow" => "Precision Sizing",
    "mini_specs" => [
      ["fa-bolt", "25 HP x 2 Motors"],
      ["fa-ruler", "40-60mm Output"],
      ["fa-weight-hanging", "15 - 20 TPH"],
      ["fa-cogs", "Cast Steel Gears"]
    ]
  ],
  [
    "image_path" => "assets/img/product-images/vibrator-screen/Vibrator-Screen-3.png",
    "title" => "Vibrator Screen Machine",
    "subtitle" => "Triple Deck",
    "link" => "vibrator-screen",
    "short_description" => "Triple deck design ensuring precise multi-stage screening and efficient material separation.",
    "long_description" => "Multi-deck vibrating screen for sorting coke and coal by size. High-efficiency eccentric mechanism ensures consistent grading.",
    "category" => "vibrator",
    "eyebrow" => "Sorting & Grading",
    "mini_specs" => [
      ["fa-bolt", "7.5 - 15 HP"],
      ["fa-layer-group", "1 to 4 Decks"],
      ["fa-expand-arrows-alt", "Customizable Mesh"],
      ["fa-industry", "High Throughput"]
    ]
  ],
  [
    "image_path" => "assets/img/slide/Pusher-with-stamping-arrangement.png",
    "title" => "Pusher Machine",
    "subtitle" => "With Stamping Arrangement",
    "link" => "pusher-with-stamping-arrangement",
    "short_description" => "Advanced roller system integrated with stamping arrangement for seamless coke oven pushing operations.",
    "long_description" => "Fully integrated machine for stamp-charged coke ovens. Features a 20m pusher beam, leveling system, and synchronized roller stamping arrangement.",
    "category" => "heavy-machinery",
    "eyebrow" => "Advanced Machinery",
    "mini_specs" => [
      ["fa-bolt", "40 HP Main Drive"],
      ["fa-ruler", "20m Beam"],
      ["fa-sync", "Roller Stamping"],
      ["fa-truck-moving", "15 HP Travel"]
    ]
  ],
  [
    "image_path" => "assets/img/slide/Coal-Charging-Car.png",
    "title" => "Coal Charging Car",
    "subtitle" => "Coke Oven Charging",
    "link" => "coal-charging-car",
    "short_description" => "Specialized vehicle engineered for the efficient and controlled charging of coal into coke ovens.",
    "long_description" => "Rail-mounted top charging vehicle. Features 2, 3 or 4 hoppers, semi-automatic discharge gates, and smoke control systems for efficient oven charging.",
    "category" => "heavy-machinery",
    "eyebrow" => "Coke Oven Machinery",
    "mini_specs" => [
      ["fa-weight-hanging", "8 - 20 Ton Cap."],
      ["fa-truck-moving", "15 HP Travel"],
      ["fa-th", "2, 3 & 4 Hoppers"],
      ["fa-cogs", "Motorised Gates"]
    ]
  ],
  [
    "image_path" => "assets/img/slide/Power-Winch.png",
    "title" => "Door Lifting Power Winch",
    "subtitle" => "Coke Oven Gate Lifting Equipment",
    "link" => "power-winch",
    "short_description" => "Lifts heavy coke oven doors: 2.5 - 5 tons, 5 - 7.5 HP motor, self-locking worm reducer gearbox.",
    "long_description" => "Designed for vertical lifting of heavy Coke Oven doors. Self-locking worm gear design ensures safety and precise control during maintenance.",
    "category" => "power-winch",
    "eyebrow" => "Coke Oven Gate Lifting Equipment",
    "mini_specs" => [
      ["fa-weight-hanging", "2.5 - 5 Tons"],
      ["fa-bolt", "5 - 7.5 HP"],
      ["fa-cogs", "Worm Reducer"],
      ["fa-arrow-up", "Vertical Lift"]
    ]
  ],
  [
    "image_path" => "assets/img/slide/Haulage-Machine.png",
    "title" => "Coke Oven Haulage Machine",
    "subtitle" => "Power Driven",
    "link" => "haulage",
    "short_description" => "Robust power-driven system engineered for efficient material transport in mining and industrial sites.",
    "long_description" => "Robust pulling machine for extracting coke from ovens. Powered by a worm reducer gearbox and cast steel gears for high-torque, reliable operation.",
    "category" => "haulage",
    "eyebrow" => "Material Traction",
    "mini_specs" => [
      ["fa-bolt", "10 HP Motor"],
      ["fa-truck-loading", "10 Ton Capacity"],
      ["fa-cogs", "Worm Reducer"],
      ["fa-shield-alt", "Machine Cut Gears"]
    ]
  ],
  [
    "image_path" => "assets/img/slide/Conveyor-Materials.png",
    "title" => "Idler Roller, Head Pulley",
    "subtitle" => "Conveyor Material",
    "link" => "conveyor-materials",
    "short_description" => "Durable rollers and pulleys manufactured to ensure smooth, low-friction conveyor belt operation.",
    "long_description" => "Complete range of belt conveyor components including heavy-duty idlers, impact rollers, and pulleys tailored for harsh environments.",
    "category" => "conveyor",
    "eyebrow" => "System Components",
    "mini_specs" => [
      ["fa-check-circle", "Idlers & Rollers"],
      ["fa-check-circle", "Head/Tail Pulleys"],
      ["fa-ruler-horizontal", "600 - 1400 mm Belts"],
      ["fa-shield-alt", "Dust Proof"]
    ]
  ]
];
?>
<?php
/**
 * Every product detail page, as data.
 *
 * Generated once from the ten hand-written pages by
 * tools/extract_product_data.py, then maintained by hand. The pages were
 * near-literal clones -- a normalised skeleton diff of two of them was
 * twelve hunks, six of which were only Font Awesome icon swaps -- so the
 * differences between them are content, and content belongs here.
 *
 * product-page.php renders this. Each <slug>.php is a three-line stub.
 */
$MTC_PRODUCTS = [
  'coal-crusher-5-No-single-disc' => [
      'slug' => 'coal-crusher-5-No-single-disc',
      'title' => 'Coal Crusher Single Disc (5 No., 8–12 TPH) | Manual Tools Company',
      'description' => 'Single disc coal crusher (coal disintegrator), 5 No. size: 80–120 HP, 8–12 TPH, feed up to 150 mm, output below 2 mm. Made in Dhanbad, India.',
      'og_image' => 'assets/img/about-us-products-thumbnail/Coal-Crusher-single-disc.jpg',
      'schema_name' => 'Coal Crusher (5 No.) — Single Disc',
      'schema_description' => '5 No. single disc coal crusher — 8–12 TPH capacity, crushed size <2 mm, 80–120 HP motor range, manganese liners, 12 mm body thickness, six mild steel hammers.',
      'sku' => 'MTC-CC-5-SD',
      'schema_props' => [
          [
              'Motor Power',
              '80 – 120 H.P.'
          ],
          [
              'Feed Size',
              '< 150 mm'
          ],
          [
              'Crushed Size',
              '< 2 mm'
          ],
          [
              'Capacity',
              '8 – 12 TPH'
          ]
      ],
      'crumb_heading' => 'Coal Crusher Single Disc',
      'crumb_last' => 'Coal Crusher',
      'main_image' => 'assets/img/about-us-products/Coal Crusher.jpg',
      'gallery_dir' => 'assets/img/product-images/coal-crusher-single-disc/',
      // Optional names for individual gallery files, shown as a caption under
      // the main image and used as alt text (product page and photo gallery).
      'gallery_labels' => [
          'disc-fitted-with-en8-shaft.png' => 'Disc fitted with EN-8 Shaft (spare part)',
          'top-liner-jaw-plate.png' => 'Manganese Steel Top Liner Jaw Plate (spare part)',
          'single-disc-crusher-in-workshop.jpg' => 'Single disc coal crusher in our workshop',
      ],
      'has_video' => false,
      'hero_alt' => 'Single disc coal crusher (coal disintegrator)',
      'thumb_alt' => 'Coal Crusher (5 No.) Single Disc',
      'eyebrow' => 'Industrial Coal Disintegrator',
      'h1_lead' => 'Coal Crusher',
      'h1_accent' => 'Single Disc (5 No.)',
      'model_label' => 'Model',
      'model' => 'MTC-CC-5-SD',
      'stock' => 'In Stock',
      'intro_html' => 'Engineered for precision and consistency, this Single Disc Crusher effectively pulverizes coal into fine
granules below 2mm. Featuring a robust 12mm body and 6 Mild Steel hammers, it is ideal for coke oven
applications.',
      'specs' => [
          [
              'fa-tachometer-alt',
              'Capacity',
              '8 - 12 TPH'
          ],
          [
              'fa-bolt',
              'Motor Power',
              '80 - 120 HP'
          ],
          [
              'fa-filter',
              'Output Size',
              '< 2 mm'
          ],
          [
              'fa-arrow-down',
              'Max Feed Size',
              'Up to 150mm'
          ]
      ],
      'brochure' => 'brochure/Manual_Tools_Co_Coal_Crusher_Single_Disc.pdf',
      'trust' => [
          [
              'fa-check-circle',
              'ISO 9001:2015'
          ],
          [
              'fa-headset',
              'On-Site Support'
          ],
          [
              'fa-truck',
              'Global Shipping'
          ]
      ],
      'overview_heading' => 'What is a 5 No. single disc coal crusher?',
      'overview_paras' => [
          'A 5 No. single disc coal crusher is a coal disintegrator that reduces coal lumps of up to 150 mm to fine particles below 2 mm, the size needed for charging coke ovens and firing boilers. Inside a 12 mm fabricated steel body lined with manganese steel plates, a single rotating disc carries six mild steel hammers. Coal fed into the hopper is struck repeatedly by the hammers until it is fine enough to discharge.',
          'The crusher is driven by an 80 to 120 HP electric motor, chosen to suit the output you need, and handles 8 to 12 tons of coal per hour. The hammers are replaced through a side access door, and routine care is limited to checking the liner plates and greasing the bearings. It suits coke oven plants and thermal power units with moderate throughput.'
      ],
      'overview_related_html' => 'Need 20–25 TPH or feed up to 200 mm? <a href="coal-crusher-5-No-double-disc">See the Double Disc coal crusher <i class="fas fa-arrow-right"></i></a>',
      // Spare and wear parts, rendered by product-page.php between the overview
      // and the tabs. Optional: a product without this key gets no section.
      'spares' => [
          [
              'img' => 'assets/img/product-images/coal-crusher-double-disc/coal-crusher-6.png',
              'alt' => 'Mild steel coal crusher hammer, a replaceable wear part',
              'title' => 'Crusher hammers',
              'desc' => 'Mild steel hammers, changed through the side access door without dismantling the rotor. Inspect every 300 hours and turn the faces once the edges round off.',
              'fits' => '6 per machine'
          ],
          [
              'img' => 'assets/img/product-images/coal-crusher-single-disc/top-liner-jaw-plate.png',
              'alt' => 'Manganese steel top liner jaw plates for a coal crusher, stacked',
              'title' => 'Manganese Steel Top Liner Jaw Plate',
              'desc' => 'Jaw plates that line the crushing chamber and take the wear instead of the body. Bolted in, so a worn plate is swapped without cutting.',
              'fits' => 'Single disc, 5 No.'
          ],
          [
              'img' => 'assets/img/product-images/coal-crusher-single-disc/disc-fitted-with-en8-shaft.png',
              'alt' => 'Single disc coal crusher rotor fitted with an EN-8 shaft',
              'title' => 'Disc rotor with shaft',
              'desc' => 'The balanced disc that carries the six hammers, fitted to a machined EN-8 shaft. Supplied as a complete assembly or as the bare disc.',
              'fits' => 'Single disc, 5 No.'
          ]
      ],
      'spares_note' => 'Also made to order: side liner plates, bearing housings, V-belt drives and hopper sections. Tell us the machine and we will quote the part.',
      'buyer_items' => [
          '<strong>Lead time:</strong> Standard models are often in stock. Custom builds take 3–4 weeks.',
          '<strong>Warranty:</strong> 1 year, as on all our machinery.',
          '<strong>Installation:</strong> Installation supervision and commissioning available.',
          '<strong>Custom builds:</strong> Capacity, motor power and dimensions can be matched to your plant and drawings.',
          '<strong>Brochure:</strong> <a href="brochure/Manual_Tools_Co_Coal_Crusher_Single_Disc.pdf" download>Download PDF</a>'
      ],
      'tabs' => [
          [
              'id' => 'desc',
              'label' => 'Technical Description'
          ],
          [
              'id' => 'operationalflow',
              'label' => 'Operational Process Flow'
          ],
          [
              'id' => 'apps',
              'label' => 'Applications'
          ],
          [
              'id' => 'maint',
              'label' => 'Maintenance'
          ],
          [
              'id' => 'faq',
              'label' => 'FAQ'
          ]
      ],
      'tech_heading' => 'Engineered for Tough Environments',
      'tech_paras' => [
          'The Manual Tools Company Single Disc Coal Crusher utilizes a unique high-speed impact action that is highly effective for reducing coal to specific sizes required for coke ovens and thermal power plants. The six hammers are mounted on one balanced disc, which gives controlled, uniform crushing and a consistent output below 2 mm.',
          'Constructed with heavy-duty fabricated steel housing and lined with wear-resistant manganese steel plates, this machine is built for continuous, heavy-duty industrial operation.'
      ],
      'tech_table_heading' => 'Technical Parameters',
      'tech_rows' => [
          [
              'Rotor Style',
              'Single Disc (6 Mild Steel Hammers)'
          ],
          [
              'Motor Power',
              '80 HP – 120 HP (Based on required TPH)'
          ],
          [
              'Input Feed Size',
              '< 150 mm'
          ],
          [
              'Output Size',
              '< 2 mm (Fine Pulverization)'
          ],
          [
              'Crushing Capacity',
              '8 – 12 Tons Per Hour'
          ],
          [
              'Body Thickness',
              '12 mm Heavy-Duty Fabricated Steel'
          ]
      ],
      'flow_heading_accent' => '3-Stage',
      'flow_heading_rest' => 'Operation Cycle',
      'flow_step_word' => 'Step',
      'flow_steps' => [
          [
              'fa-arrow-down',
              'Gravity Feed Intake',
              'Raw coal lumps (up to 150mm) enter via the top hopper. The angled chute design ensures
material is directed straight into the rotor\'s impact zone without clogging.'
          ],
          [
              'fa-hammer',
              'High-Velocity Impact',
              'The Single Disc rotates at 960-1440 RPM. Six suspended mild steel hammers strike
the coal against the serrated liner plates, achieving instant size reduction.'
          ],
          [
              'fa-filter',
              'Calibrated Discharge',
              'Crushed material passes through the bottom adjustable grate bars. Only particles smaller
than 2mm are released onto the output conveyor, ensuring 100% uniformity.'
          ]
      ],
      'process_diagram' => 'assets/img/product-images/coal-crusher-single-disc/process-diagram.jpg',
      'process_diagram_alt' => 'Process Flow Diagram',
      'process_diagram_caption' => 'Visual representation of internal mechanism',
      'apps' => [
          [
              'fa-industry',
              'Coke Oven Plants',
              'Essential for preparing fine coal charge for beehive and recovery
type ovens to ensure uniform combustion.'
          ],
          [
              'fa-bolt',
              'Thermal Power',
              'Used for pulverizing coal for Fluidized Bed Combustion (FBC)
boilers to maximize thermal efficiency.'
          ],
          [
              'fa-cubes',
              'Brick Kilns',
              'Generates consistent fine coal dust required for automated kiln
firing systems and mixture.'
          ]
      ],
      'maint_alert' => [
          'fa-exclamation-triangle',
          'Maintenance Tip:',
          'Regular lubrication of the main bearing blocks extends machine life.'
      ],
      'maint_cols' => [
          [
              'title' => 'Daily / Weekly Checks',
              'items' => [
                  'Check foundation bolts for tightness before starting.',
                  'Inspect <span class="mtc-maintenance-highlight">V-Belts</span> for proper tension and
alignment.',
                  'Ensure the crusher chamber is empty before motor startup.',
                  'Monitor bearing temperature during operation (should not exceed 70°C).'
              ]
          ],
          [
              'title' => 'Periodic Replacement',
              'items' => [
                  '<strong>Hammers:</strong> Inspect every 300 hours. Rotate faces if edges become rounded.',
                  '<strong>Liner Plates:</strong> Check wear pattern monthly. Replace if thickness reduces by
60%.',
                  '<strong>Rotor Disc:</strong> Inspect annually for any hairline cracks or imbalance.',
                  '<strong>Bearings:</strong> Flush and replace grease completely every 6 months.'
              ]
          ]
      ],
      'custom_tabs' => [],
      'faqs' => [
          [
              'What is the output size?',
              'The Single Disc Crusher is calibrated to produce a fine output size of below 2 mm.'
          ],
          [
              'What is the motor capacity?',
              'It requires an electrical motor between 80 H.P. to 120 H.P. depending on your required TPH (Tons Per Hour).'
          ],
          [
              'Are the hammers replaceable?',
              'Yes, the 6 Mild Steel hammers are designed for easy replacement via the side access door.'
          ],
          [
              'What is the delivery time?',
              'Standard models are often in stock. Custom configurations typically take 3-4 weeks for fabrication.'
          ],
          [
              'What is the maintenance schedule?',
              'Routine maintenance involves checking the liner plates and greasing the bearings. The hammers are easily replaceable when worn out.'
          ]
      ],
      'quote_title' => 'Coal Crusher Single Disc',
      'related_slug' => 'coal-crusher-5-No-single-disc'
  ],
  'coal-crusher-5-No-double-disc' => [
      'slug' => 'coal-crusher-5-No-double-disc',
      'title' => 'Coal Crusher Double Disc (5 No., 20–25 TPH) | Manual Tools Company',
      'description' => 'Double disc coal crusher (coal disintegrator), 5 No. size: 150–180 HP, 20–25 TPH, feed below 200 mm, output below 2 mm. Made in Dhanbad, India.',
      'og_image' => 'assets/img/about-us-products-thumbnail/Coal-Crusher-Double-Disc.jpg',
      'schema_name' => 'Coal Crusher (5 No.) — Double Disc',
      'schema_description' => '5 No. double disc coal crusher — 20–25 TPH capacity, crushed size <2 mm, 150–180 HP motor range, manganese liners, 12 mild steel hammers.',
      'sku' => 'MTC-CC-5-DD',
      'schema_props' => [
          [
              'Motor Power',
              '150 – 180 H.P.'
          ],
          [
              'Feed Size',
              '< 200 mm'
          ],
          [
              'Crushed Size',
              '< 2 mm'
          ],
          [
              'Capacity',
              '20 – 25 TPH'
          ]
      ],
      'crumb_heading' => 'Coal Crusher Double Disc',
      'crumb_last' => 'Coal Crusher',
      'main_image' => 'assets/img/about-us-products/Coal Crusher Double Disc.jpg',
      'gallery_dir' => 'assets/img/product-images/coal-crusher-double-disc/',
      'gallery_labels' => [
          'crushers-driving-arrangement.png' => "Crusher's Driving Arrangement",
      ],
      'has_video' => false,
      'hero_alt' => 'Double disc coal crusher (coal disintegrator)',
      'thumb_alt' => 'Coal Crusher (5 No.) Double Disc',
      'eyebrow' => 'High Capacity Coal Disintegrator',
      'h1_lead' => 'Coal Crusher',
      'h1_accent' => 'Double Disc (5 No.)',
      'model_label' => 'Model',
      'model' => 'MTC-CC-5-DD',
      'stock' => 'Made to Order',
      'intro_html' => 'Engineered for high-volume industrial demands, the Double Disc Crusher delivers superior throughput of up to 25 TPH. Featuring <strong>12 Mild Steel hammers</strong> across two discs, it ensures rapid pulverization of larger coal lumps (<150mm) into fine <2mm granules for maximum combustion efficiency.',
      'specs' => [
          [
              'fa-tachometer-alt',
              'Capacity',
              '20 - 25 TPH'
          ],
          [
              'fa-bolt',
              'Motor Power',
              '150 - 180 HP'
          ],
          [
              'fa-filter',
              'Output Size',
              '< 2 mm'
          ],
          [
              'fa-arrow-down',
              'Max Feed Size',
              'Up to 200mm'
          ]
      ],
      'brochure' => 'brochure/Manual_Tools_Co_Coal_Crusher_Double_Disc.pdf',
      'trust' => [
          [
              'fa-check-circle',
              'ISO 9001:2015'
          ],
          [
              'fa-cogs',
              'Heavy Duty Series'
          ],
          [
              'fa-truck',
              'Global Shipping'
          ]
      ],
      'overview_heading' => 'What is a 5 No. double disc coal crusher?',
      'overview_paras' => [
          'A 5 No. double disc coal crusher is a high-capacity coal disintegrator for plants that need 20 to 25 tons of fine coal per hour. Two discs rotate together and carry 12 mild steel hammers in total, so coal is struck far more often than in a single disc machine. That lets it accept larger lumps, up to 200 mm, while still discharging coal below 2 mm through calibrated grate bars.',
          'The housing is 16 mm fabricated steel, and each hammer can be replaced or reversed. A 150 to 180 HP slip-ring or squirrel cage motor drives the machine. It is built for large recovery-type coke ovens, bigger FBC boilers in thermal power plants and briquetting plants, and it handles coal with up to 8–10% moisture.'
      ],
      'overview_related_html' => 'Need 8–12 TPH with a smaller motor? <a href="coal-crusher-5-No-single-disc">See the Single Disc coal crusher <i class="fas fa-arrow-right"></i></a>',
      'spares' => [
          [
              'img' => 'assets/img/product-images/coal-crusher-double-disc/coal-crusher-6.png',
              'alt' => 'Mild steel coal crusher hammer, a replaceable wear part',
              'title' => 'Crusher hammers',
              'desc' => 'Mild steel hammers, reversed or replaced through the side access door. Inspect every 300 hours and turn the faces once the edges round off.',
              'fits' => '12 per machine, 6 per disc'
          ],
          [
              'img' => 'assets/img/product-images/coal-crusher-double-disc/coal-crusher-7.png',
              'alt' => 'Double disc coal crusher rotor assembly on its shaft',
              'title' => 'Twin disc rotor',
              'desc' => 'Double disc rotor fitted with 12 mild steel hammers, on one machined shaft, balanced as a set so the machine runs true at speed.',
              'fits' => 'Double disc, 5 No.'
          ],
          [
              'img' => 'assets/img/product-images/coal-crusher-single-disc/top-liner-jaw-plate.png',
              'alt' => 'Manganese steel top liner jaw plates for a coal crusher, stacked',
              'title' => 'Manganese Steel Top Liner Jaw Plate',
              'desc' => 'Jaw plates that line the crushing chamber and take the wear instead of the body. Bolted in, so a worn plate is swapped without cutting.',
              'fits' => 'Double disc, 5 No.'
          ],
          [
              'img' => 'assets/img/product-images/coal-crusher-double-disc/crushers-driving-arrangement.png',
              'alt' => "Coal crusher's driving arrangement: motor, gear box and coupling on a base frame",
              'title' => 'Driving arrangement',
              'desc' => 'Motor, gear box, flexible coupling and fabricated base frame, supplied as a matched set and aligned to the crusher shaft.',
              'fits' => '150 - 180 HP drives'
          ]
      ],
      'spares_note' => 'Also made to order: side liner plates, bearing housings, V-belt drives and hopper sections. Tell us the machine and we will quote the part.',
      'buyer_items' => [
          '<strong>Lead time:</strong> Made to order. Fabrication usually takes 4–5 weeks.',
          '<strong>Warranty:</strong> 1 year, as on all our machinery.',
          '<strong>Installation:</strong> Installation supervision and commissioning available.',
          '<strong>Custom builds:</strong> Capacity, motor power and dimensions can be matched to your plant and drawings.',
          '<strong>Brochure:</strong> <a href="brochure/Manual_Tools_Co_Coal_Crusher_Double_Disc.pdf" download>Download PDF</a>'
      ],
      'tabs' => [
          [
              'id' => 'desc',
              'label' => 'Technical Description'
          ],
          [
              'id' => 'operationalflow',
              'label' => 'Operational Process Flow'
          ],
          [
              'id' => 'apps',
              'label' => 'Applications'
          ],
          [
              'id' => 'maint',
              'label' => 'Maintenance'
          ],
          [
              'id' => 'faq',
              'label' => 'FAQ'
          ]
      ],
      'tech_heading' => 'Double the Power, Double the Output',
      'tech_paras' => [
          'The Manual Tools Company <strong>Double Disc Coal Crusher</strong> is the powerhouse of our pulverization line. By utilizing a dual-rotor configuration, this machine doubles the impact frequency, allowing it to process significantly larger feed materials (up to 150mm) while maintaining the ultra-fine output required for Coke Oven Plants.',
          'Ideally suited for large-scale operations, the unit is constructed with a 16mm heavy-duty fabricated steel housing and features 12 replaceable Mild Steel hammers, with manganese steel liner plates to withstand abrasive Indian coal varieties.'
      ],
      'tech_table_heading' => 'Technical Parameters',
      'tech_rows' => [
          [
              'Rotor Style',
              'Double Disc (12 Mild Steel Hammers)'
          ],
          [
              'Motor Power',
              '150 HP – 180 HP (Heavy Duty)'
          ],
          [
              'Input Feed Size',
              '< 200 mm'
          ],
          [
              'Output Size',
              '< 2 mm (Fine Pulverization)'
          ],
          [
              'Crushing Capacity',
              '20 – 25 Tons Per Hour'
          ],
          [
              'Body Thickness',
              '16 mm Heavy-Duty Fabricated Steel'
          ]
      ],
      'flow_heading_accent' => 'High-Velocity',
      'flow_heading_rest' => 'Crushing Cycle',
      'flow_step_word' => 'Step',
      'flow_steps' => [
          [
              'fa-arrow-down',
              'Large Feed Intake',
              'Capable of accepting larger lumps (200mm). The wide hopper throat ensures material distributes evenly across the width of both discs.'
          ],
          [
              'fa-hammer',
              'Dual Rotor Impact',
              'Two discs rotating in sync carry <strong>12 Mild Steel Hammers</strong>. This creates a denser impact zone, pulverizing material faster than single-disc models.'
          ],
          [
              'fa-filter',
              'High Volume Discharge',
              'The crushed coal passes through the calibrated grate bars. The doubled surface area allows for a massive 25 TPH discharge rate while keeping size < 2mm.'
          ]
      ],
      'process_diagram' => null,
      'process_diagram_alt' => null,
      'process_diagram_caption' => null,
      'apps' => [
          [
              'fa-industry',
              'Large Coke Ovens',
              'Designed for high-capacity recovery type ovens requiring continuous feed without downtime.'
          ],
          [
              'fa-bolt',
              'Thermal Power',
              'Critical for larger FBC boilers where fuel consistency directly impacts megawatt output.'
          ],
          [
              'fa-cubes',
              'Briquetting Plants',
              'Provides the massive volume of fine dust needed for industrial fuel briquette manufacturing.'
          ]
      ],
      'maint_alert' => [
          'fa-exclamation-triangle',
          'Heavy Duty Note:',
          'Ensure the 160+ HP motor is soft-started to prevent belt slippage due to high torque.'
      ],
      'maint_cols' => [
          [
              'title' => 'Daily / Weekly Checks',
              'items' => [
                  'Check tightness of all 12 hammer bolts.',
                  'Inspect main shaft bearings for vibration (heavy load zone).',
                  'Verify V-Belt tension (dual grooves require precise alignment).',
                  'Clear magnetic debris from the hopper to protect liners.'
              ]
          ],
          [
              'title' => 'Periodic Replacement',
              'items' => [
                  '<strong>Hammers:</strong> Inspect 12 hammers every 200 hours due to higher throughput.',
                  '<strong>Liner Plates:</strong> Rotate side liners to ensure even wear patterns.',
                  '<strong>Bearings:</strong> Use high-temperature grease; purge monthly.',
                  '<strong>Grate Bars:</strong> Check for widening gaps that might allow >2mm particles to pass.'
              ]
          ]
      ],
      'custom_tabs' => [],
      'faqs' => [
          [
              'How does this differ from the Single Disc model?',
              'The Double Disc model uses two rotors and 12 hammers, doubling the capacity to 20-25 TPH and allowing for larger feed sizes (200mm) compared to the Single Disc\'s 8-12 TPH.'
          ],
          [
              'What motor is required?',
              'Due to the high inertia and crushing load, a slip-ring or squirrel cage motor between 160 H.P. and 200 H.P. is required.'
          ],
          [
              'Can it handle wet coal?',
              'It can handle moisture up to 8-10%. However, for very sticky or wet coal, we recommend cleaning the grate bars more frequently to prevent clogging.'
          ],
          [
              'Are the 12 hammers replaceable individually?',
              'Yes, each hammer is individually suspended and can be replaced or reversed.'
          ],
          [
              'What is the delivery timeline?',
              'Double Disc models are typically Made-to-Order. Fabrication usually takes 4-5 weeks depending on our current production queue.'
          ]
      ],
      'quote_title' => 'Coal Crusher Double Disc',
      'related_slug' => 'coal-crusher-5-No-double-disc'
  ],
  'coke-cutter-double-drive' => [
      'slug' => 'coke-cutter-double-drive',
      'title' => 'Coke Cutter Machine – Double Drive, Drum Type | Manual Tools Company',
      'description' => 'Double drive coke cutter machine, drum type: 2 x 20 HP motors, 12–15 TPH, feed below 200 mm, adjustable 40–60 mm output. Made in Dhanbad, India.',
      'og_image' => 'assets/img/about-us-products-thumbnail/Double-Drive-Coke-Cutter-Machine.jpg',
      'schema_name' => 'Coke Cutter Machine (Double Drive, Drum Type)',
      'schema_description' => 'Double drive coke cutter machine with 12-15 TPH capacity, 40-60mm adjustable output, and manganese steel teeth.',
      'sku' => 'MTC-CCM-DD',
      'schema_props' => [
          [
              'Motor Power',
              '20 H.P. x 2 (Double Drive)'
          ],
          [
              'Feed Size',
              '< 200 mm'
          ],
          [
              'Finished Size',
              '40 - 60 mm (Adjustable)'
          ],
          [
              'Capacity',
              '12 – 15 TPH'
          ]
      ],
      'crumb_heading' => 'Coke Cutter Machine',
      'crumb_last' => 'Coke Cutter',
      'main_image' => 'assets/img/about-us-products/Double Drive Coke Cutter Machine.jpg',
      'gallery_dir' => 'assets/img/product-images/coke-cutter/',
      'has_video' => false,
      'hero_alt' => 'Coke Cutter Double Drive',
      'thumb_alt' => 'Coke Cutter Machine (Double Drive, Drum Type)',
      'eyebrow' => 'Industrial Coke Sizing Equipment',
      'h1_lead' => 'Coke Cutter Machine',
      'h1_accent' => 'Double Drive, Drum Type',
      'model_label' => 'Model',
      'model' => 'MTC-CCM-DD',
      'stock' => 'Made to Order',
      'intro_html' => 'Built for high-torque applications, our Double Drive Coke Cutter utilizes <strong>two 20 HP motors</strong> to slice through hard coke lumps without jamming. Featuring adjustable drum spacing, it delivers precise output sizes (40mm–60mm) essential for blast furnaces and foundries.',
      'specs' => [
          [
              'fa-tachometer-alt',
              'Capacity',
              '12 - 15 TPH'
          ],
          [
              'fa-bolt',
              'Motor Power',
              '20 HP x 2 (Dual)'
          ],
          [
              'fa-ruler-horizontal',
              'Output Size',
              '40 - 60 mm'
          ],
          [
              'fa-arrow-down',
              'Max Feed Size',
              'Up to 200mm'
          ]
      ],
      'brochure' => 'brochure/Manual_Tools_Co_Coke_Cutter_Double_Drive.pdf',
      'trust' => [
          [
              'fa-check-circle',
              'ISO 9001:2015'
          ],
          [
              'fa-cogs',
              'Cast Steel Gears'
          ],
          [
              'fa-tools',
              'Manganese Teeth'
          ]
      ],
      'overview_heading' => 'What is a double drive coke cutter?',
      'overview_paras' => [
          'A double drive coke cutter is a sizing machine that cuts hard coke lumps into uniform pieces instead of smashing them, so it produces much less dust than a hammer crusher. This drum-type model takes lumps up to 200 mm and delivers 40 to 60 mm coke, set by adjusting the gap between its drums, at 12 to 15 tons per hour.',
          'Each side of the cutter has its own 20 HP motor (40 HP in total). The balanced torque from the two drives stops the machine stalling on hard metallurgical coke and extends gear life. Gears are heavy-duty cast steel, and the cutting teeth are replaceable manganese steel liner plates. It is used by coke oven plants that supply sized coke to blast furnaces and foundries.'
      ],
      'overview_related_html' => 'Need 15–20 TPH or individually replaceable teeth? <a href="coke-cutter-double-drive-ring-type">See the Ring Type coke cutter <i class="fas fa-arrow-right"></i></a>',
      'buyer_items' => [
          '<strong>Lead time:</strong> Made to order. Ask us for the current lead time.',
          '<strong>Warranty:</strong> 1 year, as on all our machinery.',
          '<strong>Installation:</strong> Installation supervision and commissioning available.',
          '<strong>Custom builds:</strong> Capacity, motor power and dimensions can be matched to your plant and drawings.',
          '<strong>Brochure:</strong> <a href="brochure/Manual_Tools_Co_Coke_Cutter_Double_Drive.pdf" download>Download PDF</a>'
      ],
      'tabs' => [
          [
              'id' => 'desc',
              'label' => 'Technical Description'
          ],
          [
              'id' => 'operationalflow',
              'label' => 'Operational Process Flow'
          ],
          [
              'id' => 'apps',
              'label' => 'Applications'
          ],
          [
              'id' => 'maint',
              'label' => 'Maintenance'
          ],
          [
              'id' => 'faq',
              'label' => 'FAQ'
          ]
      ],
      'tech_heading' => 'Precision Cutting with Double Drive Power',
      'tech_paras' => [
          'The Manual Tools Company <strong>Coke Cutter (Double Drive)</strong> is engineered to solve the problem of uneven coke sizing. Unlike standard crushers that produce excess fines (dust), this machine uses a cutting action to slice coke lumps to a specific size.',
          'The "Double Drive" system refers to the independent 20 H.P. motors powering each side of the cutter assembly. This ensures balanced torque distribution, preventing the stalling often seen when processing hard metallurgical coke. The machine is fitted with <strong>Cast Steel Gears</strong> and <strong>Manganese Steel Liner Teeth</strong> for maximum longevity.'
      ],
      'tech_table_heading' => 'Technical Parameters',
      'tech_rows' => [
          [
              'Drive System',
              'Double Drive (Dual Motor)'
          ],
          [
              'Motor Power',
              '20 H.P. + 20 H.P. (Total 40 H.P.)'
          ],
          [
              'Input Feed Size',
              '< 200 mm'
          ],
          [
              'Finished Output Size',
              '40 mm – 60 mm (Adjustable Drum)'
          ],
          [
              'Processing Capacity',
              '12 – 15 Tons Per Hour'
          ],
          [
              'Gear Material',
              'Heavy Duty Cast Steel'
          ],
          [
              'Teeth Material',
              'Manganese Steel Liner Plates'
          ]
      ],
      'flow_heading_accent' => '3-Stage',
      'flow_heading_rest' => 'Sizing Cycle',
      'flow_step_word' => 'Step',
      'flow_steps' => [
          [
              'fa-dolly-flatbed',
              'Material Intake',
              'Raw coke lumps up to 200mm are fed via conveyor into the hopper. The wide mouth ensures no bridging or clogging occurs at the entry point.'
          ],
          [
              'fa-cog',
              'Double Drive Cutting',
              'Twin drums, powered by separate motors, rotate against each other. The manganese teeth "cut" rather than crush the coke, preserving structural integrity.'
          ],
          [
              'fa-sliders-h',
              'Calibrated Output',
              'The gap between drums is adjustable. Material falls through only when it matches the set size (40-60mm), ensuring a uniform product for furnaces.'
          ]
      ],
      'process_diagram' => 'assets/img/product-images/coke-cutter/process-diagram.jpg',
      'process_diagram_alt' => 'Coke Cutter Process Flow',
      'process_diagram_caption' => 'Cutter Mechanism View',
      'apps' => [
          [
              'fa-industry',
              'Blast Furnaces',
              'Ensures coke is the correct size for optimal air permeability and combustion inside the blast furnace.'
          ],
          [
              'fa-fire-alt',
              'Foundries',
              'Provides uniform sizing for Cupola furnaces, reducing waste and improving melt efficiency.'
          ],
          [
              'fa-flask',
              'Chemical Plants',
              'Used in processes requiring precise carbon sizing for filtration or reaction beds.'
          ]
      ],
      'maint_alert' => [
          'fa-exclamation-triangle',
          'Operational Tip:',
          'Ensure both motors are synchronized during startup to prevent uneven wear on the gear teeth.'
      ],
      'maint_cols' => [
          [
              'title' => 'Daily / Weekly Checks',
              'items' => [
                  'Inspect V-Belts for proper tension and alignment.',
                  'Inspect Manganese Teeth for chipping or excessive wear.',
                  'Verify the gap setting between drums (40-60mm).',
                  'Tighten foundation bolts due to vibration.'
              ]
          ],
          [
              'title' => 'Periodic Replacement',
              'items' => [
                  '<strong>Liner Teeth:</strong> Replace when cutting efficiency drops (edges become rounded).',
                  '<strong>Pinion:</strong> Grease pinions Regularly.',
                  '<strong>Bearings:</strong> Grease main shaft bearings weekly.'
              ]
          ]
      ],
      'custom_tabs' => [],
      'faqs' => [
          [
              'Why use Double Drive instead of Single?',
              'Double Drive (two motors) provides balanced torque on both sides of the shaft. This prevents jamming when cutting very hard coke lumps and extends gear life.'
          ],
          [
              'Is the output size adjustable?',
              'Yes, the machine features an adjustable drum mechanism. You can change the gap setting to produce coke between 40 mm and 60 mm.'
          ],
          [
              'Does it produce dust (fines)?',
              'Compared to hammer mills, the Coke Cutter produces significantly less dust because it cuts/shears the material rather than smashing it.'
          ],
          [
              'What is the gear material?',
              'We use high-grade Cast Steel for all gears to withstand high torque and shock loads.'
          ],
          [
              'What happens if a piece of iron enters?',
              'The machine is robust, but iron can damage teeth. We highly recommend installing a magnetic separator on the feed conveyor.'
          ]
      ],
      'quote_title' => 'Coke Cutter Machine (Double Drive, Drum Type)',
      'related_slug' => 'coke-cutter-double-drive'
  ],
  'coke-cutter-double-drive-ring-type' => [
      'slug' => 'coke-cutter-double-drive-ring-type',
      'title' => 'Ring Type Coke Cutter, 15–20 TPH | Manual Tools Company',
      'description' => 'Ring type coke cutter with double drive and manganese steel toothed rings: 2 x 25 HP, 15–20 TPH, adjustable 40–60 mm output. Made in Dhanbad, India.',
      'og_image' => 'assets/img/about-us-products-thumbnail/Double-Drive-Coke-Cutter-Machine-Ring-Type.jpg',
      'schema_name' => 'Ring Type Coke Cutter (Double Drive)',
      'schema_description' => 'Double drive coke cutter machine featuring segmented manganese steel rings, 15–20 TPH capacity, and adjustable output.',
      'sku' => 'MTC-CCM-DD-RT',
      'schema_props' => [
          [
              'Motor Power',
              '25 H.P. x 2 (Double Drive)'
          ],
          [
              'Teeth Type',
              'Manganese Steel Rings'
          ],
          [
              'Finished Size',
              '40 - 60 mm (Adjustable)'
          ],
          [
              'Capacity',
              '15 – 20 TPH'
          ]
      ],
      'crumb_heading' => 'Coke Cutter Machine',
      'crumb_last' => 'Double Drive (Ring Type)',
      'main_image' => 'assets/img/about-us-products/Double Drive Coke Cutter Machine Ring Type.jpg',
      'gallery_dir' => 'assets/img/product-images/coke-cutter-ring-teeth/',
      'has_video' => true,
      'hero_alt' => 'Double Drive Coke Cutter Machine Ring Type',
      'thumb_alt' => 'Double Drive Coke Cutter Machine Ring Type',
      'eyebrow' => 'Industrial Coke Sizing Equipment',
      'h1_lead' => 'Ring Type Coke Cutter',
      'h1_accent' => 'Double Drive, Toothed Rings',
      'model_label' => 'Model',
      'model' => 'MTC-CCM-DD-RT',
      'stock' => 'Heavy Duty',
      'intro_html' => 'Designed for ease of maintenance and high durability, this model features <strong>Segmented Manganese Steel Rings</strong> instead of standard liner plates. Powered by <strong>Dual 25 HP Motors</strong>, it allows for easy replacement of individual rings, reducing downtime while delivering precise 40mm–60mm coke output.',
      'specs' => [
          [
              'fa-cogs',
              'Mechanism',
              'Toothed Rings'
          ],
          [
              'fa-bolt',
              'Motor Power',
              '25 HP x 2 (Dual)'
          ],
          [
              'fa-ruler-horizontal',
              'Output Size',
              '40 - 60 mm'
          ],
          [
              'fa-weight-hanging',
              'Capacity',
              '15 - 20 TPH'
          ]
      ],
      'brochure' => 'brochure/Manual_Tools_Co_Coke_Cutter_Ring_Type.pdf',
      'trust' => [
          [
              'fa-circle-notch',
              'Segmented Rings'
          ],
          [
              'fa-sync-alt',
              'Easy Replacement'
          ],
          [
              'fa-shield-alt',
              'Manganese Steel'
          ]
      ],
      'overview_heading' => 'What is a ring type coke cutter?',
      'overview_paras' => [
          'A ring type coke cutter is a double drive coke sizing machine whose shafts carry separate toothed rings of high manganese steel instead of one lined drum. Each ring is keyed to the shaft on its own, so a worn or damaged section can be replaced without relining the whole drum, which shortens maintenance stops. The rings cut hard coke aggressively, limit flat "slabs" and fines, and work-harden in use.',
          'Two 25 HP motors (50 HP in total) drive the counter-rotating shafts, so lumps up to 200 mm pass without jamming. The gap between the ring shafts is adjustable for an output of 40 to 60 mm, and the machine handles 20 tons per hour. It is the higher-capacity choice for coke oven plants that supply blast furnace coke.'
      ],
      'overview_related_html' => 'Need 12–15 TPH with lined drums? <a href="coke-cutter-double-drive">See the Drum Type double drive coke cutter <i class="fas fa-arrow-right"></i></a>',
      'buyer_items' => [
          '<strong>Lead time:</strong> Made to order. Ask us for the current lead time.',
          '<strong>Warranty:</strong> 1 year, as on all our machinery.',
          '<strong>Installation:</strong> Installation supervision and commissioning available.',
          '<strong>Custom builds:</strong> Capacity, motor power and dimensions can be matched to your plant and drawings.',
          '<strong>Brochure:</strong> <a href="brochure/Manual_Tools_Co_Coke_Cutter_Ring_Type.pdf" download>Download PDF</a>'
      ],
      'tabs' => [
          [
              'id' => 'desc',
              'label' => 'Technical Description'
          ],
          [
              'id' => 'operationalflow',
              'label' => 'Operational Process Flow'
          ],
          [
              'id' => 'apps',
              'label' => 'Applications'
          ],
          [
              'id' => 'maint',
              'label' => 'Maintenance'
          ],
          [
              'id' => 'faq',
              'label' => 'FAQ'
          ]
      ],
      'tech_heading' => 'Superior Sizing with Ring Type Technology',
      'tech_paras' => [
          'The Manual Tools Company <strong>Ring Type Double Drive Coke Cutter</strong> is a specialized variant of our standard sizing machines. Instead of a single drum shell, the shaft is fitted with multiple <strong>independent Manganese Steel Rings</strong>. This design offers superior flexibility in maintenance and ensures a more aggressive cutting action for hard metallurgical coke.',
          'Powered by <strong>Two 25 H.P. Motors</strong>, the counter-rotating shafts deliver high torque to prevent stalling. The ring design prevents the formation of "slabs" (flat pieces) and reduces the generation of fines, ensuring optimal blast furnace permeability.'
      ],
      'tech_table_heading' => 'Technical Parameters',
      'tech_rows' => [
          [
              'Drive System',
              'Double Drive (Dual Motor)'
          ],
          [
              'Cutting Element',
              'Segmented Toothed Rings'
          ],
          [
              'Motor Power',
              '25 H.P. + 25 H.P. (Total 50 H.P.)'
          ],
          [
              'Input Feed Size',
              '< 200 mm'
          ],
          [
              'Finished Output Size',
              '40 mm – 60 mm (Adjustable)'
          ],
          [
              'Processing Capacity',
              '15 – 20 Tons Per Hour'
          ],
          [
              'Material of Construction',
              'High Manganese Steel (Rings)'
          ]
      ],
      'flow_heading_accent' => 'Ring-Type',
      'flow_heading_rest' => 'Sizing Process',
      'flow_step_word' => 'Step',
      'flow_steps' => [
          [
              'fa-dolly-flatbed',
              'Feed Intake',
              'Large coke lumps fall into the cutting chamber. The robust housing is designed to withstand impact from heavy material.'
          ],
          [
              'fa-ring',
              'Ring Shearing',
              'As the shafts rotate, the toothed rings engage the coke. The segmented design concentrates force on specific points, cleaner cuts with less dust.'
          ],
          [
              'fa-sort-amount-down',
              'Sized Output',
              'The sized coke (40-60mm) passes through the gap. Oversized pieces remain until cut, ensuring strict quality control for furnace use.'
          ]
      ],
      'process_diagram' => 'assets/img/product-images/coke-cutter/process-diagram.jpg',
      'process_diagram_alt' => 'Ring Type Coke Cutter Process Flow',
      'process_diagram_caption' => 'Ring Cutter Mechanism',
      'apps' => [
          [
              'fa-industry',
              'Steel Plants',
              'Crucial for preparing metallurgical coke for Blast Furnaces where air flow permeability is key.'
          ],
          [
              'fa-fire-alt',
              'Cupola Furnaces',
              'Provides consistent coke sizes for foundries, ensuring stable temperatures and melting rates.'
          ],
          [
              'fa-cogs',
              'Ferro Alloys',
              'Used in Ferro Alloy units where specific carbon sizing is required for reduction processes.'
          ]
      ],
      'maint_alert' => [
          'fa-wrench',
          'Maintenance Advantage:',
          'With the Ring Type design, if a specific section wears out, you can replace individual rings rather than the entire drum.'
      ],
      'maint_cols' => [
          [
              'title' => 'Regular Inspection',
              'items' => [
                  'Check tightness of the ring locking nuts/keys on the shaft.',
                  'Monitor gear lubrication levels (Cast Steel Gears).',
                  'Inspect V-Belts for tension balance between the two motors.',
                  'Clear any buildup of fines in the discharge chute.'
              ]
          ],
          [
              'title' => 'Parts Replacement',
              'items' => [
                  '<strong>Manganese Rings:</strong> Replace individual rings when teeth become rounded.',
                  '<strong>Bearings:</strong> Heavy duty pedestals require weekly greasing.',
                  '<strong>Motor Alignment:</strong> Check alignment periodically to prevent vibration.'
              ]
          ]
      ],
      'custom_tabs' => [],
      'faqs' => [
          [
              'What is the benefit of the Ring Type design?',
              'The Ring Type design uses segmented toothed rings keyed to the shaft. This allows for easier maintenance—if one section is damaged, you only replace that ring instead of relining the whole drum. It also provides very aggressive cutting for hard materials.'
          ],
          [
              'Why are there two motors (Double Drive)?',
              'Double Drive ensures equal torque distribution on both ends of the cutting shaft. This prevents the machine from jamming when a particularly large or hard lump of coke enters, and it extends the life of the gears.'
          ],
          [
              'Can I adjust the output size?',
              'Yes, the gap between the ring shafts is adjustable. You can set the output size between 40 mm and 60 mm depending on your furnace requirements.'
          ],
          [
              'How durable are the rings?',
              'The rings are cast from High Manganese Steel, which work-hardens during use. They are designed to withstand the abrasive nature of metallurgical coke for long periods.'
          ],
          [
              'What capacity does this machine handle?',
              'This model is designed for a throughput of 15 to 20 Tons Per Hour (TPH).'
          ]
      ],
      'quote_title' => 'Ring Type Coke Cutter (Double Drive)',
      'related_slug' => 'coke-cutter-double-drive-ring-type'
  ],
  'haulage' => [
      'slug' => 'haulage',
      'title' => 'Coke Oven Haulage Machine (10 Ton, 10 HP) | Manual Tools Company',
      'description' => 'Coke oven haulage machine (haulage winch): 10 HP motor, worm reducer gearbox and 10-ton pull for coke cake extraction and rail shunting. Made in Dhanbad.',
      'og_image' => 'assets/img/about-us-products-thumbnail/Haulage-Machine.png',
      'schema_name' => 'Coke Oven Haulage Machine (10 Ton)',
      'schema_description' => 'Electric Haulage Machine designed for coke oven extraction. Features 10 HP motor, worm reducer gearbox, and 10-ton pulling capacity.',
      'sku' => 'MTC-HM-10T',
      'schema_props' => [
          [
              'Motor Power',
              '10 H.P. Electrical'
          ],
          [
              'Pulling Capacity',
              '10 Tons'
          ],
          [
              'Gearbox',
              'Worm Reducer Type'
          ],
          [
              'Application',
              'Coke Oven / Mining'
          ]
      ],
      'crumb_heading' => 'Coke Oven Haulage Machine',
      'crumb_last' => 'Coke Oven Haulage Machine',
      'main_image' => 'assets/img/about-us-products/Haulage Machine.jpg',
      'gallery_dir' => 'assets/img/product-images/haulage/',
      'has_video' => true,
      'hero_alt' => 'Coke oven haulage machine, 10 HP / 10 ton',
      'thumb_alt' => 'Coke oven haulage machine, 10 HP / 10 ton',
      'eyebrow' => 'Coke Oven Extraction Series',
      'h1_lead' => 'Coke Oven Haulage Machine',
      'h1_accent' => '10 HP / 10 Ton',
      'model_label' => 'Model',
      'model' => 'MTC-HM-10T',
      'stock' => 'Made to Order',
      'intro_html' => 'Engineered for the demanding environment of coke ovens and mines, this heavy-duty Haulage Machine utilizes a high-torque <strong>Worm Reducer Gearbox</strong> powered by a 10 HP motor. It ensures steady, reliable pulling power (up to 10 Tons) for extracting coke or moving heavy industrial loads.',
      'specs' => [
          [
              'fa-weight-hanging',
              'Pulling Capacity',
              '10 Tons'
          ],
          [
              'fa-bolt',
              'Motor Power',
              '10 HP (Elec.)'
          ],
          [
              'fa-cogs',
              'Gearbox Type',
              'Worm Reducer'
          ],
          [
              'fa-truck-loading',
              'Application',
              'Coke / Mining'
          ]
      ],
      'brochure' => 'brochure/Manual_Tools_Co_Haulage_Machine.pdf',
      'trust' => [
          [
              'fa-check-circle',
              'ISO 9001:2015'
          ],
          [
              'fa-shield-alt',
              'Heavy Duty Chassis'
          ],
          [
              'fa-wrench',
              'Low Maintenance'
          ]
      ],
      'overview_heading' => 'What is a coke oven haulage machine?',
      'overview_paras' => [
          'A coke oven haulage machine is an electric winch that pulls heavy loads horizontally or up an incline. In coke oven plants it is used to extract coke cakes and to move charging cars and heavy door mechanisms. This model has a 10 HP, 3-phase motor driving a heavy-duty worm reducer gearbox with machine-cut cast steel gears.',
          'The worm drive cuts the motor speed and multiplies torque for a steady pull of up to 10 tons, and because it cannot run backwards it helps stop the load slipping back. The wire rope winds onto a drum mounted on a fabricated MS Channel steel base frame, and a manual or electro-hydraulic thruster brake is available. The same machine is used for rail shunting inside plants and for hauling tubs up inclines in mines. It is not a lifting hoist: for lifting oven doors, see the Door Lifting Power Winch.'
      ],
      'overview_related_html' => 'Need to lift oven doors vertically? <a href="power-winch">See the Door Lifting Power Winch <i class="fas fa-arrow-right"></i></a>',
      'buyer_items' => [
          '<strong>Lead time:</strong> Made to order. Ask us for the current lead time.',
          '<strong>Warranty:</strong> 1 year, as on all our machinery.',
          '<strong>Installation:</strong> Installation supervision and commissioning available.',
          '<strong>Custom builds:</strong> Capacity, motor power and dimensions can be matched to your plant and drawings.',
          '<strong>Brochure:</strong> <a href="brochure/Manual_Tools_Co_Haulage_Machine.pdf" download>Download PDF</a>'
      ],
      'tabs' => [
          [
              'id' => 'desc',
              'label' => 'Technical Description'
          ],
          [
              'id' => 'operationalflow',
              'label' => 'Operational Mechanics'
          ],
          [
              'id' => 'apps',
              'label' => 'Applications'
          ],
          [
              'id' => 'maint',
              'label' => 'Maintenance'
          ],
          [
              'id' => 'faq',
              'label' => 'FAQ'
          ]
      ],
      'tech_heading' => 'Reliable Traction for Heavy Loads',
      'tech_paras' => [
          'The Manual Tools Company Haulage Machine is built on a rigid fabricated steel chassis designed to resist the twisting forces encountered during heavy pulling operations. At its core is a precision-engineered <strong>Worm Reducer Gearbox</strong>, which converts high-speed motor rotation into high-torque pulling power.',
          'Specifically optimized for Coke Oven Plants, this machine allows for the smooth, controlled extraction of coke cakes or the movement of charging cars. The use of cast steel gears ensures longevity even under shock-load conditions.'
      ],
      'tech_table_heading' => 'Technical Parameters',
      'tech_rows' => [
          [
              'Motor Power',
              '10 H.P. (3-Phase, 440V)'
          ],
          [
              'Pulling Capacity',
              '10 Tons (Horizontal Load)'
          ],
          [
              'Gearbox Technology',
              'Heavy Duty Worm Reducer'
          ],
          [
              'Gear Material',
              'Cast Steel (Machine Cut)'
          ],
          [
              'Base Frame',
              'Fabricated MS Channel Steel'
          ],
          [
              'Braking System',
              'Manual / Electro-Hydraulic Thruster (Optional)'
          ]
      ],
      'flow_heading_accent' => 'Torque',
      'flow_heading_rest' => 'Transmission Flow',
      'flow_step_word' => 'Stage',
      'flow_steps' => [
          [
              'fa-bolt',
              'Electrical Input',
              'The 10 HP motor initiates high-speed rotation. A flexible coupling transmits this energy to the gearbox input shaft, absorbing initial start-up shock.'
          ],
          [
              'fa-compress-arrows-alt',
              'Speed Reduction',
              'The <strong>Worm Reducer</strong> dramatically lowers the RPM while multiplying torque. This non-reversible gear action acts as a natural braking aid, preventing load back-slip.'
          ],
          [
              'fa-anchor',
              'Drum Traction',
              'The output shaft rotates the main rope drum. The steel wire rope coils onto the drum, exerting a steady 10-ton pull on the connected load, such as a coke cake or charging car.'
          ]
      ],
      'process_diagram' => null,
      'process_diagram_alt' => null,
      'process_diagram_caption' => null,
      'apps' => [
          [
              'fa-industry',
              'Coke Ovens',
              'Used primarily for extracting heavy coke cakes and operating heavy door mechanisms efficiently.'
          ],
          [
              'fa-train',
              'Rail Shunting',
              'Ideal for moving wagons or material trolleys within plant premises where locomotives cannot reach.'
          ],
          [
              'fa-hard-hat',
              'Underground Mines',
              'Employed to pull tubs of coal or minerals up inclined planes (gradients) reliably.'
          ]
      ],
      'maint_alert' => [
          'fa-exclamation-triangle',
          'Safety First:',
          'Inspect the wire rope daily for fraying. A snapped rope under tension is extremely dangerous.'
      ],
      'maint_cols' => [
          [
              'title' => 'Lubrication Schedule',
              'items' => [
                  '<strong>Gearbox Oil:</strong> Check level weekly. Change the gear oil (SAE 140 or Servo Mesh SP 320, depending on ambient temperature) every 1000 running hours.',
                  '<strong>Bearings:</strong> Re-grease monthly.',
                  '<strong>Wire Rope:</strong> Apply oil to prevent rust and internal friction.'
              ]
          ],
          [
              'title' => 'Mechanical Inspection',
              'items' => [
                  'Check foundation bolts for vibration looseness weekly.',
                  'Inspect the coupling rubber bushes between motor and gearbox.',
                  'Check worm gear teeth for excessive pitting or wear annually.'
              ]
          ]
      ],
      'custom_tabs' => [],
      'faqs' => [
          [
              'What is the maximum pulling capacity?',
              'This model is rated for 10 Tons of horizontal pulling force.'
          ],
          [
              'Can it be used for lifting?',
              'No. This is a Haulage machine designed for horizontal pulling or inclined dragging. It is not a vertical lifting hoist.'
          ],
          [
              'What kind of oil does the gearbox need?',
              'The Worm Reducer typically requires heavy-duty gear oil like Servo Mesh SP 320 or SAE 140, depending on ambient temperature.'
          ],
          [
              'Does it come with wire rope?',
              'The machine is supplied with the drum. Wire rope length and diameter are usually customized based on client requirements.'
          ],
          [
              'Is the motor included?',
              'Yes, the standard unit comes with a 10 HP Electrical Motor pre-mounted and aligned.'
          ]
      ],
      'quote_title' => 'Coke Oven Haulage Machine (10 Ton)',
      'related_slug' => 'haulage'
  ],
  'power-winch' => [
      'slug' => 'power-winch',
      'title' => 'Door Lifting Power Winch for Coke Ovens | Manual Tools Company',
      'description' => 'Power winch for lifting coke oven doors: 2.5–5 ton capacity, 5–7.5 HP motor, worm reducer gearbox, 2–4 m/min lift. Made in Dhanbad, India. Get a quote.',
      'og_image' => 'assets/img/about-us-products-thumbnail/Power-Winchh.png',
      'schema_name' => 'Door Lifting Power Winch',
      'schema_description' => 'Heavy-duty electric winch designed for lifting coke oven doors. Features worm reducer gearbox and 5 ton capacity.',
      'sku' => 'MTC-PW-DL',
      'schema_props' => [
          [
              'Motor Power',
              '5 – 7.5 H.P.'
          ],
          [
              'Lifting Capacity',
              '2.5 – 5 Tons'
          ],
          [
              'Gearbox',
              'Worm Reducer'
          ],
          [
              'Application',
              'Vertical Lifting'
          ]
      ],
      'crumb_heading' => 'Power Winch',
      'crumb_last' => 'Door Lifting Power Winch',
      'main_image' => 'assets/img/about-us-products/Power Winchh.jpg',
      'gallery_dir' => 'assets/img/product-images/power-winch/',
      'has_video' => false,
      'hero_alt' => 'Coke oven door lifting power winch',
      'thumb_alt' => 'Door Lifting Power Winch',
      'eyebrow' => 'Coke Oven Gate Lifting Equipment',
      'h1_lead' => 'Door Lifting',
      'h1_accent' => 'Power Winch',
      'model_label' => 'Model',
      'model' => 'MTC-PW-DL',
      'stock' => 'In Stock',
      'intro_html' => 'Control matters more than speed when lifting heavy Coke Oven doors. This Power Winch uses a high-ratio <strong>Worm Reducer Gearbox</strong> to multiply torque and keep the lift slow and steady. Powered by a robust 5-7.5 HP motor, it offers a lifting capacity of up to 5 tons.',
      'specs' => [
          [
              'fa-weight-hanging',
              'Lifting Capacity',
              '2.5 - 5 Tons'
          ],
          [
              'fa-bolt',
              'Motor Power',
              '5 - 7.5 HP'
          ],
          [
              'fa-cogs',
              'Gearbox Type',
              'Worm Reducer Gearbox'
          ],
          [
              'fa-arrow-up',
              'Operation',
              'Vertical Lift'
          ]
      ],
      'brochure' => 'brochure/Manual_Tools_Co_Power_Winch.pdf',
      'trust' => [
          [
              'fa-check-circle',
              'ISO 9001:2015'
          ],
          [
              'fa-cogs',
              'Worm Reducer Gearbox'
          ],
          [
              'fa-tools',
              'Heavy Duty'
          ]
      ],
      'overview_heading' => 'What is a door lifting power winch?',
      'overview_paras' => [
          'A door lifting power winch is an electric winch that raises and lowers heavy coke oven doors on the battery bench. It is built for controlled lifting rather than speed: a 5 to 7.5 HP motor drives a worm reducer gearbox, whose high reduction ratio multiplies torque and keeps the door moving at a slow, steady rate.',
          'The output shaft turns a grooved steel drum that winds the wire rope at about 2 to 4 metres per minute. Lifting capacity is 2.5 to 5 tons, which covers most standard coke oven doors, depending on battery height and door weight. Besides oven doors, the winch lifts isolation dampers in power plants and steel mills and serves maintenance bays without an overhead crane.'
      ],
      'overview_related_html' => 'Need horizontal pulling instead of lifting? <a href="haulage">See the Coke Oven Haulage Machine <i class="fas fa-arrow-right"></i></a>',
      'buyer_items' => [
          '<strong>Lead time:</strong> Often in stock. Confirm availability when you enquire.',
          '<strong>Warranty:</strong> 1 year, as on all our machinery.',
          '<strong>Installation:</strong> Installation supervision and commissioning available.',
          '<strong>Custom builds:</strong> Capacity, motor power and dimensions can be matched to your plant and drawings.',
          '<strong>Brochure:</strong> <a href="brochure/Manual_Tools_Co_Power_Winch.pdf" download>Download PDF</a>'
      ],
      'tabs' => [
          [
              'id' => 'desc',
              'label' => 'Technical Description'
          ],
          [
              'id' => 'operationalflow',
              'label' => 'Operational Mechanics'
          ],
          [
              'id' => 'apps',
              'label' => 'Applications'
          ],
          [
              'id' => 'maint',
              'label' => 'Maintenance'
          ],
          [
              'id' => 'faq',
              'label' => 'FAQ'
          ]
      ],
      'tech_heading' => 'Precision Lifting for Critical Operations',
      'tech_paras' => [
          'The Manual Tools Company <strong>Door Lifting Power Winch</strong> is designed specifically for the vertical lifting of heavy industrial doors, particularly in Coke Oven Batteries. Unlike standard construction winches, this unit prioritizes steady, controlled movement over speed.',
          'The core advantage lies in its <strong>Worm Reducer Gearbox</strong>. A worm drive reaches a high reduction ratio in a single compact stage, so a modest 5 to 7.5 HP motor produces the torque needed to raise a 5 ton door, and the lift stays slow and even rather than jerking the rope.'
      ],
      'tech_table_heading' => 'Technical Parameters',
      'tech_rows' => [
          [
              'Lifting Capacity',
              '2.5 Tons – 5 Tons'
          ],
          [
              'Motor Power',
              '5 HP – 7.5 HP (3-Phase)'
          ],
          [
              'Gearbox Type',
              'Worm Reducer Gearbox'
          ],
          [
              'Gear Material',
              'Cast Steel'
          ],
          [
              'Drum Type',
              'Grooved Steel Drum / Steel Drum'
          ],
          [
              'Base Frame',
              'Heavy Fabricated Steel Channel'
          ]
      ],
      'flow_heading_accent' => 'Safe Lifting',
      'flow_heading_rest' => 'Cycle',
      'flow_step_word' => 'Step',
      'flow_steps' => [
          [
              'fa-power-off',
              'Drive Activation',
              'The 5-7.5 HP electric motor is engaged. Power is transmitted through a coupling to the input shaft of the Worm Gearbox.'
          ],
          [
              'fa-sort-amount-down',
              'Torque Multiplication',
              'The worm shaft drives the worm wheel. This reduces speed significantly while multiplying lifting torque, ensuring a smooth, non-jerky lift.'
          ],
          [
              'fa-arrow-up',
              'Vertical Lift',
              'The output shaft rotates the grooved drum, winding the steel wire rope. The load (Coke Oven Door) is lifted vertically to the desired height.'
          ]
      ],
      'process_diagram' => null,
      'process_diagram_alt' => null,
      'process_diagram_caption' => null,
      'apps' => [
          [
              'fa-door-open',
              'Coke Oven Doors',
              'The primary application. Used on the bench for lifting and positioning heavy oven doors during charging.'
          ],
          [
              'fa-wind',
              'Heavy Dampers',
              'Used in power plants and steel mills to vertically lift heavy isolation dampers in flue gas ducts.'
          ],
          [
              'fa-warehouse',
              'Maintenance Bays',
              'General purpose vertical lifting for equipment maintenance where overhead cranes are not available.'
          ]
      ],
      'maint_alert' => [
          'fa-exclamation-circle',
          'Critical Check:',
          'Inspect the Wire Rope weekly. Look for broken strands or "bird-caging" near the drum attachment point.'
      ],
      'maint_cols' => [
          [
              'title' => 'Lubrication & Care',
              'items' => [
                  '<strong>Gearbox:</strong> Maintain oil level (SAE-90/140). Worm gears generate heat, so oil quality is vital.',
                  '<strong>Wire Rope:</strong> Apply heavy lubricant/grease to prevent corrosion from coke oven fumes.',
                  '<strong>Drum Bushings:</strong> Grease nipples on the drum shaft monthly.'
              ]
          ],
          [
              'title' => 'Mechanical Inspection',
              'items' => [
                  'Inspect foundation bolts. Vibration can loosen them over time.',
                  'Verify the limit switch functionality to prevent over-winding.'
              ]
          ]
      ],
      'custom_tabs' => [],
      'faqs' => [
          [
              'Why is a Worm Gearbox used instead of Helical?',
              'A worm drive reaches a high reduction ratio in one compact stage, so a smaller motor delivers the torque a heavy door needs, and the lift stays slow and even.'
          ],
          [
              'What is the lifting speed?',
              'These are designed for torque, not speed. The lifting speed is generally slow and controlled (approx. 2-4 meters/minute) to ensure safety.'
          ],
          [
              'What capacity do I need for a Coke Oven?',
              'Standard Coke Oven doors usually require the 2.5 Ton to 5 Ton range, depending on the battery height and door weight.'
          ],
          [
              'Is the wire rope included?',
              'Yes, a standard length is included, but we can customize the rope length and diameter based on your lifting height.'
          ]
      ],
      'quote_title' => 'Door Lifting Power Winch',
      'related_slug' => 'power-winch'
  ],
  'vibrator-screen' => [
      'slug' => 'vibrator-screen',
      'title' => 'Vibrating Screen for Coke & Coal (1–4 Deck) | Manual Tools Company',
      'description' => 'Vibrator screen machine (vibrating screen) for grading coke and coal: 1–4 decks, 7.5–15 HP motor, interchangeable mesh. Made in Dhanbad, India.',
      'og_image' => 'assets/img/about-us-products-thumbnail/Vibrator-Screen-Machine.png',
      'schema_name' => 'Vibrator Screen Machine',
      'schema_description' => 'Multi-deck vibrating screen machine for precise size separation of coke, coal, and minerals.',
      'sku' => 'MTC-VS-MD',
      'schema_props' => [
          [
              'Motor Power',
              '7.5 – 15 H.P.'
          ],
          [
              'Decks',
              '1 to 4 Decks'
          ],
          [
              'Screen Size',
              '4\'x12\' to 5\'x16\''
          ],
          [
              'Application',
              'Grading & Sorting'
          ]
      ],
      'crumb_heading' => 'Vibrator Screen Machine',
      'crumb_last' => 'Vibrator Screen',
      'main_image' => 'assets/img/about-us-products/Vibrator Screen Machine.jpg',
      'gallery_dir' => 'assets/img/product-images/vibrator-screen/',
      'gallery_labels' => [
          'vibrator-screen-dispatch.jpg' => 'Vibrator Screen loaded for dispatch',
      ],
      'has_video' => false,
      'hero_alt' => 'Vibrator screen machine (vibrating screen) for coke and coal',
      'thumb_alt' => 'Vibrator Screen Machine',
      'eyebrow' => 'Industrial Grading & Sorting',
      'h1_lead' => 'Vibrator Screen',
      'h1_accent' => 'Multi-Deck Series',
      'model_label' => 'Model',
      'model' => 'MTC-VS-MD',
      'stock' => 'Custom Config',
      'intro_html' => 'Achieve precise material separation with our heavy-duty Vibrator Screen. Designed for the Coke and Coal industries, this machine features an eccentric shaft mechanism for aggressive vibration and high screening efficiency. Available in <strong>1 to 4 deck configurations</strong> to suit your specific sizing requirements.',
      'specs' => [
          [
              'fa-layer-group',
              'Configuration',
              '1 - 4 Decks'
          ],
          [
              'fa-bolt',
              'Motor Power',
              '7.5 - 15 HP'
          ],
          [
              'fa-ruler-combined',
              'Screen Size',
              'Up to 5\' x 16\''
          ],
          [
              'fa-filter',
              'Mesh Type',
              'High Carbon Steel'
          ]
      ],
      'brochure' => 'brochure/Manual_Tools_Co_Vibrator_Screen.pdf',
      'trust' => [
          [
              'fa-check-circle',
              'ISO 9001:2015'
          ],
          [
              'fa-random',
              'High Efficiency'
          ],
          [
              'fa-cogs',
              'Low Maintenance'
          ]
      ],
      'overview_heading' => 'What is a vibrator screen machine?',
      'overview_paras' => [
          'A vibrator screen machine, also called a vibrating screen, separates bulk material such as coke, coal and iron ore into size grades. An eccentric shaft, driven by a 7.5 to 15 HP, 1440 RPM motor, shakes the screen deck in a circular motion: fine particles fall through the mesh while oversize lumps travel to the discharge chute. Each deck discharges its own grade, for example +40 mm, 20–40 mm and below 20 mm.',
          'Machines are built with one to four decks, and a three-deck screen gives four output sizes. Standard screen sizes are 4\'×12\', 4\'×16\' and 5\'×16\', with interchangeable high carbon steel mesh for changing the grading. Coil spring suspension keeps vibration away from the foundation, and the amplitude is adjusted with counterweights. In coke oven plants it separates coke breeze from blast furnace coke; it is also used in coal washeries and stone crushing plants.'
      ],
      'overview_related_html' => 'Need rollers or pulleys for the conveyors around it? <a href="conveyor-materials">See our Conveyor Materials <i class="fas fa-arrow-right"></i></a>',
      'buyer_items' => [
          '<strong>Lead time:</strong> Built to your deck and screen-size configuration. Ask us for the current lead time.',
          '<strong>Warranty:</strong> 1 year, as on all our machinery.',
          '<strong>Installation:</strong> Installation supervision and commissioning available.',
          '<strong>Custom builds:</strong> Capacity, motor power and dimensions can be matched to your plant and drawings.',
          '<strong>Brochure:</strong> <a href="brochure/Manual_Tools_Co_Vibrator_Screen.pdf" download>Download PDF</a>'
      ],
      'tabs' => [
          [
              'id' => 'desc',
              'label' => 'Technical Description'
          ],
          [
              'id' => 'operationalflow',
              'label' => 'Sorting Process'
          ],
          [
              'id' => 'apps',
              'label' => 'Applications'
          ],
          [
              'id' => 'maint',
              'label' => 'Maintenance'
          ],
          [
              'id' => 'faq',
              'label' => 'FAQ'
          ]
      ],
      'tech_heading' => 'High-Capacity Industrial Screening',
      'tech_paras' => [
          'The Manual Tools Company <strong>Vibrator Screen Machine</strong> is engineered to separate bulk materials into specific grades. By utilizing an eccentric shaft or unbalanced motor system, the machine generates a uniform circular motion that effectively stratifies the material bed.',
          'Built on a heavy-duty fabricated steel chassis with spring suspension, it minimizes vibration transfer to the foundation while maximizing screening energy. The mesh decks are interchangeable, allowing operators to easily switch between sorting sizes (e.g., separating Coke Breeze from Lumps).'
      ],
      'tech_table_heading' => 'Technical Parameters',
      'tech_rows' => [
          [
              'Screen Dimensions',
              '4\'x12\' | 4\'x16\' | 5\'x16\' (Standard Sizes)'
          ],
          [
              'Number of Decks',
              '1, 2, 3, or 4 Decks (Customizable)'
          ],
          [
              'Motor Power',
              '7.5 HP – 15 HP (Based on Load)'
          ],
          [
              'Vibration Mechanism',
              'Eccentric Shaft'
          ],
          [
              'Mounting',
              'Heavy Coil Spring Suspension'
          ]
      ],
      'flow_heading_accent' => '3-Stage',
      'flow_heading_rest' => 'Grading Cycle',
      'flow_step_word' => 'Step',
      'flow_steps' => [
          [
              'fa-dolly-flatbed',
              'Material Feed',
              'Mixed material is fed onto the top deck. The vibration immediately spreads the material across the full width of the screen cloth.'
          ],
          [
              'fa-wave-square',
              'Stratification',
              'Fine particles vibrate down through the mesh openings to the lower decks, while larger lumps (Oversize) ride over the top to the discharge chute.'
          ],
          [
              'fa-columns',
              'Multi-Output',
              'Each deck discharges its specific size grade (e.g., +40mm, 20-40mm, -20mm) into separate hoppers or conveyors for final storage.'
          ]
      ],
      'process_diagram' => null,
      'process_diagram_alt' => null,
      'process_diagram_caption' => null,
      'apps' => [
          [
              'fa-fire',
              'Coke Oven Plants',
              'Essential for separating "Coke Breeze" (dust) from usable Blast Furnace Coke lumps.'
          ],
          [
              'fa-gem',
              'Coal Washeries',
              'Used for sizing raw coal before washing and dewatering clean coal after processing.'
          ],
          [
              'fa-cubes',
              'Stone Crushing',
              'Highly effective for grading aggregates, gravel, and sand in construction material plants.'
          ]
      ],
      'maint_alert' => [
          'fa-exclamation-triangle',
          'Efficiency Tip:',
          'Regularly check the tension of the screen mesh. Loose mesh reduces efficiency and wears out faster.'
      ],
      'maint_cols' => [
          [
              'title' => 'Daily / Weekly Checks',
              'items' => [
                  'Inspect suspension springs for cracks or fatigue.',
                  'Check V-Belt tension on the drive motor.',
                  'Ensure screen cloth clamping bolts are tight.',
                  'Monitor bearing temperature (should be warm, not hot).'
              ]
          ],
          [
              'title' => 'Periodic Replacement',
              'items' => [
                  '<strong>Screen Mesh:</strong> High wear item. Replace immediately if holes appear.',
                  '<strong>Bearings:</strong> Heavy duty spherical roller bearings need greasing every 100 hours.',
                  '<strong>Rubber Buffers:</strong> Replace if they become brittle or cracked.'
              ]
          ]
      ],
      'custom_tabs' => [],
      'faqs' => [
          [
              'What materials can this machine handle?',
              'It is primarily designed for Coke, Coal, and Iron Ore, but is also suitable for stone aggregates and other minerals.'
          ],
          [
              'Can I change the output size?',
              'Yes. The wire mesh screens are interchangeable. You can replace them with different mesh sizes (apertures) to change the output grading.'
          ],
          [
              'How many sizes can I get at once?',
              'That depends on the number of decks. A 3-deck machine will give you 4 different output sizes (Oversize + 3 grades).'
          ],
          [
              'What motor does it use?',
              'Typically, a 1440 RPM, 3-phase induction motor ranging from 7.5 HP to 15 HP, depending on the machine size.'
          ],
          [
              'Is the vibration adjustable?',
              'Yes, the amplitude can be adjusted by changing the counterweights on the flywheels/eccentric shaft.'
          ]
      ],
      'quote_title' => 'Vibrator Screen Machine',
      'related_slug' => 'vibrator-screen'
  ],
  'conveyor-materials' => [
      'slug' => 'conveyor-materials',
      'title' => 'Conveyor Idlers, Rollers & Pulleys | Manual Tools Company',
      'description' => 'Conveyor idlers, idler rollers, impact rollers and head & tail pulleys for 600–1400 mm belts in coke and coal handling. Made in Dhanbad, India.',
      'og_image' => 'assets/img/about-us-products-thumbnail/Conveyor-Material.png',
      'schema_name' => 'Conveyor Components Series',
      'schema_description' => 'Comprehensive range of conveyor components including Idlers, Return Rollers, Impact Rollers, and Pulleys for belt widths up to 1400mm.',
      'sku' => null,
      'schema_props' => [
          [
              'Belt Widths',
              '600mm – 1400mm'
          ],
          [
              'Roller Type',
              'MS Seamless / Impact Rubber'
          ],
          [
              'Pulley Type',
              'Rubber Lagged / Plain'
          ],
          [
              'Bearing',
              'Sealed 2RS / ZZ'
          ]
      ],
      'crumb_heading' => 'Conveyor Materials',
      'crumb_last' => 'Conveyor Materials',
      'main_image' => 'assets/img/about-us-products/Conveyor Material.jpeg',
      'gallery_dir' => 'assets/img/product-images/conveyor-materials/',
      'has_video' => false,
      'hero_alt' => 'Conveyor idlers, rollers and pulleys',
      'thumb_alt' => 'Conveyor Materials & Components',
      'eyebrow' => 'Industrial Handling Systems',
      'h1_lead' => 'Conveyor Materials',
      'h1_accent' => '& Components',
      'model_label' => 'Category',
      'model' => 'MTC-CM-SERIES',
      'stock' => 'In Stock / Made to Order',
      'intro_html' => 'Ensure continuous plant operation with our premium range of conveyor components. From heavy-duty <strong>Head & Tail Pulleys</strong> to frictionless <strong>Idlers and Rollers</strong>, our materials are engineered for the abrasive and dusty environments of Coke Ovens, Washeries, and Power Plants.',
      'specs' => [
          [
              'fa-ruler-horizontal',
              'Belt Widths',
              '600 - 1400 mm'
          ],
          [
              'fa-circle-notch',
              'Bearings',
              'Sealed'
          ],
          [
              'fa-layer-group',
              'Material',
              'Seamless Pipe'
          ],
          [
              'fa-industry',
              'Application',
              'Heavy Duty'
          ]
      ],
      'brochure' => 'brochure/Manual_Tools_Co_Conveyor_Components.pdf',
      'trust' => [
          [
              'fa-check-circle',
              'ISO 9001:2015'
          ],
          [
              'fa-shield-alt',
              'Dust Proof Seals'
          ],
          [
              'fa-truck',
              'Bulk Supply'
          ]
      ],
      'overview_heading' => 'Which conveyor components do we make?',
      'overview_paras' => [
          'Manual Tools Company manufactures components for belt conveyors in coke oven plants, coal washeries and power plants: carrying idlers (idler rollers), return rollers, rubber-ringed impact rollers for hopper loading points, and head and tail pulleys in plain steel or with rubber lagging (diamond groove or plain) for better grip in wet conditions.',
          'Rollers use seamless pipe on bright steel (EN-8) shafts with sealed ball bearings (6204, 6205 or 6305) to keep dust out. Components are available for belt widths of 600, 750, 800, 900, 1000, 1200 and 1400 mm, and idler frames (brackets) can be supplied with the rollers or separately as spares. We take bulk orders for plant-wide replacement.'
      ],
      'overview_related_html' => 'Grading material before it goes on the belt? <a href="vibrator-screen">See the Vibrator Screen Machine <i class="fas fa-arrow-right"></i></a>',
      'buyer_items' => [
          '<strong>Lead time:</strong> Standard sizes (e.g. 800 mm and 1000 mm rollers) are often in stock. Custom pulleys usually take 2–3 weeks.',
          '<strong>Custom builds:</strong> Capacity, motor power and dimensions can be matched to your plant and drawings.',
          '<strong>Brochure:</strong> <a href="brochure/Manual_Tools_Co_Conveyor_Components.pdf" download>Download PDF</a>'
      ],
      'tabs' => [
          [
              'id' => 'components',
              'label' => 'Component Breakdown'
          ],
          [
              'id' => 'specs',
              'label' => 'General Specifications'
          ],
          [
              'id' => 'faq',
              'label' => 'FAQ'
          ]
      ],
      'tech_heading' => 'Comprehensive Conveyor Solutions',
      'tech_paras' => [
          'We manufacture key components that ensure the smooth running of your belt conveyor systems. Select a component below to see details.'
      ],
      'tech_table_heading' => 'Technical Parameters',
      'tech_rows' => [],
      'flow_heading_accent' => null,
      'flow_heading_rest' => null,
      'flow_step_word' => 'Step',
      'flow_steps' => [],
      'process_diagram' => null,
      'process_diagram_alt' => null,
      'process_diagram_caption' => null,
      'apps' => [],
      'maint_alert' => null,
      'maint_cols' => [],
      'custom_tabs' => [
          'components' => '<div class="mtc-tech-wrapper">
<h3 class="mtc-tech-heading">Comprehensive Conveyor Solutions</h3>
<p class="mtc-tech-paragraph">We manufacture key components that ensure the smooth running of your belt conveyor systems. Select a component below to see details.</p>
<div class="mtc-component-grid">
<!-- Card 1: Idlers -->
<div class="mtc-component-card">
<div class="mtc-card-icon"><i class="fas fa-ellipsis-h"></i></div>
<h4 class="mtc-card-title">Carrying Idlers</h4>
<ul class="mtc-card-list">
<li>Troughing Sets - 30°</li>
<li>Heavy Gauge Seamless Steel Pipe</li>
<li>Sealed for Dust Protection</li>
</ul>
</div>
<!-- Card 2: Return Rollers -->
<div class="mtc-component-card">
<div class="mtc-card-icon"><i class="fas fa-minus"></i></div>
<h4 class="mtc-card-title">Return Rollers</h4>
<ul class="mtc-card-list">
<li>Single Flat Roller configuration</li>
<li>Brackets supplied</li>
<li>Smooth surface to prevent belt wear</li>
</ul>
</div>
<!-- Card 3: Impact Rollers -->
<div class="mtc-component-card">
<div class="mtc-card-icon"><i class="fas fa-compress-arrows-alt"></i></div>
<h4 class="mtc-card-title">Impact Rollers</h4>
<ul class="mtc-card-list">
<li>Shock-absorbing Rubber Rings</li>
<li>Installed at loading points</li>
<li>Prevents belt damage from falling material</li>
</ul>
</div>
<!-- Card 4: Pulleys -->
<div class="mtc-component-card">
<div class="mtc-card-icon"><i class="fas fa-bullseye"></i></div>
<h4 class="mtc-card-title">Head & Tail Pulleys</h4>
<ul class="mtc-card-list">
<li>Head Pulley (Drive) & Tail Pulley (Tension)</li>
<li>Diamond Groove Rubber Lagging available</li>
<li>Key-based locking assemblies</li>
<li>Coupling Pair for head Pulley available</li>
</ul>
</div>
</div>
</div>',
          'specs' => '<div class="mtc-tech-wrapper">
<h3 class="mtc-tech-heading">Material Specifications</h3>
<div class="mtc-tech-table-container">
<table class="mtc-modern-tech-table">
<thead>
<tr>
<th width="40%">Property</th>
<th>Standard Specification</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>Belt Width Compatibility</strong></td>
<td>600, 750, 800, 900, 1000, 1200, 1400 mm</td>
</tr>
<tr>
<td><strong>Shaft Material</strong></td>
<td>Bright Steel Bar (EN-8)</td>
</tr>
<tr>
<td><strong>Bearings</strong></td>
<td>Ball Bearings (6204, 6205, 6305)</td>
</tr>
</tbody>
</table>
</div>
</div>'
      ],
      'faqs' => [
          [
              'What belt sizes do you support?',
              'We manufacture components for all standard belt widths: 600mm, 750mm, 800mm, 900mm, 1000mm, 1200mm, and 1400mm.'
          ],
          [
              'Are the impact rollers rubberized?',
              'Yes, our Impact Rollers feature robust rubber rings specifically designed to absorb the shock of falling material at hopper loading points.'
          ],
          [
              'Do pulleys come with lagging?',
              'We offer both plain steel face pulleys and rubber-lagged pulleys (Diamond groove or plain) for better traction in wet conditions.'
          ],
          [
              'Can you supply brackets?',
              'Yes, we can supply the Idler Frames (brackets) along with the rollers or separately as spares.'
          ],
          [
              'What is the delivery time?',
              'Standard sizes (e.g., 800mm/1000mm rollers) are often in stock. Custom pulleys typically take 2-3 weeks.'
          ]
      ],
      'quote_title' => 'Conveyor Materials',
      'related_slug' => 'conveyor-materials'
  ],
  'pusher-with-stamping-arrangement' => [
      'slug' => 'pusher-with-stamping-arrangement',
      'title' => 'Stamp Charging Pusher Machine for Coke Ovens | Manual Tools Company',
      'description' => 'Pusher machine with roller stamping arrangement for stamp-charged coke ovens: 20 m beam, 40 HP main drive, 15 HP long travel. Made in Dhanbad, India.',
      'og_image' => 'assets/img/about-us-products-thumbnail/Pusher-Machine-With-Stamping-Arrangement.png',
      'schema_name' => 'Pusher Machine With Stamping Arrangement',
      'schema_description' => 'Heavy-duty Pusher Machine with Stamping Arrangement (Roller System) designed for stamp-charged coke ovens, with a 20m pusher beam and synchronized roller system.',
      'sku' => 'MTC-PM-SA',
      'schema_props' => [
          [
              'Pusher Beam',
              '20 Meters'
          ],
          [
              'Main Drive',
              '40 HP Motor'
          ],
          [
              'Travel Drive',
              '15 HP Motor'
          ],
          [
              'System',
              'Roller Stamping'
          ]
      ],
      'crumb_heading' => 'Pusher Machine',
      'crumb_last' => 'Pusher Machine',
      'main_image' => 'assets/img/about-us-products/Pusher Machine With Stamping Arrangement.jpg',
      'gallery_dir' => 'assets/img/product-images/pusher-machine-with-stamping-arrangement/',
      'has_video' => false,
      'hero_alt' => 'Stamp charging pusher machine with roller stamping arrangement',
      'thumb_alt' => 'Pusher Machine with Stamping Arrangement',
      'eyebrow' => 'Coke Oven Machinery Series',
      'h1_lead' => 'Pusher Machine',
      'h1_accent' => 'With Stamping Arrangement',
      'model_label' => 'Model',
      'model' => 'MTC-PM-SA',
      'stock' => 'Made to Order',
      'intro_html' => 'Designed for stamp-charged coke ovens, this machine integrates a heavy-duty <strong>Pusher Beam</strong> with a <strong>Roller Stamping System</strong>. It ensures uniform coal cake density and smooth discharging operation. Powered by a 40 HP main drive, it handles the toughest industrial cycles with ease.',
      'specs' => [
          [
              'fa-ruler-horizontal',
              'Beam Length',
              '20 Meters'
          ],
          [
              'fa-bolt',
              'Main Motor',
              '40 HP (Elec.)'
          ],
          [
              'fa-truck-moving',
              'Long Travel',
              '15 HP Motor'
          ],
          [
              'fa-cogs',
              'System',
              'Roller Stamping'
          ]
      ],
      'brochure' => 'brochure/Manual_Tools_Co_Pusher_Machine.pdf',
      'trust' => [
          [
              'fa-check-circle',
              'ISO 9001:2015'
          ],
          [
              'fa-shield-alt',
              'Heavy Structure'
          ],
          [
              'fa-cog',
              'Precision Stamping'
          ]
      ],
      'overview_heading' => 'What is a pusher machine with stamping arrangement?',
      'overview_paras' => [
          'A pusher machine with stamping arrangement is a combined stamp charging and pushing machine for stamp-charged coke ovens, and it does two jobs. Its roller stamping system (7.5 HP) compacts loose coal fines into a dense coal cake, which gives better coke quality. Its 20-metre pusher beam, driven by a 40 HP motor through a heavy-duty helical gearbox and chain drive, pushes the finished coke out of the oven after carbonisation.',
          'The machine travels on rails along the battery, powered by a 15 HP long travel motor, and includes a 20-metre leveller beam with rack and pinion. Total connected load is about 65 to 70 HP. The standard beam suits ovens up to 11 metres long, and custom lengths are available. Travel and alignment are motorised, while stamping and pushing are controlled from a panel. Roller stamping is faster and needs less maintenance than drop-hammer systems.'
      ],
      'overview_related_html' => 'Top-charging your ovens instead? <a href="coal-charging-car">See the Coal Charging Car <i class="fas fa-arrow-right"></i></a>',
      'buyer_items' => [
          '<strong>Lead time:</strong> Made to order. Ask us for the current lead time.',
          '<strong>Warranty:</strong> 1 year, as on all our machinery.',
          '<strong>Installation:</strong> Installation supervision and commissioning available.',
          '<strong>Custom builds:</strong> Capacity, motor power and dimensions can be matched to your plant and drawings.',
          '<strong>Brochure:</strong> <a href="brochure/Manual_Tools_Co_Pusher_Machine.pdf" download>Download PDF</a>'
      ],
      'tabs' => [
          [
              'id' => 'desc',
              'label' => 'Technical Description'
          ],
          [
              'id' => 'operationalflow',
              'label' => 'Operational Process'
          ],
          [
              'id' => 'apps',
              'label' => 'Applications'
          ],
          [
              'id' => 'maint',
              'label' => 'Maintenance'
          ],
          [
              'id' => 'faq',
              'label' => 'FAQ'
          ]
      ],
      'tech_heading' => 'Integrated Stamping & Pushing Solution',
      'tech_paras' => [
          'The Manual Tools Company <strong>Pusher Machine with Stamping Arrangement</strong> is a critical asset for modern Coke Oven Batteries. It combines two essential functions: compacting loose coal into a dense "cake" using a synchronized roller system, and pushing this cake into the oven for carbonization.',
          'The machine travels on rails along the battery length, powered by a 15 HP Long Travel motor. The massive 20-meter Pusher Beam is driven by a powerful 40 HP motor through a heavy-duty Helical Gearbox, ensuring sufficient force to eject the finished coke mass after carbonization.'
      ],
      'tech_table_heading' => 'Technical Parameters',
      'tech_rows' => [
          [
              'Pusher Beam Length',
              '20 Meters (Heavy Fabrication)'
          ],
          [
              'Main Pusher Motor',
              '40 HP (Electric)'
          ],
          [
              'Long Travel Motor',
              '15 HP (Electric)'
          ],
          [
              'Stamping Drive',
              '7.5 HP (Synchronized Roller System)'
          ],
          [
              'Transmission',
              'Heavy Duty Helical Gearbox & Chain Drive'
          ],
          [
              'Leveller Beam',
              '20 Meters (Rack & Pinion Mechanism)'
          ]
      ],
      'flow_heading_accent' => '3-Stage',
      'flow_heading_rest' => 'Operational Cycle',
      'flow_step_word' => 'Step',
      'flow_steps' => [
          [
              'fa-layer-group',
              'Coal Stamping',
              'Coal fines are fed in and the <strong>Roller Stamping System</strong> compacts them into a high-density cake, essential for good coke quality.'
          ],
          [
              'fa-sign-out-alt',
              'Coke Ejection',
              'After carbonization, the Pusher Beam rams the finished red-hot coke mass out the other side.'
          ]
      ],
      'process_diagram' => null,
      'process_diagram_alt' => null,
      'process_diagram_caption' => null,
      'apps' => [
          [
              'fa-fire-alt',
              'Coke Ovens',
              'The primary machinery for stamp-charged horizontal coke ovens.'
          ],
          [
              'fa-industry',
              'Steel Plants',
              'Used in integrated steel plants where high-density metallurgical coke is required for blast furnaces.'
          ],
          [
              'fa-cogs',
              'Coal Carbonization',
              'Ensures uniform carbonization by creating a consistent coal cake density throughout the batch.'
          ]
      ],
      'maint_alert' => [
          'fa-exclamation-triangle',
          'Alignment Warning:',
          'Ensure rails are perfectly level. Misalignment can cause the 20m beam to jam inside the oven.'
      ],
      'maint_cols' => [
          [
              'title' => 'Lubrication Schedule',
              'items' => [
                  '<strong>Roller Chains:</strong> Apply heavy chain oil daily to prevent stiff links.',
                  '<strong>Gearbox:</strong> Check oil level weekly. Replace gear oil every 6 months.',
                  '<strong>Rack & Pinion:</strong> Grease the main beam rack teeth weekly.',
                  '<strong>Wheel Bearings:</strong> Grease long-travel wheel bearings monthly.'
              ]
          ],
          [
              'title' => 'Mechanical Inspection',
              'items' => [
                  'Check the tension of the stamping roller chains.',
                  'Inspect the pusher beam shoe (front tip) for heat damage/wear.',
                  'Verify the function of limit switches (end-stops).',
                  'Tighten motor mounting bolts due to vibration.'
              ]
          ]
      ],
      'custom_tabs' => [],
      'faqs' => [
          [
              'What is the maximum oven size?',
              'The standard 20-meter beam is designed for ovens up to 11 meters in length. Custom lengths are available.'
          ],
          [
              'Why use Roller Stamping?',
              'Roller stamping is faster and requires less maintenance than drop-hammer systems. It provides continuous compaction.'
          ],
          [
              'What is the power requirement?',
              'The total connected load is approximately 65-70 HP (40 HP Main + 15 HP Travel + 7.5 HP Stamping + Auxiliaries).'
          ],
          [
              'Is the operation automated?',
              'The machine is semi-automatic. Travel and alignment are manual/motorized, while the stamping and pushing cycles are controlled via a panel.'
          ],
          [
              'Does it include the charging box?',
              'The charging box is usually part of the oven structure, but we can fabricate a mobile charging box integrated with the machine if required.'
          ]
      ],
      'quote_title' => 'Pusher Machine With Stamping',
      'related_slug' => 'pusher-with-stamping-arrangement'
  ],
  'coal-charging-car' => [
      'slug' => 'coal-charging-car',
      'title' => 'Coal Charging Car (Larry Car) for Coke Ovens | Manual Tools Company',
      'description' => 'Coal charging car (larry car) for top-charged coke ovens: 2, 3 or 4 conical hoppers, 8–20 ton capacity, 15 HP travel drive. Made in Dhanbad, India.',
      'og_image' => 'assets/img/about-us-products-thumbnail/Coal-Charging-Car.jpg',
      'schema_name' => 'Coal Charging Car',
      'schema_description' => 'Rail-mounted Coal Charging Car for top-charging coke ovens. Features 2, 3 or 4 hoppers, gravity feed system, and heavy-duty travel mechanism.',
      'sku' => 'MTC-CCC-Series',
      'schema_props' => [
          [
              'Capacity',
              '8T / 15T / 20T'
          ],
          [
              'Travel Motor',
              '15 HP'
          ],
          [
              'Charging Mouths',
              '2, 3 & 4 Nos'
          ],
          [
              'Mechanism',
              'Gravity Feed'
          ]
      ],
      'crumb_heading' => 'Coal Charging Car',
      'crumb_last' => 'Coal Charging Car',
      'main_image' => 'assets/img/about-us-products/Coal-Charging-Car.jpg',
      'gallery_dir' => 'assets/img/product-images/coal-charging-car/',
      'has_video' => false,
      'hero_alt' => 'Coal charging car (larry car) for coke ovens',
      'thumb_alt' => 'Coal Charging Car',
      'eyebrow' => 'Coke Oven Machinery Series',
      'h1_lead' => 'Coal',
      'h1_accent' => 'Charging Car (Top Feed)',
      'model_label' => 'Model',
      'model' => 'MTC-CCC-Series',
      'stock' => 'Made to Order',
      'intro_html' => 'Optimized for efficient "Top Charging" of coke ovens, this machine runs on battery-top rails to deliver precise coal quantities into the oven chambers. Equipped with <strong>2, 3 or 4 Conical Hoppers</strong> and a heavy-duty travel mechanism, it ensures uniform coal distribution.',
      'specs' => [
          [
              'fa-weight-hanging',
              'Hopper Capacity',
              '8 - 20 Tons'
          ],
          [
              'fa-truck-moving',
              'Travel Motor',
              '15 HP (Elec.)'
          ],
          [
              'fa-arrow-down',
              'Charging Mouths',
              '2, 3 & 4'
          ],
          [
              'fa-cogs',
              'Operation',
              'Gravity Feed'
          ]
      ],
      'brochure' => 'brochure/Manual_Tools_Co_Charging_Car.pdf',
      'trust' => [
          [
              'fa-check-circle',
              'ISO 9001:2015'
          ],
          [
              'fa-shield-alt',
              'Heavy Structure'
          ]
      ],
      'overview_heading' => 'What is a coal charging car?',
      'overview_paras' => [
          'A coal charging car, also called a larry car, is a rail-mounted machine that runs along the top of a coke oven battery and charges coal into the ovens from above. It takes a measured coal blend from the overhead service bunker into four conical hoppers, travels to the empty oven, and lines up its telescopic sleeves with the oven\'s four charging holes to limit smoke leakage. Motorised slide gates (3 HP) then open and the coal flows in by gravity, with a manual override wheel for power failures.',
          'A 15 HP motor with a worm reducer gearbox moves the car at 60 to 80 metres per minute and positions it precisely. Hoppers are made from 8 mm tapered steel plate with steep sides so that wet coal flows, in capacities of 8, 15 or 20 tons. Safety features include hydraulic buffers, travel alarms and heat shields for the operator cabin.'
      ],
      'overview_related_html' => 'Running a stamp-charged battery? <a href="pusher-with-stamping-arrangement">See the Pusher Machine with Stamping Arrangement <i class="fas fa-arrow-right"></i></a>',
      'buyer_items' => [
          '<strong>Lead time:</strong> Made to order. Ask us for the current lead time.',
          '<strong>Warranty:</strong> 1 year, as on all our machinery.',
          '<strong>Installation:</strong> Installation supervision and commissioning available.',
          '<strong>Custom builds:</strong> Capacity, motor power and dimensions can be matched to your plant and drawings.',
          '<strong>Brochure:</strong> <a href="brochure/Manual_Tools_Co_Charging_Car.pdf" download>Download PDF</a>'
      ],
      'tabs' => [
          [
              'id' => 'desc',
              'label' => 'Technical Description'
          ],
          [
              'id' => 'operationalflow',
              'label' => 'Operational Process'
          ],
          [
              'id' => 'apps',
              'label' => 'Applications'
          ],
          [
              'id' => 'maint',
              'label' => 'Maintenance'
          ],
          [
              'id' => 'faq',
              'label' => 'FAQ'
          ]
      ],
      'tech_heading' => 'Precision Coal Feed System',
      'tech_paras' => [
          'The Manual Tools Company <strong>Coal Charging Car</strong> (Larry Car) is a rail-mounted vehicle designed to travel along the top of the coke oven battery. Its primary function is to receive pulverized coal from the overhead service bunker and discharge it into the hot ovens via charging holes.',
          'Constructed with 8mm thick tapered steel plates, the hoppers ensure smooth coal flow without bridging. The travel mechanism is powered by a 15 HP motor coupled with a Worm Reducer Gearbox, providing high torque for controlled movement and precise positioning over the oven mouths.'
      ],
      'tech_table_heading' => 'Technical Parameters',
      'tech_rows' => [
          [
              'Hopper Capacity',
              '8 Tons / 15 Tons / 20 Tons (Customizable)'
          ],
          [
              'Long Travel Motor',
              '15 HP (Electric)'
          ],
          [
              'Gate Operation Motor',
              '3 HP (For Hopper Discharge)'
          ],
          [
              'Number of Hoppers',
              '2, 3 or 4 Conical Hoppers'
          ],
          [
              'Travel Speed',
              '60 - 80 meters/minute'
          ],
          [
              'Gearbox Type',
              'Heavy Duty Worm Reducer'
          ],
          [
              'Body Plate Thickness',
              '8mm (Tapered / Vertical)'
          ]
      ],
      'flow_heading_accent' => '3-Stage',
      'flow_heading_rest' => 'Charging Cycle',
      'flow_step_word' => 'Step',
      'flow_steps' => [
          [
              'fa-arrow-down',
              'Bunker Filling',
              'The car positions itself under the overhead coal tower. The hoppers are filled with a precise weight of coal blend.'
          ],
          [
              'fa-crosshairs',
              'Alignment',
              'Driven by the 15 HP motor, the car travels to the empty oven. The telescopic sleeves align perfectly with the oven\'s charging holes to prevent smoke leakage.'
          ],
          [
              'fa-box-open',
              'Gravity Discharge',
              'The bottom slide gates open (via 3 HP motor or manual gear). Coal flows by gravity into the oven. Mechanical vibrators may engage to clear sticky coal.'
          ]
      ],
      'process_diagram' => null,
      'process_diagram_alt' => null,
      'process_diagram_caption' => null,
      'apps' => [
          [
              'fa-fire',
              'Coke Ovens',
              'Standard equipment for top-charged byproduct recovery coke oven batteries.'
          ],
          [
              'fa-industry',
              'Steel Plants',
              'Critical for the continuous production of metallurgical coke in integrated steelworks.'
          ]
      ],
      'maint_alert' => [
          'fa-exclamation-triangle',
          'Heat Warning:',
          'This machine operates on top of hot ovens. Regularly inspect electrical cables for heat damage.'
      ],
      'maint_cols' => [
          [
              'title' => 'Lubrication Schedule',
              'items' => [
                  '<strong>Travel Wheels:</strong> Grease bearings weekly. High-temp grease recommended.',
                  '<strong>Gearboxes:</strong> Check oil levels monthly. Replace SAE-140 oil every 6 months.',
                  '<strong>Slide Gates:</strong> Lubricate rack and pinion mechanisms weekly to prevent jamming.'
              ]
          ],
          [
              'title' => 'Mechanical Inspection',
              'items' => [
                  'Check wheel flanges for excessive wear due to rail misalignment.',
                  'Inspect hopper interiors for coal build-up (rat-holing).'
              ]
          ]
      ],
      'custom_tabs' => [],
      'faqs' => [
          [
              'What travel system is used?',
              'The car runs on a robust rail-mounted system (Track wheels) powered by a 15 HP slip-ring or squirrel cage motor.'
          ],
          [
              'How many charging mouths does it have?',
              'Built with 2, 3 or 4 charging mouths, to match the charging holes on your oven top.'
          ],
          [
              'Is the discharge automated?',
              'Yes, the slide gates are motorized (3 HP) for semi-automatic operation, with a manual override wheel in case of power failure.'
          ],
          [
              'What safety features are included?',
              'Includes hydraulic buffers, audible travel alarms, and heat shields for the operator cabin.'
          ],
          [
              'Can it handle wet coal?',
              'Yes, the hoppers have steep tapered angles (conical shape) to facilitate the flow of wet coal.'
          ]
      ],
      'quote_title' => 'Coal Charging Car',
      'related_slug' => 'coal-charging-car'
  ],
];

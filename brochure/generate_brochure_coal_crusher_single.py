from fpdf import FPDF
from fpdf.enums import XPos, YPos

# --- Theme Configuration (Industrial/Corporate) ---
FONT_FAMILY = "Helvetica"

COLORS = {
    "header_bg": (16, 24, 32),    
    "accent_red": (194, 24, 7),   # Safety Red (Havells-inspired)
    "text_main": (33, 37, 41),
    "text_light": (100, 100, 100),
    "bg_light": (245, 245, 245),
    "footer_red": (178, 34, 34),
}

class MTCStyleBrochure(FPDF):
    def __init__(self):
        super().__init__()
        self.show_branding = True  # Flag to toggle header/footer

    def drawer_first_page(self):
        # 1. Preparation
        self.show_branding = False
        self.set_auto_page_break(False) 
        self.add_page()
        
        # 2. Background Image (Full Bleed)
        try:
            self.image("brochure/first_page.png", 0, 0, 210, 297)
        except:
            self.set_fill_color(33, 37, 41)
            self.rect(0, 0, 210, 297, 'F')

        # 2. Centered Logo Placement
        logo_w = 100  # Increased size for a centered hero look
        logo_x = (210 - logo_w) / 2
        
        try:
            # Using the calculated logo_x to center the image
            self.image("assets/img/MTC Logo.png", 15, 15, logo_w) 
        except:
            # Fallback centered text
            self.set_y(40)
            self.set_font(FONT_FAMILY, "B", 32)
            self.set_text_color(255, 255, 255)
            # Setting width to 0 and align to "C" centers it relative to the page
            self.cell(0, 15, "MANUAL TOOLS CO.", align="C", ln=True)

        try:
            # Placing logo with a slight margin from the edges
            self.image("brochure/30yearss.png", 15, 275, 45) 
        except:
            self.set_fill_color(*COLORS["accent_red"])
            self.rect(140, 250, 60, 25, 'F') # The badge background

            self.set_xy(140, 253)
            self.set_font(FONT_FAMILY, "B", 22)
            self.set_text_color(255, 255, 255)
            self.cell(60, 10, "30+ YEARS", align="C", ln=True)

            self.set_x(140)
            self.set_font(FONT_FAMILY, "", 10)
            self.cell(60, 5, "OF ENGINEERING EXCELLENCE", align="C")

        # --- RIGHT SIDE: Balanced Office Info ---
        # We align the text to the right to hug the margin
        self.set_xy(110, 277)
        self.set_font(FONT_FAMILY, "B", 10)
        self.set_text_color(255, 255, 255)
        # Website URL
        self.cell(85, 6, "Ravindra Kr. Agarwal, Prop.", align="R", ln=True)
        # Office Address
        self.set_x(110)
        self.set_font(FONT_FAMILY, "", 9)
        self.set_text_color(200, 200, 200) # Slightly lighter grey for the address
        self.cell(85, 6, "Dhanbad, Jharkhand | manualtoolsco.com", align="R")
        # 5. Cleanup
        self.set_auto_page_break(True, margin=20)
        self.show_branding = True

    def header(self):
        if getattr(self, 'show_branding', True):
            self.set_fill_color(*COLORS["header_bg"])
            self.rect(0, 0, 210, 32, 'F')
            try:
                self.image("assets/img/MTC Logo.png", 10, 8, 100)
            except:
                self.set_font(FONT_FAMILY, "B", 16)
                self.set_text_color(255, 255, 255)
                self.text(10, 22, "MANUAL TOOLS CO.")

            # Company Tagline (Right)
            self.set_font(FONT_FAMILY, "B", 10)
            self.set_text_color(255, 255, 255)
            self.text(145, 18, "Ph: +91 9430707348")
            self.set_font(FONT_FAMILY, "", 8)
            self.text(145, 23, "Dhanbad, Jharkhand | manualtoolsco.com")

    def footer(self):
        # FIX: Explicitly tell the footer to stay hidden on Page 1
        if self.page_no() == 1:
            return
        # Only draw footer if flag is True
        if getattr(self, 'show_branding', True):
            self.set_fill_color(*COLORS["header_bg"])
            self.rect(0, 283, 210, 16, 'F') 
            self.set_y(-11)
            self.set_font(FONT_FAMILY, "B", 8) 
            self.set_text_color(255, 255, 255)
            text = "OUR PRODUCTS : Haulages, Disintegrators, Conveyors, Bunkers, Elevator, Pusher Machine, Mixers, Power Winch and Fabrication of all kinds as per Design."
            self.multi_cell(0, 4, text, align="C")

    def draw_section_header(self, title, y_pos):
        self.set_fill_color(*COLORS["bg_light"])
        self.rect(10, y_pos, 190, 10, 'F')
        self.set_xy(10, y_pos)
        self.set_font(FONT_FAMILY, "B", 12)
        self.set_text_color(*COLORS["accent_red"])
        self.cell(0, 10, title, ln=True)
    
    def draw_process_step(self, icon_char, title, description):
        start_x = 120
        # Draw soft background for step
        step_y = self.get_y()
        self.set_fill_color(255, 255, 255)
        self.rect(start_x, step_y, 80, 35, 'F') 
        
        # Step Title with Accent Color
        self.set_font(FONT_FAMILY, "B", 11)
        self.set_text_color(*COLORS["accent_red"])
        self.set_xy(start_x + 2, step_y + 2)
        self.cell(0, 6, title, ln=True)
        
        # Step Description
        self.set_font(FONT_FAMILY, "", 9)
        self.set_text_color(*COLORS["text_main"])
        self.set_x(start_x + 5)
        self.multi_cell(70, 5, description)
        # self.ln(1)
    def draw_gallery_grid(self):
        """
        Creates a 3-column photo gallery grid.
        'images' should be a list of file paths.
        """
        # --- Product Gallery ---
        gallery_start_y = self.get_y() + 5
        self.draw_section_header("PRODUCT GALLERY", gallery_start_y)
        self.set_y(gallery_start_y + 10)    
        self.set_font(FONT_FAMILY, "", 10)
        self.set_text_color(*COLORS["text_light"])
        self.multi_cell(0, 5, "A showcase of our engineered installations and heavy-duty industrial components.", align="L")
        self.ln(5)
        images = [
        "assets/img/product-images/coal-crusher-single-disc/coal-crusher-1.png",
        "assets/img/product-images/coal-crusher-single-disc/coal-crusher-2.png",
        "assets/img/product-images/coal-crusher-single-disc/DSC_0216.png",
        # Add more paths as needed
        ]
        margin = 10
        gap = 5
        # Calculate width for 3 columns: (Total width - margins - gaps) / 3
        img_w = (210 - (2 * margin) - (2 * gap)) / 3
        img_h = 40  # Fixed height for uniform grid
        
        start_y = self.get_y()
        x_offset = margin
        
        for i, img_path in enumerate(images):
            # If we've reached 3 images, move to the next row
            if i > 0 and i % 3 == 0:
                x_offset = margin
                start_y += img_h + gap
            
            # Draw frame and image
            try:
                self.image(img_path, x_offset, start_y, img_w, img_h)
            except:
                # Placeholder if image is missing
                self.set_fill_color(240, 240, 240)
                self.rect(x_offset, start_y, img_w, img_h, 'F')
                self.set_xy(x_offset, start_y + (img_h/2))
                self.set_font(FONT_FAMILY, "I", 8)
                self.set_text_color(150)
                self.cell(img_w, 5, "Image Missing", align="C")
            
            x_offset += img_w + gap
    def request_A_quotation(self):
        self.set_y(-40)
        self.set_fill_color(*COLORS["accent_red"])
        self.rect(10, self.get_y(), 190, 15, 'F')
        self.set_xy(10, self.get_y())
        self.set_font(FONT_FAMILY, "B", 12)
        self.set_text_color(255, 255, 255)
        self.cell(190, 15, "REQUEST A QUOTATION: +91 9430707348", align="C")

    def add_bullet_list(self, features, x_pos, y_start, width=85, line_height=7):
        """
        Draws a vector tick mark and text for each feature.
        """
        self.set_y(y_start)
        for feat in features:
            curr_y = self.get_y()
            self.set_x(x_pos)
            self.set_draw_color(194, 24, 7)
            self.set_line_width(0.4)
            tick_x = x_pos + 1
            tick_y = curr_y + 3
            self.line(tick_x, tick_y, tick_x + 1.5, tick_y + 1.5)
            self.line(tick_x + 1.5, tick_y + 1.5, tick_x + 3.5, tick_y - 1.5)
            self.set_text_color(0, 0, 0)
            self.set_font(FONT_FAMILY, "", 10)
            self.set_x(x_pos + 6)
            self.multi_cell(width - 6, line_height, feat)
            self.set_y(self.get_y() + 1)

    def create_faq_section(self, faq_data, y_start):
        """
        Creates a clean, professional FAQ section.
        Updated for FPDF v2.5+ compatibility.
        """
        self.set_y(y_start)
        # 1. Section Header
        self.draw_section_header("COMMOM QUESTIONS", y_start)
        # self.ln(4)

        
        # 2. Iterate through Questions
        for item in faq_data:
            # Check for page break space
            if self.get_y() > 250:
                self.add_page()
                self.set_y(20)

            # --- QUESTION ---
            self.set_font(FONT_FAMILY, "B", 10)
            self.set_text_color(194, 24, 7) # MTC Red
            
            # FIX: Use new_x=XPos.RIGHT to keep cursor on same line
            self.cell(8, 6, "Q.", new_x=XPos.RIGHT, new_y=YPos.TOP)
            
            self.set_text_color(0, 0, 0) # Black
            
            # FIX: Explicitly calculate width (Effective Page Width - 8mm indentation)
            # This prevents the "Not enough horizontal space" crash
            self.multi_cell(w=self.epw - 8, h=6, txt=item['q'], 
                            new_x=XPos.LMARGIN, new_y=YPos.NEXT)
            
            # --- ANSWER ---
            self.set_text_color(100, 100, 100) # Grey
            self.cell(8, 6, "A.", new_x=XPos.RIGHT, new_y=YPos.TOP)
            
            self.set_font(FONT_FAMILY, "", 10)
            self.set_text_color(50, 50, 50)
            
            # FIX: Explicit width again
            self.multi_cell(w=self.epw - 8, h=6, txt=item['a'], 
                            new_x=XPos.LMARGIN, new_y=YPos.NEXT)
            
            # Spacing between Q&A pairs
            self.ln(3)
def generate_brochure():
    pdf = MTCStyleBrochure()
    # --- STEP 1: ADD COVER PAGE (NO HEADER/FOOTER) ---
    pdf.drawer_first_page()

    # --- STEP 2: RE-ENABLE BRANDING FOR REMAINING PAGES ---
    pdf.set_auto_page_break(auto=True, margin=20)
    pdf.add_page()
    
    # --- 1. Product Title & Hero Image ---
    pdf.set_y(35)
    pdf.set_font(FONT_FAMILY, "B", 26)
    pdf.set_text_color(*COLORS["text_main"])
    pdf.cell(0, 15, "COAL CRUSHER 5 NO. SIZE", ln=True)
    pdf.set_font(FONT_FAMILY, "B", 14)
    pdf.set_text_color(120)
    pdf.cell(0, 8, "SINGLE DISC DISINTEGRATOR", ln=True)
    pdf.ln(5)

    y_hero = pdf.get_y()
    try:
        pdf.image("assets/img/slide/Coal-Crusher.png", 10, y_hero-10, 120)
    except:
        pdf.rect(10, y_hero, 110, 70)
        pdf.text(45, y_hero + 35, "[Product Image]")

    # Quick Summary Box (Right of image)
    pdf.set_xy(125, y_hero)
    pdf.set_fill_color(255, 255, 255)
    pdf.set_font(FONT_FAMILY, "B", 10)
    pdf.set_text_color(*COLORS["accent_red"])
    pdf.cell(0, 10, "KEY CAPABILITY:", ln=True)
    pdf.set_x(125)
    pdf.set_font(FONT_FAMILY, "", 10)
    pdf.set_text_color(*COLORS["text_main"])
    pdf.multi_cell(75, 6, "Engineered for precision and consistency, this Single Disc Crusher effectively pulverizes coal into fine granules below 2mm. Featuring a robust 12mm body and 6 Manganese Steel hammers, it is the ideal product for coke oven applications requiring uniform output.")

    # --- 2. The "Advantage" Layout (Havells Style) ---
    pdf.set_y(y_hero + 75)

    advantage_y = pdf.get_y()
    
# Left Column: Performance
    pdf.set_font(FONT_FAMILY, "B", 11)
    pdf.set_text_color(*COLORS["text_main"])
    pdf.set_xy(10, advantage_y)
    
    # CHANGE: Set Draw Color to Red BEFORE creating the cell with the border
    pdf.set_draw_color(194, 24, 7) 
    pdf.set_line_width(0.4) 
    
    # The 'B' (Bottom) border will now be drawn in Red
    pdf.cell(90, 10, "PERFORMANCE", ln=True, border='B')
    pdf.ln(2)
    
    perf_features = [
        "Crushing Capacity: 10 to 12 Tons / Hour",
        "80 - 120 HP Heavy-Duty Electrical Drive",
        "Input Feed Size up to 125mm",
        "Output Size < 2mm"
    ]
    pdf.add_bullet_list(perf_features, 10, advantage_y + 12)

    # Right Column: Convenience & Durability
    pdf.set_font(FONT_FAMILY, "B", 11)
    pdf.set_xy(110, advantage_y)

    # CHANGE: Explicitly set Red again (good practice) just in case it was changed elsewhere
    pdf.set_draw_color(194, 24, 7)
    
    pdf.cell(90, 10, "DURABILITY & DESIGN", ln=True, border='B')
    pdf.ln(2)
    
    conv_features = [
        "Manganese Steel Side & Top Liner Jaw Plates",
        "Double Row Spherical Bearings",
        "Single-Side Easy Feeding Mouth",
        "Extra-Wide Disc for Uniformity"
    ]
    pdf.add_bullet_list(conv_features, 110, advantage_y + 12)

    pdf.draw_gallery_grid()

    # --- 4. Call to Action (Safety Red) ---
    pdf.request_A_quotation()


    # --- New Page: Operational Process Flow ---
    pdf.add_page()
    
    # --- Operational Process Flow ---

    # Section Title
    pdf.set_y(40)
    pdf.set_font(FONT_FAMILY, "", 16)
    pdf.set_text_color(*COLORS["text_light"])
    pdf.cell(0, 10, "Operational Process Flow", align="C", ln=True)
    
    pdf.set_font(FONT_FAMILY, "B", 14)
    pdf.set_text_color(*COLORS["text_main"])
    pdf.cell(0, 8, "Visualizing the high-speed fine pulverization cycle.", align="C", ln=True)
    pdf.ln(5)

    # Main Layout: Image on Left (55%), Text on Right (45%)
    current_y = pdf.get_y()
    
    # 1. Main Machine Image Placeholder
    try:
        pdf.image("assets/img/product-images/coal-crusher-single-disc/process-diagram.jpg", 10, current_y, 105)
    except:
        pdf.set_fill_color(240, 240, 240)
        pdf.rect(10, current_y, 105, 120, 'F')
        pdf.set_xy(10, current_y + 55)
        pdf.set_font(FONT_FAMILY, "I", 10)
        pdf.cell(105, 10, "[Operational Diagram Image]", align="C")

    # 2. Right Side: Process Steps
    pdf.set_xy(120, current_y)
    pdf.set_font(FONT_FAMILY, "B", 12)
    pdf.set_text_color(*COLORS["text_main"])
    pdf.cell(0, 5, "Single Disc Pulverizing Cycle", ln=True)
    # pdf.ln(2)

    # Data from the Image
    steps = [
        ("1. Gravity Feed", "Raw coal lumps (up to 125mm) are delivered via the upper conveyor belt and drop directly into the crushing chamber via the top hopper."),
        ("2. High-Speed Impact", "Inside, the Single Disc rotates at high speed. The 6 Manganese Steel hammers impact the coal against the liner plates, shattering it instantly."),
        ("3. Fine Discharge (< 2mm)", "The pulverized coal is reduced to a fine powder (below 2mm) and discharged onto the lower conveyor belt, ready for the boiler.")
    ]

    for title, desc in steps:
        pdf.draw_process_step("", title, desc)
    # --- End : Operational Process Flow ---

    product_faqs = [
    {
        "q": "What is the output size?",
        "a": "The Single Disc Crusher is calibrated to produce a fine output size of below 2 mm."
    },
    {
        "q": "What is the motor capacity?",
        "a": "It requires an electrical motor between 80 H.P. to 120 H.P. depending on your required TPH (Tons Per Hour)."
    },
    {
        "q": "Are the hammers replaceable?",
        "a": "Yes, the 6 Manganese Steel hammers are designed for easy replacement via the side access door."
    },
    {
        "q": "What is the delivery time?",
        "a": "Standard models are often in stock. Custom configurations typically take 3-4 weeks for fabrication."
    },
    {
        "q": "What is the maintenance schedule?",
        "a": "Routine maintenance involves checking the liner plates and greasing the bearings. The hammers are easily replaceable when worn out."
    }
    ]

    # 2. Call the method
    # Adjust '220' to wherever you want this section to start on the page
    pdf.create_faq_section(product_faqs, y_start=pdf.get_y()+5)

    pdf.request_A_quotation()

    pdf.output("brochure/Manual_Tools_Co_Coal_Crusher_Single_Disc.pdf")

if __name__ == "__main__":
    generate_brochure()
from fpdf import FPDF
from fpdf.enums import XPos, YPos
import glob
import os

# --- Theme Configuration ---
FONT_FAMILY = "Helvetica"
COLORS = {
    "header_bg": (16, 24, 32),    
    "accent_red": (194, 24, 7),   # Safety Red
    "text_main": (33, 37, 41),
    "text_light": (100, 100, 100),
    "bg_light": (245, 245, 245),
    "footer_red": (178, 34, 34),
}

class MTCStyleBrochure(FPDF):
    def __init__(self):
        super().__init__()
        self.show_branding = True 

    def drawer_first_page(self):
        # 1. Preparation
        self.show_branding = False
        self.set_auto_page_break(False) 
        self.add_page()
        
        # 2. Background Image
        try:
            self.image("brochure/first_page.png", 0, 0, 210, 297)
        except:
            self.set_fill_color(33, 37, 41)
            self.rect(0, 0, 210, 297, 'F')

        # 3. Branding Elements (Logo & Badge)
        logo_w = 100 
        try:
            self.image("assets/img/MTC Logo.png", 15, 15, logo_w) 
        except:
            self.set_y(40)
            self.set_font(FONT_FAMILY, "B", 32)
            self.set_text_color(255, 255, 255)
            self.cell(0, 15, "MANUAL TOOLS CO.", align="C", ln=True)

        try:
            self.image("brochure/30yearss.png", 15, 275, 45) 
        except:
            self.set_fill_color(*COLORS["accent_red"])
            self.rect(140, 250, 60, 25, 'F')
            self.set_xy(140, 253)
            self.set_font(FONT_FAMILY, "B", 22)
            self.set_text_color(255, 255, 255)
            self.cell(60, 10, "30+ YEARS", align="C", ln=True)

        # 4. Office Info
        self.set_xy(110, 277)
        self.set_font(FONT_FAMILY, "B", 10)
        self.set_text_color(255, 255, 255)
        self.cell(90, 6, "Ravindra Kr. Agarwal, Prop.", align="R", ln=True)
        self.set_x(110)
        self.set_font(FONT_FAMILY, "", 9)
        self.set_text_color(200, 200, 200)
        self.cell(90, 6, "Dhanbad, Jharkhand | manualtoolsco.com", align="R")
        
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

            self.set_font(FONT_FAMILY, "B", 10)
            self.set_text_color(255, 255, 255)
            self.set_xy(105, 14) 
            self.cell(95, 5, "Ph: +91 9430707348", align="R")
            self.set_font(FONT_FAMILY, "", 9)
            self.set_xy(105, 19)
            self.cell(95, 5, "Dhanbad, Jharkhand | manualtoolsco.com", align="R")

    def footer(self):
        if self.page_no() == 1: return
        if getattr(self, 'show_branding', True):
            self.set_fill_color(*COLORS["header_bg"])
            self.rect(0, 283, 210, 16, 'F') 
            self.set_y(-11)
            self.set_font(FONT_FAMILY, "B", 8) 
            self.set_text_color(255, 255, 255)
            text = "OUR PRODUCTS : Coke Cutter, Coal Crusher, Haulages, Disintegrators, Conveyors, Bunkers, Elevator, Pusher Machine, Mixers, Power Winch."
            self.multi_cell(0, 4, text, align="C")

    def draw_section_header(self, title, y_pos):
        self.set_fill_color(*COLORS["bg_light"])
        self.rect(10, y_pos, 190, 10, 'F')
        self.set_xy(10, y_pos)
        self.set_font(FONT_FAMILY, "B", 12)
        self.set_text_color(*COLORS["accent_red"])
        self.cell(0, 10, title, ln=True)

    def draw_process_step(self, title, description):
        start_x = 120
        step_y = self.get_y()
        self.set_fill_color(255, 255, 255)
        self.rect(start_x, step_y, 80, 35, 'F') 
        
        self.set_font(FONT_FAMILY, "B", 11)
        self.set_text_color(*COLORS["accent_red"])
        self.set_xy(start_x + 2, step_y + 2)
        self.cell(0, 6, title, ln=True)
        
        self.set_font(FONT_FAMILY, "", 9)
        self.set_text_color(*COLORS["text_main"])
        self.set_x(start_x + 5)
        self.multi_cell(70, 5, description)

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
        "assets/img/product-images/coke-cutter/4.png",
        "assets/img/product-images/coke-cutter/5.jpg",
        "assets/img/product-images/coke-cutter/6.jpeg",
        # Add more paths as needed
        ]
        margin = 10
        gap = 15
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
        self.set_y(y_start)
        self.draw_section_header("COMMON QUESTIONS", y_start)
        for item in faq_data:
            if self.get_y() > 250:
                self.add_page()
                self.set_y(20)

            self.set_font(FONT_FAMILY, "B", 10)
            self.set_text_color(194, 24, 7) 
            self.cell(8, 6, "Q.", new_x=XPos.RIGHT, new_y=YPos.TOP)
            self.set_text_color(0, 0, 0)
            self.multi_cell(w=self.epw - 8, h=6, txt=item['q'], new_x=XPos.LMARGIN, new_y=YPos.NEXT)
            
            self.set_text_color(100, 100, 100)
            self.cell(8, 6, "A.", new_x=XPos.RIGHT, new_y=YPos.TOP)
            self.set_font(FONT_FAMILY, "", 10)
            self.set_text_color(50, 50, 50)
            self.multi_cell(w=self.epw - 8, h=6, txt=item['a'], new_x=XPos.LMARGIN, new_y=YPos.NEXT)
            self.ln(3)

def generate_brochure():
    pdf = MTCStyleBrochure()
    
    # --- PAGE 1: COVER ---
    pdf.drawer_first_page()

    # --- PAGE 2: PRODUCT SPECS ---
    pdf.set_auto_page_break(auto=True, margin=20)
    pdf.add_page()
    
    # 1. Product Title
    pdf.set_y(35)
    pdf.set_font(FONT_FAMILY, "B", 26)
    pdf.set_text_color(*COLORS["text_main"])
    pdf.cell(0, 15, "COKE CUTTER MACHINE", ln=True)
    pdf.set_font(FONT_FAMILY, "B", 14)
    pdf.set_text_color(120)
    pdf.cell(0, 8, "DOUBLE DRIVE INDUSTRIAL SERIES", ln=True)
    pdf.ln(5)

    y_hero = pdf.get_y()
    
    # 2. Main Image
    try:
        # Using the main HD image from HTML
        pdf.image("assets/img/product-images/coke-cutter/1.png", 30, y_hero-10, 60)
    except:
        pdf.rect(10, y_hero, 110, 70)
        pdf.text(45, y_hero + 35, "[Product Image Missing]")

    # 3. Summary Box
    pdf.set_xy(125, y_hero)
    pdf.set_fill_color(255, 255, 255)
    pdf.set_font(FONT_FAMILY, "B", 10)
    pdf.set_text_color(*COLORS["accent_red"])
    pdf.cell(0, 10, "KEY CAPABILITY:", ln=True)
    pdf.set_x(125)
    pdf.set_font(FONT_FAMILY, "", 10)
    pdf.set_text_color(*COLORS["text_main"])
    # Extracted from HTML description
    pdf.multi_cell(75, 6, "Built for maximum torque and power, this double-drive cutter features dual 20 HP motors and cast steel gears. Its adjustable drum system ensures uniform output sizing (45-60mm) while manganese steel liner teeth guarantee longevity.")

    # 4. Features Columns
    pdf.set_y(y_hero + 75)
    advantage_y = pdf.get_y()
    
    # Left: Performance
    pdf.set_font(FONT_FAMILY, "B", 11)
    pdf.set_text_color(*COLORS["text_main"])
    pdf.set_xy(10, advantage_y)
    pdf.set_draw_color(194, 24, 7) 
    pdf.set_line_width(0.4) 
    pdf.cell(90, 10, "PERFORMANCE", ln=True, border='B')
    pdf.ln(2)
    
    perf_features = [
        "Breaking Capacity: 12 to 15 Tons / Hour",
        "Dual Motors: 20 H.P. (x2) Double Drive",
        "Input Feed Size: Below 200 mm",
        "Finished Output: 45 - 60 mm"
    ]
    pdf.add_bullet_list(perf_features, 10, advantage_y + 12)

    # Right: Durability
    pdf.set_font(FONT_FAMILY, "B", 11)
    pdf.set_xy(110, advantage_y)
    pdf.set_draw_color(194, 24, 7)
    pdf.cell(90, 10, "DURABILITY & DESIGN", ln=True, border='B')
    pdf.ln(2)
    
    conv_features = [
        "Manganese Steel Liner Teeth (Replaceable)",
        "Cast Steel Gears (Both Sides)",
        "Adjustable Drum Distance (Up to 30mm)",
        "Double Drive System Prevents Jamming"
    ]
    pdf.add_bullet_list(conv_features, 110, advantage_y + 12)

    # 5. Gallery (Dynamic from folder)
    # Ensure this path matches where your images are stored locally
    pdf.draw_gallery_grid()

    # 6. Call to Action
    pdf.request_A_quotation()

    # --- PAGE 3: PROCESS & FAQ ---
    pdf.add_page()
    
    # 1. Process Header
    pdf.set_y(40)
    pdf.set_font(FONT_FAMILY, "", 16)
    pdf.set_text_color(*COLORS["text_light"])
    pdf.cell(0, 10, "Operational Process Flow", align="C", ln=True)
    pdf.set_font(FONT_FAMILY, "B", 14)
    pdf.set_text_color(*COLORS["text_main"])
    pdf.cell(0, 8, "Visualizing the Double Drive cutting cycle.", align="C", ln=True)
    pdf.ln(5)

    current_y = pdf.get_y()
    
    # 2. Process Diagram
    try:
        pdf.image("assets/img/product-images/coke-cutter/process-diagram.jpg", 10, current_y, 105)
    except:
        pdf.set_fill_color(240, 240, 240)
        pdf.rect(10, current_y, 105, 120, 'F')
        pdf.set_xy(10, current_y + 55)
        pdf.set_font(FONT_FAMILY, "I", 10)
        pdf.cell(105, 10, "[Process Diagram Missing]", align="C")

    # 3. Process Steps (Text)
    pdf.set_xy(120, current_y)
    pdf.set_font(FONT_FAMILY, "B", 12)
    pdf.set_text_color(*COLORS["text_main"])
    pdf.cell(0, 5, "Continuous Production Cycle", ln=True)

    # Steps extracted from HTML
    steps = [
        ("1. Material Feed", "Raw coal/coke lumps (up to 200mm) are delivered via the upper conveyor belt directly into the machine's intake hopper."),
        ("2. Double Drive Cutting", "The dual 20HP motors power the crushing drums, efficiently breaking down the material without jamming, ensuring high throughput."),
        ("3. Output (45-60mm)", "Uniformly sized coke product is discharged onto the lower conveyor belt for immediate transport.")
    ]

    for title, desc in steps:
        pdf.draw_process_step(title, desc)

    # 4. FAQs (Extracted from PHP array)
    coke_cutter_faqs = [
        {
            "q": "What is the advantage of the Double Drive system?",
            "a": "The Dual Drive system (20 HP motors on both sides) provides balanced torque and consistent power, preventing jamming and ensuring uniform cutting of hard coke lumps."
        },
        {
            "q": "Can I adjust the output size?",
            "a": "Yes, the machine features an Adjustable Drum Distance mechanism, allowing you to fine-tune the finished coke size between 45 mm and 60 mm."
        },
        {
            "q": "What is the maximum feed size it can handle?",
            "a": "This heavy-duty cutter accepts coke lumps up to 200 mm in size."
        },
        {
            "q": "How durable are the cutting teeth?",
            "a": "We use high-grade Manganese Steel Liner Teeth which are wear-resistant and fully replaceable."
        }
    ]

    pdf.create_faq_section(coke_cutter_faqs, y_start=pdf.get_y()+5)
    pdf.request_A_quotation()

    pdf.output("brochure/Manual_Tools_Co_Coke_Cutter_Double_Drive.pdf")

if __name__ == "__main__":
    generate_brochure()
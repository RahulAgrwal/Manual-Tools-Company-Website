<!-- ============================================ -->
<!-- MTC MODERN CLIENTS SECTION                   -->
<!-- ============================================ -->

<?php
// (Keep your existing arrays exactly as they are)
$domestic_clients = [
    ["image_path" => "assets/img/clients/domestic/Brahma Refactories.png", "image_name" => "Brahma Refactories"],
    ["image_path" => "assets/img/clients/domestic/JindalSawIPU.png", "image_name" => "Jindal Saw IPU"],
    ["image_path" => "assets/img/clients/domestic/Krishna Hydrocarbon.jpg", "image_name" => "Krishna Hydrocarbon"],
    ["image_path" => "assets/img/clients/domestic/narsingh_ispat_ltd_logo.jpeg", "image_name" => "Narsingh Ispat Ltd"],
    ["image_path" => "assets/img/clients/domestic/Nilanvhal Carbo Pvt. ltd.png", "image_name" => "Nilachal Carbo Metalicks Limited"],
    ["image_path" => "assets/img/clients/domestic/Ramco Cement.jpg", "image_name" => "Ramco Cement Limited"],
    ["image_path" => "assets/img/clients/domestic/Saurashtra Fuels Pvt. Ltd..jpg", "image_name" => "Saurashtra Fuels Pvt. Ltd."],
    ["image_path" => "assets/img/clients/domestic/SBQ Steel LTD.png", "image_name" => "SBQ Steel LTD"],
    ["image_path" => "assets/img/clients/domestic/Simplex Coke and Refacctory.png", "image_name" => "Simplex Coke & Refractory Pvt. Ltd."],
    ["image_path" => "assets/img/clients/domestic/Su Mangala Coke Pvt. Ltd..png", "image_name" => "Su Mangala Coke Pvt. Ltd."],
    ["image_path" => "assets/img/clients/domestic/Surya-Orange-Logo.jpg", "image_name" => "SURYA CEMENT UDYOG"],
    ["image_path" => "assets/img/clients/domestic/Tata Metaliks.png", "image_name" => "Tata Metaliks"],
    ["image_path" => "assets/img/clients/domestic/Akash Coke.webp", "image_name" => "Akash Coke Industries Pvt. Ltd."],
    ["image_path" => "assets/img/clients/domestic/Kalimati.png", "image_name" => "Kalimati Metalik (P) Ltd."],
    ["image_path" => "assets/img/clients/domestic/krishna-coke.jpg", "image_name" => "Krishna Coke (INDIA) Pvt. Ltd."],
    ["image_path" => "assets/img/clients/domestic/MFPL.webp", "image_name" => "Metalik Fuel Private Limited"],
    ["image_path" => "assets/img/clients/domestic/Vivan-overseas.png", "image_name" => "VIVAN Overseas"],
];

$international_clients = [
    ["image_path" => "assets/img/clients/international/milpa.jpg", "image_name" => "C.I. Milpa S.A."],
];
?>

<section id="clients" class="mtc-clients-section">
    <div class="container">
        
        <!-- DOMESTIC SECTION -->
        <div class="mb-5">
            <div class="section-title text-center mb-4">
                <h2 class="mtc-section-header">Domestic <span class="text-orange">Partners</span></h2>
                <p class="text-muted">Trusted by leading Coke Oven plants across India</p>
            </div>

            <div class="row g-3 justify-content-center">
                <?php foreach ($domestic_clients as $client) : ?>
                    <!-- Using col-6 (mobile) to col-lg-2 (desktop) for a dense, neat grid -->
                    <div class="col-lg-2 col-md-3 col-4">
                        <div class="mtc-client-card">
                            <img src="<?php echo $client['image_path']; ?>" 
                                 alt="<?php echo $client['image_name']; ?>" 
                                 title="<?php echo $client['image_name']; ?>" 
                                 loading="lazy" decoding="async">
                        </div>
                    </div>
                <?php endforeach; ?>
                                <!-- NEW: THE "AND MANY MORE" CARD -->
                <div class="col-lg-2 col-md-3 col-4">
                    <a href="contact" class="mtc-client-card mtc-more-card">
                        <div class="text-center">
                            <span class="plus-icon">+</span>
                            <span class="more-text">And Many<br>More...</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

<!-- INTERNATIONAL SECTION (Now matches Domestic Style) -->
<div class="mt-5">
    <div class="section-title text-center mb-4">
        <h2 class="mtc-section-header">Global <span class="text-orange">Reach</span></h2>
        <p class="text-muted">Exporting excellence beyond borders</p>
    </div>

    <!-- 1. Use the SAME grid classes: row g-3 justify-content-center -->
    <div class="row g-3 justify-content-center">
        <?php foreach ($international_clients as $client) : ?>
            
            <!-- 2. Use the SAME column sizes: col-lg-2 col-md-3 col-4 -->
            <div class="col-lg-2 col-md-3 col-4">
                
                <!-- 3. Use the standard .mtc-client-card (Remove 'international' class) -->
                <!-- 4. Remove the <p> name and globe icon to match domestic style -->
                <div class="mtc-client-card">
                    <img src="<?php echo $client['image_path']; ?>" 
                         alt="<?php echo $client['image_name']; ?>" 
                         title="<?php echo $client['image_name']; ?>" 
                         loading="lazy" decoding="async">
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>

    </div>
</section>
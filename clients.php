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
    ["image_path" => "assets/img/clients/domestic/Akash Coke.webp", "image_name" => "Akash Coke Industries Pvt. Ltd."],
    ["image_path" => "assets/img/clients/domestic/Kalimati.png", "image_name" => "Kalimati Metalik (P) Ltd."],
    ["image_path" => "assets/img/clients/domestic/krishna-coke.jpg", "image_name" => "Krishna Coke (INDIA) Pvt. Ltd."],
    ["image_path" => "assets/img/clients/domestic/MFPL.webp", "image_name" => "Metalik Fuel Private Limited"],
    ["image_path" => "assets/img/clients/domestic/Vivan-overseas.png", "image_name" => "VIVAN Overseas"],
    ["image_path" => "assets/img/clients/domestic/Shree-Satya-Group.png", "image_name" => "Shree Satya Group"],
    ["image_path" => "assets/img/clients/domestic/Mahalaxmi-Group.png", "image_name" => "Mahalaxmi Group"],
];

$international_clients = [
    ["image_path" => "assets/img/clients/international/milpa.jpg", "image_name" => "C.I. Milpa S.A."],
];
?>

<!-- One logo wall rather than two: the single international client used to
     sit alone on its own row under a "Global Reach" heading. It now sits in
     the same wall, marked, so the proof reads as one body of work. -->
<section id="clients" class="section clients" aria-labelledby="clients-title">
  <div class="wrap">
    <div class="section-head section-head--center">
      <h2 id="clients-title">Our clients</h2>
      <p>Trusted by leading coke oven plants across India, and exporting beyond its borders.</p>
    </div>

    <ul class="clients__wall">
      <?php foreach ($domestic_clients as $client) : ?>
        <li class="clients__cell">
          <img src="<?php echo mtc_img($client['image_path']); ?>"
               <?php echo mtc_img_size(mtc_img($client['image_path'])); ?>
               alt="<?php echo htmlspecialchars($client['image_name']); ?>"
               title="<?php echo htmlspecialchars($client['image_name']); ?>"
               loading="lazy" decoding="async">
        </li>
      <?php endforeach; ?>
      <?php foreach ($international_clients as $client) : ?>
        <li class="clients__cell clients__cell--intl">
          <img src="<?php echo mtc_img($client['image_path']); ?>"
               <?php echo mtc_img_size(mtc_img($client['image_path'])); ?>
               alt="<?php echo htmlspecialchars($client['image_name']); ?>"
               title="<?php echo htmlspecialchars($client['image_name']); ?>"
               loading="lazy" decoding="async">
          <span class="clients__tag">International</span>
        </li>
      <?php endforeach; ?>
      <li class="clients__cell clients__cell--more">
        <a href="contact">And many more</a>
      </li>
    </ul>
  </div>
</section>

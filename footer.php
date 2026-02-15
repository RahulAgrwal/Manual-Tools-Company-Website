<?php
// Ensure counter exists to prevent errors
if(file_exists("webcounter.php")) {
    include_once "webcounter.php";
    $page_name = basename($_SERVER['PHP_SELF']);
    $access_number = visitor($page_name);
} else {
    $access_number = 1000; // Fallback
}
?>

<footer id="footer" class="mtc-modern-footer">
    
    <!-- Main Footer Content -->
    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">

                <!-- Col 1: Brand & Socials -->
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.php" class="logo d-flex align-items-center mb-3">
                        <img src="assets/img/MTC_Logo_Footer.png" alt="MTC Logo" class="img-fluid" style="max-height: 60px;">
                        <span class="ms-2 text-white fw-bold fs-4">MANUAL TOOLS CO.</span>
                    </a>
                    <p class="footer-desc">
                        Leading manufacturer of heavy-duty Coke Oven Machinery. Engineering excellence from Dhanbad to the world since 1995.
                    </p>
                    <div class="social-links mt-3">
                        <a href="https://www.facebook.com/profile.php?id=61560479668542" class="facebook" target="_blank"><i class="bx bxl-facebook"></i></a>
                        <a href="https://www.instagram.com/manual_tools_company/" class="instagram" target="_blank"><i class="bx bxl-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        <a href="https://maps.app.goo.gl/SR7U9r1J5fXyFfF7A" class="googlemap" target="_blank"><i class="bx bx-map"></i></a>
                    </div>
                </div>

                <!-- Col 2: Useful Links -->
                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="/">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="about">Company Profile</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="products">All Products</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="photo-gallery">Gallery</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="contact">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Col 3: Key Products -->
                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Key Machinery</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="coal-crusher">Coal Crusher</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="pusher-machine-with-stamping-arrangement">Pusher Machine</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="coal-charging-car">Charging Car</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="power-winch">Power Winch</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="vibrator-screen">Vibrator Screen</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact & Map -->
                <div class="col-lg-3 col-md-6 footer-contact">
                    <h4>Get In Touch</h4>
                    
                    <div class="contact-item">
                        <i class="bx bx-map"></i>
                        <span>Bastacolla, P.O. Dhansar,<br>Dhanbad - 828106, Jharkhand</span>
                    </div>
                    
                    <div class="contact-item">
                        <i class="bx bx-phone-call"></i>
                        <span>+91-9430707348</span>
                    </div>
                    
                    <div class="contact-item">
                        <i class="bx bx-envelope"></i>
                        <span>ravindrakumaragarwal@rocketmail.com</span>
                    </div>

                    <div class="mt-3">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14605.66029759085!2d86.4114906!3d23.7682293!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f6a356034dbf29%3A0x3fd82229c2edb25e!2sMANUAL%20TOOLS%20COMPANY!5e0!3m2!1sen!2sin!4v1715487885451!5m2!1sen!2sin" 
                            width="100%" height="120" style="border:0; border-radius: 6px; opacity: 0.8;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="container footer-bottom clearfix">
        <div class="copyright">
            &copy; <?php echo date("Y"); ?> <strong><span>Manual Tools Company</span></strong>. All Rights Reserved.
        </div>
        <div class="credits">
            Designed by <a href="https://github.com/RahulAgrwal" target="_blank">Rahul Agarwal</a>
            <span class="visitor-count ms-2">| &nbsp; <i class="fas fa-chart-line"></i> Visitors: <b><?php echo $access_number; ?></b></span>
        </div>
    </div>
</footer>

<!-- Google Tag -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-17669553737"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'AW-17669553737');
</script>
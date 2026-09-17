<?php
// Page key for the visitor counter (e.g. "about.php"). The count itself is
// fetched after page load from track-visit.php so it never slows rendering.
$page_name = basename($_SERVER['PHP_SELF']);
if (substr($page_name, -4) !== '.php') {
    $page_name .= '.php'; // local router reports extensionless names
}
?>

<footer id="footer" class="mtc-modern-footer">
    
    <!-- Main Footer Content -->
    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">

                <!-- Col 1: Brand & Socials -->
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="/" class="logo d-flex align-items-center mb-3">
                        <img src="assets/img/MTC_Logo_Footer.png" alt="Manual Tools Company logo" class="img-fluid" width="60" height="60" style="max-height: 60px; width: auto;" loading="lazy">
                        <span class="ms-2 text-white fw-bold fs-4">MANUAL TOOLS COMPANY</span>
                    </a>
                    <p class="footer-desc">
                        Leading manufacturer of heavy-duty Coke Oven Machinery. Engineering excellence from Dhanbad to the world since 1995.
                    </p>
                    <div class="social-links mt-3">
                        <a href="https://www.facebook.com/profile.php?id=61560479668542" class="facebook" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/manual_tools_company/" class="instagram" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://maps.app.goo.gl/SR7U9r1J5fXyFfF7A" class="googlemap" target="_blank" rel="noopener" aria-label="Google Maps location"><i class="fas fa-map-marker-alt"></i></a>
                    </div>
                </div>

                <!-- Col 2: Useful Links -->
                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><i class="fas fa-chevron-right"></i> <a href="/">Home</a></li>
                        <li><i class="fas fa-chevron-right"></i> <a href="about">Company Profile</a></li>
                        <li><i class="fas fa-chevron-right"></i> <a href="products">All Products</a></li>
                        <li><i class="fas fa-chevron-right"></i> <a href="photo-gallery">Gallery</a></li>
                        <li><i class="fas fa-chevron-right"></i> <a href="contact">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Col 3: Key Products -->
                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Key Machinery</h4>
                    <ul>
                        <li><i class="fas fa-chevron-right"></i> <a href="coal-crusher">Coal Crusher</a></li>
                        <li><i class="fas fa-chevron-right"></i> <a href="pusher-with-stamping-arrangement">Pusher Machine</a></li>
                        <li><i class="fas fa-chevron-right"></i> <a href="coal-charging-car">Charging Car</a></li>
                        <li><i class="fas fa-chevron-right"></i> <a href="power-winch">Power Winch</a></li>
                        <li><i class="fas fa-chevron-right"></i> <a href="vibrator-screen">Vibrator Screen</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact & Map -->
                <div class="col-lg-3 col-md-6 footer-contact">
                    <h4>Get In Touch</h4>
                    
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Bastacolla, P.O. Dhansar,<br>Dhanbad - 828106, Jharkhand</span>
                    </div>
                    
                    <div class="contact-item">
                        <i class="fas fa-phone-alt"></i>
                        <a href="tel:+919430707348">+91-9430707348</a>
                    </div>
                    
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>ravindrakumaragarwal@rocketmail.com</span>
                    </div>

                    <div class="mt-3">
                        <iframe title="Manual Tools Company location on Google Maps"
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
            <span class="visitor-count ms-2" id="visitor-count" data-page="<?php echo htmlspecialchars($page_name); ?>" hidden>| &nbsp; <i class="fas fa-chart-line"></i> Visitors: <b></b></span>
        </div>
    </div>
</footer>

<!-- Visitor counter: record the visit after load; stays hidden if unavailable -->
<script>
  (function () {
    var el = document.getElementById('visitor-count');
    if (!el || !window.fetch) return;
    window.addEventListener('load', function () {
      fetch('/track-visit', { method: 'POST', body: new URLSearchParams({ page: el.getAttribute('data-page') }) })
        .then(function (r) { return r.ok ? r.json() : null; })
        .then(function (d) {
          if (d && d.count) {
            el.querySelector('b').textContent = d.count;
            el.hidden = false;
          }
        })
        .catch(function () {});
    });
  })();
</script>

<?php
// Mobile call / quote bar. Product pages include sidebar-quote-form.php
// (which sets page_url) before the footer, so the quote button can jump
// to the on-page form; other pages link to the contact page.
$mtc_quote_href = isset($_GET['page_url']) ? '#quote-form' : 'contact';
?>
<div class="mtc-mobile-cta d-lg-none">
    <a href="tel:+919430707348" class="mtc-mobile-cta-call"><i class="fas fa-phone-alt"></i> Call Now</a>
    <a href="<?php echo $mtc_quote_href; ?>" class="mtc-mobile-cta-quote"><i class="fas fa-file-alt"></i> Request Quote</a>
</div>

<!-- Google tag (GA4 + Ads) is configured once in common-head.php. -->
<!-- jQuery: loaded here (not in <head>) so it doesn't block rendering. Pages load main.js after the footer. -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

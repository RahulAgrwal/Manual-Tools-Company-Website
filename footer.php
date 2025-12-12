<?php

include "webcounter.php";
$page_name = basename($_SERVER['PHP_SELF']);
$access_number = visitor($page_name);

?>

<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5 footer-contact">
                    <img src="assets/img/MTC_Logo_Footer.png" class="img-fluid rounded mb-3 align-self-center" width="20%" alt="Manual Tools Company" />
                    <p>
                    <h4>Manual Tools company</h4>Bastacolla, P.O. Dhansar,<br> Dhanbad - 828106<br /> Jharkhand, India <br /><br /> <strong>Phone:</strong> +91-9430707348<br />
                    <strong>Email:</strong> ravindrakumaragarwal@rocketmail.com<br />
                    </p>
                </div>

                <div class="col-lg-3 col-md-2 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="/">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="about">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="products">Products</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="photo-gallery">Photo Gallery</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="contact">Contact us</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-2 footer-links">
                    <h4>Our Products</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="coal-crusher">Coal Crusher 5 No. Size</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="coke-cutter-double-drive">Coke Cutter Machine</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="haulage">Haulage</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="power-winch">Door Lifting Power Winch</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="vibrator-screen">Vibrator Screen Machine</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="coal-charging-car">Coal Charging Car</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-2 footer-links">
                    <h4>Location</h4>
                    <iframe class="d-block mx-auto" style="border:0; width: 100%; height: 95%;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14605.66029759085!2d86.4114906!3d23.7682293!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f6a356034dbf29%3A0x3fd82229c2edb25e!2sMANUAL%20TOOLS%20COMPANY!5e0!3m2!1sen!2sin!4v1715487885451!5m2!1sen!2sin" frameborder="0" allowfullscreen loading="lazy"></iframe>
                
                    </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                &copy; Copyright <strong><span>Manual Tools Company</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="https://github.com/RahulAgrwal">Rahul Agarwal</a>

                <?php
                echo " , Visitor Number : <span>" . $access_number . "</span>";
                ?>

            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="https://maps.app.goo.gl/SR7U9r1J5fXyFfF7A" class="googlemap"><i class="fas fa-location-arrow"></i></a>
            <a href="https://www.facebook.com/profile.php?id=61560479668542" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="https://www.instagram.com/manual_tools_company/" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="https://www.youtube.com/channel/UCy7gmLKz8GxMEOprcQ8SkMA" class="linkedin"><i class="bx bxl-youtube"></i></a>
        </div>
    </div>
</footer>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-17669553737">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-17669553737');
</script>
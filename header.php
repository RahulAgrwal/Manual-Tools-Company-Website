<?php
$page = basename($_SERVER['PHP_SELF']);
?>


<section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:manualtoolsco.dhn@gmail.com">manualtoolsco.dhn@gmail.com</a></i>
            <i class="bi bi-phone d-flex align-items-center ms-4"><a href="tel:9430707348">9430707348</a></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
            <a href="https://maps.app.goo.gl/SR7U9r1J5fXyFfF7A" class="Location"><i class="fas fa-location-arrow"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
        </div>
    </div>
</section>
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex justify-content-between">

        <div class="logo">
            <a href="index.php"><img src="assets/img/MTC Logo.png" alt="Manual Tools Company Logo" class="img-fluid"></a>
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="<?php if ($page == 'index.php') {
                                    echo ' active"';
                                } ?>" href="index.php">Home</a></li>
                <li><a class="<?php if ($page == 'about.php') {
                                    echo ' active"';
                                } ?>" href="about.php">About</a></li>
                <li class="dropdown"><a href="products.php"><span>Products</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li class="dropdown"><a href="coal-crusher.php"><span>Coal Crusher 5 No. Size</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="coal-crusher-5-No-single-disc.php">Single Disc</a></li>
                                <li><a href="coal-crusher-5-No-double-disc.php">Double Disc</a></li>
                                <li><a href="#">Triple Disc</a></li>
                            </ul>
                        </li>
                        <li><a href="coke-cutter-double-drive.php">Coke Cutter</a></li>
                        <li><a href="haulage.php">Haulage Machine</a></li>
                        <li><a href="power-winch.php">Power Winch</a></li>
                        <li><a href="vibrator-screen.php">Vibrator Screen</a></li>
                        <li><a href="conveyor-materials.php">Conveyor Materials</a></li>
                        <li><a href="#">Coal Charging Car</a></li>
                        <li><a href="#">Pusher Machine</a></li>
                        <li><a href="#">Quenching Coke Car</a></li>
                    </ul>
                </li>
                <li><a class="<?php if ($page == 'photo-gallery.php') {
                                    echo ' active"';
                                } ?>" href="photo-gallery.php">Photo Gallery</a></li>

                <li><a class="<?php if ($page == 'contact.php') {
                                    echo ' active"';
                                } ?>" href="contact.php">Contact</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
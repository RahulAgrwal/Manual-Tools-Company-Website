<?php
$page = basename($_SERVER['PHP_SELF'], '.php');
?>

<!-- ==============================================
     TOP BAR
     ============================================== -->
<section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope"></i>
            <a href="mailto:manualtoolsco.dhn@gmail.com">manualtoolsco.dhn@gmail.com</a>
            
            <i class="bi bi-phone ms-4"></i>
            <a href="tel:9430707348">+91 9430707348</a>
        </div>
        
        <div class="social-links d-none d-md-flex align-items-center">
            <a href="https://maps.app.goo.gl/SR7U9r1J5fXyFfF7A" target="_blank" title="Location"><i class="fas fa-location-arrow"></i></a>
            <a href="https://www.facebook.com/profile.php?id=61560479668542" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/manual_tools_company/" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="youtube"><i class="bi bi-youtube"></i></a>
        </div>
    </div>
</section>

<!-- ==============================================
     MAIN HEADER
     ============================================== -->
<header id="header" class="d-flex align-items-center">
    <div class="container mtc-header-container">

        <!-- LOGO -->
        <div class="logo">
            <a href="/">
                <img src="assets/img/MTC Logo.png" alt="Manual Tools Company - Coke Oven Machinery" class="img-fluid">
            </a>
        </div>

        <!-- NAVIGATION -->
        <nav id="navbar" class="navbar">
            <ul>
                <!-- Home -->
                <li>
                    <a class="nav-link <?php echo ($page == 'index' || $page == '') ? 'active' : ''; ?>" href="/">Home</a>
                </li>

                <!-- About -->
                <li>
                    <a class="nav-link <?php echo ($page == 'about') ? 'active' : ''; ?>" href="about">About</a>
                </li>

                <!-- Products Dropdown -->
                <li class="dropdown">
                    <a href="products" class="<?php echo ($page == 'products') ? 'active' : ''; ?>">
                        <span>Products</span> <i class="bi bi-chevron-down dropdown-indicator "></i>
                    </a>
                    <ul>
                        <li><a href="coal-crusher-5-No-single-disc">Coal Crusher (5 No.) Single Disc</a></li>
                        <li><a href="coal-crusher-5-No-double-disc">Coal Crusher (5 No.) Double Disc</a></li>
                        <li><a href="coke-cutter-double-drive">Coke Cutter Machine</a></li>
                        <li><a href="haulage">Haulage Machine</a></li>
                        <li><a href="power-winch">Door Lifting Power Winch</a></li>
                        <li><a href="vibrator-screen">Vibrator Screen Machine</a></li>
                        <li><a href="conveyor-materials">Conveyor Materials</a></li>
                        <li><a href="coal-charging-car">Coal Charging Car</a></li>
                        <li><a href="pusher-with-stamping-arrangement">Pusher Machine</a></li>
                        <li><a href="#">Quenching Coke Car</a></li>
                    </ul>
                </li>

                <!-- Photo Gallery -->
                <li>
                    <a class="nav-link <?php echo ($page == 'photo-gallery') ? 'active' : ''; ?>" href="photo-gallery">Photo Gallery</a>
                </li>

                <!-- Contact (Styled as CTA) -->
                <li>
                    <a class="nav-link <?php echo ($page == 'contact') ? 'active' : ''; ?>" href="contact">Contact Us</a>
                </li>
            </ul>
            
            <!-- Mobile Toggle -->
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>

    </div>
</header>
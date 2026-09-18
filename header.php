<?php
$page = basename($_SERVER['PHP_SELF'], '.php');
$logo = mtc_img('assets/img/MTC Logo.png');
?>

<!-- ==============================================
     UTILITY BAR
     ============================================== -->
<section id="topbar">
    <div class="wrap">
        <div class="contact-info">
            <a href="mailto:manualtoolsco.dhn@gmail.com"><i class="fas fa-envelope"></i>manualtoolsco.dhn@gmail.com</a>
            <a href="tel:+919430707348"><i class="fas fa-mobile-alt"></i>+91 9430707348</a>
        </div>

        <div class="social-links">
            <a href="https://maps.app.goo.gl/SR7U9r1J5fXyFfF7A" target="_blank" rel="noopener" title="Location" aria-label="Google Maps location"><i class="fas fa-location-arrow"></i></a>
            <a href="https://www.facebook.com/profile.php?id=61560479668542" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/manual_tools_company/" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
</section>

<!-- ==============================================
     MAIN HEADER
     ============================================== -->
<header id="header">
    <div class="wrap mtc-header-container">

        <div class="logo">
            <a href="/">
                <img src="<?php echo $logo; ?>" <?php echo mtc_img_size($logo); ?> alt="Manual Tools Company - Coke Oven Machinery">
            </a>
        </div>

        <nav id="navbar" class="navbar" aria-label="Main">
            <ul>
                <li>
                    <a class="nav-link <?php echo ($page == 'index' || $page == '') ? 'active' : ''; ?>" href="/">Home</a>
                </li>

                <li>
                    <a class="nav-link <?php echo ($page == 'about') ? 'active' : ''; ?>" href="about">About</a>
                </li>

                <li class="dropdown">
                    <a href="products" class="<?php echo ($page == 'products') ? 'active' : ''; ?>">
                        <span>Products</span> <i class="fas fa-chevron-down dropdown-indicator"></i>
                    </a>
                    <ul>
                        <li><a href="coal-crusher-5-No-single-disc">Coal Crusher (5 No.) Single Disc</a></li>
                        <li><a href="coal-crusher-5-No-double-disc">Coal Crusher (5 No.) Double Disc</a></li>
                        <li><a href="coke-cutter-double-drive">Coke Cutter (Double Drive, Drum Type)</a></li>
                        <li><a href="coke-cutter-double-drive-ring-type">Coke Cutter (Ring Type)</a></li>
                        <li><a href="haulage">Coke Oven Haulage Machine</a></li>
                        <li><a href="power-winch">Door Lifting Power Winch</a></li>
                        <li><a href="vibrator-screen">Vibrator Screen Machine</a></li>
                        <li><a href="conveyor-materials">Conveyor Materials</a></li>
                        <li><a href="coal-charging-car">Coal Charging Car</a></li>
                        <li><a href="pusher-with-stamping-arrangement">Pusher Machine</a></li>
                        <!-- No page yet; see BACKLOG.md. Rendered as unavailable rather than
                             as a link that goes nowhere. -->
                        <li><a href="#" aria-disabled="true">Quenching Coke Car <span class="nav-soon">in progress</span></a></li>
                    </ul>
                </li>

                <li>
                    <a class="nav-link <?php echo ($page == 'photo-gallery') ? 'active' : ''; ?>" href="photo-gallery">Photo Gallery</a>
                </li>

                <li class="nav-cta">
                    <a class="btn btn--primary" href="contact">Request a quote</a>
                </li>
            </ul>

            <i class="fas fa-bars mobile-nav-toggle" role="button" tabindex="0" aria-label="Open menu" aria-expanded="false" aria-controls="navbar"></i>
        </nav>

    </div>
</header>

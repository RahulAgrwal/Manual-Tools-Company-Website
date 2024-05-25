<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Discover excellence with Manual Tools Company, a foremost manufacturer of Coke Oven Machinery in India. Explore our extensive selection of premium industrial equipment, including coal crushers, power winches, conveyor materials, and more. Elevate your operations with our high-quality machinery solutions.">
  <meta name="robots" content="index, follow">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="canonical" href="index.php">

  <title>Home - Manual Tools Company</title>
  <!-- <link rel="icon" type="image/png" href="assets/img/MTC_Logo_Footer.png"> -->
  <?php
  include('common-head.php');
  ?>
</head>


<body>
  <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
  <script>
    $(document).ready(function() {
      $('.counter').each(function() {
        var $this = $(this),
          countTo = $this.attr('data-target');

        $({
          countNum: $this.find('h3').text()
        }).animate({
            countNum: countTo
          },

          {
            duration: 2000,
            easing: 'linear',
            step: function() {
              $this.find('h3').text(Math.floor(this.countNum) + "+");
            },
            complete: function() {
              $this.find('h3').text(this.countNum + "+");
            }
          });
      });
    });
    window.cookieconsent.initialise({
      palette: {
        popup: {
          background: "#000",
        },
        button: {
          background: "#d7681b",
        },
      },
      content: {
        message: "This website uses cookies to ensure you get the best experience on our website.",
        dismiss: "Got it !",
        link: "Learn More",
      },
    });
  </script>

  <!-- ======= Top Bar ======= -->


  <!-- ======= Header ======= -->
  <?php
  include('header.php');
  ?>
  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <div class="carousel-inner" role="listbox">
        <!-- Slide 1 -->
        <div class="carousel-item active" style="
              background-image: url(assets/img/slide/Coal-Crusher.png);
              background-size: contain; 
    background-position: center;
/*               
              height: 100%; */
            ">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp text-center">
              <h2>Coal Crusher <span>(5 No. Size)</span></h2>
              <div class="text-center">
                <a href="coal-crusher-5-No-single-disc.php" class="btn-get-started">View Product</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide 1 -->
        <div class="carousel-item " style="
              background-image: url(assets/img/slide/Coal-Crusher-Double-disc.png);
              background-size: contain; 
    background-position: center;
              
              height: 100%;
            ">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp text-center">
              <h2>Double Disc Coal Crusher <span>(5 No. Size)</span></h2>
              <div class="text-center">
                <a href="coal-crusher-5-No-double-disc.php" class="btn-get-started">View Product</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide 1 -->
        <div class="carousel-item " style="
              background-image: url(assets/img/slide/Coke-Cutter-Machine.png);
              background-size: contain; 
    background-position: center;
              
              height: 100%;
            ">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp text-center">
              <h2>Coke Cutter Machine </h2>
              <div class="text-center">
                <a href="coke-cutter-double-drive.php" class="btn-get-started">View Product</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="
              background-image: url(assets/img/slide/Haulage-Machine.png);
              background-size: contain; 
    background-position: center;
              
              height: 100%;
            ">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp text-center">
              <h2>Haulage Machine</h2>
              <div class="text-center">
                <a href="haulage.php" class="btn-get-started">View Product</a>
              </div>
            </div>
          </div>
        </div>

        <div class="carousel-item" style="
              background-image: url(assets/img/slide/Power-Winch.png);
              background-size: contain; 
    background-position: center;
              
              height: 100%;
            ">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp text-center">
              <h2>Door Lifting Power Winch</h2>
              <div class="text-center">
                <a href="power-winch.php" class="btn-get-started">View Product</a>
              </div>
            </div>
          </div>
        </div>

        <div class="carousel-item" style="
              background-image: url(assets/img/slide/Vibrator-Screen.png);
              background-size: contain; 
    background-position: center;
              
              height: 100%;
            ">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp text-center">
              <h2>Vibrator Screen</h2>
              <div class="text-center">
                <a href="vibrator-screen.php" class="btn-get-started">View Product</a>
              </div>
            </div>
          </div>
        </div>


        <div class="carousel-item" style="
              background-image: url(assets/img/slide/Conveyor-Materials.png);
              background-size: contain; 
    background-position: center;
              
              height: 100%;
            ">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp text-center">
              <h2>Conveyor Materials</h2>
              <div class="text-center">
                <a href="conveyor-materials.php" class="btn-get-started">View Product</a>
              </div>
            </div>
          </div>
        </div>



        <!-- Slide 3 -->

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bx bx-left-arrow" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bx bx-right-arrow" aria-hidden="true"></span>
      </a>

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 text-lg-left">
            <h3>Welcome to <span>Manual Tools Company</span></h3>
            <div class="d ">
              <p>
                Established in 1995 in Dhanbad, Jharkhand, India, Manual Tools Company has been a distinguished manufacturer of Coke Oven Machineries for over 25 years. Our reputation for excellence extends globally, with our accessories for hard coke ovens being preferred by clients worldwide. We offer customizable solutions to meet specific requirements, ensuring user-friendly designs, impeccable finishes, precise performance, and exceptional stability. Choose Manual Tools Company for reliable, industry-leading solutions tailored to your needs.
              </p>
              <br>
              <div class="award-logo" style="display: flex; align-items: center;">
                <i class="fas fa-award fa-2x" style="color: red; margin-right: 10px;"></i> <span style="font-size: 18px;"> ISO 9001:2015 Certified</span>
              </div>
              <a class="cta-btn align-middle" href="about.php" style="border-radius: 20px;">More Details</a>
            </div>
          </div>
          <div class="col-lg-3 text-center">
            <div class="row ">
              <div class="col-6 p-4" style="color: blue;">
                <div class="counter" data-target="100">
                  <h3>0+</h3>
                  <p>Clients</p>
                </div>
              </div>
              <div class="col-6 p-4">
                <div class="counter" data-target="25" style="color: green;">
                  <h3>0+</h3>
                  <p>Years of Business</p>
                </div>
              </div>
              <div class="col-6 p-4">
                <div class="counter" data-target="500" style="color: red;">
                  <h3>0+</h3>
                  <p>Projects Completed</p>
                </div>
              </div>
              <div class="col-6 p-4">
                <div class="counter" data-target="15" style="color: orange;">
                  <h3>0+</h3>
                  <p>Trained Staff</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Cta Section -->


    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 text-lg-left">
            <h3>Our <span>Services</span></h3>
            <div class="d">
              <p>
                We manufacture products that are crafted under expert supervision and utilizing advanced technology. Our dedicated team rigorously tests the entire range in our quality checking wing to guarantee flawless perfection before dispatch. Furthermore, our commitment to ethical business practices and convenient payment options has facilitated us in serving numerous esteemed clients. Through our quality-driven approach and innovative technological methods, we have successfully expanded our client base significantly.
              </p>
              <ol class="list-group">
                <li class="list-group-item">
                  <i class="fas fa-pencil-alt me-2"></i> Design & Engineering
                </li>
                <li class="list-group-item">
                  <i class="fas fa-tools me-2"></i> Supervision on installation
                </li>
                <li class="list-group-item">
                  <i class="fas fa-cogs me-2"></i> Supervision on commissioning
                </li>
                <li class="list-group-item">
                  <i class="fas fa-play-circle me-2"></i> Operation
                </li>
                <li class="list-group-item">
                  <i class="fas fa-boxes me-2"></i> Inventory & Stocks
                </li>
              </ol>
            </div>
          </div>
          <div class="col-lg-6 text-center d-none d-lg-flex justify-content-center align-items-center" style="overflow: hidden;">
            <img src="assets\img\flames-fire-heat-3092318-1024x669.jpg" alt="Coke Flames" style="width: 80%; height: 80%;">
          </div>
        </div>
      </div>
    </section><!-- End Cta Section -->


    <!-- ======= Our Products Section ======= -->
    <section id="aboutus-team" class="aboutus-team section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Our <strong>Products</strong></h2>
        </div>

        <div class="row">

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="assets/img/about-us-products/Coal Crusher.jpg" class="img-fluid" alt="Coal Crusher">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Coal Crusher 5 No. Size</h4>
                <span>Single Disc</span>
                <a href="coal-crusher-5-No-single-disc.php" class="btn-get-started">View Product</a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="assets/img/about-us-products/Coal Crusher Double Disc.jpg" class="img-fluid" alt="Coal Crusher Double Disc">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Coal Crusher 5 No. Size</h4>
                <span>Double Disc</span>
                <a href="coal-crusher-5-No-double-disc.php" class="btn-get-started">View Product</a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="assets/img/about-us-products/Double Drive Coke Cutter Machine.jpg" class="img-fluid" alt="Double Drive Coke Cutter Machine">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Coke Cutter Machine</h4>
                <span>Double Drive</span>
                <a href="coke-cutter-double-drive.php" class="btn-get-started">View Product</a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="assets/img/about-us-products/Haulage Machine.jpg" class="img-fluid" alt="Haulage Machine">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Haulage Machine</h4>
                <span>Power Driven</span>
                <a href="haulage.php" class="btn-get-started">View Product</a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="assets/img/about-us-products/Power Winchh.jpg" class="img-fluid" alt="Power Winch">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Power Winch</h4>
                <span>Power Driven</span>
                <a href="power-winch.php" class="btn-get-started">View Product</a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="assets/img/about-us-products/Vibrator Screen Machine.jpg" class="img-fluid" alt="Vibrator Screen Machine">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Vibrator Screen Machine</h4>
                <span>Triple Deck</span>
                <a href="vibrator-screen.php" class="btn-get-started">View Product</a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="assets/img/about-us-products/Conveyor Material.jpeg" class="img-fluid" alt="Conveyor Materials">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Conveyor Material</h4>
                <span>Idler Roller, Head Pulley, Tail Pulley</span>
                <a href="conveyor-materials.php" class="btn-get-started">View Product</a>
              </div>
            </div>
          </div>
          <div class="btn-container"><a href="products.php" class="btn-get-started">View All Products</a></div>


        </div>

      </div>
    </section>

    <!-- End Our Our Products Section Section -->


    <!-- ======= Strength Section ======= -->
    <section id="strengths" class="strengths">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2><strong>Our Strengths</strong></h2>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up">
              <div class="icon"><i class="fas fa-award"></i></div>
              <h4 class="title"><a href="">Quality Material</a></h4>
              <p class="description">We offer top-notch materials of exceptional quality.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="fas fa-user-check"></i></div>
              <h4 class="title"><a href="">LICENSED & INSURED</a></h4>
              <p class="description">We are government-approved with all licenses available.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="fas fa-user"></i></div>
              <h4 class="title"><a href="">PROFESSIONAL WORKERS</a></h4>
              <p class="description">All our workers are highly experienced and well-trained.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="fas fa-handshake"></i></div>
              <h4 class="title"><a href="">EFFECTIVE TEAM WORK</a></h4>
              <p class="description">We may be strong as individuals but together we are invincible</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon"><i class="fas fa-phone-volume"></i></div>
              <h4 class="title"><a href="">QUICK RESPONSE</a></h4>
              <p class="description">At MTC, we prioritize being responsive and taking swift action.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="fas fa-certificate"></i></div>
              <h4 class="title"><a href="">1 Year Warranty</a></h4>
              <p class="description">We additionally provide a one-year warranty on all of our products.</p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Photo Gallery Section ======= -->
    <?php
    // Define the path to the product-images directory
    $productImagesPath = "assets/img/product-images/";

    // Function to get all folders from a directory
    function getAllFolders($path)
    {
      $folders = array();
      // Get all files and directories from the specified path
      $items = scandir($path);
      // Filter out only the directories
      foreach ($items as $item) {
        if (is_dir($path . $item) && $item != '.' && $item != '..') {
          $folders[] = $item;
        }
      }
      return $folders;
    }

    // Get all folders from the product-images directory
    $productFolders = getAllFolders($productImagesPath);
    ?>
    <section id="portfolio" class="portfolio">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2>Some of our <strong>Photo Gallery</strong></h2>
        </div>

        <div class="row" data-aos="fade-up">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <?php
              // Generate filter list
              foreach ($productFolders as $category) {
                echo '<li data-filter=".' . $category . '" class="filter-' . $category . '">' . ucwords(str_replace("-", " ", $category)) . '</li>';
              }
              ?>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up">
          <?php
          // Generate portfolio items for each category
          foreach ($productFolders as $category) {
            $folderPath = $productImagesPath . $category . '/';
            $images = scandir($folderPath);
            foreach ($images as $image) {
              if (!in_array($image, array('.', '..')) && pathinfo($image, PATHINFO_EXTENSION) == 'png') {
                echo '<div class="col-lg-4 col-md-6 portfolio-item ' . $category . '">';
                echo '<img src="' . $folderPath . $image . '" class="img-fluid" alt="' . $category . '">';
                echo '<div class="portfolio-info">';
                echo '<h4>' . $category . '</h4>';
                echo '<a href="' . $folderPath . $image . '" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" ><i class="fas fa-eye"></i></a>';
                echo '</div></div>';
              }
            }
          }
          ?>
        </div>
      </div>
    </section><!-- End Products Gallery Section -->

    <?php
    include("clients.php");
    ?>


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
  include("footer.php");
  ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
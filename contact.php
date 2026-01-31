<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Contact Manual Tools Company - Leading Coke Oven Machinery Manufacturer in India. Get quotes for Coke Cutters, Coal Crushers, and more.">
  <meta name="keywords" content="Contact Manual Tools, Manual Tools Company Dhanbad, Coke Oven Machinery Contact, Industrial Machinery Inquiry">
  <meta name="robots" content="index, follow">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Contact Us - Manual Tools Company</title>
  
  <?php include('common-head.php'); ?>


</head>

<body>

  <!-- ======= Header ======= -->
  <?php include('header.php'); ?>
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Contact Us</h2>
          <ol>
            <li><a href="/">Home</a></li>
            <li>Contact</li>
          </ol>
        </div>
      </div>
    </section>

    <!-- ======= Contact Info Grid ======= -->
    <section class="contact-section">
      <div class="container">
        
        <!-- Info Cards Row -->
        <div class="row mb-5">
          <!-- Address -->
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="contact-info-card w-100">
              <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
              <h4>Our Location</h4>
              <p>Bastacolla, P.O. Dhansar,<br>Dhanbad, Jharkhand - 828106</p>
            </div>
          </div>

          <!-- Contact Person -->
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="contact-info-card w-100">
              <div class="contact-icon"><i class="fas fa-user-tie"></i></div>
              <h4>Contact Person</h4>
              <p>Mr. Ravindra Kr. Agarwal</p>
              <p class="text-muted small">(Proprietor)</p>
            </div>
          </div>

          <!-- Phone -->
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="contact-info-card w-100">
              <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
              <h4>Call Us</h4>
              <p><a href="tel:9430707348">+91 94307 07348</a></p>
              <p><a href="tel:6204307367">+91 62043 07367</a></p>
            </div>
          </div>

          <!-- Email / Hours -->
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="contact-info-card w-100">
              <div class="contact-icon"><i class="fas fa-clock"></i></div>
              <h4>Hours & Email</h4>
              <p>Mon - Sat: 8:00 AM - 5:00 PM</p>
              <p><a href="mailto:ravindrakumaragarwal@rocketmail.com">ravindrakumaragarwal@rocketmail.com</a></p>
              <p><a href="mailto:manualtoolsco.dhn@gmail.com">manualtoolsco.dhn@gmail.com</a></p>
            </div>
          </div>
        </div>

        <!-- Form & Map Row -->
        <div class="row">
          
          <!-- Contact Form -->
          <div class="col-lg-6">
            <div class="form-wrapper">
              <div class="section-header-small">
                <h3>Get In Touch</h3>
                <p>Fill out the form below and we will get back to you shortly.</p>
              </div>

              <form id="mailsend" method="post" role="form" class="php-email-form">
                
                <!-- Feedback Messages -->
                <div class="loading">Sending...</div>
                <div class="error-msg"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>

                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name *" autocomplete="off">
                    <div class="validate"></div>
                  </div>
                  <div class="col-md-6 form-group">
                    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name *" autocomplete="off">
                    <div class="validate"></div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Company Name *" autocomplete="off">
                    <div class="validate"></div>
                  </div>
                  <div class="col-md-6 form-group">
                    <input type="text" class="form-control" name="company_gstin" id="company_gstin" placeholder="Company GSTIN" autocomplete="off">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" class="form-control" name="contact" id="contact" placeholder="Mobile Number *" autocomplete="off">
                    <div class="validate"></div>
                  </div>
                  <div class="col-md-6 form-group">
                    <input type="text" class="form-control" name="address" id="address" placeholder="Location/Address *" autocomplete="off">
                    <div class="validate"></div>
                  </div>
                </div>

                <div class="form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email *" autocomplete="off">
                  <div class="validate"></div>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject *" autocomplete="off">
                  <div class="validate"></div>
                </div>

                <div class="form-group">
                  <textarea class="form-control" id="message" name="message" rows="5" placeholder="Tell us about your requirements *" autocomplete="off"></textarea>
                  <div class="validate"></div>
                </div>

                <div class="text-center mt-3">
                  <button id="mailsubmit" class="btn-submit" type="submit">Send Message</button>
                </div>
              </form>
            </div>
          </div>

          <!-- Google Map -->
          <div class="col-lg-6">
<div class="faq-wrapper">
  <div class="section-header-small">
    <h3>Frequently Asked Questions</h3>
    <p>Quick answers about our machinery and services.</p>
  </div>

  <div class="accordion custom-accordion" id="faqAccordion">

    <?php
    // 1. Define your FAQ Data Array
    $faqs = [
        [
            "question" => "Can you customize machinery specs?",
            "answer" => "Yes, Manual Tools Company specializes in custom fabrication. We can modify motor power, dimensions, and capacity (TPH) based on your specific Coke Oven requirements and technical drawings."
        ],
        [
            "question" => "What is the typical delivery timeline?",
            "answer" => "Delivery timelines depend on the order volume and machine complexity. Standard spare parts are often in stock, while heavy machinery (like Coal Crushers, Coke Cutters) typically takes 4-8 weeks for manufacturing."
        ],
        [
            "question" => "Do you provide fitting and commissioning support?",
            "answer" => "Yes, based on the project scope, we offer on-site installation assistance and commissioning support to ensure your machinery operates optimally from day one."
        ],
        [
            "question" => "How do I request a formal quotation?",
            "answer" => "You can request a quote by filling out the form on the left, sending an email to <strong>ravindrakumaragarwal@rocketmail.com</strong>, or calling us directly at <strong>+91 94307 07348</strong>."
        ],
        [
            "question" => "Where is your workshop located?",
            "answer" => "Our manufacturing unit and workshop are located in Bastacolla, Dhansar, Dhanbad, Jharkhand. You are welcome to visit us for a physical inspection of our machinery."
        ],
        [
            "question" => "Do we provide delivery on Weekends?",
            "answer" => "Yes, we offer weekend delivery options for urgent orders."
        ]
    ];

    // 2. Iterate through the array
    foreach ($faqs as $index => $faq) {
        // Generate unique IDs based on the index (0, 1, 2...)
        $headingId = "heading" . $index;
        $collapseId = "collapse" . $index;

        // Logic to make the FIRST item open by default
        $isFirst = ($index === 0);
        $showClass = $isFirst ? "show" : "";           // Adds 'show' class to body
        $btnCollapsed = $isFirst ? "" : "collapsed";   // Adds 'collapsed' class to button
        $ariaExpanded = $isFirst ? "true" : "false";   // Accessibility attribute
    ?>

      <!-- Single FAQ Card -->
      <div class="card">
        <div class="card-header" id="<?php echo $headingId; ?>">
          <h5 class="mb-0">
            <button class="btn btn-link w-100 text-left <?php echo $btnCollapsed; ?>" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#<?php echo $collapseId; ?>" 
                    aria-expanded="<?php echo $ariaExpanded; ?>" 
                    aria-controls="<?php echo $collapseId; ?>">
              <?php echo $faq['question']; ?>
              <i class="fas fa-plus float-right"></i>
            </button>
          </h5>
        </div>

        <div id="<?php echo $collapseId; ?>" 
             class="accordion-collapse collapse <?php echo $showClass; ?>" 
             aria-labelledby="<?php echo $headingId; ?>" 
             data-bs-parent="#faqAccordion">
          <div class="card-body">
            <?php echo $faq['answer']; ?>
          </div>
        </div>
      </div>

    <?php 
    } // End foreach 
    ?>

  </div>
</div>
      </div>
    </div>

  </div>
</div>
          </div>

        </div>
      </div>
    </section>

  </main>

  <!-- ======= Footer ======= -->
  <?php include("footer.php"); ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  
  <!-- JavaScript (Kept from your original code) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#contact, #company_gstin, #email, #subject, #company_name').on('input', function() {
        validateInput(this);
      });

      $('#mailsend').submit(function(e) {
        e.preventDefault(); 

        const contactInput = document.getElementById("contact");
        const gstinInput = document.getElementById("company_gstin");
        const emailInput = document.getElementById("email");
        const subjectInput = document.getElementById("subject");
        const companyNameInput = document.getElementById("company_name");
        $('.error-msg').hide();
        $('.sent-message').hide();

        // Run validation
        let valid = true;
        if (!validateInput(emailInput)) valid = false;
        if (!validateInput(subjectInput)) valid = false;
        if (!validateInput(companyNameInput)) valid = false;
        
        if (!valid) return;

        var formData = new FormData(this);
        var ajaxUrl = './forms/contact.php'; // Default for Local (XAMPP/Apache)
        if (window.location.hostname !== 'localhost' && window.location.hostname !== '127.0.0.1') {
            ajaxUrl = './forms/contact';
        }

        $.ajax({
          type: 'POST',
          url: ajaxUrl, 
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function() {
            $('.loading').fadeIn(); 
          },
          success: function(response) {
            $('.loading').fadeOut(); 
            console.log("Response:", response);
            try {
                // Ensure response is parsed if it comes back as string
                if(typeof response === 'string') {
                    response = JSON.parse(response);
                }

                if (response.success) {
                  $('.sent-message').html(response.message).fadeIn(); 
                  $('#mailsend')[0].reset(); 
                  $('.error-msg').hide();
                  $('.form-control').removeClass('error-border');
                  if (typeof gtag === 'function') {
                      gtag('event', 'conversion', {
                          'send_to': 'AW-17669553737/4NI3CPisnNgbEMn8v-lB'
                      });
                      console.log("Conversion Triggered");
                    
                  } else {
                      console.log("Conversion logic skipped (Localhost or AdBlocker active)");
                  }
                } else {
                  $('.sent-message').hide();
                  $('.error-msg').html(response.message).fadeIn(); 
                }
            } catch(e) {
                console.error("JSON Parse Error", e);
                $('.error-msg').html("An unexpected error occurred.").fadeIn();
            }
          },
          error: function(xhr, status, error) {
            $('.loading').fadeOut();
            console.log("AJAX Error:", status, error);
            $('.error-msg').html("Server error. Please try again later.").fadeIn();
          }
        });
      });

      function validateInput(input) {
        const value = input.value.trim();
        const validateDiv = input.parentElement.querySelector(".validate");

        if (input.id === 'email' && !validateEmail(value)) {
          showError(input, "Please enter a valid email");
          return false;
        } else if (input.id === 'subject' && !validateSubject(value)) {
          showError(input, "Subject cannot be blank.");
          return false;
        } else if (input.id === 'company_name' && !validateCompanyName(value)) {
          showError(input, "Company name cannot be blank.");
          return false;
        } else {
          if(validateDiv) validateDiv.textContent = ""; 
          input.classList.remove("error-border"); 
          return true;
        }
      }

      function validateEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
      }

      function validateSubject(subject) {
        return subject !== "";
      }

      function validateCompanyName(companyName) {
        return companyName !== "";
      }

      function showError(input, message) {
        const validateDiv = input.parentElement.querySelector(".validate");
        if(validateDiv) validateDiv.textContent = message;
        input.classList.add("error-border");
      }
    });
  </script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
</html>
(function() {
    "use strict";

    /**
     * 1. HELPER FUNCTIONS
     */
    const select = (el, all = false) => {
        el = el.trim();
        if (all) {
            return [...document.querySelectorAll(el)];
        } else {
            return document.querySelector(el);
        }
    }

    const on = (type, el, listener, all = false) => {
        let selectEl = select(el, all);
        if (selectEl) {
            if (all) {
                selectEl.forEach(e => e.addEventListener(type, listener));
            } else {
                selectEl.addEventListener(type, listener);
            }
        }
    }

    const onscroll = (el, listener) => {
        el.addEventListener('scroll', listener);
    }

    /**
     * 2. SCROLLTO FUNCTION (Calculates Header Offset)
     */
    const scrollto = (el) => {
        let header = select('#header');
        let offset = header.offsetHeight;

        if (!header.classList.contains('header-scrolled')) {
            offset -= 16;
        }

        let elementPos = select(el).offsetTop;
        window.scrollTo({
            top: elementPos - offset,
            behavior: 'smooth'
        });
    }

    /**
     * 3. MOBILE NAV TOGGLE
     */
    on('click', '.mobile-nav-toggle', function(e) {
        let navbar = document.querySelector('#navbar');

        // 1. Toggle the Main Menu
        navbar.classList.toggle('navbar-mobile');
        this.classList.toggle('bi-list');
        this.classList.toggle('bi-x');
        document.body.classList.toggle('mobile-nav-active');

        // 2. CHECK STATE
        if (!navbar.classList.contains('navbar-mobile')) {
            // === CASE: MENU CLOSED ===
            // Find all items with active classes and remove them
            let activeDropdowns = navbar.querySelectorAll('.dropdown-active');
            let activeLinks = navbar.querySelectorAll('.dropdown > a.active');

            activeDropdowns.forEach(el => el.classList.remove('dropdown-active'));
            activeLinks.forEach(el => el.classList.remove('active'));

        }
    });

    /**
     * 4. MOBILE DROPDOWNS
     */
    on('click', '.navbar .dropdown > a', function(e) {
        if (select('#navbar').classList.contains('navbar-mobile')) {
            e.preventDefault(); // Stop link navigation
            this.nextElementSibling.classList.toggle('dropdown-active');

            // Rotate the arrow icon
            let icon = this.querySelector('i');
            if (icon) {
                icon.classList.toggle('bi-chevron-up');
                icon.classList.toggle('bi-chevron-down');
            }
        }
    }, true);

    /**
     * 5. PAGE LOAD & SCROLL EVENTS
     */
    window.addEventListener('load', () => {
        // Scroll to hash on load
        if (window.location.hash && select(window.location.hash)) {
            scrollto(window.location.hash);
        }

        // Fixed Header Logic
        let selectHeader = select('#header');
        if (selectHeader) {
            let headerOffset = selectHeader.offsetTop;
            let nextElement = selectHeader.nextElementSibling;

            const headerFixed = () => {
                if ((headerOffset - window.scrollY) <= 0) {
                    selectHeader.classList.add('fixed-top');
                    if (nextElement) nextElement.classList.add('scrolled-offset');
                } else {
                    selectHeader.classList.remove('fixed-top');
                    if (nextElement) nextElement.classList.remove('scrolled-offset');
                }
            }
            window.addEventListener('load', headerFixed);
            onscroll(document, headerFixed);
        }

        // Back to Top Button
        let backtotop = select('.back-to-top');
        if (backtotop) {
            const toggleBacktotop = () => {
                if (window.scrollY > 100) {
                    backtotop.classList.add('active');
                } else {
                    backtotop.classList.remove('active');
                }
            }
            window.addEventListener('load', toggleBacktotop);
            onscroll(document, toggleBacktotop);
        }
    });


    /**
     * 6. PHOTO GALLERY (Isotope filters and GLightbox, photo-gallery.php only)
     */
    document.addEventListener('DOMContentLoaded', () => {

        // Portfolio Isotope
        let portfolioContainer = select('.portfolio-container');
        if (portfolioContainer && typeof Isotope !== 'undefined') {
            let portfolioIsotope = new Isotope(portfolioContainer, {
                itemSelector: '.portfolio-item',
                layoutMode: 'fitRows'
            });

            let portfolioFilters = select('#portfolio-flters li', true);
            on('click', '#portfolio-flters li', function(e) {
                e.preventDefault();
                portfolioFilters.forEach(el => el.classList.remove('filter-active'));
                this.classList.add('filter-active');
                portfolioIsotope.arrange({
                    filter: this.getAttribute('data-filter')
                });
            }, true);
        }

        // Portfolio Lightbox
        if (typeof GLightbox !== 'undefined') {
            const portfolioLightbox = GLightbox({
                selector: '.portfolio-lightbox'
            });
        }

    });

})();

$(document).ready(function() {

    function loadRecaptchaV3(siteKey) {
        if (typeof grecaptcha !== 'undefined') {
            return Promise.resolve();
        }

        if (window.__mtcRecaptchaLoader) {
            return window.__mtcRecaptchaLoader;
        }

        window.__mtcRecaptchaLoader = new Promise(function(resolve, reject) {
            var script = document.createElement('script');
            script.src = 'https://www.google.com/recaptcha/api.js?render=' + encodeURIComponent(siteKey);
            script.async = true;
            script.defer = true;
            script.onload = function() { resolve(); };
            script.onerror = function() { reject(new Error('Unable to load reCAPTCHA.')); };
            document.head.appendChild(script);
        });

        return window.__mtcRecaptchaLoader;
    }

  // Target any form with the class 'ajax-form'
  $('.ajax-form').submit(function(e) {
    e.preventDefault(); 

    // Find the specific form being submitted
    var $form = $(this);
    
    // Dynamically get the URL from the form's 'action' attribute
    var actionUrl = $form.attr('action'); 
    
    // Optional: Your existing localhost logic adapted dynamically
    if (window.location.hostname !== 'localhost' && window.location.hostname !== '127.0.0.1') {
        actionUrl = actionUrl.replace('.php', ''); // strips .php on production if needed
    }

    // Find message containers ONLY inside this specific form
    var $loading = $form.find('.loading');
    var $errorMsg = $form.find('.error-msg');
    var $sentMsg = $form.find('.sent-message');

    $errorMsg.hide();
    $sentMsg.hide();

    // Generic Validation: Check all fields with the 'required' attribute
    let valid = true;
    $form.find('[required]').each(function() {
      if ($(this).val().trim() === '') {
        valid = false;
        $(this).addClass('error-border');
      } else {
        $(this).removeClass('error-border');
      }
    });

    // Email specific validation (if an email field exists in this form)
    var $emailField = $form.find('input[type="email"], input[name="email"]');
    if ($emailField.length > 0) {
      const emailVal = $emailField.val().trim();
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (emailVal !== '' && !emailRegex.test(emailVal)) {
        valid = false;
        $emailField.addClass('error-border');
        $errorMsg.html("Please enter a valid email address.").fadeIn();
      }
    }

    // Stop if validation fails
    if (!valid) {
      if ($errorMsg.is(':hidden')) {
        $errorMsg.html("Please fill out all required fields correctly.").fadeIn();
      }
      return;
    }

        // Prepare data and send AJAX
        var formData = new FormData(this);
        var recaptchaSiteKey = ($form.attr('data-recaptcha-site-key') || '').trim();
        var recaptchaAction = ($form.attr('data-recaptcha-action') || 'form_submit').trim();
        console.log("Form Data:", formData);

        var sendAjax = function() {
            $.ajax({
                type: 'POST',
                url: actionUrl, 
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $loading.fadeIn(); 
                },
                success: function(response) {
                    $loading.fadeOut(); 
                    console.log("Response:", response);
                    try {
                        if(typeof response === 'string') {
                                response = JSON.parse(response);
                        }

                        if (response.success) {
                            $sentMsg.html(response.message || "Message sent!").fadeIn(); 
                            $form[0].reset(); 
                            $form.find('.error-border').removeClass('error-border');
              
                            // Track GA4 Event & Google Ads Conversion
                            if (typeof gtag === 'function') {
                                    // Track to GA4 with event parameters
                                    gtag('event', 'generate_lead', {
                                            'form_name': $form.attr('id') || 'contact_form',
                                            'form_action': $form.attr('action'),
                                            'timestamp': new Date().toISOString()
                                    });
                  
                                    // Track Google Ads Conversion
                                    gtag('event', 'conversion', {
                                            'send_to': 'AW-17669553737/4NI3CPisnNgbEMn8v-lB',
                                            'value': 1.0,
                                            'currency': 'INR'
                                    });
                  
                                    console.log("GA4 Event & Conversion Tracked");
                            }
                        } else {
                            $errorMsg.html(response.message || "Something went wrong.").fadeIn(); 
                        }
                    } catch(e) {
                        console.error("JSON Parse Error", e);
                        $errorMsg.html("An unexpected error occurred.").fadeIn();
                    }
                },
                error: function(xhr, status, error) {
                    $loading.fadeOut();
                    console.log("AJAX Error:", status, error);
                    $errorMsg.html("Server error. Please try again later.").fadeIn();
                }
            });
        };

        if (recaptchaSiteKey !== '') {
            loadRecaptchaV3(recaptchaSiteKey)
                .then(function() {
                    if (typeof grecaptcha === 'undefined') {
                        throw new Error('reCAPTCHA failed to initialize.');
                    }

                    return new Promise(function(resolve, reject) {
                        grecaptcha.ready(function() {
                            grecaptcha.execute(recaptchaSiteKey, { action: recaptchaAction })
                                .then(resolve)
                                .catch(reject);
                        });
                    });
                })
                .then(function(token) {
                    if (!token) {
                        throw new Error('reCAPTCHA token was not generated.');
                    }

                    formData.set('g-recaptcha-response', token);
                    formData.set('recaptcha_action', recaptchaAction);
                    sendAjax();
                })
                .catch(function(error) {
                    $errorMsg.html(error.message || 'Security verification failed. Please retry.').fadeIn();
                });

            return;
        }

        sendAjax();
  });

  // Real-time input validation cleanup
  $('.ajax-form input, .ajax-form textarea').on('input', function() {
    $(this).removeClass('error-border');
    $(this).closest('form').find('.error-msg').fadeOut();
  });

});
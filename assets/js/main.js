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
        select('#navbar').classList.toggle('navbar-mobile');
        // Toggle the icon between List (Hamburger) and X (Close)
        this.classList.toggle('bi-list');
        this.classList.toggle('bi-x');
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
     * 5. SCROLLTO LINKS (Clicking nav links)
     */
    on('click', '.scrollto', function(e) {
        if (select(this.hash)) {
            e.preventDefault();

            let navbar = select('#navbar');
            if (navbar.classList.contains('navbar-mobile')) {
                // Close mobile menu
                navbar.classList.remove('navbar-mobile');
                let navbarToggle = select('.mobile-nav-toggle');
                navbarToggle.classList.toggle('bi-list');
                navbarToggle.classList.toggle('bi-x');
            }
            // Use the custom scrollto function defined above
            scrollto(this.hash);
        }
    }, true);

    /**
     * 6. PAGE LOAD & SCROLL EVENTS
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
     * 7. COMPONENT INITIALIZATION (Carousel, Isotope, etc.)
     */
    document.addEventListener('DOMContentLoaded', () => {

        // Hero Carousel Indicators
        let heroCarouselIndicators = select("#hero-carousel-indicators");
        let heroCarouselItems = select('#heroCarousel .carousel-item', true);

        if (heroCarouselIndicators && heroCarouselItems.length > 0) {
            heroCarouselItems.forEach((item, index) => {
                heroCarouselIndicators.innerHTML += `<li data-bs-target='#heroCarousel' data-bs-slide-to='${index}' ${index === 0 ? "class='active'" : ""}></li>`;
            });
        }

        // Carousel & Image Lazy Loading
        // Merged logic for cleaner execution
        const allLazyItems = document.querySelectorAll('.carousel-item[data-lqip], img[data-full-src]');

        allLazyItems.forEach(item => {
            // Logic for Carousel Backgrounds
            if (item.classList.contains('carousel-item')) {
                const lqipPath = item.getAttribute('data-lqip');
                const fullImagePath = item.getAttribute('data-full-image');
                item.style.backgroundColor = '#f5f5f5';

                if (lqipPath) item.style.backgroundImage = `url(${lqipPath})`;

                if (fullImagePath) {
                    const fullImage = new Image();
                    fullImage.src = fullImagePath;
                    fullImage.onload = () => {
                        item.style.backgroundImage = `url(${fullImagePath})`;
                    };
                }
            }
            // Logic for Standard Images
            else if (item.tagName === 'IMG') {
                const fullSrc = item.getAttribute('data-full-src');
                const loader = new Image();
                loader.src = fullSrc;
                loader.onload = () => {
                    item.src = fullSrc;
                    item.classList.add('lazy-loaded');
                    item.removeAttribute('data-full-src');
                };
            }
        });

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

        // Portfolio Details Slider (Swiper)
        if (select('.portfolio-details-slider') && typeof Swiper !== 'undefined') {
            new Swiper('.portfolio-details-slider', {
                speed: 400,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false
                },
                pagination: {
                    el: '.swiper-pagination',
                    type: 'bullets',
                    clickable: true
                }
            });
        }

        // Number Counters (Intersection Observer)
        const counters = document.querySelectorAll('.counter h3');
        if (counters.length > 0) {
            const speed = 200;
            const animateCounter = (counterElement) => {
                const target = +counterElement.closest('.counter').getAttribute('data-target');
                let current = 0;
                const updateCount = () => {
                    const increment = target / speed;
                    if (current < target) {
                        current += increment;
                        counterElement.innerText = Math.ceil(current) + "+";
                        setTimeout(updateCount, 1);
                    } else {
                        counterElement.innerText = target + "+";
                    }
                };
                updateCount();
            };

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counterElementH3 = entry.target.querySelector('h3');
                        if (counterElementH3 && !counterElementH3.classList.contains('animated')) {
                            animateCounter(counterElementH3);
                            counterElementH3.classList.add('animated');
                            observer.unobserve(entry.target);
                        }
                    }
                });
            }, {
                threshold: 0.5
            });

            document.querySelectorAll('.counter').forEach(counterDiv => {
                observer.observe(counterDiv);
            });
        }

    });

})();
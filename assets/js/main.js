document.addEventListener('DOMContentLoaded', () => {

    /* --- Header Scroll Logic --- */
    const header = document.querySelector('.site-header');

    function checkScroll() {
        if (window.scrollY > 80) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }

    // Initial check on load
    checkScroll();

    // Listen to scroll events
    window.addEventListener('scroll', checkScroll);


    /* --- Mobile Menu Toggle --- */
    const menuToggle = document.getElementById('menuToggle');
    const mainNav = document.getElementById('mainNav');
    const navOverlay = document.getElementById('navOverlay');

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', () => {
            const isOpen = mainNav.classList.contains('open');
            mainNav.classList.toggle('open');
            menuToggle.classList.toggle('active');
            if (navOverlay) navOverlay.classList.toggle('active');
            document.body.style.overflow = isOpen ? '' : 'hidden';
        });

        // Close nav when clicking overlay
        if (navOverlay) {
            navOverlay.addEventListener('click', () => {
                mainNav.classList.remove('open');
                menuToggle.classList.remove('active');
                navOverlay.classList.remove('active');
                document.body.style.overflow = '';
            });
        }

        // Close nav when clicking a link
        mainNav.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mainNav.classList.remove('open');
                menuToggle.classList.remove('active');
                if (navOverlay) navOverlay.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
    }


    /* --- Slider Logic --- */
    const slides = document.querySelectorAll('.slide');
    const segments = document.querySelectorAll('.progress-segment');
    const prevBtn = document.querySelector('.slider-prev');
    const nextBtn = document.querySelector('.slider-next');

    let currentIndex = 0;
    const duration = 5000;
    let slideTimer;

    if (slides.length === 0) return;

    function goToSlide(index) {
        if (index === currentIndex) return;

        const currentSlide = slides[currentIndex];
        const nextSlide = slides[index];

        // Reset classes for all slides to prevent lingering animations except the current and next
        slides.forEach(s => {
            if (s !== currentSlide && s !== nextSlide) {
                s.classList.remove('active', 'anim-in', 'anim-out');
            }
        });

        // Current slide animates out
        currentSlide.classList.remove('anim-in', 'active');
        currentSlide.classList.add('anim-out');

        // Next slide animates in
        // Removing and re-adding active ensures the CSS entrance animations trigger again
        nextSlide.classList.remove('anim-out');

        // Use a tiny timeout to ensure browser paints the frame before adding active back if it was just removed,
        // though because it wasn't active, adding it immediately works perfectly.
        nextSlide.classList.add('active', 'anim-in');

        // Update Progress bars
        segments.forEach((seg, i) => {
            seg.classList.remove('active', 'filled');
            if (i < index) {
                seg.classList.add('filled');
            } else if (i === index) {
                seg.classList.add('active');
            }
        });

        // Restart logic for the case when wrapping from last to first
        if (index === 0) {
            segments.forEach(seg => {
                seg.classList.remove('active', 'filled');
            });
            segments[0].classList.add('active');
        }

        currentIndex = index;

        // Restart timer
        clearTimeout(slideTimer);
        slideTimer = setTimeout(nextSlideFn, duration);
    }

    function nextSlideFn() {
        let nextIndex = (currentIndex + 1) % slides.length;
        goToSlide(nextIndex);
    }

    function prevSlideFn() {
        let prevIndex = (currentIndex - 1 + slides.length) % slides.length;
        goToSlide(prevIndex);
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            nextSlideFn();
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            prevSlideFn();
        });
    }

    // Initialize first slide progress
    segments[0].classList.add('active');
    slides[0].classList.add('active');

    // Start initial timer
    slideTimer = setTimeout(nextSlideFn, duration);


    /* --- Category Gallery Tabs --- */
    const catTabs = document.querySelectorAll('.cat-tab');
    const catPanels = document.querySelectorAll('.cat-panel');
    let activeCatSwiper = null;

    function initCatSwiper(panel) {
        const swiperEl = panel.querySelector('.cat-swiper');
        if (!swiperEl) return null;

        return new Swiper(swiperEl, {
            slidesPerView: 1.2,
            spaceBetween: 20,
            freeMode: true,
            grabCursor: true,
            pagination: {
                el: swiperEl.querySelector('.swiper-pagination'),
                clickable: true,
            },
            breakpoints: {
                768: { slidesPerView: 2.5 },
                1024: { slidesPerView: 3.5 }
            }
        });
    }

    function switchTab(tabName) {
        // Update tab buttons
        catTabs.forEach(t => t.classList.remove('active'));
        const clickedTab = document.querySelector('.cat-tab[data-tab="' + tabName + '"]');
        if (clickedTab) clickedTab.classList.add('active');

        // Update panels
        catPanels.forEach(p => p.classList.remove('active'));
        const targetPanel = document.getElementById('panel-' + tabName);
        if (targetPanel) targetPanel.classList.add('active');

        // Destroy old swiper, init new one
        if (activeCatSwiper) {
            activeCatSwiper.destroy(true, true);
            activeCatSwiper = null;
        }
        if (targetPanel) {
            activeCatSwiper = initCatSwiper(targetPanel);
        }
    }

    // Tab click listeners
    catTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            switchTab(tab.getAttribute('data-tab'));
        });
    });

    // Init first tab on load
    if (catTabs.length > 0) {
        const firstPanel = document.getElementById('panel-' + catTabs[0].getAttribute('data-tab'));
        if (firstPanel) activeCatSwiper = initCatSwiper(firstPanel);
    }

});


new Swiper(".worksmart-swiper", {
    grabCursor: true,
    speed: 1800,
    spaceBetween: 15,
    direction: "horizontal",
    loop: true,

    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
    },

    slidesPerView: 1,

    navigation: {
        nextEl: ".swiper-next",
        prevEl: ".swiper-prev",
    },

    breakpoints: {
        480: { slidesPerView: 1.05, spaceBetween: 20 },
        768: { slidesPerView: 1.1, spaceBetween: 30 },
        992: { slidesPerView: 1.15, spaceBetween: 40 },
        1200: { slidesPerView: 1.2, spaceBetween: 50 },
        1400: { slidesPerView: 1.3, spaceBetween: 60 },
        1600: { slidesPerView: 1.4, spaceBetween: 60 },
    }
});


/* --- How It Works Accordion --- */
(function () {
    const items = document.querySelectorAll('.hiw-item');
    const images = document.querySelectorAll('.hiw-img');

    if (!items.length) return;

    items.forEach(item => {
        item.querySelector('.hiw-header').addEventListener('click', () => {
            const step = item.getAttribute('data-step');

            // Collapse all items
            items.forEach(i => i.classList.remove('active'));

            // Activate clicked
            item.classList.add('active');

            // Fade images
            images.forEach(img => img.classList.remove('active'));
            const targetImg = document.getElementById('step-img-' + step);
            if (targetImg) {
                setTimeout(() => {
                    targetImg.classList.add('active');
                }, 100);
            }
        });
    });
})();


/* --- Number Counter Animation --- */
(function () {
    const counters = document.querySelectorAll('.kue-numerbsd .counter');
    if (!counters.length) return;

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const endVal = parseInt(target.getAttribute('data-target') || 0);
                const duration = 2500; // ms
                let startTimestamp = null;

                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    // easeOutQuart
                    const easeProgress = 1 - Math.pow(1 - progress, 4);
                    target.innerText = Math.floor(easeProgress * endVal);
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    } else {
                        target.innerText = endVal;
                    }
                };
                window.requestAnimationFrame(step);
                observer.unobserve(target); // Only animate once
            }
        });
    }, { threshold: 0.5 }); // Trigger when 50% is visible

    counters.forEach(counter => observer.observe(counter));
})();


/* --- FAQ Accordion --- */
document.addEventListener('DOMContentLoaded', () => {
    const faqHeaders = document.querySelectorAll('.faq-header');
    if (faqHeaders.length > 0) {
        faqHeaders.forEach(header => {
            header.addEventListener('click', () => {
                const item = header.parentElement;
                const isActive = item.classList.contains('active');
                
                // Close all other FAQs
                document.querySelectorAll('.faq-item').forEach(i => {
                    i.classList.remove('active');
                });

                // Toggle current FAQ
                if (!isActive) {
                    item.classList.add('active');
                }
            });
        });
    }
});

/* --- Booking Modal Handling --- */
document.addEventListener('DOMContentLoaded', () => {
    // Open modal on 'Book Now' click
    const bookNowBtns = document.querySelectorAll('.open-booking-modal');
    const bookNowModalEl = document.getElementById('bookNowModal');
    
    if (bookNowBtns.length > 0 && bookNowModalEl) {
        bookNowBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                // Check if bootstrap is available (it should be since the modal is Bootstrap structured)
                if(typeof bootstrap !== 'undefined'){
                    const modal = new bootstrap.Modal(bookNowModalEl);
                    modal.show();
                } else {
                    // Fallback simple display if Bootstrap JS failed to load
                    bookNowModalEl.classList.add('show');
                    bookNowModalEl.style.display = 'block';
                    bookNowModalEl.style.backgroundColor = 'rgba(0,0,0,0.5)';
                }
            });
        });

        // Fallback close logic
        const closeBtns = bookNowModalEl.querySelectorAll('[data-bs-dismiss="modal"]');
        closeBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                bookNowModalEl.classList.remove('show');
                bookNowModalEl.style.display = 'none';
            });
        });
    }

    // Handle AJAX Submission
    const popupForm = document.getElementById('popupBookingForm');
    const popupMsg = document.getElementById('popupFormMessage');
    
    if (popupForm) {
        popupForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const btn = document.getElementById('btnPopupBooking');
            const btnText = btn.querySelector('.btn-text');
            const originalText = btnText.innerText;
            
            btn.disabled = true;
            btnText.innerText = 'Sending...';
            
            const formData = new FormData(popupForm);
            
            fetch('book-now-mail.php', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                popupMsg.style.display = 'block';
                if(data.status === 'success'){
                    popupMsg.style.color = '#28a745';
                    popupMsg.innerText = data.message;
                    popupForm.reset();
                    setTimeout(() => {
                        if(typeof bootstrap !== 'undefined'){
                            const modal = bootstrap.Modal.getInstance(bookNowModalEl);
                            if(modal) modal.hide();
                        } else {
                            bookNowModalEl.style.display = 'none';
                        }
                        popupMsg.style.display = 'none';
                        window.location.href = 'success.php'; // Redirect to success page directly for wow factor
                    }, 1500);
                } else {
                    popupMsg.style.color = '#dc3545';
                    popupMsg.innerText = data.message;
                }
            })
            .catch(err => {
                popupMsg.style.display = 'block';
                popupMsg.style.color = '#dc3545';
                popupMsg.innerText = 'An error occurred. Please try again.';
            })
            .finally(() => {
                btn.disabled = false;
                btnText.innerText = originalText;
            });
        });
    }
});

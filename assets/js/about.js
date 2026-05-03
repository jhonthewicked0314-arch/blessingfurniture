/* ── About Page JavaScript ── */
document.addEventListener('DOMContentLoaded', function() {

    // FAQ Accordion
    document.querySelectorAll('.faq-header').forEach(function(header) {
        header.addEventListener('click', function() {
            var item = this.closest('.faq-item');
            var isActive = item.classList.contains('active');
            // Close all
            document.querySelectorAll('.faq-item').forEach(function(i) {
                i.classList.remove('active');
            });
            // Toggle clicked
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });

    // ── Testimonial Two-Row Auto-Swipers ──
    if (typeof Swiper !== 'undefined') {
        // Row 1: Slides left (default direction)
        new Swiper('.testi-swiper-row1', {
            slidesPerView: 'auto',
            spaceBetween: 24,
            loop: true,
            speed: 6000,
            allowTouchMove: true,
            autoplay: {
                delay: 0,
                disableOnInteraction: false
            },
            freeMode: {
                enabled: true,
                momentum: false
            }
        });

        // Row 2: Slides right (reverse direction)
        new Swiper('.testi-swiper-row2', {
            slidesPerView: 'auto',
            spaceBetween: 24,
            loop: true,
            speed: 7000,
            allowTouchMove: true,
            autoplay: {
                delay: 0,
                disableOnInteraction: false,
                reverseDirection: true
            },
            freeMode: {
                enabled: true,
                momentum: false
            }
        });
    }

    // Counter animation for stats
    function animateCounters() {
        document.querySelectorAll('.stat-counter').forEach(function(counter) {
            if (counter.dataset.animated) return;
            var target = parseInt(counter.dataset.target);
            var duration = 2000;
            var step = target / (duration / 16);
            var current = 0;
            var timer = setInterval(function() {
                current += step;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                counter.textContent = Math.floor(current);
            }, 16);
            counter.dataset.animated = 'true';
        });
    }

    // Intersection Observer for scroll animations
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
                if (entry.target.classList.contains('stat-counter')) {
                    animateCounters();
                }
            }
        });
    }, { threshold: 0.2 });

    document.querySelectorAll('.observe-me').forEach(function(el) {
        observer.observe(el);
    });

    // Smooth parallax for hero decorative elements
    window.addEventListener('scroll', function() {
        var scrollY = window.pageYOffset;
        document.querySelectorAll('.float-decor').forEach(function(el, i) {
            var speed = 0.02 + (i * 0.01);
            el.style.transform = 'translateY(' + (scrollY * speed) + 'px)';
        });
    });
});

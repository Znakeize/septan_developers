<!-- AOS JavaScript and Animations Initialization -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS (Animate On Scroll)
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 1000,
                once: true,
                offset: 100,
                easing: 'ease-out-cubic',
                delay: 0
            });
        }

        // Page Loader - Smooth fade-out effect
        window.addEventListener('load', function() {
            setTimeout(function() {
                const pageLoader = document.getElementById('pageLoader');
                if (pageLoader) {
                    pageLoader.classList.add('hidden');
                    // Remove from DOM after animation completes
                    setTimeout(function() {
                        pageLoader.remove();
                    }, 500);
                }
            }, 1000);
        });

        // Intersection Observer for scroll-based animations (lazy initialization)
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    // Lazy initialize heavy animations only when visible
                    if (entry.target.classList.contains('service-card') || 
                        entry.target.classList.contains('project-card') ||
                        entry.target.classList.contains('blog-card')) {
                        entry.target.style.willChange = 'transform';
                    }
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe all sections and cards
        const sections = document.querySelectorAll('section');
        const cards = document.querySelectorAll('.service-card, .project-card, .blog-card, .testimonial-card, .stat-card, .feature-box, .process-step, .vm-card');
        
        sections.forEach(function(section) {
            section.classList.add('animate-on-scroll');
            observer.observe(section);
        });

        cards.forEach(function(card) {
            card.classList.add('animate-on-scroll');
            observer.observe(card);
        });

        // Smooth scrolling enhancement
        document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#' || !href) return;
                
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    const offsetTop = target.offsetTop - 80; // Account for fixed nav
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Optimize animations for performance
        let ticking = false;
        function updateAnimations() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    // Performance optimization: reduce animations on scroll
                    const scrolled = window.pageYOffset;
                    if (scrolled > 100) {
                        document.body.classList.add('scrolled');
                    } else {
                        document.body.classList.remove('scrolled');
                    }
                    ticking = false;
                });
                ticking = true;
            }
        }
        window.addEventListener('scroll', updateAnimations, { passive: true });
    });
</script>


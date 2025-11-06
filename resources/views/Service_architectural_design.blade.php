<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Architectural Design - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/chatbot.css') }}">
</head>
<body data-page="architectural-design">
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
        <div class="logo"><a href="{{ route('home') }}" style="display:inline-flex;align-items:center;gap:10px;text-decoration:none;">
                <img src="{{ asset('assets/img/logo-sample.svg') }}" alt="Septan" style="height:32px;display:block;"/>
                <span style="font-weight:900;letter-spacing:2px;color:#dc2626;">SEPTAN</span></div>
            <button class="menu-toggle" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </button>
            <ul id="nav-menu">
                <li><a href="{{ route('home') }}#about">About</a></li>
                <li class="dropdown">
                    <a href="{{ route('home') }}#services">Services</a>
                    <ul>
                        <li><a href="{{ route('services.architectural_design') }}">Architectural Design</a></li>
                        <li><a href="{{ route('services.structural_design') }}">Structural Design</a></li>
			            <li><a href="{{ route('services.bim') }}">Building Information Modeling (BIM)</a></li>
                        <li><a href="{{ route('services.interior_design') }}">Interior Design</a></li>
                        <li><a href="{{ route('services.3d_rendering') }}">3D Rendering</a></li>
                        <li><a href="{{ route('services.estimation') }}">Estimation & Consultation</a></li>
                        <li><a href="{{ route('services.project_management') }}">Project Management</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('home') }}#projects">Projects</a></li>
                <li><a href="{{ route('home') }}#testimonials">Testimonials</a></li>
                <li><a href="{{ route('home') }}#blog">Blog</a></li>
                <li><a href="{{ route('home') }}#contact">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="service-hero" @if(isset($heroImages) && count($heroImages) > 0) style="background: linear-gradient(135deg, rgba(220, 38, 38, 0.1), rgba(0, 0, 0, 0.9)), url('{{ $heroImages[0] }}'); background-size: cover; background-position: center; background-attachment: fixed;" @endif>
        @if(isset($heroImages) && count($heroImages) > 0)
        <div class="hero-slides">
            @foreach($heroImages as $index => $image)
            <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" style="background-image: url('{{ $image }}');"></div>
            @endforeach
        </div>
        <div class="hero-nav">
            <button type="button" class="prev"><i class="fas fa-chevron-left"></i></button>
            <button type="button" class="next"><i class="fas fa-chevron-right"></i></button>
        </div>
        @endif
        <div class="service-hero-content">
            <h1>ARCHITECTURAL <span>DESIGN</span></h1>
            <p>Creating innovative and sustainable architectural solutions that blend modern aesthetics with environmental harmony. We transform your vision into timeless structures that inspire and endure.</p>
            <a href="#contact" class="cta-button">Start Your Project</a>
        </div>
    </section>

    <!-- Service Overview -->
    <section>
        <div class="section-container">
            <h3>Comprehensive Architectural Services</h3>
            <p>At Septan Developers, we specialize in creating architectural designs that are not only visually stunning but also functionally superior. Our approach combines cutting-edge design principles with sustainable practices to deliver spaces that inspire and endure.</p>
            
            <p>We work closely with clients to understand their vision, requirements, and constraints, translating them into architectural masterpieces that exceed expectations. From residential homes to commercial complexes, our architectural designs prioritize sustainability, functionality, and timeless beauty.</p>

            <p>Our team of experienced architects brings creativity, technical expertise, and attention to detail to every project. We believe that great architecture should enhance the quality of life, respect the environment, and stand the test of time.</p>
        </div>
    </section>

    <!-- Service Features -->
    <section class="dark-section">
        <div class="section-container">
            <h2>OUR <span>CAPABILITIES</span></h2>
            <div class="service-features">
                <div class="feature-box">
                    <h4>Conceptual Design</h4>
                    <p>Developing initial design concepts that capture your vision and meet project requirements through sketches, mood boards, and 3D visualizations. We explore multiple design directions to find the perfect solution.</p>
                </div>
                <div class="feature-box">
                    <h4>Detailed Planning</h4>
                    <p>Creating comprehensive architectural drawings, floor plans, elevations, and sections with precise specifications for construction. Every detail is meticulously planned and documented.</p>
                </div>
                <div class="feature-box">
                    <h4>Sustainable Solutions</h4>
                    <p>Integrating eco-friendly materials, passive design strategies, and energy-efficient systems to minimize environmental impact. We design for a sustainable future.</p>
                </div>
                <div class="feature-box">
                    <h4>Space Optimization</h4>
                    <p>Maximizing functionality and flow through intelligent space planning and innovative design solutions. Every square foot is thoughtfully utilized.</p>
                </div>
                <div class="feature-box">
                    <h4>Site Analysis</h4>
                    <p>Comprehensive evaluation of site conditions, context, climate, and orientation to inform design decisions. We work with the site, not against it.</p>
                </div>
                <div class="feature-box">
                    <h4>Regulatory Compliance</h4>
                    <p>Ensuring all designs meet local building codes, zoning regulations, and permit requirements. We navigate the regulatory landscape for you.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Design Process -->
    <section class="process-section">
        <div class="section-container">
            <h2>OUR DESIGN <span>PROCESS</span></h2>
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h4>Consultation</h4>
                    <p>Initial meeting to understand your vision, requirements, budget, and project timeline. We listen carefully to your needs and aspirations.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h4>Concept Development</h4>
                    <p>Creating preliminary design concepts with sketches and 3D visualizations for your review. We present multiple design options.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h4>Design Refinement</h4>
                    <p>Refining the chosen concept based on your feedback and technical requirements. We iterate until perfection is achieved.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h4>Final Documentation</h4>
                    <p>Producing complete construction documents ready for permitting and building. Every detail is specified and coordinated.</p>
                </div>
            </div>
        </div>
    </section>

     <!-- Contact Section -->
    <section id="contact" class="light">
        <div class="section-container">
            <h2>GET IN <span>TOUCH</span></h2>
            <div class="contact-container">
                <form id="contact-form">
                    <input type="hidden" id="csrf_token" name="csrf_token">
                    <input type="text" id="name" name="name" placeholder="Your Name" required>
                    <input type="email" id="email" name="email" placeholder="Your Email" required>
                    <input type="tel" id="phone" name="phone" placeholder="Your Phone" required>
                    <textarea id="message" name="message" placeholder="Your Message" required></textarea>
                    <button type="submit">Send Message</button>
                    <div id="form-message"></div>
                    <div id="form-success"></div>
                </form>
                <div class="contact-info-section">
                    <h3>Contact Information</h3>
                    <div class="contact-info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <strong>Office Address</strong>
                            <p>Septan Developers (Pvt) Ltd<br>Ambalangoda, Sri Lanka</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <strong>Phone</strong>
                            <p>+94 76 3132675</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <strong>Email</strong>
                            <p>septandevelopers@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="map-container-contact">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31643.45039811249!2d79.86124199999998!3d6.927078999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae183cd06a4f207:0xc2e135d975365914!2sSeptan%20Developers%20(Pvt)%20Ltd!5e0!3m2!1sen!2sus!4v1697803541000!5m2!1sen!2sus" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-social">
                <a href="https://facebook.com/SeptanDevelopers" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://instagram.com/septan_developers" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://linkedin.com/company/septan-developers-pvt-ltd" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                <a href="https://tiktok.com/@septandevelopers" target="_blank"><i class="fab fa-tiktok"></i></a>
                <a href="https://youtube.com/@SeptanDevelopers" target="_blank"><i class="fab fa-youtube"></i></a>
            </div>
            <div class="footer-links">
                <a href="#">Terms</a>
                <a href="#">Privacy</a>
            </div>
            <div class="copyright">
                &copy; 2025 Septan Developers. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    
    <!-- Septan AI Chatbot -->
    @include('partials.chatbot')
</body>
</html>

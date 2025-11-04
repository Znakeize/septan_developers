<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Building Information Modeling - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body data-page="bim-page">
    <nav>
        <div class="nav-container">
        <div class="logo"><a href="{{ route('home') }}" style="display:inline-flex;align-items:center;gap:10px;text-decoration:none;">
                <img src="{{ asset('assets/img/logo-sample.svg') }}" alt="Septan" style="height:32px;display:block;"/>
                <span style="font-weight:900;letter-spacing:2px;color:#dc2626;">SEPTAN</span></div>
            <button class="menu-toggle" onclick="toggleMenu()"><i class="fas fa-bars"></i></button>
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
            <h1>BUILDING INFORMATION <span>MODELING</span></h1>
            <p>Revolutionizing construction through intelligent 3D modeling and seamless project coordination. Our BIM services integrate all building systems for optimal efficiency and collaboration.</p>
            <a href="#contact" class="cta-button">Start Your Project</a>
        </div>
    </section>

    <section>
        <div class="section-container">
            <h3>Advanced BIM Solutions</h3>
            <p>Building Information Modeling (BIM) is at the heart of our modern construction approach. We create comprehensive digital representations of your project that enable better visualization, coordination, and decision-making throughout the entire building lifecycle.</p>
            <p>Our BIM services integrate architectural, structural, and MEP (Mechanical, Electrical, Plumbing) systems into a single coordinated model, identifying conflicts before construction begins and ensuring seamless execution on site.</p>
            <p>From clash detection to 5D cost estimation, our BIM expertise streamlines the construction process, reduces errors, and delivers significant time and cost savings.</p>
        </div>
    </section>

    <section style="background: #111;">
        <div class="section-container">
            <h2>BIM <span>CAPABILITIES</span></h2>
            <div class="service-features">
                <div class="feature-box">
                    <h4>3D Modeling</h4>
                    <p>Creating detailed 3D models with accurate geometry, materials, and component specifications for all building elements and systems.</p>
                </div>
                <div class="feature-box">
                    <h4>Clash Detection</h4>
                    <p>Identifying and resolving conflicts between different building systems before construction starts, eliminating costly on-site changes.</p>
                </div>
                <div class="feature-box">
                    <h4>4D Scheduling</h4>
                    <p>Integrating time-based information to visualize construction sequences and optimize project timelines for efficient execution.</p>
                </div>
                <div class="feature-box">
                    <h4>5D Cost Estimation</h4>
                    <p>Linking model elements to cost data for accurate quantity takeoffs and real-time budget management throughout the project.</p>
                </div>
                <div class="feature-box">
                    <h4>MEP Coordination</h4>
                    <p>Coordinating mechanical, electrical, and plumbing systems for optimal installation routes and maintenance accessibility.</p>
                </div>
                <div class="feature-box">
                    <h4>Facility Management</h4>
                    <p>Providing as-built BIM models with complete asset information for efficient building operation and lifecycle maintenance.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="process-section">
        <div class="section-container">
            <h2>BIM <span>IMPLEMENTATION</span></h2>
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h4>Model Development</h4>
                    <p>Creating comprehensive BIM models with detailed architectural, structural, and MEP components in coordinated 3D environment.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h4>Coordination</h4>
                    <p>Running clash detection and coordinating all building systems to ensure conflict-free construction and optimal system integration.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h4>Documentation</h4>
                    <p>Generating construction documents, schedules, and quantity takeoffs directly from the intelligent BIM model.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h4>Handover</h4>
                    <p>Delivering as-built models with complete asset information for seamless transition to facility management operations.</p>
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
</body>
</html>

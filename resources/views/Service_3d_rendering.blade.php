<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Rendering & Visualization - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body data-page="3d-rendering">
    <nav>
        <div class="nav-container">
            <div class="logo"><a href="{{route('home')}}">SEPTAN</a></div>
            <button class="menu-toggle" onclick="toggleMenu()"><i class="fas fa-bars"></i></button>
            <ul id="nav-menu">
                <li><a href="{{route('home')}}#about">About</a></li>
                <li class="dropdown">
                    <a href="{{route('home')}}#services">Services</a>
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
        <div class="service-hero-content">
            <h1>3D RENDERING & <span>VISUALIZATION</span></h1>
            <p>Bringing your projects to life with photorealistic visualizations and immersive virtual experiences. See your design before construction begins.</p>
            <a href="#contact" class="cta-button">Start Your Project</a>
        </div>
    </section>

    <section>
        <div class="section-container">
            <h3>Photorealistic Visualizations</h3>
            <p>Our 3D rendering services allow you to experience your project before a single brick is laid. Using state-of-the-art rendering software and techniques, we create stunning photorealistic images and animations that accurately represent materials, lighting, and atmosphere.</p>
            <p>These visualizations serve as powerful communication tools, helping clients, stakeholders, and contractors understand the design intent and make informed decisions early in the project timeline.</p>
            <p>From exterior views to interior walkthroughs, our 3D visualizations capture every detail with precision and artistry, bringing your vision to life in stunning clarity.</p>
        </div>
    </section>

    <section style="background: #111;">
        <div class="section-container">
            <h2>VISUALIZATION <span>SERVICES</span></h2>
            <div class="service-features">
                <div class="feature-box">
                    <h4>Exterior Rendering</h4>
                    <p>Photorealistic exterior views showcasing architectural design, landscaping, and contextual surroundings in various lighting conditions.</p>
                </div>
                <div class="feature-box">
                    <h4>Interior Rendering</h4>
                    <p>Detailed interior visualizations capturing materials, lighting, furniture, and spatial atmosphere with lifelike accuracy.</p>
                </div>
                <div class="feature-box">
                    <h4>Virtual Tours</h4>
                    <p>Interactive 360-degree tours allowing immersive exploration of spaces from any angle and perspective.</p>
                </div>
                <div class="feature-box">
                    <h4>Animation</h4>
                    <p>Dynamic fly-through animations presenting the project from multiple perspectives and sequences for comprehensive understanding.</p>
                </div>
                <div class="feature-box">
                    <h4>Material Studies</h4>
                    <p>Visualizing different material options, colors, and finishes to aid design decision-making and client presentations.</p>
                </div>
                <div class="feature-box">
                    <h4>Marketing Visuals</h4>
                    <p>High-quality renders optimized for brochures, websites, and marketing campaigns to showcase your project effectively.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="process-section">
        <div class="section-container">
            <h2>VISUALIZATION <span>PROCESS</span></h2>
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h4>3D Modeling</h4>
                    <p>Creating accurate 3D models from architectural drawings with precise geometry, details, and spatial relationships.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h4>Material Application</h4>
                    <p>Applying realistic materials, textures, and finishes to all surfaces and objects with proper scale and detail.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h4>Lighting Setup</h4>
                    <p>Setting up lighting scenarios that accurately simulate natural and artificial light sources for realistic atmosphere.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h4>Rendering & Post-Production</h4>
                    <p>Generating high-resolution images and enhancing them through professional post-processing for final delivery.</p>
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

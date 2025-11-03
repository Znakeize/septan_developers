<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interior Design - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    
</head>
<body data-page="interior-design">
    <nav>
        <div class="nav-container">
            <div class="logo"><a href="{{ route('home') }}">SEPTAN</a></div>
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
        @endif
        <div class="service-hero-content">
            <h1>INTERIOR <span>DESIGN</span></h1>
            <p>Transforming spaces into inspiring environments that reflect your personality and enhance daily living. Our interior design expertise creates functional beauty in every room.</p>
            <a href="#contact" class="cta-button">Start Your Project</a>
        </div>
    </section>

    <section>
        <div class="section-container">
            <h3>Creating Beautiful Interiors</h3>
            <p>Our interior design services focus on creating spaces that are both aesthetically pleasing and highly functional. We believe that great interior design goes beyond visual appealâ€”it enhances the way people live, work, and interact with their environment.</p>
            <p>From concept to completion, we handle every aspect of interior design including space planning, material selection, furniture design, lighting design, and decorative elements. Our designs reflect your unique style while incorporating the latest trends and timeless principles.</p>
            <p>Whether you're renovating a single room or designing an entire building, our team brings creativity, attention to detail, and a commitment to excellence to every project.</p>
        </div>
    </section>

    <section style="background: #111;">
        <div class="section-container">
            <h2>DESIGN <span>SERVICES</span></h2>
            <div class="service-features">
                <div class="feature-box">
                    <h4>Space Planning</h4>
                    <p>Optimizing room layouts for maximum functionality, flow, and comfort while maintaining aesthetic appeal and meeting your lifestyle needs.</p>
                </div>
                <div class="feature-box">
                    <h4>Material Selection</h4>
                    <p>Curating premium materials, finishes, and textures that align with your design vision, budget, and durability requirements.</p>
                </div>
                <div class="feature-box">
                    <h4>Furniture Design</h4>
                    <p>Custom furniture design and selection that perfectly fits your space, complements the overall design, and meets functional needs.</p>
                </div>
                <div class="feature-box">
                    <h4>Lighting Design</h4>
                    <p>Creating layered lighting schemes that enhance ambiance, functionality, and architectural features throughout your space.</p>
                </div>
                <div class="feature-box">
                    <h4>Color Consultation</h4>
                    <p>Developing cohesive color palettes that create the desired mood, visual harmony, and psychological impact in your spaces.</p>
                </div>
                <div class="feature-box">
                    <h4>Styling & Accessories</h4>
                    <p>Final touches including artwork, textiles, plants, and decorative elements that complete the design vision and add personality.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="process-section">
        <div class="section-container">
            <h2>DESIGN <span>JOURNEY</span></h2>
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h4>Discovery</h4>
                    <p>Understanding your lifestyle, preferences, functional requirements, and budget through detailed consultation and site analysis.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h4>Concept Creation</h4>
                    <p>Developing design concepts with mood boards, color schemes, preliminary layouts, and material samples for your review.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h4>Design Development</h4>
                    <p>Refining the design with detailed drawings, material specifications, furniture selections, and 3D visualizations.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h4>Implementation</h4>
                    <p>Overseeing installation, coordinating with contractors, and styling the space to ensure the design vision is perfectly executed.</p>
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

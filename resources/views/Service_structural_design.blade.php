<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Structural Design - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/chatbot.css') }}">
</head>
<body data-page="structural-design">
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
            <h1>STRUCTURAL <span>DESIGN</span></h1>
            <p>Engineering robust and safe structural systems that ensure the longevity and integrity of your building. Our expert structural engineers deliver solutions that combine safety, efficiency, and innovation.</p>
            <a href="#contact" class="cta-button">Start Your Project</a>
        </div>
    </section>

    <section>
        <div class="section-container">
            <h3>Advanced Structural Engineering</h3>
            <p>Our structural engineering services ensure that every building we design is safe, durable, and built to last. We use advanced analysis techniques and industry-leading software to create structural systems that meet all safety codes while optimizing material efficiency.</p>
            
            <p>From foundation design to roof framing, we handle all aspects of structural engineering with precision and expertise. Our engineers work collaboratively with architects to ensure structural integrity never compromises aesthetic vision.</p>

            <p>We specialize in designing structures that can withstand environmental challenges including seismic activity, wind loads, and varying soil conditions while maintaining cost-effectiveness and constructability.</p>
        </div>
    </section>

    <section style="background: #111;">
        <div class="section-container">
            <h2>ENGINEERING <span>EXPERTISE</span></h2>
            <div class="service-features">
                <div class="feature-box">
                    <h4>Foundation Design</h4>
                    <p>Comprehensive foundation analysis and design considering soil conditions, load requirements, and environmental factors for stable and durable foundations.</p>
                </div>
                <div class="feature-box">
                    <h4>Load Analysis</h4>
                    <p>Detailed structural load calculations including dead loads, live loads, wind loads, and seismic considerations using advanced computational methods.</p>
                </div>
                <div class="feature-box">
                    <h4>Material Optimization</h4>
                    <p>Selecting appropriate structural materials and optimizing member sizes for cost-effective and efficient design without compromising safety.</p>
                </div>
                <div class="feature-box">
                    <h4>Code Compliance</h4>
                    <p>Ensuring all structural designs meet local building codes, international engineering standards, and industry best practices.</p>
                </div>
                <div class="feature-box">
                    <h4>Seismic Design</h4>
                    <p>Specialized earthquake-resistant design incorporating latest seismic engineering principles for enhanced structural resilience.</p>
                </div>
                <div class="feature-box">
                    <h4>Steel & Concrete Design</h4>
                    <p>Expert design of reinforced concrete and structural steel systems optimized for strength, durability, and constructability.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="process-section">
        <div class="section-container">
            <h2>ENGINEERING <span>WORKFLOW</span></h2>
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h4>Site Assessment</h4>
                    <p>Evaluating site conditions, soil properties, and environmental factors affecting structural design requirements.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h4>Structural Analysis</h4>
                    <p>Performing comprehensive load analysis and structural modeling using advanced engineering software and methodologies.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h4>Design Development</h4>
                    <p>Creating detailed structural drawings and specifications for all building components with precise calculations.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h4>Quality Assurance</h4>
                    <p>Reviewing designs for compliance, safety, and constructability before finalization and construction documentation.</p>
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

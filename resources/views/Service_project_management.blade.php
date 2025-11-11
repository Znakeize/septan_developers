<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @include('partials.animations-init')
    <link rel="stylesheet" href="{{ asset('assets/css/chatbot.css') }}">
</head>
<body data-page="project-management">
    @include('partials.page-loader')
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
            <h1>PROJECT <span>MANAGEMENT</span></h1>
            <p>Ensuring seamless project execution from planning through completion with expert oversight. We deliver projects on time, within budget, and to the highest quality standards.</p>
            <a href="#contact" class="cta-button">Start Your Project</a>
        </div>
    </section>

    <section data-aos="fade-up">
        <div class="section-container">
            <h3 data-aos="fade-up" data-aos-delay="100">Comprehensive Project Oversight</h3>
            <p>Our project management services ensure that your construction project is delivered on time, within budget, and to the highest quality standards. We coordinate all aspects of the project, managing teams, resources, and timelines to achieve successful outcomes.</p>
            <p>From initial planning through final handover, our experienced project managers serve as your single point of contact, providing regular updates and proactively addressing challenges before they impact your project.</p>
            <p>We employ industry-leading project management methodologies and tools to maintain control over scope, schedule, cost, and quality throughout the entire construction process.</p>
        </div>
    </section>

    <section style="background: #111;" data-aos="fade-up">
        <div class="section-container">
            <h2 data-aos="fade-up" data-aos-delay="100">MANAGEMENT <span>SERVICES</span></h2>
            <div class="service-features">
                <div class="feature-box">
                    <h4>Planning & Scheduling</h4>
                    <p>Developing comprehensive project schedules with critical path analysis, milestone tracking, and resource allocation for optimal efficiency.</p>
                </div>
                <div class="feature-box">
                    <h4>Resource Coordination</h4>
                    <p>Managing contractors, suppliers, and labor resources for optimal project efficiency, productivity, and quality workmanship.</p>
                </div>
                <div class="feature-box">
                    <h4>Quality Control</h4>
                    <p>Implementing rigorous quality assurance processes and conducting regular site inspections to ensure standards are met.</p>
                </div>
                <div class="feature-box">
                    <h4>Budget Management</h4>
                    <p>Monitoring costs, managing change orders, processing payments, and ensuring project stays within approved budget constraints.</p>
                </div>
                <div class="feature-box">
                    <h4>Risk Mitigation</h4>
                    <p>Identifying potential risks, developing mitigation strategies, and implementing solutions to minimize project disruptions.</p>
                </div>
                <div class="feature-box">
                    <h4>Communication</h4>
                    <p>Providing regular progress reports, coordinating meetings, and maintaining transparent communication with all stakeholders.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="process-section" data-aos="fade-up">
        <div class="section-container">
            <h2>MANAGEMENT <span>FRAMEWORK</span></h2>
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h4>Project Setup</h4>
                    <p>Establishing project framework, team structure, communication protocols, and baseline schedules for successful execution.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h4>Execution Monitoring</h4>
                    <p>Overseeing daily operations, tracking progress against schedule, and ensuring quality standards are maintained throughout.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h4>Issue Resolution</h4>
                    <p>Addressing challenges promptly, coordinating solutions with stakeholders, and implementing corrective actions as needed.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h4>Project Closeout</h4>
                    <p>Final inspections, documentation compilation, punch list completion, and successful handover of completed project.</p>
                </div>
            </div>
        </div>
    </section>

     <!-- Contact Section -->
    <section id="contact" class="light" data-aos="fade-up">
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
    @include('partials.animations-script')
    
    <!-- Septan AI Chatbot -->
    @include('partials.chatbot')
</body>
</html>

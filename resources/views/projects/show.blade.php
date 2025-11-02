<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->title }} - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; background: #000; color: #fff; overflow-x: hidden; scroll-behavior: smooth; }

        nav { position: fixed; top: 0; width: 100%; background: rgba(0, 0, 0, 0.95); backdrop-filter: blur(10px); padding: 1rem 2rem; z-index: 1000; border-bottom: 1px solid #333; }
        .nav-container { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 1.5rem; font-weight: 900; color: #dc2626; letter-spacing: 2px; }
        .logo a { color: #dc2626; text-decoration: none; }
        nav ul { display: flex; list-style: none; gap: 2rem; }
        nav ul li a { color: #fff; text-decoration: none; font-weight: 600; text-transform: uppercase; font-size: 0.9rem; letter-spacing: 1px; transition: color 0.3s ease; }
        nav ul li a:hover { color: #dc2626; }
        .menu-toggle { display: none; background: none; border: none; color: #fff; font-size: 1.5rem; cursor: pointer; }

        .project-hero {
            height: 70vh;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 70px;
        }
        .project-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
        }
        .project-hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 0 2rem;
        }
        .project-hero h1 {
            font-size: 4rem;
            font-weight: 900;
            letter-spacing: 5px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        .project-hero .tagline {
            font-size: 1.5rem;
            color: #dc2626;
            letter-spacing: 2px;
        }

        .project-details {
            padding: 100px 20px;
            background: #111;
        }
        .details-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .project-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 60px;
        }
        .info-card {
            background: rgba(220, 38, 38, 0.05);
            padding: 30px;
            border-left: 4px solid #dc2626;
        }
        .info-card h3 {
            color: #dc2626;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 15px;
        }
        .info-card p {
            font-size: 1.3rem;
            color: #ccc;
            line-height: 1.6;
        }
        .project-description {
            margin: 60px 0;
        }
        .project-description h2 {
            font-size: 3rem;
            margin-bottom: 30px;
            color: #dc2626;
            text-transform: uppercase;
            letter-spacing: 3px;
        }
        .project-description p {
            font-size: 1.2rem;
            line-height: 2;
            color: #ccc;
            margin-bottom: 20px;
        }

        .project-gallery {
            padding: 100px 20px;
            background: #000;
        }
        .section-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        h2 {
            font-size: 3.5rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 80px;
            letter-spacing: 5px;
            text-transform: uppercase;
        }
        h2 span {
            color: #dc2626;
        }
        .gallery-hero {
            display: grid;
            grid-template-columns: 1.8fr 0.9fr;
            gap: 30px;
            align-items: stretch;
            margin-bottom: 40px;
        }
        .gallery-video {
            position: relative;
            width: 100%;
            padding-top: 56.25%;
            overflow: hidden;
            border: 1px solid #222;
            background: #000;
        }
        .gallery-video iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
        .gallery-hero .cta-card {
            align-self: center;
            justify-self: center;
            max-width: 360px;
            width: 100%;
            background: linear-gradient(135deg, #dc2626, #991b1b);
            border-radius: 12px;
            padding: 1.25rem;
            text-align: center;
        }
        .gallery-hero .cta-card h3 {
            font-size: 1.4rem;
            margin-bottom: 0.75rem;
        }
        .gallery-hero .cta-card p {
            margin-bottom: 1rem;
            opacity: 0.9;
            font-size: 0.95rem;
        }
        .cta-button {
            background: #fff;
            color: #dc2626;
            padding: 0.6rem 1rem;
            border: none;
            border-radius: 6px;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .cta-button:hover {
            background: #000;
            color: #fff;
            transform: translateY(-2px);
        }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }
        .gallery-item {
            height: 400px;
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.5s ease;
        }
        .gallery-item:hover {
            transform: scale(1.05);
        }
        .gallery-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(220, 38, 38, 0.2);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .gallery-item:hover::before {
            opacity: 1;
        }

        section {
            padding: 100px 20px;
        }
        .contact-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            max-width: 1200px;
            margin: 0 auto;
        }
        form {
            background: #111;
            padding: 50px;
            border: 1px solid #222;
        }
        input, textarea {
            width: 100%;
            padding: 1.2rem;
            margin-bottom: 20px;
            background: #000;
            border: 1px solid #333;
            color: #fff;
            font-size: 1rem;
        }
        input:focus, textarea:focus {
            outline: none;
            border-color: #dc2626;
        }
        textarea {
            min-height: 150px;
            resize: vertical;
        }
        button[type="submit"] {
            background: #dc2626;
            color: #fff;
            padding: 1.2rem 3rem;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 2px;
            transition: all 0.3s ease;
            width: 100%;
        }
        button[type="submit"]:hover {
            background: #fff;
            color: #dc2626;
        }
        .contact-info-section {
            background: #111;
            padding: 50px;
            border: 1px solid #222;
        }
        .contact-info-section h3 {
            font-size: 2rem;
            color: #dc2626;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .contact-info-item {
            margin-bottom: 25px;
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }
        .contact-info-item i {
            color: #dc2626;
            font-size: 1.5rem;
            margin-top: 5px;
        }
        .contact-info-item div {
            flex: 1;
        }
        .contact-info-item strong {
            display: block;
            margin-bottom: 5px;
            color: #fff;
        }
        .contact-info-item p {
            color: #999;
            margin: 0;
        }
        #form-message, #form-success {
            display: none;
            padding: 15px;
            margin-top: 15px;
            text-align: center;
        }
        #form-message {
            background: rgba(239, 68, 68, 0.2);
            color: #EF4444;
            border: 1px solid #EF4444;
        }
        #form-success {
            background: rgba(16, 185, 129, 0.2);
            color: #10B981;
            border: 1px solid #10B981;
        }
        #form-message.active, #form-success.active {
            display: block;
        }

        footer {
            background: #000;
            padding: 60px 20px 30px;
            border-top: 1px solid #222;
        }
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }
        .footer-social {
            margin-bottom: 30px;
        }
        .footer-social a {
            color: #fff;
            font-size: 1.8rem;
            margin: 0 15px;
            transition: all 0.3s ease;
        }
        .footer-social a:hover {
            color: #dc2626;
            transform: scale(1.2);
        }
        .copyright {
            color: #666;
            font-size: 0.9rem;
            margin-top: 20px;
        }

        @media (max-width: 900px) {
            .gallery-hero {
                grid-template-columns: 1fr;
            }
        }
        @media (max-width: 768px) {
            .menu-toggle { display: block; }
            nav ul {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background: rgba(0, 0, 0, 0.98);
                padding: 2rem;
                gap: 1rem;
            }
            nav ul.active { display: flex; }
            .project-hero h1 { font-size: 2.5rem; }
            h2 { font-size: 2rem; }
            .contact-container { grid-template-columns: 1fr; }
            .gallery-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
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
                <li><a href="{{ route('projects.index') }}">Projects</a></li>
                <li><a href="{{ route('blogs.index') }}">Blog</a></li>
                <li><a href="{{ route('home') }}#contact">Contact</a></li>
            </ul>
        </div>
    </nav>

    <section class="project-hero" style="background-image: url('{{ $project->main_image ? asset('storage/' . $project->main_image) : asset('assets/img/default-project.jpg') }}');">
        <div class="project-hero-content">
            <h1>{{ strtoupper($project->title) }}</h1>
            <div class="tagline">{{ strtoupper($project->type) }} • {{ strtoupper($project->location) }}</div>
        </div>
    </section>

    <section class="project-details">
        <div class="details-container">
            <div class="project-info-grid">
                <div class="info-card">
                    <h3>Location</h3>
                    <p>{{ $project->location }}</p>
                </div>
                <div class="info-card">
                    <h3>Year Completed</h3>
                    <p>{{ $project->year }}</p>
                </div>
                <div class="info-card">
                    <h3>Project Type</h3>
                    <p>{{ $project->type }}</p>
                </div>
                @if($project->project_area)
                <div class="info-card">
                    <h3>Area</h3>
                    <p>{{ number_format($project->project_area) }} sq ft</p>
                </div>
                @endif
            </div>

            <div class="project-description">
                <h2>PROJECT <span>OVERVIEW</span></h2>
                <p>{{ $project->description }}</p>
            </div>
        </div>
    </section>

    @if(($project->video_url || ($project->gallery_images && count($project->gallery_images) > 0)))
    <section class="project-gallery">
        <div class="section-container">
            <h2>PROJECT <span>GALLERY</span></h2>
            <div class="gallery-hero">
                @if($project->video_url)
                <div class="gallery-video">
                    <iframe id="projectVideo" src="" title="Project Video" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
                </div>
                @elseif($project->gallery_images && count($project->gallery_images) > 0)
                <div class="gallery-video" style="padding-top: 0; height: 100%;">
                    <img src="{{ asset('storage/' . $project->gallery_images[0]) }}" alt="Project image" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                @endif
                <div class="cta-card">
                    <h3>Like This Project?</h3>
                    <p>Let's create something amazing together</p>
                    <a href="#contact" class="cta-button">Start Your Project</a>
                </div>
            </div>
            @if($project->gallery_images && count($project->gallery_images) > ($project->video_url ? 1 : 0))
            <div class="gallery-grid">
                @foreach(array_slice($project->gallery_images, $project->video_url ? 1 : 0) as $image)
                <div class="gallery-item" style="background-image: url('{{ asset('storage/' . $image) }}');" onclick="openLightbox('{{ asset('storage/' . $image) }}')"></div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
    @endif

    @if($relatedProjects->count() > 0)
    <section style="background: #111; padding: 100px 20px;">
        <div class="section-container">
            <h2>RELATED <span>PROJECTS</span></h2>
            <div class="gallery-grid">
                @foreach($relatedProjects as $related)
                <a href="{{ route('projects.show', $related->slug) }}" style="text-decoration: none;">
                    <div class="gallery-item" style="background-image: url('{{ $related->main_image ? asset('storage/' . $related->main_image) : asset('assets/img/default-project.jpg') }}');">
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent); padding: 20px; color: #fff;">
                            <h3 style="font-size: 1.5rem; margin-bottom: 10px;">{{ $related->title }}</h3>
                            <p style="color: #ccc; font-size: 0.9rem;">{{ $related->location }} • {{ $related->year }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section id="contact" style="background: #111;">
        <div class="section-container">
            <h2>GET IN <span>TOUCH</span></h2>
            <div class="contact-container">
                <form id="contact-form">
                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required>
                    <input type="tel" name="phone" placeholder="Your Phone" required>
                    <textarea name="message" placeholder="Your Message" required></textarea>
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
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-social">
                <a href="https://facebook.com/SeptanDevelopers" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://instagram.com/septan_developers" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://linkedin.com/company/septan-developers-pvt-ltd" target="_blank"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <div class="copyright">&copy; 2025 Septan Developers. All rights reserved.</div>
        </div>
    </footer>

    <div class="lightbox" id="lightbox" onclick="closeLightbox()" style="display: none; position: fixed; z-index: 9999; inset: 0; background: rgba(0,0,0,0.95); align-items: center; justify-content: center;">
        <span class="lightbox-close" style="position: absolute; top: 20px; right: 40px; color: #fff; font-size: 40px; cursor: pointer;">&times;</span>
        <img src="" alt="Lightbox image" id="lightbox-img" style="max-width: 90%; max-height: 90%;">
</div>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        function toggleMenu() {
            document.getElementById('nav-menu').classList.toggle('active');
        }

        function openLightbox(src) {
            document.getElementById('lightbox-img').src = src;
            document.getElementById('lightbox').style.display = 'flex';
        }
        function closeLightbox() {
            document.getElementById('lightbox').style.display = 'none';
        }

        function setProjectVideo(youtubeUrl) {
            try {
                if (!youtubeUrl) return;
                const idMatch = youtubeUrl.match(/(?:v=|\.be\/|embed\/)([A-Za-z0-9_-]{11})/);
                const videoId = idMatch ? idMatch[1] : null;
                if (!videoId) return;
                const params = new URLSearchParams({
                    autoplay: '1',
                    mute: '1',
                    controls: '0',
                    rel: '0',
                    playsinline: '1',
                    modestbranding: '1',
                    loop: '1',
                    playlist: videoId
                });
                const src = `https://www.youtube.com/embed/${videoId}?${params.toString()}`;
                const iframe = document.getElementById('projectVideo');
                if (iframe) iframe.src = src;
            } catch (e) { /* no-op */ }
        }

        @if($project->video_url)
        setProjectVideo('{{ $project->video_url }}');
        @endif

        document.getElementById('contact-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const form = e.target;
            const successMessage = document.getElementById('form-success');
            successMessage.textContent = 'Thank you for your message! We\'ll get back to you soon.';
            successMessage.classList.add('active');
            form.reset();
        });
    </script>
</body>
</html>

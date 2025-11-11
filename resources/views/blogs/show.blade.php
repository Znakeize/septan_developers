<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->title }} - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @include('partials.animations-init')
    <link rel="stylesheet" href="{{ asset('assets/css/chatbot.css') }}">
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

        .blog-hero {
            height: 60vh;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 70px;
        }
        .blog-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
        }
        .blog-hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 0 2rem;
            max-width: 900px;
        }
        .blog-category {
            color: #dc2626;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 20px;
            letter-spacing: 3px;
            font-size: 1rem;
        }
        .blog-hero h1 {
            font-size: 3.5rem;
            font-weight: 900;
            letter-spacing: 3px;
            margin-bottom: 20px;
            line-height: 1.2;
        }
        .blog-meta {
            display: flex;
            justify-content: center;
            gap: 30px;
            font-size: 0.9rem;
            color: #999;
            flex-wrap: wrap;
        }
        .blog-meta span {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .blog-meta i {
            color: #dc2626;
        }

        .blog-content {
            padding: 100px 20px;
            background: #111;
        }
        .content-container {
            max-width: 900px;
            margin: 0 auto;
        }
        .featured-image {
            width: 100%;
            height: 500px;
            background-size: cover;
            background-position: center;
            margin-bottom: 60px;
            border: 1px solid #222;
        }
        .blog-content h2 {
            font-size: 2.5rem;
            margin: 50px 0 30px;
            color: #dc2626;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .blog-content h3 {
            font-size: 2rem;
            margin: 40px 0 20px;
            color: #fff;
            letter-spacing: 1px;
        }
        .blog-content p {
            font-size: 1.2rem;
            line-height: 2;
            color: #ccc;
            margin-bottom: 25px;
        }
        .blog-content ul {
            margin: 30px 0;
            padding-left: 40px;
        }
        .blog-content li {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #ccc;
            margin-bottom: 15px;
        }
        .blog-content li strong {
            color: #dc2626;
        }
        
        /* Blog content wrapper styles for rendered HTML */
        .blog-content-wrapper {
            font-size: 1.2rem;
            line-height: 2;
            color: #ccc;
        }
        .blog-content-wrapper p {
            margin-bottom: 25px;
            font-size: 1.2rem;
            line-height: 2;
            color: #ccc;
        }
        .blog-content-wrapper ul,
        .blog-content-wrapper ol {
            margin: 30px 0;
            padding-left: 40px;
        }
        .blog-content-wrapper ul li,
        .blog-content-wrapper ol li {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #ccc;
            margin-bottom: 15px;
        }
        .blog-content-wrapper ul li::marker,
        .blog-content-wrapper ol li::marker {
            color: inherit;
        }
        .blog-content-wrapper h1,
        .blog-content-wrapper h2,
        .blog-content-wrapper h3,
        .blog-content-wrapper h4 {
            margin: 40px 0 20px;
            color: #dc2626;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .blog-content-wrapper h1 {
            font-size: 2.5rem;
        }
        .blog-content-wrapper h2 {
            font-size: 2rem;
        }
        .blog-content-wrapper h3 {
            font-size: 1.75rem;
        }
        .blog-content-wrapper h4 {
            font-size: 1.5rem;
        }
        .blog-content-wrapper a {
            color: #dc2626;
            text-decoration: underline;
        }
        .blog-content-wrapper a:hover {
            color: #fff;
        }
        .blog-content-wrapper blockquote {
            background: rgba(220, 38, 38, 0.05);
            border-left: 5px solid #dc2626;
            padding: 40px;
            margin: 50px 0;
            font-style: italic;
        }
        .blog-content-wrapper blockquote p {
            font-size: 1.4rem;
            color: #fff;
        }
        .quote-box {
            background: rgba(220, 38, 38, 0.05);
            border-left: 5px solid #dc2626;
            padding: 40px;
            margin: 50px 0;
            font-style: italic;
        }
        .quote-box p {
            font-size: 1.4rem;
            color: #fff;
        }
        .tags-section {
            margin-top: 60px;
            padding-top: 40px;
            border-top: 1px solid #333;
        }
        .tags-section h3 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: #dc2626;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .tag {
            background: rgba(220, 38, 38, 0.1);
            color: #dc2626;
            padding: 8px 20px;
            border: 1px solid #dc2626;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        .tag:hover {
            background: #dc2626;
            color: #fff;
        }
        .author-box {
            background: #000;
            border: 1px solid #222;
            padding: 40px;
            margin-top: 60px;
            display: flex;
            gap: 30px;
            align-items: center;
        }
        .author-avatar {
            width: 100px;
            height: 100px;
            background: #dc2626;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            flex-shrink: 0;
        }
        .author-info h4 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #dc2626;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .author-info p {
            font-size: 1rem;
            line-height: 1.6;
            margin: 0;
        }

        .related-posts {
            padding: 100px 20px;
            background: #000;
        }
        .section-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        h2.section-title {
            font-size: 3rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 60px;
            letter-spacing: 3px;
            text-transform: uppercase;
        }
        h2.section-title span {
            color: #dc2626;
        }
        .posts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 40px;
        }
        .post-card {
            background: #111;
            border: 1px solid #222;
            overflow: hidden;
            transition: all 0.4s ease;
            text-decoration: none;
            display: block;
        }
        .post-card:hover {
            transform: translateY(-10px);
            border-color: #dc2626;
            box-shadow: 0 20px 40px rgba(220, 38, 38, 0.2);
        }
        .post-image {
            width: 100%;
            height: 250px;
            background-size: cover;
            background-position: center;
            transition: transform 0.5s ease;
        }
        .post-card:hover .post-image {
            transform: scale(1.1);
        }
        .post-content {
            padding: 30px;
        }
        .post-category {
            color: #dc2626;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 10px;
            letter-spacing: 1px;
            font-size: 0.85rem;
        }
        .post-content h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .post-date {
            color: #666;
            font-size: 0.85rem;
            margin-bottom: 15px;
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
        #form-success {
            display: none;
            padding: 15px;
            margin-top: 15px;
            text-align: center;
            background: rgba(16, 185, 129, 0.2);
            color: #10B981;
            border: 1px solid #10B981;
        }
        #form-success.active {
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
        .footer-links {
            margin-bottom: 20px;
        }
        .footer-links a {
            color: #999;
            text-decoration: none;
            margin: 0 15px;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 1px;
        }
        .footer-links a:hover {
            color: #dc2626;
        }
        .copyright {
            color: #666;
            font-size: 0.9rem;
            margin-top: 20px;
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
            .blog-hero h1 { font-size: 2rem; }
            .contact-container, .posts-grid { grid-template-columns: 1fr; }
            .author-box { flex-direction: column; text-align: center; }
        }
    </style>
</head>
<body>
    @include('partials.page-loader')
    <nav>
        <div class="nav-container">
            <div class="logo"><a href="{{ route('home') }}" style="display:inline-flex;align-items:center;gap:10px;text-decoration:none;">
                <img src="{{ asset('assets/img/logo-sample.svg') }}" alt="Septan" style="height:32px;display:block;"/>
                <span style="font-weight:900;letter-spacing:2px;color:#dc2626;">SEPTAN</span>
            </a></div>
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

    <section class="blog-hero" style="background-image: url('{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('assets/img/default-blog.jpg') }}');">
        <div class="blog-hero-content">
            <div class="blog-category">{{ $blog->category }}</div>
  <h1>{{ $blog->title }}</h1>
            <div class="blog-meta">
                <span><i class="fas fa-calendar"></i> {{ $blog->published_date->format('F d, Y') }}</span>
                <span><i class="fas fa-user"></i> {{ $blog->user->name ?? 'Admin' }}</span>
                <span><i class="fas fa-clock"></i> {{ $blog->reading_time }} min read</span>
                <span><i class="fas fa-eye"></i> {{ number_format($blog->views) }} views</span>
            </div>
        </div>
    </section>

    <section class="blog-content" data-aos="fade-up">
        <div class="content-container">
            <div class="featured-image" style="background-image: url('{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('assets/img/default-blog.jpg') }}');"></div>

            <p style="font-size: 1.4rem; color: #999; font-style: italic; margin-bottom: 40px;">{{ $blog->excerpt }}</p>

            <div class="blog-content-wrapper">
                {!! $blog->content !!}
            </div>

            @if($blog->tags && count($blog->tags) > 0)
            <div class="tags-section">
                <h3>Tags</h3>
                <div class="tags">
                    @foreach($blog->tags as $tag)
                    <span class="tag">{{ $tag }}</span>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="author-box">
                <div class="author-avatar">
                    {{ strtoupper(substr($blog->user->name ?? 'A', 0, 1)) }}
                </div>
                <div class="author-info">
                    <h4>{{ $blog->user->name ?? 'Admin' }}</h4>
                    <p>Content creator at Septan Developers. Our team has extensive experience creating content that balances aesthetic sophistication with practical insights.</p>
                </div>
            </div>
        </div>
    </section>

    @if($relatedBlogs->count() > 0)
    <section class="related-posts" data-aos="fade-up">
        <div class="section-container">
            <h2 class="section-title">RELATED <span>ARTICLES</span></h2>
            <div class="posts-grid">
                @foreach($relatedBlogs as $related)
                <a href="{{ route('blogs.show', $related->slug) }}" class="post-card">
                    <div class="post-image" style="background-image: url('{{ $related->featured_image ? asset('storage/' . $related->featured_image) : asset('assets/img/default-blog.jpg') }}');"></div>
                    <div class="post-content">
                        <div class="post-category">{{ $related->category }}</div>
                        <h3>{{ $related->title }}</h3>
                        <div class="post-date">{{ $related->published_date->format('F d, Y') }}</div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section id="contact" style="background: #111;" data-aos="fade-up">
        <div class="section-container">
            <h2 class="section-title">GET IN <span>TOUCH</span></h2>
            <div class="contact-container">
                <form id="contact-form">
                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required>
                    <input type="tel" name="phone" placeholder="Your Phone" required>
                    <textarea name="message" placeholder="Your Message" required></textarea>
                    <button type="submit">Send Message</button>
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
                <a href="https://tiktok.com/@septandevelopers" target="_blank"><i class="fab fa-tiktok"></i></a>
                <a href="https://youtube.com/@SeptanDevelopers" target="_blank"><i class="fab fa-youtube"></i></a>
            </div>
            <div class="footer-links">
                <a href="{{ route('legal.terms') }}">Terms</a>
                <a href="{{ route('legal.privacy') }}">Privacy</a>
            </div>
            <div class="copyright">&copy; 2025 Septan Developers. All rights reserved.</div>
</div>
    </footer>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        function toggleMenu() {
            document.getElementById('nav-menu').classList.toggle('active');
        }

        document.getElementById('contact-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const form = e.target;
            const successMessage = document.getElementById('form-success');
            successMessage.textContent = 'Thank you for your message! We\'ll get back to you soon.';
            successMessage.classList.add('active');
            form.reset();
        });
    </script>
    @include('partials.animations-script')
    
    <!-- Septan AI Chatbot -->
    @include('partials.chatbot')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        .blogs-page-header {
            min-height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.2), rgba(0, 0, 0, 0.9)), url('{{ asset('assets/img/seamless-regeneration-in-the-jungle-5-633956dc14e9a-5316f9fa.jpg') }}');
            background-size: cover;
            background-position: center;
            padding: 150px 20px 80px;
            text-align: center;
        }
        .blogs-page-header h1 {
            font-size: 48px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        .blogs-page-header p {
            font-size: 18px;
            opacity: 0.9;
        }
        .blogs-section {
            padding: 80px 20px;
            max-width: 1400px;
            margin: 0 auto;
        }
        .blogs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 40px;
            margin-top: 40px;
        }
        .blog-card {
            background: #1a1a1a;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
            cursor: pointer;
        }
        .blog-card:hover {
            transform: translateY(-10px);
        }
        .blog-image {
            width: 100%;
            height: 250px;
            background-size: cover;
            background-position: center;
        }
        .blog-content {
            padding: 30px;
        }
        .blog-category {
            display: inline-block;
            background: #dc2626;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 15px;
        }
        .blog-content h3 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #fff;
        }
        .blog-date {
            color: #999;
            font-size: 14px;
            margin-bottom: 15px;
        }
        .blog-excerpt {
            color: #ccc;
            margin-bottom: 15px;
            line-height: 1.6;
        }
        .blog-meta {
            display: flex;
            gap: 20px;
            font-size: 13px;
            color: #999;
            margin-bottom: 15px;
        }
        .blog-link {
            color: #dc2626;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: gap 0.3s;
        }
        .blog-link:hover {
            gap: 12px;
        }
        .pagination {
            margin-top: 60px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .pagination a, .pagination span {
            padding: 10px 20px;
            background: #1a1a1a;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .pagination a:hover {
            background: #dc2626;
        }
        .pagination span {
            background: #dc2626;
        }
        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }
        .empty-state i {
            font-size: 64px;
            color: #666;
            margin-bottom: 20px;
        }
        .empty-state p {
            font-size: 18px;
            color: #999;
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

    <section class="blogs-page-header">
        <div>
            <h1>OUR <span style="color: #dc2626;">BLOG</span></h1>
            <p>Insights, news, and updates from the construction industry</p>
        </div>
    </section>

    <section class="blogs-section">
        @if($blogs->count() > 0)
        <div class="blogs-grid">
            @foreach($blogs as $blog)
            <div class="blog-card" onclick="window.location.href='{{ route('blogs.show', $blog->slug) }}'" style="cursor: pointer;">
                <div class="blog-image" style="background-image: url('{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('assets/img/default-blog.jpg') }}');"></div>
                <div class="blog-content">
                    <span class="blog-category">{{ $blog->category }}</span>
                    <h3>{{ $blog->title }}</h3>
                    <div class="blog-date">{{ $blog->published_date->format('F d, Y') }}</div>
                    <p class="blog-excerpt">{{ Str::limit($blog->excerpt, 120) }}</p>
                    <div class="blog-meta">
                        <span><i class="fas fa-user"></i> {{ $blog->user->name ?? 'Admin' }}</span>
                        <span><i class="fas fa-clock"></i> {{ $blog->reading_time }} min read</span>
                        <span><i class="fas fa-eye"></i> {{ number_format($blog->views) }} views</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="pagination">
            {{ $blogs->links() }}
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-newspaper"></i>
            <p>No blog articles available at the moment. Check back soon!</p>
        </div>
        @endif
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

    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>

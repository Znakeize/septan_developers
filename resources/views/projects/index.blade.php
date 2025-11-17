<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @include('partials.animations-init')
    <link rel="stylesheet" href="{{ asset('assets/css/chatbot.css') }}">
    <style>
        .projects-page-header {
            min-height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.2), rgba(0, 0, 0, 0.9)), url('{{ asset('assets/img/amila_ruwan-liyanapathirana-wood-locally-bricks-hotel-moksha-nature-sri-lanka-designboom-03-1-b5a51208.jpg') }}');
            background-size: cover;
            background-position: center;
            padding: 150px 20px 80px;
            text-align: center;
        }
        .projects-page-header h1 {
            font-size: 48px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        .projects-page-header p {
            font-size: 18px;
            opacity: 0.9;
        }
        .projects-section {
            padding: 80px 20px;
            max-width: 1400px;
            margin: 0 auto;
        }
        .projects-filters { text-align: center; margin-top: 10px; }
        .projects-filters button {
            background: transparent;
            border: 2px solid #dc2626;
            color: #dc2626;
            padding: 0.6rem 1.4rem;
            margin: 0.35rem;
            cursor: pointer;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
            transition: all 0.25s ease;
        }
        .projects-filters button:hover,
        .projects-filters button.active { background: #dc2626; color: #fff; }
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 40px;
            margin-top: 40px;
        }
        /* Enable filtering on this page */
        .projects-grid .project-card { display: none; }
        .projects-grid .project-card.active { display: block; }
        .project-card {
            background: #1a1a1a;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
            cursor: pointer;
        }
        .project-card:hover {
            transform: translateY(-10px);
        }
        .project-image {
            width: 100%;
            height: 300px;
            background-size: cover;
            background-position: center;
        }
        .project-content {
            padding: 30px;
        }
        .project-content h3 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #fff;
        }
        .project-content p {
            color: #ccc;
            margin-bottom: 10px;
            font-size: 14px;
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

    <section class="project-hero blog-hero" style="position:relative;">
        <div class="hero-slides">
            @php
                $slideProjects = $projects->take(8);
            @endphp
            @forelse($slideProjects as $idx => $p)
                <div class="hero-slide {{ $idx === 0 ? 'active' : '' }}" style="background-image: url('{{ $p->main_image ? asset('storage/' . $p->main_image) : asset('assets/img/default-project.jpg') }}');"></div>
            @empty
                <div class="hero-slide active" style="background-image: url('{{ asset('assets/img/amila_ruwan-liyanapathirana-wood-locally-bricks-hotel-moksha-nature-sri-lanka-designboom-03-1-b5a51208.jpg') }}');"></div>
                <div class="hero-slide" style="background-image: url('{{ asset('assets/img/seamless-regeneration-in-the-jungle-5-633956dc14e9a-5316f9fa.jpg') }}');"></div>
                <div class="hero-slide" style="background-image: url('{{ asset('assets/img/palinda-kannagara-linear-house-at-battaramulla-sri-lanka-designboom-mobile-55e43d88.jpg') }}');"></div>
            @endforelse
        </div>
        <div class="blog-hero-content" style="position:relative;z-index:2;text-align:center;padding:0 2rem;">
            <h1>OUR <span style="color:#dc2626;">PROJECTS</span></h1>
            <p>Explore our portfolio of innovative construction and design projects</p>
        </div>
    </section>

    <section class="projects-section" data-aos="fade-up">
        @php
            $categories = $projects->pluck('category')->filter()->unique()->values();
            $hasRenovation = $categories->contains(function($c){ return strtolower($c) === 'renovation'; });
        @endphp
        @if($projects->count() > 0)
        <div class="projects-filters">
            <button class="active" data-filter="all">All</button>
            @foreach($categories as $cat)
                <button data-filter="{{ $cat }}">{{ ucfirst($cat) }}</button>
            @endforeach
            @if(!$hasRenovation)
                <button data-filter="renovation">Renovation</button>
            @endif
        </div>
        <div class="projects-grid">
            @foreach($projects as $project)
            <div class="project-card active" data-category="{{ $project->category }}" onclick="window.location.href='{{ route('projects.show', $project->slug) }}'" style="cursor: pointer;">
                <div class="project-image" style="background-image: url('{{ $project->main_image ? asset('storage/' . $project->main_image) : asset('assets/img/default-project.jpg') }}');"></div>
                <div class="project-content">
                    <h3>{{ $project->title }}</h3>
                    <p>{{ $project->location }} • {{ $project->year }}</p>
                    <p style="color:#dc2626;text-transform:uppercase;font-weight:700;">{{ $project->type }}</p>
                    <p class="project-excerpt">{{ Str::limit($project->description, 120) }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="pagination">
            {{ $projects->links() }}
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-folder-open"></i>
            <p>No projects available at the moment. Check back soon!</p>
        </div>
        @endif
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
            <div class="copyright">&copy; 2025 Septan Developers. All rights reserved. <br><span style="font-weight:900;letter-spacing:2px;color:#dc2626;">SEPTAN</span></div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    @include('partials.animations-script')
    
    <!-- Septan AI Chatbot -->
    @include('partials.chatbot')
</body>
</html>

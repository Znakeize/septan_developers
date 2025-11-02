<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
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
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 40px;
            margin-top: 40px;
        }
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

    <section class="projects-page-header">
        <div>
            <h1>OUR <span style="color: #dc2626;">PROJECTS</span></h1>
            <p>Explore our portfolio of innovative construction and design projects</p>
        </div>
    </section>

    <section class="projects-section">
        @if($projects->count() > 0)
        <div class="projects-grid">
            @foreach($projects as $project)
            <div class="project-card" onclick="window.location.href='{{ route('projects.show', $project->slug) }}'" style="cursor: pointer;">
                <div class="project-image" style="background-image: url('{{ $project->main_image ? asset('storage/' . $project->main_image) : asset('assets/img/default-project.jpg') }}');"></div>
                <div class="project-content">
                    <h3>{{ $project->title }}</h3>
                    <p><strong>Location:</strong> {{ $project->location }} | <strong>Year:</strong> {{ $project->year }}</p>
                    <p><strong>Type:</strong> {{ $project->type }}</p>
                    <p><strong>Category:</strong> {{ ucfirst($project->category) }}</p>
                    <p style="margin-top: 15px; line-height: 1.6;">{{ Str::limit($project->description, 150) }}</p>
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
            </div>
            <div class="copyright">&copy; 2025 Septan Developers. All rights reserved.</div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>

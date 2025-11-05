<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; background: #000; color: #fff; overflow-x: hidden; }
        
        .admin-container { display: flex; min-height: 100vh; }
        .sidebar { width: 260px; background: #111; color: #fff; padding: 20px 0; position: fixed; height: 100vh; overflow-y: auto; border-right: 1px solid #222; }
        .sidebar-header { padding: 0 20px 30px; border-bottom: 1px solid #333; }
        .sidebar-header h2 { font-size: 24px; color: #dc2626; font-weight: 900; letter-spacing: 2px; }
        .sidebar-menu { padding: 20px 0; }
        .menu-item { padding: 12px 20px; color: #ccc; text-decoration: none; display: flex; align-items: center; gap: 12px; transition: all 0.3s; }
        .menu-item:hover, .menu-item.active { background: #dc2626; color: #fff; }
        .menu-item i { width: 20px; }
        
        .main-content { flex: 1; margin-left: 260px; padding: 30px; background: #000; }
        .page-header { background: #111; padding: 30px; border-radius: 10px; margin-bottom: 30px; border: 1px solid #222; }
        .page-header h1 { font-size: 32px; color: #fff; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 2px; }
        .page-header p { color: #999; }
        
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px; margin-bottom: 30px; }
        .stat-card { background: #111; padding: 30px; border-radius: 10px; border: 1px solid #222; transition: all 0.3s; }
        .stat-card:hover { border-color: #dc2626; transform: translateY(-5px); }
        .stat-card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .stat-card-header h3 { font-size: 14px; color: #999; text-transform: uppercase; font-weight: 600; letter-spacing: 1px; }
        .stat-card-header i { font-size: 24px; color: #dc2626; }
        .stat-card-value { font-size: 36px; font-weight: bold; color: #fff; margin-bottom: 10px; }
        .stat-card-change { font-size: 14px; color: #dc2626; }
        
        .quick-actions { background: #111; padding: 30px; border-radius: 10px; border: 1px solid #222; margin-bottom: 30px; }
        .quick-actions h2 { font-size: 20px; color: #dc2626; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 1px; }
        .actions-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; }
        .action-btn { padding: 20px; background: #000; border: 1px solid #222; border-radius: 8px; text-decoration: none; color: #ccc; display: flex; align-items: center; gap: 12px; transition: all 0.3s; }
        .action-btn:hover { background: #dc2626; color: #fff; border-color: #dc2626; transform: translateY(-3px); }
        .action-btn i { font-size: 24px; }
        .action-btn span { font-weight: 500; }
        
        .recent-activity { background: #111; padding: 30px; border-radius: 10px; border: 1px solid #222; }
        .recent-activity h2 { font-size: 20px; color: #dc2626; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 1px; }
        .activity-item { padding: 15px; border-bottom: 1px solid #222; display: flex; align-items: center; gap: 15px; }
        .activity-item:last-child { border-bottom: none; }
        .activity-icon { width: 40px; height: 40px; border-radius: 50%; background: #000; border: 1px solid #222; display: flex; align-items: center; justify-content: center; }
        .activity-icon i { color: #dc2626; }
        .activity-content h4 { font-size: 14px; color: #fff; margin-bottom: 5px; }
        .activity-content p { font-size: 12px; color: #999; }
    </style>
</head>
<body>
    <div class="admin-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('admin.dashboard') }}" style="display:inline-flex;align-items:center;gap:10px;text-decoration:none;padding:6px 0;">
                    <img src="{{ asset('assets/img/logo-sample.svg') }}" alt="Septan" style="height:32px;display:block;"/>
                </a>
            </div>
            <nav class="sidebar-menu">
                <a href="{{ route('admin.dashboard') }}" class="menu-item active">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="{{ route('admin.projects.index') }}" class="menu-item">
                    <i class="fas fa-building"></i> Projects
                </a>
                <a href="{{ route('admin.blogs.index') }}" class="menu-item">
                    <i class="fas fa-newspaper"></i> Blog Articles
                </a>
                <a href="{{ route('admin.settings.index') }}" class="menu-item">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <a href="{{ route('admin.social.index') }}" class="menu-item">
                    <i class="fas fa-share-alt"></i> Social Media
                </a>
                <a href="{{ route('home') }}" class="menu-item">
                    <i class="fas fa-globe"></i> View Website
                </a>
                <a href="{{ route('logout') }}" class="menu-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </nav>
        </aside>

        <main class="main-content">
            <div class="page-header">
                <h1>Dashboard</h1>
                <p>Welcome back, {{ auth()->user()->name }}!</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-card-header">
                        <h3>Total Projects</h3>
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="stat-card-value">{{ \App\Models\Project::count() }}</div>
                    <div class="stat-card-change">
                        <i class="fas fa-arrow-up"></i> {{ \App\Models\Project::where('is_published', true)->count() }} published
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-card-header">
                        <h3>Blog Articles</h3>
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="stat-card-value">{{ \App\Models\Blog::count() }}</div>
                    <div class="stat-card-change">
                        <i class="fas fa-arrow-up"></i> {{ \App\Models\Blog::where('is_published', true)->count() }} published
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-card-header">
                        <h3>Total Views</h3>
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-card-value">{{ number_format(\App\Models\Blog::sum('views')) }}</div>
                    <div class="stat-card-change">
                        <i class="fas fa-chart-line"></i> Blog views
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-card-header">
                        <h3>Featured Projects</h3>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-card-value">{{ \App\Models\Project::where('is_featured', true)->count() }}</div>
                    <div class="stat-card-change">
                        <i class="fas fa-check-circle"></i> Featured
                    </div>
                </div>
            </div>

            <div class="quick-actions">
                <h2>Quick Actions</h2>
                <div class="actions-grid">
                    <a href="{{ route('admin.projects.create') }}" class="action-btn">
                        <i class="fas fa-plus-circle"></i>
                        <span>Add Project</span>
                    </a>
                    <a href="{{ route('admin.blogs.create') }}" class="action-btn">
                        <i class="fas fa-edit"></i>
                        <span>Write Article</span>
                    </a>
                    <a href="{{ route('admin.projects.index') }}" class="action-btn">
                        <i class="fas fa-list"></i>
                        <span>Manage Projects</span>
                    </a>
                    <a href="{{ route('admin.blogs.index') }}" class="action-btn">
                        <i class="fas fa-newspaper"></i>
                        <span>Manage Articles</span>
                    </a>
                    <a href="{{ route('admin.social.index') }}" class="action-btn">
                        <i class="fas fa-share-alt"></i>
                        <span>Social Media Control</span>
                    </a>
                </div>
            </div>

            <div class="recent-activity">
                <h2>Recent Activity</h2>
                @php
                    $recentProjects = \App\Models\Project::latest()->limit(5)->get();
                    $recentBlogs = \App\Models\Blog::latest()->limit(5)->get();
                    $recentItems = $recentProjects->concat($recentBlogs)->sortByDesc('created_at')->take(5);
                @endphp

                @if($recentItems->count() > 0)
                    @foreach($recentItems as $item)
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas {{ $item instanceof \App\Models\Project ? 'fa-building' : 'fa-newspaper' }}"></i>
                        </div>
                        <div class="activity-content">
                            <h4>{{ $item instanceof \App\Models\Project ? 'New Project' : 'New Article' }}: {{ $item->title }}</h4>
                            <p>{{ $item->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p style="color: #999; padding: 20px; text-align: center;">No recent activity</p>
                @endif
            </div>
        </main>
</div>
</body>
</html>

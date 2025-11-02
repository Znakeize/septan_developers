<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Projects - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; background: #000; color: #fff; overflow-x: hidden; }
        
        .admin-container { display: flex; min-height: 100vh; }
        
        /* Sidebar */
        .sidebar { width: 260px; background: #111; color: #fff; padding: 20px 0; position: fixed; height: 100vh; overflow-y: auto; border-right: 1px solid #222; }
        .sidebar-header { padding: 0 20px 30px; border-bottom: 1px solid #333; }
        .sidebar-header h2 { font-size: 24px; color: #dc2626; font-weight: 900; letter-spacing: 2px; }
        .sidebar-menu { padding: 20px 0; }
        .menu-item { padding: 12px 20px; color: #ccc; text-decoration: none; display: flex; align-items: center; gap: 12px; transition: all 0.3s; }
        .menu-item:hover, .menu-item.active { background: #dc2626; color: #fff; }
        .menu-item i { width: 20px; }
        
        /* Main Content */
        .main-content { flex: 1; margin-left: 260px; padding: 30px; background: #000; }
        .top-bar { background: #111; padding: 20px 30px; border-radius: 10px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; border: 1px solid #222; }
        .top-bar h1 { font-size: 28px; color: #fff; text-transform: uppercase; letter-spacing: 2px; }
        .add-btn { background: #dc2626; color: #fff; padding: 12px 24px; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; font-weight: 500; transition: all 0.3s; }
        .add-btn:hover { background: #b91c1c; transform: translateY(-2px); }
        
        /* Projects Grid */
        .projects-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px; }
        .project-card { background: #111; border-radius: 10px; overflow: hidden; border: 1px solid #222; transition: all 0.3s; }
        .project-card:hover { transform: translateY(-5px); border-color: #dc2626; }
        .project-image { width: 100%; height: 200px; object-fit: cover; }
        .project-content { padding: 20px; }
        .project-title { font-size: 18px; font-weight: bold; margin-bottom: 10px; color: #fff; }
        .project-meta { display: flex; gap: 15px; margin-bottom: 15px; font-size: 14px; color: #999; }
        .project-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; margin-right: 8px; }
        .badge-residential { background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid #10b981; }
        .badge-commercial { background: rgba(59, 130, 246, 0.1); color: #3b82f6; border: 1px solid #3b82f6; }
        .badge-renovation { background: rgba(245, 158, 11, 0.1); color: #f59e0b; border: 1px solid #f59e0b; }
        .badge-published { background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid #10b981; }
        .badge-draft { background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid #ef4444; }
        .project-actions { display: flex; gap: 10px; margin-top: 15px; }
        .btn { padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 500; display: inline-flex; align-items: center; gap: 6px; transition: all 0.3s; border: none; cursor: pointer; }
        .btn-view { background: #3b82f6; color: #fff; }
        .btn-edit { background: #f59e0b; color: #fff; }
        .btn-delete { background: #ef4444; color: #fff; }
        .btn:hover { opacity: 0.9; transform: translateY(-2px); }
        
        .alert { padding: 15px 20px; border-radius: 8px; margin-bottom: 20px; }
        .alert-success { background: rgba(16, 185, 129, 0.1); color: #10b981; border-left: 4px solid #10b981; }
        
        .pagination { margin-top: 30px; display: flex; justify-content: center; }
        .pagination a, .pagination span { padding: 8px 16px; margin: 0 4px; border-radius: 6px; text-decoration: none; background: #111; color: #ccc; border: 1px solid #222; }
        .pagination a:hover { background: #dc2626; color: #fff; border-color: #dc2626; }
        .pagination span { background: #dc2626; color: #fff; border-color: #dc2626; }
    </style>
</head>
<body>
    <div class="admin-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>SEPTAN ADMIN</h2>
            </div>
            <nav class="sidebar-menu">
                <a href="{{ route('admin.dashboard') }}" class="menu-item">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="{{ route('admin.projects.index') }}" class="menu-item active">
                    <i class="fas fa-building"></i> Projects
                </a>
                <a href="{{ route('admin.blogs.index') }}" class="menu-item">
                    <i class="fas fa-newspaper"></i> Blog Articles
                </a>
                <a href="{{ route('admin.settings.index') }}" class="menu-item">
                    <i class="fas fa-cog"></i> Settings
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
            <div class="top-bar">
                <h1>Manage Projects</h1>
                <a href="{{ route('admin.projects.create') }}" class="add-btn">
                    <i class="fas fa-plus"></i> Add New Project
                </a>
            </div>

            @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
            @endif

            @if($projects->count() > 0)
            <div class="projects-grid">
    @foreach($projects as $project)
                <div class="project-card">
                    @if($project->main_image)
                    <img src="{{ asset('storage/' . $project->main_image) }}" alt="{{ $project->title }}" class="project-image">
                    @else
                    <div class="project-image" style="background: #ddd; display: flex; align-items: center; justify-content: center; color: #999;">
                        <i class="fas fa-image" style="font-size: 48px;"></i>
                    </div>
                    @endif
                    <div class="project-content">
                        <h3 class="project-title">{{ $project->title }}</h3>
                        <div class="project-meta">
                            <span><i class="fas fa-map-marker-alt"></i> {{ $project->location }}</span>
                            <span><i class="fas fa-calendar"></i> {{ $project->year }}</span>
                        </div>
                        <div>
                            <span class="project-badge badge-{{ $project->category }}">{{ ucfirst($project->category) }}</span>
                            <span class="project-badge {{ $project->is_published ? 'badge-published' : 'badge-draft' }}">
                                {{ $project->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </div>
                        <div class="project-actions">
                            <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-view" target="_blank">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this project?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
    @endforeach
            </div>

            <div class="pagination">
                {{ $projects->links() }}
            </div>
            @else
            <div style="background: #fff; padding: 40px; border-radius: 10px; text-align: center;">
                <i class="fas fa-inbox" style="font-size: 64px; color: #ddd; margin-bottom: 20px;"></i>
                <p style="color: #666; font-size: 18px;">No projects found. Create your first project!</p>
            </div>
            @endif
        </main>
</div>
</body>
</html>

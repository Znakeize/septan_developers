<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Blog Articles - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; background: #000; color: #fff; overflow-x: hidden; }
        
        .admin-container { display: flex; min-height: 100vh; }
        .sidebar { width: 260px; background: #111; color: #fff; padding: 20px 0; position: fixed; height: 100vh; border-right: 1px solid #222; }
        .sidebar-header { padding: 0 20px 30px; border-bottom: 1px solid #333; }
        .sidebar-header h2 { font-size: 24px; color: #dc2626; font-weight: 900; letter-spacing: 2px; }
        .sidebar-menu { padding: 20px 0; }
        .menu-item { padding: 12px 20px; color: #ccc; text-decoration: none; display: flex; align-items: center; gap: 12px; transition: all 0.3s; }
        .menu-item:hover, .menu-item.active { background: #dc2626; color: #fff; }
        
        .main-content { flex: 1; margin-left: 260px; padding: 30px; background: #000; }
        .top-bar { background: #111; padding: 20px 30px; border-radius: 10px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; border: 1px solid #222; }
        .top-bar h1 { font-size: 28px; color: #fff; text-transform: uppercase; letter-spacing: 2px; }
        .add-btn { background: #dc2626; color: #fff; padding: 12px 24px; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; font-weight: 500; transition: all 0.3s; }
        .add-btn:hover { background: #b91c1c; transform: translateY(-2px); }
        
        .blogs-table { background: #111; border-radius: 10px; border: 1px solid #222; overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        thead { background: #000; }
        th { text-align: left; padding: 15px 20px; font-weight: 600; color: #dc2626; text-transform: uppercase; font-size: 13px; border-bottom: 2px solid #222; letter-spacing: 1px; }
        td { padding: 15px 20px; border-bottom: 1px solid #222; }
        tr:hover { background: rgba(220, 38, 38, 0.05); }
        
        .blog-title-cell { display: flex; align-items: center; gap: 15px; }
        .blog-thumbnail { width: 60px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid #222; }
        .blog-info h4 { font-size: 15px; margin-bottom: 5px; color: #fff; }
        .blog-meta { font-size: 12px; color: #999; }
        
        .badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; }
        .badge-published { background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid #10b981; }
        .badge-draft { background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid #ef4444; }
        
        .action-btns { display: flex; gap: 8px; }
        .btn { padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 13px; display: inline-flex; align-items: center; gap: 5px; transition: all 0.3s; border: none; cursor: pointer; }
        .btn-view { background: #3b82f6; color: #fff; }
        .btn-edit { background: #f59e0b; color: #fff; }
        .btn-delete { background: #ef4444; color: #fff; }
        .btn:hover { opacity: 0.9; transform: translateY(-2px); }
        
        .alert-success { padding: 15px 20px; background: rgba(16, 185, 129, 0.1); color: #10b981; border-left: 4px solid #10b981; border-radius: 8px; margin-bottom: 20px; }
        
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
                <a href="{{ route('admin.projects.index') }}" class="menu-item">
                    <i class="fas fa-building"></i> Projects
                </a>
                <a href="{{ route('admin.blogs.index') }}" class="menu-item active">
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
                <h1>Manage Blog Articles</h1>
                <a href="{{ route('admin.blogs.create') }}" class="add-btn">
                    <i class="fas fa-plus"></i> Add New Article
                </a>
            </div>

            @if(session('success'))
            <div class="alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
            @endif

            @if($blogs->count() > 0)
            <div class="blogs-table">
                <table>
                    <thead>
                        <tr>
                            <th>Article</th>
                            <th>Category</th>
                            <th>Published</th>
                            <th>Views</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
    @foreach($blogs as $blog)
                        <tr>
                            <td>
                                <div class="blog-title-cell">
                                    @if($blog->featured_image)
                                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="blog-thumbnail">
                                    @else
                                    <div class="blog-thumbnail" style="background: #ddd; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-image" style="color: #999;"></i>
                                    </div>
                                    @endif
                                    <div class="blog-info">
                                        <h4>{{ Str::limit($blog->title, 50) }}</h4>
                                        <div class="blog-meta">
                                            By {{ $blog->user->name ?? 'Unknown' }} • {{ $blog->reading_time }} min read
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $blog->category }}</td>
                            <td>{{ $blog->published_date->format('M d, Y') }}</td>
                            <td>{{ number_format($blog->views) }}</td>
                            <td>
                                <span class="badge {{ $blog->is_published ? 'badge-published' : 'badge-draft' }}">
                                    {{ $blog->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-view" target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this article?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $blogs->links() }}
            </div>
            @else
            <div style="background: #fff; padding: 40px; border-radius: 10px; text-align: center;">
                <i class="fas fa-inbox" style="font-size: 64px; color: #ddd; margin-bottom: 20px;"></i>
                <p style="color: #666; font-size: 18px;">No blog articles found. Create your first article!</p>
            </div>
            @endif
        </main>
</div>
</body>
</html>

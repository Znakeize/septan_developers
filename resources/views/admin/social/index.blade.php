<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Social Media - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; background: #000; color:#e5e5e5; }
        .admin-container { display: flex; min-height: 100vh; }
        .sidebar { width: 260px; background: #1a1a1a; color: #fff; padding: 20px 0; position: fixed; height: 100vh; overflow-y: auto; }
        .main-content { flex: 1; margin-left: 260px; padding: 30px; }
        .section { background: #0f0f0f; padding: 30px; border-radius: 10px; border: 1px solid #222; margin-bottom: 30px; }
        .page-header { background: #111; padding: 30px; border-radius: 10px; margin-bottom: 30px; border: 1px solid #222; }
        .page-header h1 { font-size: 28px; color: #fff; }
        .tabs { background:#0f0f0f; border:1px solid #222; border-radius:10px; display:flex; gap:10px; padding:6px; margin-bottom:20px; }
        .tab { padding:10px 16px; border-radius:8px; cursor:pointer; color:#ccc; }
        .tab.active { background:#dc2626; color:#fff; }
        .grid { display:grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 20px; }
        .card { background:#0b0b0b; border:1px solid #222; border-radius:10px; padding:16px; }
        .card:hover { border-color:#dc2626; }
        .btn { padding: 10px 16px; border: none; border-radius: 8px; cursor: pointer; font-weight: 500; display: inline-flex; align-items: center; gap: 8px; }
        .btn-primary { background:#dc2626; color:#fff; }
        .btn-secondary { background:#333; color:#fff; }
        .btn-danger { background:#ef4444; color:#fff; }
        .table { width:100%; border-collapse: collapse; }
        .table th { text-align:left; padding:12px; font-size:12px; color:#dc2626; border-bottom:1px solid #222; letter-spacing:1px; }
        .table td { padding:12px; border-bottom:1px solid #222; font-size:14px; }
        .status { padding:4px 10px; border-radius:14px; font-size:12px; border:1px solid #333; }
        .status.published { background: rgba(16,185,129,.1); color:#10b981; border-color:#10b981; }
        .status.pending { background: rgba(245,158,11,.1); color:#f59e0b; border-color:#f59e0b; }
        .status.failed { background: rgba(239,68,68,.1); color:#ef4444; border-color:#ef4444; }
        .platform-chip { padding:4px 10px; border-radius:14px; font-size:12px; border:1px solid #333; margin-right:6px; }
        .platform-chip.facebook { border-color:#1877f2; color:#1877f2; background: rgba(24,119,242,.1); }
        .platform-chip.twitter { border-color:#1da1f2; color:#1da1f2; background: rgba(29,161,242,.1); }
        .platform-chip.instagram { border-color:#e1306c; color:#e1306c; background: rgba(225,48,108,.1); }
        .platform-chip.linkedin { border-color:#0077b5; color:#0077b5; background: rgba(0,119,181,.1); }
        .content-grid { display:grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap:20px; }
        .content-card { background:#0b0b0b; border:1px solid #222; border-radius:10px; overflow:hidden; display:flex; flex-direction:column; }
        .content-card img { width:100%; height:160px; object-fit:cover; }
        .content-card .body { padding:16px; }
        .content-meta { display:flex; justify-content:space-between; align-items:center; padding:12px 16px; border-top:1px solid #222; }
        .pill { padding:4px 10px; background:#111; color:#aaa; border-radius:999px; font-size:12px; border:1px solid #222; }
    </style>
    </head>
<body>
    <div class="admin-container">
        <aside class="sidebar">
            <div style="padding:16px 20px; border-bottom:1px solid #333;">
                <a href="{{ route('admin.dashboard') }}" style="display:inline-flex;align-items:center;gap:10px;text-decoration:none;">
                    <img src="{{ asset('assets/img/logo-sample.svg') }}" alt="Septan" style="height:32px;display:block;"/>
                </a>
            </div>
            <nav style="padding: 10px 0;">
                <a href="{{ route('admin.dashboard') }}" class="menu-item" style="display:block;color:#ccc;padding:10px 20px;text-decoration:none;">Dashboard</a>
                <a href="{{ route('admin.projects.index') }}" class="menu-item" style="display:block;color:#ccc;padding:10px 20px;text-decoration:none;">Projects</a>
                <a href="{{ route('admin.blogs.index') }}" class="menu-item" style="display:block;color:#ccc;padding:10px 20px;text-decoration:none;">Blogs</a>
                <a href="{{ route('admin.social.index') }}" class="menu-item" style="display:block;color:#fff;background:#dc2626;padding:10px 20px;text-decoration:none;">Social Media</a>
            </nav>
        </aside>
        <main class="main-content">
            <div class="page-header">
                <h1>Social Media Manager</h1>
                <p style="color:#9aa; margin-top:6px;">Share your projects and articles across platforms</p>
            </div>

            <div class="tabs">
                <button class="tab active" data-target="#tab-dashboard"><i class="fas fa-gauge"></i> Dashboard</button>
                <button class="tab" data-target="#tab-projects"><i class="fas fa-building"></i> Projects</button>
                <button class="tab" data-target="#tab-articles"><i class="fas fa-newspaper"></i> Articles</button>
            </div>

            <section id="tab-dashboard" class="section">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                    <h2 style="font-size:20px; color:#dc2626;">Connected Accounts</h2>
                    <a href="{{ route('admin.social.connect', 'facebook') }}" class="btn btn-primary"><i class="fas fa-plug"></i> Connect New</a>
                </div>
                <div class="grid">
                    @php
                        $platformIcons = ['facebook' => 'facebook-f','twitter'=>'twitter','instagram'=>'instagram','linkedin'=>'linkedin-in'];
                    @endphp
                    @foreach($accounts as $account)
                        <div class="card" style="border-color: {{ $account->is_active ? '#10b981' : '#222' }};">
                            <div style="display:flex; align-items:center; gap:12px; margin-bottom:10px;">
                                <div class="platform-icon" style="width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:#111;">
                                    <i class="fab fa-{{ $platformIcons[$account->platform] ?? 'share-alt' }}" style="font-size:18px;"></i>
                                </div>
                                <div>
                                    <div style="font-weight:600; color:#fff; text-transform:capitalize;">{{ $account->platform }}</div>
                                    <div style="font-size:12px; color:#999;">{{ $account->platform_username ?? 'Connected' }}</div>
                                </div>
                                <span class="pill" style="margin-left:auto; {{ $account->is_active ? 'color:#10b981;border-color:#10b981;background:rgba(16,185,129,.1);' : '' }}">{{ $account->is_active ? 'Connected' : 'Disconnected' }}</span>
                            </div>
                            <div style="display:flex; gap:8px;">
                                <a href="{{ route('admin.social.connect', $account->platform) }}" class="btn btn-secondary btn-sm"><i class="fas fa-sync"></i> Reconnect</a>
                                <form action="{{ route('admin.social.disconnect', $account) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-unlink"></i> Disconnect</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="section" style="margin-top: -10px;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                    <h2 style="font-size:20px; color:#dc2626;">Published & Scheduled Posts ({{ $posts->total() }})</h2>
                    <div style="display:flex; gap:8px;">
                        <button class="btn btn-secondary" data-filter="all">All</button>
                        <button class="btn btn-secondary" data-filter="published">Published</button>
                        <button class="btn btn-secondary" data-filter="pending">Scheduled</button>
                        <button class="btn btn-secondary" data-filter="failed">Failed</button>
                    </div>
                </div>
                @if($posts->count())
                <div style="overflow-x:auto;">
                    <table class="table" id="postsTable">
                        <thead>
                            <tr>
                                <th>Content</th>
                                <th>Platform</th>
                                <th>Status</th>
                                <th>Scheduled</th>
                                <th>Published</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr data-status="{{ $post->status }}">
                                <td>
                                    <div style="display:flex; align-items:center; gap:12px;">
                                        @if($post->project)
                                            <img src="{{ $post->project->main_image ? asset('storage/' . $post->project->main_image) : asset('assets/img/default-project.jpg') }}" style="width:56px;height:56px;border-radius:6px;object-fit:cover;border:1px solid #222;" alt="">
                                            <div>
                                                <div style="color:#fff;font-weight:600;">{{ $post->project->title }}</div>
                                                <div style="color:#999;font-size:12px;">Project • {{ Str::limit($post->content, 50) }}</div>
                                            </div>
                                        @elseif($post->blog)
                                            <img src="{{ $post->blog->featured_image ? asset('storage/' . $post->blog->featured_image) : asset('assets/img/default-blog.jpg') }}" style="width:56px;height:56px;border-radius:6px;object-fit:cover;border:1px solid #222;" alt="">
                                            <div>
                                                <div style="color:#fff;font-weight:600;">{{ $post->blog->title }}</div>
                                                <div style="color:#999;font-size:12px;">Blog • {{ Str::limit($post->content, 50) }}</div>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="platform-chip {{ $post->platform }}"><i class="fab fa-{{ $post->platform }}"></i> {{ ucfirst($post->platform) }}</span>
                                </td>
                                <td><span class="status {{ $post->status }}">{{ ucfirst($post->status) }}</span></td>
                                <td>{{ $post->scheduled_at ? $post->scheduled_at->format('M d, Y H:i') : '-' }}</td>
                                <td>{{ $post->published_at ? $post->published_at->format('M d, Y H:i') : '-' }}</td>
                                <td>
                                    <div style="display:flex; gap:8px;">
                                        @if($post->platform_post_id)
                                        <button class="btn btn-secondary btn-sm" onclick="viewPost('{{ $post->platform }}', '{{ $post->platform_post_id }}')"><i class="fas fa-external-link-alt"></i></button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="margin-top:20px;">{{ $posts->links() }}</div>
                @else
                <div style="text-align:center; padding:40px; color:#888;">No posts yet. Share your first project or blog article!</div>
                @endif
            </section>

            <section id="tab-projects" class="section" style="display:none;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                    <h2 style="font-size:20px; color:#dc2626;">Your Projects</h2>
                </div>
                <div class="content-grid">
                    @foreach($recentProjects as $project)
                    <div class="content-card">
                        @if($project->main_image)
                        <img src="{{ asset('storage/' . $project->main_image) }}" alt="{{ $project->title }}">
                        @endif
                        <div class="body">
                            <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px;">
                                <span class="pill">project</span>
                                <span style="font-size:12px; color:#999;">{{ $project->created_at->format('M d, Y') }}</span>
                            </div>
                            <div style="font-weight:700; color:#fff; margin-bottom:6px;">{{ $project->title }}</div>
                            <div style="color:#aaa; font-size:14px; margin-bottom:10px;">{{ Str::limit($project->description, 120) }}</div>
                        </div>
                        <div class="content-meta">
                            <span style="color:#999; font-size:12px;">{{ $project->category }}</span>
                            <button class="btn btn-primary" onclick="openSocialModal('project', {{ $project->id }})"><i class="fas fa-share"></i> Share</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            <section id="tab-articles" class="section" style="display:none;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                    <h2 style="font-size:20px; color:#dc2626;">Your Articles</h2>
                </div>
                <div class="content-grid">
                    @foreach($recentBlogs as $blog)
                    <div class="content-card">
                        @if($blog->featured_image)
                        <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}">
                        @endif
                        <div class="body">
                            <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px;">
                                <span class="pill">article</span>
                                <span style="font-size:12px; color:#999;">{{ ($blog->published_date ?? $blog->created_at)->format('M d, Y') }}</span>
                            </div>
                            <div style="font-weight:700; color:#fff; margin-bottom:6px;">{{ $blog->title }}</div>
                            <div style="color:#aaa; font-size:14px; margin-bottom:10px;">{{ Str::limit($blog->excerpt, 120) }}</div>
                        </div>
                        <div class="content-meta">
                            <span style="color:#999; font-size:12px;">{{ $blog->category }}</span>
                            <button class="btn btn-primary" onclick="openSocialModal('blog', {{ $blog->id }})"><i class="fas fa-share"></i> Share</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            @include('admin.social.publish-modal')
        </main>
    </div>

    <script>
        // Tabs
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function(){
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                document.querySelectorAll('.section').forEach(s => s.style.display = 'none');
                const target = this.getAttribute('data-target') || '#tab-dashboard';
                const el = document.querySelector(target);
                if (el) el.style.display = '';
            });
        });

        // Filter posts
        document.querySelectorAll('[data-filter]').forEach(btn => {
            btn.addEventListener('click', function(){
                const filter = this.getAttribute('data-filter');
                document.querySelectorAll('#postsTable tbody tr').forEach(row => {
                    if (filter === 'all' || row.dataset.status === filter) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

        // View post on platform
        function viewPost(platform, postId) {
            const urls = {
                facebook: `https://facebook.com/${postId}`,
                twitter: `https://twitter.com/i/web/status/${postId}`,
                instagram: `https://instagram.com/p/${postId}`,
                linkedin: `https://linkedin.com/feed/update/${postId}`
            };
            window.open(urls[platform] || '#', '_blank');
        }
    </script>
</body>
</html>

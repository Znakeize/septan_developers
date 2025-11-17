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
        .tabs { background:#0f0f0f; border:1px solid #222; border-radius:10px; display:flex; gap:10px; padding:6px; margin-bottom:20px; flex-wrap: wrap; }
        .tab { padding:10px 16px; border-radius:8px; cursor:pointer; color:#ccc; transition: all 0.3s; }
        .tab:hover { background: #1a1a1a; }
        .tab.active { background:#dc2626; color:#fff; }
        .grid { display:grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 20px; }
        .card { background:#0b0b0b; border:1px solid #222; border-radius:10px; padding:16px; transition: all 0.3s; }
        .card:hover { border-color:#dc2626; transform: translateY(-2px); }
        .btn { padding: 10px 16px; border: none; border-radius: 8px; cursor: pointer; font-weight: 500; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s; }
        .btn:hover { opacity: 0.9; transform: translateY(-1px); }
        .btn-primary { background:#dc2626; color:#fff; }
        .btn-secondary { background:#333; color:#fff; }
        .btn-danger { background:#ef4444; color:#fff; }
        .btn-success { background:#10b981; color:#fff; }
        .btn-info { background:#3b82f6; color:#fff; }
        .btn-sm { padding: 6px 12px; font-size: 14px; }
        .table { width:100%; border-collapse: collapse; }
        .table th { text-align:left; padding:12px; font-size:12px; color:#dc2626; border-bottom:1px solid #222; letter-spacing:1px; }
        .table td { padding:12px; border-bottom:1px solid #222; font-size:14px; }
        .status { padding:4px 10px; border-radius:14px; font-size:12px; border:1px solid #333; }
        .status.published { background: rgba(16,185,129,.1); color:#10b981; border-color:#10b981; }
        .status.pending { background: rgba(245,158,11,.1); color:#f59e0b; border-color:#f59e0b; }
        .status.failed { background: rgba(239,68,68,.1); color:#ef4444; border-color:#ef4444; }
        .platform-chip { padding:4px 10px; border-radius:14px; font-size:12px; border:1px solid #333; margin-right:6px; display: inline-flex; align-items: center; }
        .platform-chip.facebook { border-color:#1877f2; color:#1877f2; background: rgba(24,119,242,.1); }
        .platform-chip.twitter { border-color:#1da1f2; color:#1da1f2; background: rgba(29,161,242,.1); }
        .platform-chip.instagram { border-color:#e1306c; color:#e1306c; background: rgba(225,48,108,.1); }
        .platform-chip.linkedin { border-color:#0077b5; color:#0077b5; background: rgba(0,119,181,.1); }
        .platform-chip.youtube { border-color:#ff0000; color:#ff0000; background: rgba(255,0,0,.1); }
        .platform-chip svg { width: 14px; height: 14px; }
        .content-grid { display:grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap:20px; }
        .content-card { background:#0b0b0b; border:1px solid #222; border-radius:10px; overflow:hidden; display:flex; flex-direction:column; }
        .content-card img { width:100%; height:160px; object-fit:cover; }
        .content-card .body { padding:16px; }
        .content-meta { display:flex; justify-content:space-between; align-items:center; padding:12px 16px; border-top:1px solid #222; }
        .pill { padding:4px 10px; background:#111; color:#aaa; border-radius:999px; font-size:12px; border:1px solid #222; }
        
        /* Social Card Styles */
        .social-card { background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%); padding: 25px; border-radius: 12px; text-align: center; cursor: pointer; border: 1px solid #222; transition: all 0.3s; }
        .social-card:hover { transform: translateY(-5px); border-color: #dc2626; box-shadow: 0 8px 16px rgba(220, 38, 38, 0.2); }
        .social-icon { width: 60px; height: 60px; margin: 0 auto 15px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: rgba(220, 38, 38, 0.1); border: 2px solid rgba(220, 38, 38, 0.3); }
        .social-icon svg { width: 30px; height: 30px; }
        .social-card:hover .social-icon { background: rgba(220, 38, 38, 0.2); border-color: #dc2626; }
        
        /* Form Styles */
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #e5e5e5; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 12px; border: 2px solid #222; border-radius: 8px; font-size: 14px; background: #0b0b0b; color: #e5e5e5; transition: border-color 0.3s; }
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus { outline: none; border-color: #dc2626; }
        
        /* Connection Status */
        .connection-status { display: flex; align-items: center; gap: 10px; padding: 15px; background: rgba(59, 130, 246, 0.1); border-radius: 8px; margin-bottom: 20px; border: 1px solid rgba(59, 130, 246, 0.3); }
        .status-dot { width: 12px; height: 12px; border-radius: 50%; background: #10b981; animation: pulse 2s infinite; }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
        
        /* Analytics */
        .analytics-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 20px; }
        .analytics-card { background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%); color: white; padding: 20px; border-radius: 10px; text-align: center; border: 1px solid rgba(255,255,255,0.1); }
        .analytics-card h3 { font-size: 2em; margin-bottom: 5px; }
        .analytics-card p { opacity: 0.9; font-size: 0.9em; }
        
        /* Success Message */
        .success-message { background: rgba(16,185,129,.1); color: #10b981; padding: 15px; border-radius: 8px; margin-top: 15px; border: 1px solid rgba(16,185,129,.3); display: none; }
        
        /* Modal/Form Overlay */
        .connection-form-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.8); z-index: 1000; align-items: center; justify-content: center; }
        .connection-form-overlay.active { display: flex; }
        .connection-form-container { background: #0f0f0f; padding: 30px; border-radius: 10px; border: 1px solid #222; max-width: 500px; width: 90%; max-height: 90vh; overflow-y: auto; }
        
        /* Activity Log */
        .activity-log { max-height: 300px; overflow-y: auto; }
        .activity-item { padding: 10px; border-bottom: 1px solid #222; }
        .activity-item:last-child { border-bottom: none; }
        .activity-item p { margin-bottom: 5px; color: #e5e5e5; }
        .activity-item small { color: #999; }
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
                <h1>🌐 Social Media Hub</h1>
                <p style="color:#9aa; margin-top:6px;">Connect, Share & Grow Your Digital Presence</p>
            </div>

            <div class="tabs">
                <button class="tab active" data-target="#tab-connect"><i class="fas fa-plug"></i> Connect Accounts</button>
                <button class="tab" data-target="#tab-dashboard"><i class="fas fa-gauge"></i> Dashboard</button>
                <button class="tab" data-target="#tab-manage"><i class="fas fa-cog"></i> Manage Links</button>
                <button class="tab" data-target="#tab-analytics"><i class="fas fa-chart-bar"></i> Analytics</button>
                <button class="tab" data-target="#tab-projects"><i class="fas fa-building"></i> Projects</button>
                <button class="tab" data-target="#tab-articles"><i class="fas fa-newspaper"></i> Articles</button>
            </div>

            @if(session('success'))
                <div class="success-message" style="display: block;">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <!-- Connect Accounts Tab -->
            <section id="tab-connect" class="section">
                <h2 style="margin-bottom: 25px; color: #dc2626; font-size: 20px;">🔗 Connect Your Social Media Accounts</h2>
                
                <div class="grid">
                    <div class="social-card" onclick="openConnectionForm('facebook')">
                        <div class="social-icon facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0,0,256,256">
                                <g fill="#dc2626" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(10.66667,10.66667)"><path d="M12,2c-5.523,0 -10,4.477 -10,10c0,5.013 3.693,9.153 8.505,9.876v-7.226h-2.474v-2.629h2.474v-1.749c0,-2.896 1.411,-4.167 3.818,-4.167c1.153,0 1.762,0.085 2.051,0.124v2.294h-1.642c-1.022,0 -1.379,0.969 -1.379,2.061v1.437h2.995l-0.406,2.629h-2.588v7.247c4.881,-0.661 8.646,-4.835 8.646,-9.897c0,-5.523 -4.477,-10 -10,-10z"></path></g></g>
                            </svg>
                        </div>
                        <h3 style="color: #fff; margin-bottom: 5px;">Facebook</h3>
                        <p style="color: #999; font-size: 14px;">Connect your page</p>
                        <small style="color: #666;">Click to connect</small>
                    </div>

                    <div class="social-card" onclick="openConnectionForm('instagram')">
                        <div class="social-icon instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0,0,256,256">
                                <g fill="#dc2626" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(10.66667,10.66667)"><path d="M8,3c-2.761,0 -5,2.239 -5,5v8c0,2.761 2.239,5 5,5h8c2.761,0 5,-2.239 5,-5v-8c0,-2.761 -2.239,-5 -5,-5zM18,5c0.552,0 1,0.448 1,1c0,0.552 -0.448,1 -1,1c-0.552,0 -1,-0.448 -1,-1c0,-0.552 0.448,-1 1,-1zM12,7c2.761,0 5,2.239 5,5c0,2.761 -2.239,5 -5,5c-2.761,0 -5,-2.239 -5,-5c0,-2.761 2.239,-5 5,-5zM12,9c-1.65685,0 -3,1.34315 -3,3c0,1.65685 1.34315,3 3,3c1.65685,0 3,-1.34315 3,-3c0,-1.65685 -1.34315,-3 -3,-3z"></path></g></g>
                            </svg>
                        </div>
                        <h3 style="color: #fff; margin-bottom: 5px;">Instagram</h3>
                        <p style="color: #999; font-size: 14px;">@septan_developers</p>
                        <small style="color: #666;">Click to connect</small>
                    </div>

                    <div class="social-card" onclick="openConnectionForm('linkedin')">
                        <div class="social-icon linkedin">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0,0,256,256">
                                <g fill="#dc2626" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(10.66667,10.66667)"><path d="M19,3h-14c-1.105,0 -2,0.895 -2,2v14c0,1.105 0.895,2 2,2h14c1.105,0 2,-0.895 2,-2v-14c0,-1.105 -0.895,-2 -2,-2zM9,17h-2.523v-7h2.523zM7.694,8.717c-0.771,0 -1.286,-0.514 -1.286,-1.2c0,-0.686 0.514,-1.2 1.371,-1.2c0.771,0 1.286,0.514 1.286,1.2c0,0.686 -0.514,1.2 -1.371,1.2zM18,17h-2.442v-3.826c0,-1.058 -0.651,-1.302 -0.895,-1.302c-0.244,0 -1.058,0.163 -1.058,1.302c0,0.163 0,3.826 0,3.826h-2.523v-7h2.523v0.977c0.325,-0.57 0.976,-0.977 2.197,-0.977c1.221,0 2.198,0.977 2.198,3.174z"></path></g></g>
                            </svg>
                        </div>
                        <h3 style="color: #fff; margin-bottom: 5px;">LinkedIn</h3>
                        <p style="color: #999; font-size: 14px;">Professional network</p>
                        <small style="color: #666;">Click to connect</small>
                    </div>

                    <div class="social-card" onclick="openConnectionForm('youtube')">
                        <div class="social-icon youtube">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0,0,256,256">
                                <g fill="#dc2626" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(10.66667,10.66667)"><path d="M21.582,6.186c-0.23,-0.86 -0.908,-1.538 -1.768,-1.768c-1.56,-0.418 -7.814,-0.418 -7.814,-0.418c0,0 -6.254,0 -7.814,0.418c-0.86,0.23 -1.538,0.908 -1.768,1.768c-0.418,1.56 -0.418,5.814 -0.418,5.814c0,0 0,4.254 0.418,5.814c0.23,0.86 0.908,1.538 1.768,1.768c1.56,0.418 7.814,0.418 7.814,0.418c0,0 6.254,0 7.814,-0.418c0.861,-0.23 1.538,-0.908 1.768,-1.768c0.418,-1.56 0.418,-5.814 0.418,-5.814c0,0 0,-4.254 -0.418,-5.814zM10,15.464v-6.928l6,3.464z"></path></g></g>
                            </svg>
                        </div>
                        <h3 style="color: #fff; margin-bottom: 5px;">YouTube</h3>
                        <p style="color: #999; font-size: 14px;">Video content</p>
                        <small style="color: #666;">Click to connect</small>
                    </div>

                    <div class="social-card" onclick="openConnectionForm('twitter')">
                        <div class="social-icon twitter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0,0,256,256">
                                <g fill="#dc2626" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(10.66667,10.66667)"><path d="M10.053,7.988l5.631,8.024h-1.497l-5.621,-8.024zM21,6v12c0,1.657 -1.343,3 -3,3h-12c-1.657,0 -3,-1.343 -3,-3v-12c0,-1.657 1.343,-3 3,-3h12c1.657,0 3,1.343 3,3zM17.538,17l-4.186,-5.99l3.422,-4.01h-1.311l-2.704,3.16l-2.207,-3.16h-3.85l3.941,5.633l-3.737,4.367h1.333l3.001,-3.516l2.458,3.516z"></path></g></g>
                            </svg>
                        </div>
                        <h3 style="color: #fff; margin-bottom: 5px;">Twitter/X</h3>
                        <p style="color: #999; font-size: 14px;">Share updates</p>
                        <small style="color: #666;">Click to connect</small>
                    </div>
                </div>

                <div id="connectionSuccess" class="success-message"></div>
            </section>

            <!-- Dashboard Tab -->
            <section id="tab-dashboard" class="section" style="display:none;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                    <h2 style="font-size:20px; color:#dc2626;">Connected Accounts</h2>
                </div>
                <div class="grid">
                    @php
                        function getPlatformSVG($platform) {
                            $svgs = [
                                'facebook' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0,0,256,256"><g fill="#dc2626" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(10.66667,10.66667)"><path d="M12,2c-5.523,0 -10,4.477 -10,10c0,5.013 3.693,9.153 8.505,9.876v-7.226h-2.474v-2.629h2.474v-1.749c0,-2.896 1.411,-4.167 3.818,-4.167c1.153,0 1.762,0.085 2.051,0.124v2.294h-1.642c-1.022,0 -1.379,0.969 -1.379,2.061v1.437h2.995l-0.406,2.629h-2.588v7.247c4.881,-0.661 8.646,-4.835 8.646,-9.897c0,-5.523 -4.477,-10 -10,-10z"></path></g></g></svg>',
                                'instagram' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0,0,256,256"><g fill="#dc2626" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(10.66667,10.66667)"><path d="M8,3c-2.761,0 -5,2.239 -5,5v8c0,2.761 2.239,5 5,5h8c2.761,0 5,-2.239 5,-5v-8c0,-2.761 -2.239,-5 -5,-5zM18,5c0.552,0 1,0.448 1,1c0,0.552 -0.448,1 -1,1c-0.552,0 -1,-0.448 -1,-1c0,-0.552 0.448,-1 1,-1zM12,7c2.761,0 5,2.239 5,5c0,2.761 -2.239,5 -5,5c-2.761,0 -5,-2.239 -5,-5c0,-2.761 2.239,-5 5,-5zM12,9c-1.65685,0 -3,1.34315 -3,3c0,1.65685 1.34315,3 3,3c1.65685,0 3,-1.34315 3,-3c0,-1.65685 -1.34315,-3 -3,-3z"></path></g></g></svg>',
                                'linkedin' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0,0,256,256"><g fill="#dc2626" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(10.66667,10.66667)"><path d="M19,3h-14c-1.105,0 -2,0.895 -2,2v14c0,1.105 0.895,2 2,2h14c1.105,0 2,-0.895 2,-2v-14c0,-1.105 -0.895,-2 -2,-2zM9,17h-2.523v-7h2.523zM7.694,8.717c-0.771,0 -1.286,-0.514 -1.286,-1.2c0,-0.686 0.514,-1.2 1.371,-1.2c0.771,0 1.286,0.514 1.286,1.2c0,0.686 -0.514,1.2 -1.371,1.2zM18,17h-2.442v-3.826c0,-1.058 -0.651,-1.302 -0.895,-1.302c-0.244,0 -1.058,0.163 -1.058,1.302c0,0.163 0,3.826 0,3.826h-2.523v-7h2.523v0.977c0.325,-0.57 0.976,-0.977 2.197,-0.977c1.221,0 2.198,0.977 2.198,3.174z"></path></g></g></svg>',
                                'youtube' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0,0,256,256"><g fill="#dc2626" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(10.66667,10.66667)"><path d="M21.582,6.186c-0.23,-0.86 -0.908,-1.538 -1.768,-1.768c-1.56,-0.418 -7.814,-0.418 -7.814,-0.418c0,0 -6.254,0 -7.814,0.418c-0.86,0.23 -1.538,0.908 -1.768,1.768c-0.418,1.56 -0.418,5.814 -0.418,5.814c0,0 0,4.254 0.418,5.814c0.23,0.86 0.908,1.538 1.768,1.768c1.56,0.418 7.814,0.418 7.814,0.418c0,0 6.254,0 7.814,-0.418c0.861,-0.23 1.538,-0.908 1.768,-1.768c0.418,-1.56 0.418,-5.814 0.418,-5.814c0,0 0,-4.254 -0.418,-5.814zM10,15.464v-6.928l6,3.464z"></path></g></g></svg>',
                                'twitter' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0,0,256,256"><g fill="#dc2626" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(10.66667,10.66667)"><path d="M10.053,7.988l5.631,8.024h-1.497l-5.621,-8.024zM21,6v12c0,1.657 -1.343,3 -3,3h-12c-1.657,0 -3,-1.343 -3,-3v-12c0,-1.657 1.343,-3 3,-3h12c1.657,0 3,1.343 3,3zM17.538,17l-4.186,-5.99l3.422,-4.01h-1.311l-2.704,3.16l-2.207,-3.16h-3.85l3.941,5.633l-3.737,4.367h1.333l3.001,-3.516l2.458,3.516z"></path></g></g></svg>',
                            ];
                            return $svgs[$platform] ?? '<i class="fas fa-share-alt" style="font-size:18px;color:#dc2626;"></i>';
                        }
                    @endphp
                    @forelse($accounts as $account)
                        <div class="card" style="border-color: {{ $account->is_active ? '#10b981' : '#222' }};">
                            <div style="display:flex; align-items:center; gap:12px; margin-bottom:10px;">
                                <div class="platform-icon" style="width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:#111;">
                                    {!! getPlatformSVG($account->platform) !!}
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
                    @empty
                        <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #888;">
                            No accounts connected yet. Go to "Connect Accounts" to add your social media profiles.
                        </div>
                    @endforelse
                </div>

                <div class="section" style="margin-top: 20px; margin-bottom: 0;">
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
                                        <span class="platform-chip {{ $post->platform }}">
                                            {!! getPlatformSVG($post->platform) !!}
                                            <span style="margin-left: 6px;">{{ ucfirst($post->platform) }}</span>
                                        </span>
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
                </div>
            </section>

            <!-- Manage Links Tab -->
            <section id="tab-manage" class="section" style="display:none;">
                <h2 style="margin-bottom: 25px; color: #dc2626; font-size: 20px;">⚙️ Manage Social Links</h2>
                
                <div class="connection-status">
                    <div class="status-dot"></div>
                    <span><strong>Status:</strong> All systems operational</span>
                </div>

                <div id="connectedAccounts">
                    <h3 style="margin-bottom: 15px; color: #e5e5e5;">Connected Accounts</h3>
                    <div id="accountsList" style="display: flex; flex-direction: column; gap: 15px;">
                        @forelse($accounts->where('is_active', true) as $account)
                            <div style="padding: 15px; background: #0b0b0b; border-radius: 8px; border-left: 4px solid #dc2626;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div>
                                        <strong style="text-transform: capitalize; color: #fff;">{{ $account->platform }}</strong>
                                        <p style="color: #999; margin-top: 5px;">@{{ $account->platform_username ?? 'N/A' }}</p>
                                        <small style="color: #666;">Connected: {{ $account->created_at->format('M d, Y') }}</small>
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.social.connect', $account->platform) }}" class="btn btn-secondary btn-sm" style="margin-right: 5px;"><i class="fas fa-external-link-alt"></i> View</a>
                                        <form action="{{ route('admin.social.disconnect', $account) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p style="color: #666;">No accounts connected yet. Go to "Connect Accounts" to add your social media profiles.</p>
                        @endforelse
                    </div>
                </div>

                <div style="margin-top: 30px; padding: 20px; background: rgba(245,158,11,.1); border-radius: 8px; border: 1px solid rgba(245,158,11,.3);">
                    <h4 style="color: #f59e0b; margin-bottom: 10px;">📋 Quick Actions</h4>
                    <button class="btn btn-info" style="margin-right: 10px; margin-bottom: 10px;" onclick="exportLinks()"><i class="fas fa-download"></i> Export Links</button>
                    <button class="btn btn-success" style="margin-right: 10px; margin-bottom: 10px;" onclick="syncAccounts()"><i class="fas fa-sync"></i> Sync All</button>
                    <button class="btn btn-danger" style="margin-bottom: 10px;" onclick="disconnectAll()"><i class="fas fa-unlink"></i> Disconnect All</button>
                </div>
            </section>

            <!-- Analytics Tab -->
            <section id="tab-analytics" class="section" style="display:none;">
                <h2 style="margin-bottom: 25px; color: #dc2626; font-size: 20px;">📊 Social Media Analytics</h2>
                
                <div class="analytics-grid">
                    <div class="analytics-card">
                        <h3>{{ $analytics['total_shares'] }}</h3>
                        <p>Total Shares</p>
                    </div>
                    <div class="analytics-card">
                        <h3>{{ number_format($analytics['total_reach']) }}</h3>
                        <p>Estimated Reach</p>
                    </div>
                    <div class="analytics-card">
                        <h3>{{ $analytics['connected_platforms'] }}</h3>
                        <p>Connected Platforms</p>
                    </div>
                    <div class="analytics-card">
                        <h3>{{ $analytics['engagement'] }}%</h3>
                        <p>Engagement Rate</p>
                    </div>
                </div>

                <div style="margin-top: 30px; padding: 20px; background: #0b0b0b; border-radius: 10px; border: 1px solid #222;">
                    <h3 style="margin-bottom: 15px; color: #e5e5e5;">Recent Activity</h3>
                    <div class="activity-log">
                        @forelse($analytics['recent_activity'] as $activity)
                            <div class="activity-item">
                                <p>{{ $activity['message'] }}</p>
                                <small>{{ $activity['timestamp']->format('M d, Y H:i') }}</small>
                            </div>
                        @empty
                            <p style="color: #666; text-align: center; padding: 20px;">No activity yet. Start sharing content to see your analytics!</p>
                        @endforelse
                    </div>
                </div>
            </section>

            <!-- Projects Tab -->
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

            <!-- Articles Tab -->
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

    <!-- Connection Form Modal -->
    <div id="connectionFormOverlay" class="connection-form-overlay" onclick="closeConnectionForm(event)">
        <div class="connection-form-container" onclick="event.stopPropagation()">
            <h3 id="formTitle" style="margin-bottom: 20px; color: #dc2626;"></h3>
            <form id="connectionForm" onsubmit="saveConnection(event)">
                <div class="form-group">
                    <label for="username">Username/Handle</label>
                    <input type="text" id="username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="profileUrl">Profile URL</label>
                    <input type="url" id="profileUrl" placeholder="https://">
                </div>
                <div class="form-group">
                    <label for="accessToken">Access Token (Optional)</label>
                    <input type="password" id="accessToken" placeholder="For API integration">
                </div>
                <div style="display: flex; gap: 10px;">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Save Connection</button>
                    <button type="button" class="btn btn-secondary" onclick="closeConnectionForm()"><i class="fas fa-times"></i> Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentPlatform = '';

        // Tabs
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function(){
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                document.querySelectorAll('.section').forEach(s => s.style.display = 'none');
                const target = this.getAttribute('data-target') || '#tab-connect';
                const el = document.querySelector(target);
                if (el) el.style.display = '';
            });
        });

        // Connection Form
        function openConnectionForm(platform) {
            currentPlatform = platform;
            const overlay = document.getElementById('connectionFormOverlay');
            const title = document.getElementById('formTitle');
            const usernameInput = document.getElementById('username');
            const urlInput = document.getElementById('profileUrl');
            
            title.textContent = `Connect ${platform.charAt(0).toUpperCase() + platform.slice(1)}`;
            
            // Pre-fill for Instagram
            if (platform === 'instagram') {
                usernameInput.value = 'septan_developers';
                urlInput.value = 'https://www.instagram.com/septan_developers/';
            } else {
                usernameInput.value = '';
                urlInput.value = '';
            }
            
            overlay.classList.add('active');
        }

        function closeConnectionForm(event) {
            if (event && event.target !== event.currentTarget) return;
            document.getElementById('connectionFormOverlay').classList.remove('active');
            document.getElementById('connectionForm').reset();
        }

        function saveConnection(event) {
            event.preventDefault();
            
            const username = document.getElementById('username').value;
            const profileUrl = document.getElementById('profileUrl').value;
            const accessToken = document.getElementById('accessToken').value;
            
            if (!username) {
                alert('Please enter a username');
                return;
            }
            
            fetch('{{ route("admin.social.account.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    platform: currentPlatform,
                    username: username,
                    profile_url: profileUrl || null,
                    access_token: accessToken || null
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const successMsg = document.getElementById('connectionSuccess');
                    successMsg.textContent = '✅ ' + data.message;
                    successMsg.style.display = 'block';
                    closeConnectionForm();
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    alert(data.message || 'An error occurred. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        }

        // Export Links
        function exportLinks() {
            fetch('{{ route("admin.social.export-links") }}')
                .then(response => response.json())
                .then(data => {
                    const blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' });
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'social-media-links.json';
                    a.click();
                });
        }

        function syncAccounts() {
            alert('Syncing accounts... This feature would connect to social media APIs to update your profiles.');
        }

        function disconnectAll() {
            if (confirm('Are you sure you want to disconnect all accounts?')) {
                // This would need a route to disconnect all
                alert('This feature would disconnect all accounts. Please disconnect individually for now.');
            }
        }

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

        // Ensure openSocialModal is available globally (from publish-modal.blade.php)
        // If the modal's function isn't loaded yet, provide a fallback
        if (typeof openSocialModal === 'undefined') {
            window.openSocialModal = function(type, id) {
                const modal = document.getElementById('socialPublishModal');
                if (modal) {
                    const typeInput = document.getElementById('contentType');
                    const idInput = document.getElementById('contentId');
                    if (typeInput) typeInput.value = type;
                    if (idInput) idInput.value = id;
                    modal.classList.add('active');
                } else {
                    // Retry after modal loads
                    setTimeout(() => window.openSocialModal(type, id), 100);
                }
            };
        }
    </script>
</body>
</html>

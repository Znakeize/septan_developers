<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Control - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; background: #000; color:#e5e5e5; }
        .admin-container { display: flex; min-height: 100vh; }
        .sidebar { width: 260px; background: #1a1a1a; color: #fff; padding: 20px 0; position: fixed; height: 100vh; overflow-y: auto; }
        .main-content { flex: 1; margin-left: 260px; padding: 30px; }
        .form-container { background: #0f0f0f; padding: 30px; border-radius: 10px; border:1px solid #222; max-width: 1100px; }
        .header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
        .header h1 { color:#dc2626; }
        .grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(280px,1fr)); gap:20px; }
        .card { border:1px solid #222; background:#0b0b0b; border-radius:10px; padding:16px; }
        label { display:block; color:#bbb; font-size:14px; margin-bottom:6px; }
        input[type="text"], input[type="url"], textarea { width:100%; padding:10px; border:1px solid #222; background:#0b0b0b; color:#e5e5e5; border-radius:6px; }
        .row { display:grid; grid-template-columns:1fr; gap:10px; margin-bottom:10px; }
        .switch { display:flex; align-items:center; gap:10px; margin-bottom:10px; }
        .actions { margin-top:20px; display:flex; gap:12px; }
        .btn { padding:10px 18px; border:none; border-radius:6px; cursor:pointer; }
        .btn-primary { background:#dc2626; color:#fff; }
        .notice { color:#9ca3af; font-size:13px; margin-top:6px; }
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
                <a href="{{ route('admin.social.index') }}" class="menu-item" style="display:block;color:#fff;background:#ff4b33;padding:10px 20px;text-decoration:none;">Social Media</a>
            </nav>
        </aside>
        <main class="main-content">
            <div class="form-container">
                <div class="header">
                    <h1>SOCIAL MEDIA CONTROL</h1>
                    <a href="{{ route('admin.dashboard') }}" style="color:#9ca3af;text-decoration:none;">Back</a>
                </div>
                @if(session('success'))
                    <div style="background:#062b1e;border:1px solid #14532d;color:#34d399;padding:10px;border-radius:6px;margin-bottom:14px;">{{ session('success') }}</div>
                @endif

                <form action="{{ route('admin.social.store') }}" method="POST">
                    @csrf
                    <div class="grid">
                        @foreach($platforms as $platform)
                        <?php $c = $channels[$platform] ?? null; ?>
                        <div class="card">
                            <div class="switch">
                                <input type="checkbox" id="enabled_{{ $platform }}" name="channels[{{ $platform }}][enabled]" value="1" {{ $c && $c->enabled ? 'checked' : '' }}>
                                <label for="enabled_{{ $platform }}" style="margin:0;">Enable {{ ucfirst($platform) }}</label>
                            </div>
                            <div class="row">
                                <label>App ID</label>
                                <input type="text" name="channels[{{ $platform }}][app_id]" value="{{ $c->app_id ?? '' }}">
                            </div>
                            <div class="row">
                                <label>App Secret</label>
                                <input type="text" name="channels[{{ $platform }}][app_secret]" value="{{ $c->app_secret ?? '' }}">
                            </div>
                            <div class="row">
                                <label>Access Token</label>
                                <input type="text" name="channels[{{ $platform }}][access_token]" value="{{ $c->access_token ?? '' }}">
                            </div>
                            <div class="row">
                                <label>Page/Profile ID</label>
                                <input type="text" name="channels[{{ $platform }}][page_id]" value="{{ $c->page_id ?? '' }}">
                            </div>
                            <div class="row">
                                <label>Page/Profile Name</label>
                                <input type="text" name="channels[{{ $platform }}][page_name]" value="{{ $c->page_name ?? '' }}">
                            </div>
                            <div class="row">
                                <label>Webhook URL (optional)</label>
                                <input type="url" name="channels[{{ $platform }}][webhook_url]" value="{{ $c->webhook_url ?? '' }}">
                            </div>
                            <div class="row">
                                <label>Message Template</label>
                                <textarea name="channels[{{ $platform }}][message_template]" rows="4" placeholder="e.g. New project: {title} in {location}. Check it out: {url}">{{ $c->message_template ?? '' }}</textarea>
                                <div class="notice">Available variables: {title}, {url}, {location}, {year}, {type}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="actions">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Settings</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>



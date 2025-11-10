<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add Project - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; background: #000; color:#e5e5e5; }
        
        .admin-container { display: flex; min-height: 100vh; }
        .sidebar { width: 260px; background: #1a1a1a; color: #fff; padding: 20px 0; position: fixed; height: 100vh; overflow-y: auto; }
        .sidebar-header { padding: 0 20px 30px; border-bottom: 1px solid #333; }
        .sidebar-header h2 { font-size: 24px; color: #dc2626; }
        .sidebar-menu { padding: 20px 0; }
        .menu-item { padding: 12px 20px; color: #ccc; text-decoration: none; display: flex; align-items: center; gap: 12px; transition: all 0.3s; }
        .menu-item:hover, .menu-item.active { background: #dc2626; color: #fff; }
        
        .main-content { flex: 1; margin-left: 260px; padding: 30px; }
        .form-container { background: #0f0f0f; padding: 30px; border-radius: 10px; border:1px solid #222; max-width: 1000px; }
        .form-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .form-header h1 { font-size: 28px; color: #dc2626; letter-spacing:1px; }
        .back-btn { color: #666; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
        
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; color: #bbb; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; }
        .form-group textarea { min-height: 150px; resize: vertical; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .full-width { grid-column: 1 / -1; }
        
        .input-group { position: relative; }
        .input-group i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #999; font-size: 1.1rem; width: 28px; text-align: center; z-index: 1; pointer-events: none; }
        .input-group input, .input-group textarea, .input-group select {
            width: 100%; padding: 12px 12px 12px 64px; border: 1px solid #222; border-radius: 6px; background:#0b0b0b;
            color: #e5e5e5; font-size: 14px; transition: border 0.3s ease;
        }
        .input-group .help-text, .input-group .error { margin-left: 64px; }
        .input-group select:focus { outline: none; border-color: #dc2626; }
        .form-container .input-group input,
        .form-container .input-group textarea,
        .form-container .input-group select { padding-left: 64px !important; }
        
        .drop-zone {
            position: relative; width: 100%; min-height: 140px; background: #0b0b0b; border: 2px dashed #222;
            border-radius: 8px; display: flex; flex-direction: column; align-items: center; justify-content: center;
            color: #9ca3af; font-size: 0.95rem; transition: all 0.3s ease; cursor: pointer; padding: 20px;
        }
        .drop-zone:hover, .drop-zone.dragover { border-color: #dc2626; background: #0f0f0f; color: #dc2626; }
        .drop-zone i { font-size: 2.5rem; margin-bottom: 10px; color: #6b7280; }
        .drop-zone.dragover i { color: #dc2626; }
        .drop-zone input { position: absolute; left: 0; top: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }
        .file-list { margin-top: 10px; font-size: 0.85rem; color: #666; max-height: 80px; overflow-y: auto; width: 100%; }
        
        .image-preview { margin-top: 10px; display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 10px; max-height: 250px; overflow-y: auto; border-radius: 8px; }
        .image-preview img { width: 100%; height: 100px; object-fit: cover; border-radius: 6px; border: 1px solid #ddd; }
        
        .checkbox-group { display: flex; align-items: center; gap: 10px; }
        .checkbox-group input { width: auto; }
        
        .btn-group { display: flex; gap: 15px; margin-top: 30px; }
        .btn { padding: 12px 24px; border-radius: 6px; font-weight: 500; border: none; cursor: pointer; transition: all 0.3s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
        .btn-primary { background: #dc2626; color: #fff; }
        .btn-primary:hover { background: #b91c1c; }
        .btn-secondary { background: #374151; color: #fff; }
        .btn-secondary:hover { background: #1f2937; }
        
        .error { color: #dc2626; font-size: 13px; margin-top: 5px; }
        .help-text { font-size: 12px; color: #9ca3af; margin-top: 5px; }

        @media (max-width: 768px) {
            .form-row { grid-template-columns: 1fr; }
            .form-header { flex-direction: column; align-items: flex-start; gap: 12px; }
        }
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
                <a href="{{ route('admin.dashboard') }}" class="menu-item">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="{{ route('admin.projects.index') }}" class="menu-item active">
                    <i class="fas fa-building"></i> Projects
                </a>
                <a href="{{ route('admin.blogs.index') }}" class="menu-item">
                    <i class="fas fa-newspaper"></i> Blog Articles
                </a>
                <a href="{{ route('home') }}" class="menu-item">
                    <i class="fas fa-globe"></i> View Website
                </a>
            </nav>
        </aside>

        <main class="main-content">
            <div class="form-container">
                <div class="form-header">
                    <h1>ADD <span style="color: #ffffffff;">NEW</span> PROJECT</h1>
                    <a href="{{ route('admin.projects.index') }}" class="back-btn">
                        <i class="fas fa-arrow-left"></i> Back to Projects
                    </a>
                </div>

                <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" id="project-form">
    @csrf

                    <div class="form-row">
                        <div class="form-group input-group">
                            <i class="fas fa-building"></i>
                            <input type="text" id="title" name="title" placeholder="Project Name" value="{{ old('title') }}" required>
                        </div>
                        <div class="form-group input-group">
                            <i class="fas fa-project-diagram"></i>
                            <select id="type" name="type" required>
                                <option value="" disabled selected>Select Type</option>
                                <option value="Eco-Friendly Resort" {{ old('type') == 'Eco-Friendly Resort' ? 'selected' : '' }}>Eco-Friendly Resort</option>
                                <option value="Sustainable Office" {{ old('type') == 'Sustainable Office' ? 'selected' : '' }}>Sustainable Office</option>
                                <option value="Minimalist Villa" {{ old('type') == 'Minimalist Villa' ? 'selected' : '' }}>Minimalist Villa</option>
                                <option value="Heritage Restoration" {{ old('type') == 'Heritage Restoration' ? 'selected' : '' }}>Heritage Restoration</option>
                                <option value="Wellness Center" {{ old('type') == 'Wellness Center' ? 'selected' : '' }}>Wellness Center</option>
                                <option value="Green Hotel" {{ old('type') == 'Green Hotel' ? 'selected' : '' }}>Green Hotel</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group input-group">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" id="location" name="location" placeholder="Location" value="{{ old('location') }}" required>
                        </div>
                        <div class="form-group input-group">
                            <i class="fas fa-calendar-alt"></i>
                            <input type="text" id="year" name="year" placeholder="Year" value="{{ old('year', date('Y')) }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group input-group">
                            <i class="fas fa-tag"></i>
                            <select id="category" name="category" required>
                                <option value="" disabled selected>Select Category</option>
                                <option value="residential" {{ old('category') == 'residential' ? 'selected' : '' }}>Residential</option>
                                <option value="commercial" {{ old('category') == 'commercial' ? 'selected' : '' }}>Commercial</option>
                                <option value="renovation" {{ old('category') == 'renovation' ? 'selected' : '' }}>Renovation</option>
                            </select>
                        </div>
                        <div class="form-group input-group">
                            <i class="fas fa-video"></i>
                            <input type="text" id="video_url" name="video_url" placeholder="YouTube Video URL (Optional)" value="{{ old('video_url') }}">
                            <div class="help-text">Example: https://www.youtube.com/watch?v=OU4CpZUUJTU</div>
                        </div>
                    </div>

                    <div class="form-group input-group full-width">
                        <i class="fas fa-paragraph"></i>
                        <textarea id="description" name="description" placeholder="Project Description" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group full-width">
                        <label style="display:block;margin-bottom:10px;font-weight:600;">Feature Cards (up to 6)</label>
                        <div class="form-row">
                            @for($i=0; $i<6; $i++)
                            <div class="form-group feature-card" data-index="{{$i}}" style="border:1px dashed #ddd;border-radius:8px;padding:12px; position: relative;">
                                <button type="button" class="remove-feature" style="position:absolute; top:6px; right:6px; background:#ef4444; color:#fff; border:none; width:24px; height:24px; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center;">×</button>
                                <div class="form-group input-group">
                                    <i class="fas fa-heading"></i>
                                    <input type="text" name="features[{{$i}}][title]" placeholder="Feature title" value="{{ old('features.'.$i.'.title') }}">
                                </div>
                                <div class="form-group input-group">
                                    <i class="fas fa-align-left"></i>
                                    <input type="text" name="features[{{$i}}][description]" placeholder="Feature description" value="{{ old('features.'.$i.'.description') }}">
                                </div>
                                <div class="form-group input-group">
                                    <i class="fas fa-icons"></i>
                                    <select name="features[{{$i}}][icon]" style="width: 100%; padding: 12px 12px 12px 42px; border: 1px solid #222; border-radius: 6px; background:#0b0b0b; color: #e5e5e5; font-size: 14px;">
                                        <option value="">Select Icon</option>
                                        <optgroup label="Nature & Environment">
                                            <option value="leaf" {{ old('features.'.$i.'.icon') == 'leaf' ? 'selected' : '' }}>🌿 Leaf</option>
                                            <option value="seedling" {{ old('features.'.$i.'.icon') == 'seedling' ? 'selected' : '' }}>🌱 Seedling</option>
                                            <option value="tree" {{ old('features.'.$i.'.icon') == 'tree' ? 'selected' : '' }}>🌳 Tree</option>
                                            <option value="mountain" {{ old('features.'.$i.'.icon') == 'mountain' ? 'selected' : '' }}>⛰️ Mountain</option>
                                            <option value="sun" {{ old('features.'.$i.'.icon') == 'sun' ? 'selected' : '' }}>☀️ Sun</option>
                                            <option value="cloud" {{ old('features.'.$i.'.icon') == 'cloud' ? 'selected' : '' }}>☁️ Cloud</option>
                                            <option value="water" {{ old('features.'.$i.'.icon') == 'water' ? 'selected' : '' }}>💧 Water</option>
                                        </optgroup>
                                        <optgroup label="Energy & Sustainability">
                                            <option value="solar-panel" {{ old('features.'.$i.'.icon') == 'solar-panel' ? 'selected' : '' }}>☀️ Solar Panel</option>
                                            <option value="bolt" {{ old('features.'.$i.'.icon') == 'bolt' ? 'selected' : '' }}>⚡ Bolt</option>
                                            <option value="wind" {{ old('features.'.$i.'.icon') == 'wind' ? 'selected' : '' }}>💨 Wind</option>
                                            <option value="recycle" {{ old('features.'.$i.'.icon') == 'recycle' ? 'selected' : '' }}>♻️ Recycle</option>
                                            <option value="leaf" {{ old('features.'.$i.'.icon') == 'leaf' ? 'selected' : '' }}>🌿 Eco-Friendly</option>
                                            <option value="battery-full" {{ old('features.'.$i.'.icon') == 'battery-full' ? 'selected' : '' }}>🔋 Battery</option>
                                        </optgroup>
                                        <optgroup label="Building & Construction">
                                            <option value="building" {{ old('features.'.$i.'.icon') == 'building' ? 'selected' : '' }}>🏢 Building</option>
                                            <option value="home" {{ old('features.'.$i.'.icon') == 'home' ? 'selected' : '' }}>🏠 Home</option>
                                            <option value="warehouse" {{ old('features.'.$i.'.icon') == 'warehouse' ? 'selected' : '' }}>🏭 Warehouse</option>
                                            <option value="city" {{ old('features.'.$i.'.icon') == 'city' ? 'selected' : '' }}>🏙️ City</option>
                                            <option value="hammer" {{ old('features.'.$i.'.icon') == 'hammer' ? 'selected' : '' }}>🔨 Hammer</option>
                                            <option value="tools" {{ old('features.'.$i.'.icon') == 'tools' ? 'selected' : '' }}>🔧 Tools</option>
                                            <option value="hard-hat" {{ old('features.'.$i.'.icon') == 'hard-hat' ? 'selected' : '' }}>⛑️ Hard Hat</option>
                                        </optgroup>
                                        <optgroup label="Comfort & Wellness">
                                            <option value="spa" {{ old('features.'.$i.'.icon') == 'spa' ? 'selected' : '' }}>🧘 Spa</option>
                                            <option value="heart" {{ old('features.'.$i.'.icon') == 'heart' ? 'selected' : '' }}>❤️ Heart</option>
                                            <option value="bed" {{ old('features.'.$i.'.icon') == 'bed' ? 'selected' : '' }}>🛏️ Bed</option>
                                            <option value="couch" {{ old('features.'.$i.'.icon') == 'couch' ? 'selected' : '' }}>🛋️ Couch</option>
                                            <option value="umbrella-beach" {{ old('features.'.$i.'.icon') == 'umbrella-beach' ? 'selected' : '' }}>🏖️ Beach</option>
                                            <option value="swimming-pool" {{ old('features.'.$i.'.icon') == 'swimming-pool' ? 'selected' : '' }}>🏊 Pool</option>
                                        </optgroup>
                                        <optgroup label="Technology & Innovation">
                                            <option value="wifi" {{ old('features.'.$i.'.icon') == 'wifi' ? 'selected' : '' }}>📶 WiFi</option>
                                            <option value="laptop" {{ old('features.'.$i.'.icon') == 'laptop' ? 'selected' : '' }}>💻 Laptop</option>
                                            <option value="lightbulb" {{ old('features.'.$i.'.icon') == 'lightbulb' ? 'selected' : '' }}>💡 Lightbulb</option>
                                            <option value="cog" {{ old('features.'.$i.'.icon') == 'cog' ? 'selected' : '' }}>⚙️ Cog</option>
                                            <option value="microchip" {{ old('features.'.$i.'.icon') == 'microchip' ? 'selected' : '' }}>🔬 Microchip</option>
                                        </optgroup>
                                        <optgroup label="Safety & Security">
                                            <option value="shield-alt" {{ old('features.'.$i.'.icon') == 'shield-alt' ? 'selected' : '' }}>🛡️ Shield</option>
                                            <option value="lock" {{ old('features.'.$i.'.icon') == 'lock' ? 'selected' : '' }}>🔒 Lock</option>
                                            <option value="fire-extinguisher" {{ old('features.'.$i.'.icon') == 'fire-extinguisher' ? 'selected' : '' }}>🧯 Fire Extinguisher</option>
                                            <option value="first-aid" {{ old('features.'.$i.'.icon') == 'first-aid' ? 'selected' : '' }}>🏥 First Aid</option>
                                        </optgroup>
                                        <optgroup label="Design & Aesthetics">
                                            <option value="paint-brush" {{ old('features.'.$i.'.icon') == 'paint-brush' ? 'selected' : '' }}>🖌️ Paint Brush</option>
                                            <option value="palette" {{ old('features.'.$i.'.icon') == 'palette' ? 'selected' : '' }}>🎨 Palette</option>
                                            <option value="image" {{ old('features.'.$i.'.icon') == 'image' ? 'selected' : '' }}>🖼️ Image</option>
                                            <option value="camera" {{ old('features.'.$i.'.icon') == 'camera' ? 'selected' : '' }}>📷 Camera</option>
                                            <option value="gem" {{ old('features.'.$i.'.icon') == 'gem' ? 'selected' : '' }}>💎 Gem</option>
                                        </optgroup>
                                        <optgroup label="Transportation">
                                            <option value="car" {{ old('features.'.$i.'.icon') == 'car' ? 'selected' : '' }}>🚗 Car</option>
                                            <option value="bicycle" {{ old('features.'.$i.'.icon') == 'bicycle' ? 'selected' : '' }}>🚲 Bicycle</option>
                                            <option value="parking" {{ old('features.'.$i.'.icon') == 'parking' ? 'selected' : '' }}>🅿️ Parking</option>
                                        </optgroup>
                                        <optgroup label="Utilities">
                                            <option value="faucet" {{ old('features.'.$i.'.icon') == 'faucet' ? 'selected' : '' }}>🚿 Faucet</option>
                                            <option value="toilet" {{ old('features.'.$i.'.icon') == 'toilet' ? 'selected' : '' }}>🚽 Toilet</option>
                                            <option value="air-conditioner" {{ old('features.'.$i.'.icon') == 'air-conditioner' ? 'selected' : '' }}>❄️ Air Conditioner</option>
                                            <option value="fan" {{ old('features.'.$i.'.icon') == 'fan' ? 'selected' : '' }}>🌀 Fan</option>
                                        </optgroup>
                                        <optgroup label="Other">
                                            <option value="star" {{ old('features.'.$i.'.icon') == 'star' ? 'selected' : '' }}>⭐ Star</option>
                                            <option value="trophy" {{ old('features.'.$i.'.icon') == 'trophy' ? 'selected' : '' }}>🏆 Trophy</option>
                                            <option value="award" {{ old('features.'.$i.'.icon') == 'award' ? 'selected' : '' }}>🏅 Award</option>
                                            <option value="check-circle" {{ old('features.'.$i.'.icon') == 'check-circle' ? 'selected' : '' }}>✅ Check Circle</option>
                                            <option value="thumbs-up" {{ old('features.'.$i.'.icon') == 'thumbs-up' ? 'selected' : '' }}>👍 Thumbs Up</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            @endfor
                        </div>
                        <div style="margin-top:10px; display:flex; gap:10px; align-items:center;">
                            <button type="button" id="add-feature" class="btn btn-secondary">+ Add Feature</button>
                            <span id="feature-count" class="help-text">0/6 features shown</span>
                        </div>
                        <div class="help-text">Leave any unused feature blocks empty.</div>
                    </div>

                    <div class="form-group full-width">
                        <label style="margin-bottom: 10px; display: block;">Main Image *</label>
                        <div class="drop-zone" id="main-image-drop-zone">
                            <i class="fas fa-image"></i>
                            <p>Drop main image here or click to select</p>
                            <input type="file" id="main_image" name="main_image" accept="image/*" required>
                        </div>
                        <div class="image-preview" id="main-image-preview" style="display: none;"></div>
                        @error('main_image')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group full-width">
                        <label style="margin-bottom: 10px; display: block;">Gallery Images (Optional)</label>
                        <div class="drop-zone" id="gallery-drop-zone">
                            <i class="fas fa-images"></i>
                            <p>Drag & drop gallery images here<br>or click to select multiple</p>
                            <input type="file" id="gallery_images" name="gallery_images[]" accept="image/*" multiple>
                            <div class="file-list" id="gallery-file-list"></div>
                        </div>
                        <div class="image-preview" id="gallery-preview"></div>
                        @error('gallery_images.*')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group input-group">
                            <i class="fas fa-user"></i>
                            <input type="text" id="client_name" name="client_name" placeholder="Client Name (Optional)" value="{{ old('client_name') }}">
                        </div>
                        <div class="form-group input-group">
                            <i class="fas fa-ruler-combined"></i>
                            <input type="number" step="0.01" id="project_area" name="project_area" placeholder="Project Area (sq ft)" value="{{ old('project_area') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group input-group">
                            <i class="fas fa-calendar"></i>
                            <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}">
                        </div>
                        <div class="form-group input-group">
                            <i class="fas fa-calendar-check"></i>
                            <input type="date" id="completion_date" name="completion_date" value="{{ old('completion_date') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <div class="checkbox-group">
                                <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }}>
                                <label for="is_published" style="margin: 0;">Published</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox-group">
                                <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <label for="is_featured" style="margin: 0;">Featured</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox-group">
                                <input type="checkbox" id="share_social" name="share_social" value="1" {{ old('share_social') ? 'checked' : '' }}>
                                <label for="share_social" style="margin: 0;">Share to Social Media after saving</label>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Project
                        </button>
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
  </form>
</div>
        </main>
    </div>

    @include('admin.social.publish-modal')

    <!-- AI Assistant Toggle & Panel -->
    <button id="ai-toggle" style="position: fixed; right: 20px; bottom: 20px; z-index: 1000; background: #b91c1c; color: #fff; border: none; border-radius: 9999px; padding: 12px 16px; font-weight: 600; cursor: pointer; box-shadow: 0 10px 20px rgba(0,0,0,0.4);">
        <span style="margin-right:6px;">✨</span> AI Assistant
    </button>

    <div id="ai-panel" style="position: fixed; top: 0; right: 0; height: 100%; width: 320px; background: linear-gradient(135deg, rgba(160, 16, 16, 0.95), rgba(0,0,0,0.95)); border-left: 1px solid rgba(168,85,247,0.3); backdrop-filter: blur(8px); transform: translateX(100%); transition: transform 0.3s ease; z-index: 1000; color: #e5e7eb;">
        <div style="display:flex; align-items:center; justify-content:space-between; padding:16px; border-bottom: 1px solid rgba(247, 85, 85, 0.2);">
            <div style="display:flex; align-items:center; gap:8px; font-weight:600;">✨ <span>AI Assistant</span></div>
            <button id="ai-close" style="background:transparent; color:#9ca3af; border:none; font-size:18px; cursor:pointer;">✕</button>
        </div>
        <div style="padding: 12px;">
            <button class="ai-action" data-action="title" style="width:100%; display:flex; align-items:center; gap:10px; padding:10px 12px; background: rgba(234, 51, 51, 0.15); border:1px solid rgba(234, 51, 51, 0.25); border-radius:8px; color:#e9d5ff; margin-bottom:10px;">🏷️ Generate Project Name</button>
            <button class="ai-action" data-action="description" style="width:100%; display:flex; align-items:center; gap:10px; padding:10px 12px; background: rgba(234, 51, 51, 0.15); border:1px solid rgba(234, 51, 51, 0.25); border-radius:8px; color:#e9d5ff; margin-bottom:10px;">📝 Write Description</button>
            <button class="ai-action" data-action="features" style="width:100%; display:flex; align-items:center; gap:10px; padding:10px 12px; background: rgba(234, 51, 51, 0.15); border:1px solid rgba(234, 51, 51, 0.25); border-radius:8px; color:#e9d5ff;">✨ Autofill Features</button>
            <div id="ai-tip" style="margin-top:16px; font-size:12px; color:#c4b5fd; border:1px solid rgba(234, 51, 51, 0.25); background: rgba(234, 51, 51, 0.08); border-radius:8px; padding:10px;">Tip: Fill location/type for more relevant suggestions.</div>
            <div id="ai-loading" style="display:none; margin-top:12px; font-size:12px; color:#a78bfa;">Working…</div>
        </div>
    </div>

    <script>
        // Main image drag & drop
        const mainDropZone = document.getElementById('main-image-drop-zone');
        const mainFileInput = document.getElementById('main_image');
        const mainPreview = document.getElementById('main-image-preview');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(e => {
            mainDropZone.addEventListener(e, preventDefaults);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(e => {
            mainDropZone.addEventListener(e, () => mainDropZone.classList.add('dragover'));
        });

        ['dragleave', 'drop'].forEach(e => {
            mainDropZone.addEventListener(e, () => mainDropZone.classList.remove('dragover'));
        });

        mainDropZone.addEventListener('drop', (e) => {
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                mainFileInput.files = files;
                previewMainImage(files[0]);
            }
        });

        mainFileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                previewMainImage(e.target.files[0]);
            }
        });

        function previewMainImage(file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                mainPreview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                mainPreview.style.display = 'grid';
            };
            reader.readAsDataURL(file);
        }

        // Gallery images drag & drop
        const galleryDropZone = document.getElementById('gallery-drop-zone');
        const galleryFileInput = document.getElementById('gallery_images');
        const galleryFileList = document.getElementById('gallery-file-list');
        const galleryPreview = document.getElementById('gallery-preview');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(e => {
            galleryDropZone.addEventListener(e, preventDefaults);
        });

        ['dragenter', 'dragover'].forEach(e => {
            galleryDropZone.addEventListener(e, () => galleryDropZone.classList.add('dragover'));
        });

        ['dragleave', 'drop'].forEach(e => {
            galleryDropZone.addEventListener(e, () => galleryDropZone.classList.remove('dragover'));
        });

        galleryDropZone.addEventListener('drop', (e) => {
            handleGalleryFiles(e.dataTransfer.files);
        });

        galleryFileInput.addEventListener('change', (e) => {
            handleGalleryFiles(e.target.files);
        });

        function handleGalleryFiles(files) {
            galleryPreview.innerHTML = '';
            galleryFileList.innerHTML = '';
            
            if (files.length > 0) {
                Array.from(files).forEach((file, i) => {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        galleryPreview.appendChild(img);
                    };
                    reader.readAsDataURL(file);

                    const div = document.createElement('div');
                    div.textContent = `${i+1}. ${file.name}`;
                    galleryFileList.appendChild(div);
                });
                galleryPreview.style.display = 'grid';
            }
        }

        // AI Assistant Logic
        const aiToggle = document.getElementById('ai-toggle');
        const aiPanel = document.getElementById('ai-panel');
        const aiClose = document.getElementById('ai-close');
        const aiLoadingEl = document.getElementById('ai-loading');
        const aiActions = document.querySelectorAll('.ai-action');

        let aiBusy = false;
        function openAiPanel() { aiPanel.style.transform = 'translateX(0)'; }
        function closeAiPanel() { aiPanel.style.transform = 'translateX(100%)'; }
        aiToggle.addEventListener('click', openAiPanel);
        aiClose.addEventListener('click', closeAiPanel);

        async function simulateAI() {
            aiBusy = true;
            aiLoadingEl.style.display = 'block';
            await new Promise(r => setTimeout(r, 1200));
            aiLoadingEl.style.display = 'none';
            aiBusy = false;
        }

        function setIfEmpty(inputEl, value) {
            if (!inputEl.value || inputEl.value.trim() === '') inputEl.value = value;
        }

        function setFeature(i, title, description, icon) {
            const titleEl = document.querySelector(`input[name="features[${i}][title]"]`);
            const descEl = document.querySelector(`input[name="features[${i}][description]"]`);
            const iconEl = document.querySelector(`select[name="features[${i}][icon]"]`);
            if (titleEl) setIfEmpty(titleEl, title);
            if (descEl) setIfEmpty(descEl, description);
            if (iconEl && icon) iconEl.value = icon;
        }

        aiActions.forEach(btn => {
            btn.addEventListener('click', async () => {
                if (aiBusy) return;
                const action = btn.getAttribute('data-action');
                await simulateAI();
                if (action === 'title') {
                    const titleEl = document.getElementById('title');
                    const type = document.getElementById('type').value || 'Sustainable';
                    const location = document.getElementById('location').value || 'Sri Lanka';
                    setIfEmpty(titleEl, `${type} Project in ${location}`);
                    titleEl.focus();
                } else if (action === 'description') {
                    const desc = document.getElementById('description');
                    const type = document.getElementById('type').value || 'Eco-Friendly Development';
                    const category = document.getElementById('category').value || 'residential';
                    setIfEmpty(desc, `A ${type.toLowerCase()} focused ${category} project emphasizing passive cooling, natural light, and locally sourced materials to reduce carbon footprint while enhancing occupant comfort.`);
                    desc.focus();
                } else if (action === 'features') {
                    setFeature(0, 'Passive Ventilation', 'Cross-ventilated layout reduces reliance on AC.', 'fan');
                    setFeature(1, 'Solar Integration', 'Rooftop PV meets core energy needs.', 'solar-panel');
                    setFeature(2, 'Rainwater Harvesting', 'Stored water reused for landscaping and utilities.', 'water');
                    setFeature(3, 'Biophilic Design', 'Ample greenery and courtyard spaces for wellness.', 'leaf');
                    setFeature(4, 'Smart Controls', 'Automated lighting and climate optimization.', 'lightbulb');
                }
            });
        });

        // Feature Cards dynamic show/hide up to 6
        const featureCards = Array.from(document.querySelectorAll('.feature-card'));
        const addFeatureBtn = document.getElementById('add-feature');
        const featureCountEl = document.getElementById('feature-count');

        function isCardEmpty(card){
            const t = card.querySelector('input[name^="features"][name$="[title]"]');
            const d = card.querySelector('input[name^="features"][name$="[description]"]');
            const i = card.querySelector('select[name^="features"][name$="[icon]"]');
            return (!t.value.trim() && !d.value.trim() && !i.value.trim());
        }

        function updateFeatureCount(){
            const visible = featureCards.filter(c => c.style.display !== 'none').length;
            featureCountEl.textContent = `${visible}/6 features shown`;
            addFeatureBtn.disabled = visible >= 6;
        }

        function initFeatureCards(){
            // Hide all empty cards except the first
            let firstShown = false;
            featureCards.forEach((card, idx) => {
                const removeBtn = card.querySelector('.remove-feature');
                removeBtn.addEventListener('click', () => clearAndHide(card));
                if (isCardEmpty(card)) {
                    if (!firstShown) { card.style.display = ''; firstShown = true; } else { card.style.display = 'none'; }
                } else {
                    card.style.display = '';
                }
            });
            updateFeatureCount();
        }

        function clearAndHide(card){
            card.querySelectorAll('input, select').forEach(el => { if (el.tagName === 'SELECT') el.value = ''; else el.value = ''; });
            card.style.display = 'none';
            updateFeatureCount();
        }

        addFeatureBtn.addEventListener('click', () => {
            const next = featureCards.find(c => c.style.display === 'none');
            if (next) {
                next.style.display = '';
            }
            updateFeatureCount();
        });

        // Initialize visibility on load
        initFeatureCards();

        // Social share handling
        document.getElementById('project-form').addEventListener('submit', async function(e) {
            const share = document.getElementById('share_social');
            if (share && share.checked) {
                e.preventDefault();
                const form = e.target;
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    });
                    const data = await response.json();
                    if (response.ok && data && (data.project_id || data.id)) {
                        openSocialModal('project', data.project_id || data.id);
                    } else {
                        alert('Error saving project');
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                    }
                } catch (err) {
                    alert('Error: ' + err.message);
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            }
        });
    </script>
</body>
</html>

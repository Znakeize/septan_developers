<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Settings - Hero Images - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
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
        .page-header { background: #111; padding: 30px; border-radius: 10px; margin-bottom: 30px; border: 1px solid #222; display: flex; justify-content: space-between; align-items: center; }
        .page-header h1 { font-size: 32px; color: #fff; text-transform: uppercase; letter-spacing: 2px; }
        
        .settings-container { background: #111; padding: 30px; border-radius: 10px; border: 1px solid #222; }
        .settings-section { margin-bottom: 40px; }
        .settings-section h2 { font-size: 24px; color: #dc2626; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 1px; border-bottom: 2px solid #dc2626; padding-bottom: 10px; }
        
        .hero-section { background: #000; padding: 25px; border-radius: 8px; border: 1px solid #222; margin-bottom: 25px; }
        .hero-section h3 { font-size: 18px; color: #fff; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px; }
        
        .drop-zone {
            position: relative; width: 100%; min-height: 120px; background: #111; border: 2px dashed #333;
            border-radius: 8px; display: flex; flex-direction: column; align-items: center; justify-content: center;
            color: #999; font-size: 0.95rem; transition: all 0.3s ease; cursor: pointer; padding: 20px; margin-bottom: 15px;
        }
        .drop-zone:hover, .drop-zone.dragover { border-color: #dc2626; background: rgba(220, 38, 38, 0.05); color: #dc2626; }
        .drop-zone i { font-size: 2.5rem; margin-bottom: 10px; color: #999; }
        .drop-zone.dragover i { color: #dc2626; }
        .drop-zone input { position: absolute; left: 0; top: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }
        
        .images-preview { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 15px; margin-top: 15px; }
        .image-preview-item { position: relative; background: #111; border: 1px solid #222; border-radius: 8px; overflow: hidden; }
        .image-preview-item img { width: 100%; height: 150px; object-fit: cover; }
        .image-preview-item .remove-btn { position: absolute; top: 5px; right: 5px; background: #dc2626; color: #fff; border: none; border-radius: 50%; width: 30px; height: 30px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s; }
        .image-preview-item .remove-btn:hover { background: #fff; color: #dc2626; }
        
        .btn { padding: 12px 24px; border-radius: 6px; font-weight: 500; border: none; cursor: pointer; transition: all 0.3s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
        .btn-primary { background: #dc2626; color: #fff; }
        .btn-primary:hover { background: #b91c1c; }
        .btn-secondary { background: #333; color: #fff; }
        .btn-secondary:hover { background: #444; }
        
        .alert-success { padding: 15px 20px; background: rgba(16, 185, 129, 0.1); color: #10b981; border-left: 4px solid #10b981; border-radius: 8px; margin-bottom: 20px; }
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
                <a href="{{ route('admin.projects.index') }}" class="menu-item">
                    <i class="fas fa-building"></i> Projects
                </a>
                <a href="{{ route('admin.blogs.index') }}" class="menu-item">
                    <i class="fas fa-newspaper"></i> Blog Articles
                </a>
                <a href="{{ route('admin.settings.index') }}" class="menu-item active">
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
            <div class="page-header">
                <h1>Settings - Hero Images</h1>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>

            @if(session('success'))
            <div class="alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
            @endif

            <div class="settings-container">
                <form action="{{ route('admin.settings.hero-images.update') }}" method="POST" enctype="multipart/form-data" id="hero-images-form">
                    @csrf
                    
                    <div class="settings-section">
                        <h2>Homepage Hero Images</h2>
                        <div class="hero-section">
                            <h3>Homepage Hero Slideshow Images</h3>
                            <div class="drop-zone" id="home-drop-zone">
                                <i class="fas fa-file-upload"></i>
                                <p>Drop images here or click to select</p>
                                <input type="file" id="home_images" name="home_images[]" accept="image/*" multiple>
                            </div>
                            <div class="images-preview" id="home-preview">
                                @if(isset($heroImages['home']) && $heroImages['home'])
                                    @php $homeImages = json_decode($heroImages['home']->images, true); @endphp
                                    @foreach($homeImages as $index => $image)
                                    <div class="image-preview-item">
                                        <img src="{{ asset('storage/' . $image) }}" alt="Hero Image {{ $index + 1 }}">
                                        <button type="button" class="remove-btn" onclick="removeImage('home', {{ $index }})">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    @php
                        $services = [
                            'architectural-design' => 'Architectural Design',
                            'structural-design' => 'Structural Design',
                            'bim-page' => 'BIM (Building Information Modeling)',
                            'interior-design' => 'Interior Design',
                            '3d-rendering' => '3D Rendering',
                            'estimation-page' => 'Estimation & Consultation',
                            'project-management' => 'Project Management'
                        ];
                    @endphp

                    <div class="settings-section">
                        <h2>Service Pages Hero Images</h2>
                        @foreach($services as $pageType => $serviceName)
                        <div class="hero-section">
                            <h3>{{ $serviceName }}</h3>
                            <div class="drop-zone" data-page="{{ $pageType }}">
                                <i class="fas fa-file-upload"></i>
                                <p>Drop images here or click to select</p>
                                <input type="file" id="{{ str_replace('-', '_', $pageType) }}_images" name="{{ str_replace('-', '_', $pageType) }}_images[]" accept="image/*" multiple>
                            </div>
                            <div class="images-preview" id="{{ $pageType }}-preview">
                                @if(isset($heroImages[$pageType]) && $heroImages[$pageType])
                                    @php $serviceImages = json_decode($heroImages[$pageType]->images, true); @endphp
                                    @foreach($serviceImages as $index => $image)
                                    <div class="image-preview-item">
                                        <img src="{{ asset('storage/' . $image) }}" alt="Hero Image {{ $index + 1 }}">
                                        <button type="button" class="remove-btn" onclick="removeImage('{{ $pageType }}', {{ $index }})">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div style="margin-top: 30px;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save All Hero Images
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        // Drag and drop functionality
        document.querySelectorAll('.drop-zone').forEach(dropZone => {
            const input = dropZone.querySelector('input[type="file"]');
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(e => dropZone.addEventListener(e, preventDefaults));
            
            function preventDefaults(e) { e.preventDefault(); e.stopPropagation(); }
            
            ['dragenter', 'dragover'].forEach(e => dropZone.addEventListener(e, () => dropZone.classList.add('dragover')));
            ['dragleave', 'drop'].forEach(e => dropZone.addEventListener(e, () => dropZone.classList.remove('dragover')));
            
            dropZone.addEventListener('drop', handleDrop);
            dropZone.addEventListener('click', () => input.click());
            
            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files.length > 0) {
                    input.files = files;
                    previewImages(files, dropZone);
                }
            }
            
            input.addEventListener('change', function() {
                if (this.files.length > 0) {
                    previewImages(this.files, dropZone);
                }
            });
        });
        
        function previewImages(files, dropZone) {
            const pageType = dropZone.dataset.page || 'home';
            const previewContainer = document.getElementById(pageType + '-preview') || document.getElementById('home-preview');
            
            Array.from(files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewItem = document.createElement('div');
                        previewItem.className = 'image-preview-item';
                        previewItem.innerHTML = `
                            <img src="${e.target.result}" alt="Preview">
                        `;
                        previewContainer.appendChild(previewItem);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
        
        function removeImage(pageType, index) {
            if (confirm('Remove this image?')) {
                fetch(`/admin/settings/hero-images/${pageType}/${index}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        }
    </script>
</body>
</html>

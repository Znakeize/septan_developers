<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; background: #000; color:#e5e5e5; }
        
        .admin-container { display: flex; min-height: 100vh; }
        .sidebar { width: 260px; background: #1a1a1a; color: #fff; padding: 20px 0; position: fixed; height: 100vh; overflow-y: auto; }
        .sidebar-header { padding: 0 20px 30px; border-bottom: 1px solid #333; }
        .sidebar-header h2 { font-size: 24px; color: #ff4b33; }
        .sidebar-menu { padding: 20px 0; }
        .menu-item { padding: 12px 20px; color: #ccc; text-decoration: none; display: flex; align-items: center; gap: 12px; transition: all 0.3s; }
        .menu-item:hover, .menu-item.active { background: #ff4b33; color: #fff; }
        
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
        .input-group i { position: absolute; left: 12px; top: 14px; color: #999; font-size: 1.1rem; z-index: 1; }
        .input-group input, .input-group textarea, .input-group select {
            width: 100%; padding: 12px 12px 12px 42px; border: 1px solid #222; border-radius: 6px; background:#0b0b0b;
            color: #e5e5e5; font-size: 14px; transition: border 0.3s ease;
        }
        .input-group input:focus, .input-group textarea:focus, .input-group select:focus { outline: none; border-color: #dc2626; }
        
        .drop-zone {
            position: relative; width: 100%; min-height: 140px; background: #0b0b0b; border: 2px dashed #222;
            border-radius: 8px; display: flex; flex-direction: column; align-items: center; justify-content: center;
            color: #9ca3af; font-size: 0.95rem; transition: all 0.3s ease; cursor: pointer; padding: 20px;
        }
        .drop-zone:hover, .drop-zone.dragover { border-color: #dc2626; background: #0f0f0f; color: #dc2626; }
        .drop-zone i { font-size: 2.5rem; margin-bottom: 10px; color: #6b7280; }
        .drop-zone.dragover i { color: #ff4b33; }
        .drop-zone input { position: absolute; left: 0; top: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }
        .file-list { margin-top: 10px; font-size: 0.85rem; color: #666; max-height: 80px; overflow-y: auto; width: 100%; }
        
        .image-preview { margin-top: 10px; display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 10px; max-height: 250px; overflow-y: auto; border-radius: 8px; }
        .image-preview img { width: 100%; height: 100px; object-fit: cover; border-radius: 6px; border: 1px solid #ddd; }
        
        .gallery-images { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 10px; }
        .gallery-item { position: relative; }
        .gallery-item img { width: 120px; height: 120px; object-fit: cover; border-radius: 6px; }
        .remove-gallery { position: absolute; top: -8px; right: -8px; background: #ef4444; color: #fff; border: none; width: 24px; height: 24px; border-radius: 50%; cursor: pointer; font-size: 16px; }
        
        .checkbox-group { display: flex; align-items: center; gap: 10px; }
        .checkbox-group input { width: auto; }
        
        .btn-group { display: flex; gap: 15px; margin-top: 30px; }
        .btn { padding: 12px 24px; border-radius: 6px; font-weight: 500; border: none; cursor: pointer; transition: all 0.3s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
        .btn-primary { background: #dc2626; color: #fff; }
        .btn-primary:hover { background: #b91c1c; }
        .btn-secondary { background: #374151; color: #fff; }
        .btn-secondary:hover { background: #1f2937; }
        
        .error { color: #ef4444; font-size: 13px; margin-top: 5px; }
        .help-text { font-size: 12px; color: #9ca3af; margin-top: 5px; }
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
                    <h1>EDIT <span style="color: #ff4b33;">PROJECT</span></h1>
                    <a href="{{ route('admin.projects.index') }}" class="back-btn">
                        <i class="fas fa-arrow-left"></i> Back to Projects
                    </a>
                </div>

                <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" id="project-form">
    @csrf
    @method('PUT')

                    <div class="form-row">
                        <div class="form-group input-group">
                            <i class="fas fa-building"></i>
                            <input type="text" id="title" name="title" placeholder="Project Name" value="{{ old('title', $project->title) }}" required>
                        </div>
                        <div class="form-group input-group">
                            <i class="fas fa-project-diagram"></i>
                            <select id="type" name="type" required>
                                <option value="" disabled>Select Type</option>
                                <option value="Eco-Friendly Resort" {{ old('type', $project->type) == 'Eco-Friendly Resort' ? 'selected' : '' }}>Eco-Friendly Resort</option>
                                <option value="Sustainable Office" {{ old('type', $project->type) == 'Sustainable Office' ? 'selected' : '' }}>Sustainable Office</option>
                                <option value="Minimalist Villa" {{ old('type', $project->type) == 'Minimalist Villa' ? 'selected' : '' }}>Minimalist Villa</option>
                                <option value="Heritage Restoration" {{ old('type', $project->type) == 'Heritage Restoration' ? 'selected' : '' }}>Heritage Restoration</option>
                                <option value="Wellness Center" {{ old('type', $project->type) == 'Wellness Center' ? 'selected' : '' }}>Wellness Center</option>
                                <option value="Green Hotel" {{ old('type', $project->type) == 'Green Hotel' ? 'selected' : '' }}>Green Hotel</option>
                            </select>
                        </div>
                        <div class="form-group input-group">
                            <i class="fas fa-i-cursor"></i>
                            <input type="text" id="type_custom" name="type_custom" placeholder="Or enter custom type" value="{{ old('type_custom') }}">
                            <div class="help-text">If filled, this will override the selected type.</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group input-group">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" id="location" name="location" placeholder="Location" value="{{ old('location', $project->location) }}" required>
                        </div>
                        <div class="form-group input-group">
                            <i class="fas fa-calendar-alt"></i>
                            <input type="text" id="year" name="year" placeholder="Year" value="{{ old('year', $project->year) }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group input-group">
                            <i class="fas fa-tag"></i>
                            <select id="category" name="category" required>
                                <option value="" disabled>Select Category</option>
                                <option value="residential" {{ old('category', $project->category) == 'residential' ? 'selected' : '' }}>Residential</option>
                                <option value="commercial" {{ old('category', $project->category) == 'commercial' ? 'selected' : '' }}>Commercial</option>
                                <option value="renovation" {{ old('category', $project->category) == 'renovation' ? 'selected' : '' }}>Renovation</option>
                            </select>
                        </div>
                        <div class="form-group input-group">
                            <i class="fas fa-video"></i>
                            <input type="text" id="video_url" name="video_url" placeholder="YouTube Video URL (Optional)" value="{{ old('video_url', $project->video_url) }}">
                            <div class="help-text">Example: https://www.youtube.com/watch?v=OU4CpZUUJTU</div>
                        </div>
                    </div>

                    <div class="form-group input-group full-width">
                        <i class="fas fa-paragraph"></i>
                        <textarea id="description" name="description" placeholder="Project Description" required>{{ old('description', $project->description) }}</textarea>
                    </div>

                    <div class="form-group full-width">
                        <label style="display:block;margin-bottom:10px;font-weight:600;">Feature Cards (up to 6)</label>
                        <div class="form-row">
                            @for($i=0; $i<6; $i++)
                            <?php $f = $project->features[$i] ?? null; ?>
                            <div class="form-group" style="border:1px dashed #ddd;border-radius:8px;padding:12px;">
                                <div class="form-group input-group">
                                    <i class="fas fa-heading"></i>
                                    <input type="text" name="features[{{$i}}][title]" placeholder="Feature title" value="{{ old('features.'.$i.'.title', $f['title'] ?? '') }}">
                                </div>
                                <div class="form-group input-group">
                                    <i class="fas fa-align-left"></i>
                                    <input type="text" name="features[{{$i}}][description]" placeholder="Feature description" value="{{ old('features.'.$i.'.description', $f['description'] ?? '') }}">
                                </div>
                                <div class="form-group input-group">
                                    <i class="fas fa-icons"></i>
                                    <input type="text" name="features[{{$i}}][icon]" placeholder="Font Awesome icon e.g. leaf, wind, solar-panel" value="{{ old('features.'.$i.'.icon', $f['icon'] ?? '') }}">
                                </div>
                            </div>
                            @endfor
                        </div>
                        <div class="help-text">Leave any unused feature blocks empty.</div>
                    </div>

                    <div class="form-group full-width">
                        <label style="margin-bottom: 10px; display: block;">Main Image</label>
                        <div class="drop-zone" id="main-image-drop-zone">
                            <i class="fas fa-image"></i>
                            <p>Drop main image here or click to select</p>
                            <input type="file" id="main_image" name="main_image" accept="image/*">
                        </div>
                        <div class="image-preview" id="main-image-preview" style="{{ $project->main_image ? 'display: grid;' : 'display: none;' }}">
                            @if($project->main_image)
                            <img src="{{ asset('storage/' . $project->main_image) }}" alt="Current main image">
                            @endif
                        </div>
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
                        @if($project->gallery_images && count($project->gallery_images) > 0)
                        <div class="gallery-images" style="margin-top: 15px;">
                            @foreach($project->gallery_images as $index => $image)
                            <div class="gallery-item">
                                <img src="{{ asset('storage/' . $image) }}" alt="Gallery image">
                                <button type="button" class="remove-gallery" onclick="removeGalleryImage({{ $project->id }}, {{ $index }})">×</button>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        <div class="image-preview" id="gallery-preview"></div>
                        @error('gallery_images.*')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group input-group">
                            <i class="fas fa-user"></i>
                            <input type="text" id="client_name" name="client_name" placeholder="Client Name (Optional)" value="{{ old('client_name', $project->client_name) }}">
                        </div>
                        <div class="form-group input-group">
                            <i class="fas fa-ruler-combined"></i>
                            <input type="number" step="0.01" id="project_area" name="project_area" placeholder="Project Area (sq ft)" value="{{ old('project_area', $project->project_area) }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group input-group">
                            <i class="fas fa-calendar"></i>
                            <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}">
                        </div>
                        <div class="form-group input-group">
                            <i class="fas fa-calendar-check"></i>
                            <input type="date" id="completion_date" name="completion_date" value="{{ old('completion_date', $project->completion_date?->format('Y-m-d')) }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <div class="checkbox-group">
                                <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', $project->is_published) ? 'checked' : '' }}>
                                <label for="is_published" style="margin: 0;">Published</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox-group">
                                <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}>
                                <label for="is_featured" style="margin: 0;">Featured</label>
                            </div>
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Project
                        </button>
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
  </form>
</div>
        </main>
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

        function removeGalleryImage(projectId, index) {
            if (confirm('Are you sure you want to remove this image?')) {
                fetch(`/admin/projects/${projectId}/gallery/${index}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    }
                }).then(response => response.json())
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog Article - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/mammoth@1.6.0/mammoth.browser.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.0.379/pdf.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; background: #000; color:#e5e5e5; }
        
        .admin-container { display: flex; min-height: 100vh; }
        .sidebar { width: 260px; background: #1a1a1a; color: #fff; padding: 20px 0; position: fixed; height: 100vh; }
        .sidebar-header { padding: 0 20px 30px; border-bottom: 1px solid #333; }
        .sidebar-header h2 { font-size: 24px; color: #ff4b33; }
        .sidebar-menu { padding: 20px 0; }
        .menu-item { padding: 12px 20px; color: #ccc; text-decoration: none; display: flex; align-items: center; gap: 12px; }
        .menu-item:hover, .menu-item.active { background: #ff4b33; color: #fff; }
        
        .main-content { flex: 1; margin-left: 260px; padding: 30px; }
        .form-container { background: #0f0f0f; padding: 30px; border-radius: 10px; border:1px solid #222; max-width: 1000px; }
        .form-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .form-header h1 { font-size: 28px; color: #dc2626; letter-spacing:1px; }
        .back-btn { color: #666; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
        
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; color: #bbb; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .full-width { grid-column: 1 / -1; }
        
        .input-group { position: relative; }
        .input-group i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #999; font-size: 1.1rem; width: 24px; text-align: center; z-index: 1; pointer-events: none; }
        .input-group input, .input-group textarea, .input-group select {
            width: 100%; padding: 12px 12px 12px 56px; border: 1px solid #222; border-radius: 6px; background:#0b0b0b;
            color: #e5e5e5; font-size: 14px; transition: border 0.3s ease;
        }
        .input-group input:focus, .input-group textarea:focus, .input-group select:focus { outline: none; border-color: #dc2626; }
        .input-group .help-text, .input-group .error { margin-left: 56px; }
        .input-group textarea { min-height: 150px; resize: vertical; }
        textarea#content { display: none; }
        
        /* Quill Editor Styles */
        #editor-container { 
            min-height: 400px; 
            background: #0b0b0b;
            border: 1px solid #222;
            border-radius: 6px;
            margin-bottom: 5px;
        }
        .ql-editor {
            min-height: 400px;
            font-size: 16px;
            line-height: 1.6;
            font-family: Arial, sans-serif;
        }
        .ql-toolbar {
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
            border-bottom: 1px solid #222;
            background: #0b0b0b;
            color:#e5e5e5;
        }
        .ql-container {
            border-bottom-left-radius: 6px;
            border-bottom-right-radius: 6px;
        }
        
        /* Custom styles for bullet point colors */
        .ql-editor ul li::marker,
        .ql-editor ol li::marker {
            color: inherit;
        }
        .ql-editor ul[style*="color"] li,
        .ql-editor ol[style*="color"] li {
            color: inherit;
        }
        .ql-editor li[style*="color"] {
            color: inherit;
        }
        
        .drop-zone {
            position: relative; width: 100%; min-height: 140px; background: #0b0b0b; border: 2px dashed #222;
            border-radius: 8px; display: flex; flex-direction: column; align-items: center; justify-content: center;
            color: #9ca3af; font-size: 0.95rem; transition: all 0.3s ease; cursor: pointer; padding: 20px;
        }
        .drop-zone:hover, .drop-zone.dragover { border-color: #dc2626; background: #0f0f0f; color: #dc2626; }
        .drop-zone i { font-size: 2.5rem; margin-bottom: 10px; color: #6b7280; }
        .drop-zone.dragover i { color: #dc2626; }
        .drop-zone input { position: absolute; left: 0; top: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }
        .file-name { margin-top: 10px; font-size: 0.9rem; color: #ff4b33; word-break: break-all; }
        
        .image-preview { margin-top: 10px; max-height: 200px; overflow: hidden; border-radius: 8px; display: none; }
        .image-preview img { width: 100%; height: auto; object-fit: cover; }
        
        .checkbox-group { display: flex; align-items: center; gap: 10px; }
        .checkbox-group input { width: auto; }
        
        .help-text { font-size: 13px; color: #999; margin-top: 5px; }
        
        .btn-group { display: flex; gap: 15px; margin-top: 30px; }
        .btn { padding: 12px 24px; border-radius: 6px; font-weight: 500; border: none; cursor: pointer; transition: all 0.3s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
        .btn-primary { background: #dc2626; color: #fff; }
        .btn-primary:hover { background: #b91c1c; }
        .btn-secondary { background: #374151; color: #fff; }
        .btn-secondary:hover { background: #1f2937; }
        
        .error { color: #dc2626; font-size: 13px; margin-top: 5px; }
        .extract-msg { padding: 12px; border-radius: 6px; text-align: center; margin-top: 15px; font-size: 0.9rem; display: none; background: #7c3aed; color: #fff; }
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
                <a href="{{ route('admin.projects.index') }}" class="menu-item">
                    <i class="fas fa-building"></i> Projects
                </a>
                <a href="{{ route('admin.blogs.index') }}" class="menu-item active">
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
                    <h1>EDIT <span style="color: #ff4b33;">BLOG</span></h1>
                    <a href="{{ route('admin.blogs.index') }}" class="back-btn">
                        <i class="fas fa-arrow-left"></i> Back to Articles
                    </a>
                </div>

                <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data" id="blog-form">
    @csrf
    @method('PUT')

                    <div class="form-group input-group">
                        <i class="fas fa-heading"></i>
                        <input type="text" id="title" name="title" placeholder="Blog Title" value="{{ old('title', $blog->title) }}" required>
                        @error('title')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group input-group">
                            <i class="fas fa-tag"></i>
                            <select id="category" name="category" required>
                                <option value="" disabled>Select Category</option>
                                <option value="Sustainability" {{ old('category', $blog->category) == 'Sustainability' ? 'selected' : '' }}>Sustainability</option>
                                <option value="Commercial" {{ old('category', $blog->category) == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                                <option value="Residential" {{ old('category', $blog->category) == 'Residential' ? 'selected' : '' }}>Residential</option>
                                <option value="Interior Design" {{ old('category', $blog->category) == 'Interior Design' ? 'selected' : '' }}>Interior Design</option>
                                <option value="Wellness" {{ old('category', $blog->category) == 'Wellness' ? 'selected' : '' }}>Wellness</option>
                                <option value="Architecture" {{ old('category', $blog->category) == 'Architecture' ? 'selected' : '' }}>Architecture</option>
                            </select>
                            @error('category')<div class="error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group input-group">
                            <i class="fas fa-calendar-alt"></i>
                            <input type="date" id="published_date" name="published_date" value="{{ old('published_date', $blog->published_date->format('Y-m-d')) }}" required>
                            @error('published_date')<div class="error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="form-group input-group full-width">
                        <i class="fas fa-quote-left"></i>
                        <textarea id="excerpt" name="excerpt" required placeholder="Brief summary of the article (max 500 characters)">{{ old('excerpt', $blog->excerpt) }}</textarea>
                        <div class="help-text">A short description that appears in article listings</div>
                        @error('excerpt')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group full-width">
                        <label style="margin-bottom: 10px; display: block;">Featured Image</label>
                        <div class="drop-zone" id="blog-drop-zone">
                            <i class="fas fa-file-upload"></i>
                            <p>Drop <strong>image</strong>, <strong>Word (.docx)</strong>, or <strong>PDF</strong> here<br>or click to select</p>
                            <input type="file" id="featured_image" name="featured_image" accept="image/*,.docx,.pdf">
                            <div class="file-name" id="blog-file-name"></div>
                        </div>
                        @if($blog->featured_image)
                        <div class="image-preview" id="current-image" style="display: block;">
                            <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="Current featured image">
                        </div>
                        @endif
                        <div class="image-preview" id="blog-image-preview" style="display: none;">
                            <img src="" alt="Featured Image">
                        </div>
                        <div id="extract-msg" class="extract-msg">Text extracted!</div>
                        <div class="help-text">You can upload an image, Word document, or PDF. Content will be extracted from Word/PDF files.</div>
                        @error('featured_image')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group full-width">
                        <label style="margin-bottom: 10px; display: block; font-weight: 500; color: #333;">Article Content *</label>
                        <div id="editor-container"></div>
                        <textarea id="content" name="content" required style="display: none;">{{ old('content', $blog->content) }}</textarea>
                        <div class="help-text">Use the toolbar above to format your text, change colors, add bullet points, and adjust alignment.</div>
                        @error('content')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group input-group">
                        <i class="fas fa-tags"></i>
                        <input type="text" id="tags" name="tags" value="{{ old('tags', $blog->tags ? implode(', ', $blog->tags) : '') }}" placeholder="design, architecture, sustainability">
                        <div class="help-text">Separate tags with commas</div>
                        @error('tags')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <div class="checkbox-group">
                            <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', $blog->is_published) ? 'checked' : '' }}>
                            <label for="is_published" style="margin: 0;">Published (visible on website)</label>
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Article
                        </button>
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
  </form>
</div>
        </main>
    </div>

    <!-- AI Assistant Toggle & Panel -->
    <button id="ai-toggle" style="position: fixed; right: 20px; bottom: 20px; z-index: 1000; background: #6b21a8; color: #fff; border: none; border-radius: 9999px; padding: 12px 16px; font-weight: 600; cursor: pointer; box-shadow: 0 10px 20px rgba(0,0,0,0.4);">
        <span style="margin-right:6px;">✨</span> AI Assistant
    </button>

    <div id="ai-panel" style="position: fixed; top: 0; right: 0; height: 100%; width: 320px; background: linear-gradient(135deg, rgba(46,16,101,0.95), rgba(0,0,0,0.95)); border-left: 1px solid rgba(168,85,247,0.3); backdrop-filter: blur(8px); transform: translateX(100%); transition: transform 0.3s ease; z-index: 1000; color: #e5e7eb;">
        <div style="display:flex; align-items:center; justify-content:space-between; padding:16px; border-bottom: 1px solid rgba(168,85,247,0.2);">
            <div style="display:flex; align-items:center; gap:8px; font-weight:600;">✨ <span>AI Assistant</span></div>
            <button id="ai-close" style="background:transparent; color:#9ca3af; border:none; font-size:18px; cursor:pointer;">✕</button>
        </div>
        <div style="padding: 12px;">
            <button class="ai-action" data-action="title" style="width:100%; display:flex; align-items:center; gap:10px; padding:10px 12px; background: rgba(147,51,234,0.15); border:1px solid rgba(147,51,234,0.25); border-radius:8px; color:#e9d5ff; margin-bottom:10px;">🏷️ Generate Title</button>
            <button class="ai-action" data-action="excerpt" style="width:100%; display:flex; align-items:center; gap:10px; padding:10px 12px; background: rgba(147,51,234,0.15); border:1px solid rgba(147,51,234,0.25); border-radius:8px; color:#e9d5ff; margin-bottom:10px;">📝 Write Excerpt</button>
            <button class="ai-action" data-action="content" style="width:100%; display:flex; align-items:center; gap:10px; padding:10px 12px; background: rgba(147,51,234,0.15); border:1px solid rgba(147,51,234,0.25); border-radius:8px; color:#e9d5ff; margin-bottom:10px;">✨ Enhance Content</button>
            <button class="ai-action" data-action="tags" style="width:100%; display:flex; align-items:center; gap:10px; padding:10px 12px; background: rgba(147,51,234,0.15); border:1px solid rgba(147,51,234,0.25); border-radius:8px; color:#e9d5ff;">💡 Suggest Tags</button>
            <div id="ai-tip" style="margin-top:16px; font-size:12px; color:#c4b5fd; border:1px solid rgba(147,51,234,0.25); background: rgba(147,51,234,0.08); border-radius:8px; padding:10px;">Provide a little context to get better suggestions.</div>
            <div id="ai-loading" style="display:none; margin-top:12px; font-size:12px; color:#a78bfa;">Working…</div>
        </div>
    </div>

    <script>
        const dropZone = document.getElementById('blog-drop-zone');
        const fileInput = document.getElementById('featured_image');
        const fileNameEl = document.getElementById('blog-file-name');
        const preview = document.getElementById('blog-image-preview');
        const currentImage = document.getElementById('current-image');
        const img = preview.querySelector('img');
        const contentArea = document.getElementById('content');
        let extractedText = '';

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(e => dropZone.addEventListener(e, preventDefaults));
        function preventDefaults(e) { e.preventDefault(); e.stopPropagation(); }
        ['dragenter', 'dragover'].forEach(e => dropZone.addEventListener(e, () => dropZone.classList.add('dragover')));
        ['dragleave', 'drop'].forEach(e => dropZone.addEventListener(e, () => dropZone.classList.remove('dragover')));

        dropZone.addEventListener('drop', handleDrop);
        fileInput.addEventListener('change', () => handleFiles(fileInput.files));

        function handleDrop(e) { handleFiles(e.dataTransfer.files); }

        function handleFiles(files) {
            const file = files[0];
            if (!file) return;
            fileNameEl.textContent = `File: ${file.name}`;
            const ext = file.name.split('.').pop().toLowerCase();

            if (['png', 'jpg', 'jpeg', 'webp'].includes(ext)) {
                const reader = new FileReader();
                reader.onload = e => {
                    img.src = e.target.result;
                    preview.style.display = 'block';
                    if (currentImage) currentImage.style.display = 'none';
                };
                reader.readAsDataURL(file);
                fileInput.files = files;
            } else if (ext === 'docx' && typeof mammoth !== 'undefined') {
                extractFromWord(file);
            } else if (ext === 'pdf' && typeof pdfjsLib !== 'undefined') {
                extractFromPDF(file);
            } else {
                alert('Please select an image file for featured image, or Word/PDF for content extraction');
            }
        }

        function extractFromWord(file) {
            const reader = new FileReader();
            reader.onload = async e => {
                try {
                    const result = await mammoth.extractRawText({ arrayBuffer: e.target.result });
                    extractedText = result.value;
                    fillContent(extractedText);
                    showMsg('extract-msg', 'Text extracted from Word!');
                } catch (err) {
                    alert('Error extracting Word file: ' + err.message);
                }
            };
            reader.readAsArrayBuffer(file);
        }

        async function extractFromPDF(file) {
            try {
                const arrayBuffer = await file.arrayBuffer();
                const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
                let fullText = '';
                for (let i = 1; i <= pdf.numPages; i++) {
                    const page = await pdf.getPage(i);
                    const content = await page.getTextContent();
                    fullText += content.items.map(item => item.str).join(' ') + '\n';
                }
                extractedText = fullText;
                fillContent(extractedText);
                showMsg('extract-msg', 'Text extracted from PDF!');
            } catch (err) {
                alert('Error extracting PDF: ' + err.message);
            }
        }

        // Initialize Quill Editor
        var quill = new Quill('#editor-container', {
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    [{ 'size': ['8px', '10px', '12px', '14px', '16px', '18px', '20px', '24px', '28px', '32px', '36px', '48px'] }],
                    ['bold', 'italic', 'underline'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'align': [] }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    ['link'],
                    ['clean']
                ]
            },
            theme: 'snow',
            placeholder: 'Write your full article here...'
        });

        // Load existing content
        var existingContent = {!! json_encode(old('content', $blog->content)) !!};
        if (existingContent) {
            quill.root.innerHTML = existingContent;
            contentArea.value = existingContent;
        }

        // Update textarea on content change
        quill.on('text-change', function() {
            contentArea.value = quill.root.innerHTML;
        });

        // Also update before form submit
        document.getElementById('blog-form').addEventListener('submit', function(e) {
            contentArea.value = quill.root.innerHTML;
        });

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

        aiActions.forEach(btn => {
            btn.addEventListener('click', async () => {
                if (aiBusy) return;
                const action = btn.getAttribute('data-action');
                await simulateAI();
                if (action === 'title') {
                    const titleEl = document.getElementById('title');
                    setIfEmpty(titleEl, "Sustainable Architecture: Building Tomorrow's Green Cities");
                    titleEl.focus();
                } else if (action === 'excerpt') {
                    const excerptEl = document.getElementById('excerpt');
                    setIfEmpty(excerptEl, 'Explore how modern sustainable architecture is revolutionizing urban development with eco-friendly designs that prioritize both aesthetics and environmental responsibility.');
                    excerptEl.focus();
                } else if (action === 'content') {
                    const current = quill.root.innerHTML || '';
                    quill.root.innerHTML = (current + '<p>✨ AI Enhanced: Added compelling narrative structure, improved readability, and optimized SEO keywords.</p>').trim();
                    contentArea.value = quill.root.innerHTML;
                } else if (action === 'tags') {
                    const tagsEl = document.getElementById('tags');
                    setIfEmpty(tagsEl, 'sustainable architecture, green building, eco-design, urban development, LEED certification');
                    tagsEl.focus();
                }
            });
        });

        function fillContent(text) {
            // Convert plain text to HTML for Quill
            var html = '<p>' + text.trim().replace(/\n\n/g, '</p><p>').replace(/\n/g, '<br>') + '</p>';
            quill.root.innerHTML = html;
            contentArea.value = quill.root.innerHTML;
            document.getElementById('tags').value = extractTags(text);
        }

        function extractTags(text) {
            const keywords = text.match(/\b(Design|Sustainable|Office|Wellness|Biophilic|Flexibility|Technology|Green|Eco|Architecture|Nature|Sri Lanka|Minimalist|Residential|Commercial)\b/gi) || [];
            return [...new Set(keywords)].slice(0, 6).join(', ');
        }

        function showMsg(id, text) {
            const el = document.getElementById(id);
            el.textContent = text; el.style.display = 'block';
            setTimeout(() => el.style.display = 'none', 3000);
        }
    </script>
</body>
</html>

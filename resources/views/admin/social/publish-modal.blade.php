<div id="socialPublishModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2><i class="fas fa-share-alt"></i> Share to Social Media</h2>
            <button class="modal-close" onclick="closeSocialModal()">&times;</button>
        </div>

        <form id="socialPublishForm">
            @csrf
            <input type="hidden" id="contentType" name="type" value="">
            <input type="hidden" id="contentId" name="id" value="">

            <div class="form-group">
                <label><i class="fas fa-network-wired"></i> Select Platforms</label>
                <div class="platform-select">
                    <label class="platform-option" data-platform="facebook">
                        <input type="checkbox" name="platforms[]" value="facebook">
                        <i class="fab fa-facebook-f" style="color:#1877f2;"></i>
                        <span>Facebook</span>
                    </label>
                    <label class="platform-option" data-platform="twitter">
                        <input type="checkbox" name="platforms[]" value="twitter">
                        <i class="fab fa-twitter" style="color:#1da1f2;"></i>
                        <span>Twitter</span>
                    </label>
                    <label class="platform-option" data-platform="instagram">
                        <input type="checkbox" name="platforms[]" value="instagram">
                        <i class="fab fa-instagram" style="color:#e1306c;"></i>
                        <span>Instagram</span>
                    </label>
                    <label class="platform-option" data-platform="linkedin">
                        <input type="checkbox" name="platforms[]" value="linkedin">
                        <i class="fab fa-linkedin-in" style="color:#0077b5;"></i>
                        <span>LinkedIn</span>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label><i class="fas fa-edit"></i> Custom Message (Optional)</label>
                <textarea name="custom_message" id="customMessage" placeholder="Leave empty to use auto-generated content..."></textarea>
                <small style="color:#999;">You can customize the post content or leave empty for auto-generation</small>
            </div>

            <div class="form-group">
                <label><i class="fas fa-clock"></i> Publishing Option</label>
                <div style="display:flex;gap:15px;margin-bottom:15px;">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                        <input type="radio" name="publish_option" value="now" checked onchange="toggleSchedule()">
                        <span>Publish Now</span>
                    </label>
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                        <input type="radio" name="publish_option" value="schedule" onchange="toggleSchedule()">
                        <span>Schedule</span>
                    </label>
                </div>
                <input type="datetime-local" name="schedule_at" id="scheduleAt" style="display:none;">
            </div>

            <button type="button" class="btn btn-secondary" style="width:100%;margin-bottom:15px;" onclick="previewPosts()">
                <i class="fas fa-eye"></i> Preview Posts
            </button>

            <div id="previewContainer" class="preview-container" style="display:none;"></div>

            <div style="display:flex;gap:15px;margin-top:25px;">
                <button type="submit" class="btn btn-primary" style="flex:1;">
                    <i class="fas fa-paper-plane"></i> Publish
                </button>
                <button type="button" class="btn btn-secondary" onclick="closeSocialModal()">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); align-items: center; justify-content: center; }
    .modal.active { display: flex; }
    .modal-content { background: #111; border-radius: 10px; padding: 30px; max-width: 900px; width: 90%; max-height: 90vh; overflow-y: auto; border: 1px solid #222; }
    .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid #222; }
    .modal-header h2 { font-size: 24px; color: #dc2626; }
    .modal-close { background: none; border: none; color: #999; font-size: 28px; cursor: pointer; line-height: 1; }
    .modal-close:hover { color: #dc2626; }
    .platform-select { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 15px; }
    .platform-option { background: #0b0b0b; border: 2px solid #222; border-radius: 8px; padding: 15px; cursor: pointer; transition: all 0.3s; text-align: center; }
    .platform-option:hover { border-color: #dc2626; }
    .platform-option.selected { border-color: #dc2626; background: rgba(220, 38, 38, 0.1); }
    .platform-option input[type="checkbox"] { display: none; }
    .platform-option i { font-size: 32px; margin-bottom: 10px; display: block; }
    .platform-option span { display: block; font-size: 14px; color: #ccc; }
    .preview-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-top: 20px; }
    .preview-card { background: #0b0b0b; border: 1px solid #222; border-radius: 8px; padding: 20px; }
    .preview-card h3 { color: #dc2626; margin-bottom: 15px; display: flex; align-items: center; gap: 10px; font-size: 16px; }
    .preview-image { width: 100%; height: 200px; object-fit: cover; border-radius: 6px; margin-bottom: 15px; background: #000; }
    .preview-text { color: #ccc; font-size: 14px; line-height: 1.6; white-space: pre-wrap; word-break: break-word; }
    .preview-meta { margin-top: 15px; padding-top: 15px; border-top: 1px solid #222; font-size: 12px; color: #999; }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; margin-bottom: 8px; color: #bbb; font-weight: 500; }
    .form-group input, .form-group textarea { width: 100%; padding: 12px; background: #0b0b0b; border: 1px solid #222; border-radius: 6px; color: #e5e5e5; font-size: 14px; }
    .form-group input:focus, .form-group textarea:focus { outline: none; border-color: #dc2626; }
    .form-group textarea { min-height: 120px; resize: vertical; font-family: inherit; }
    .btn { padding: 10px 18px; border: none; border-radius: 6px; cursor: pointer; font-weight: 500; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; font-size: 14px; justify-content: center; }
    .btn-primary { background: #dc2626; color: #fff; }
    .btn-primary:hover { background: #b91c1c; }
    .btn-secondary { background: #333; color: #fff; }
    .btn-secondary:hover { background: #444; }
</style>

<script>
    document.querySelectorAll('.platform-option').forEach(option => {
        option.addEventListener('click', function() {
            const checkbox = this.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked;
            this.classList.toggle('selected', checkbox.checked);
        });
    });

    function toggleSchedule() {
        const scheduleInput = document.getElementById('scheduleAt');
        const scheduleOption = document.querySelector('input[name="publish_option"][value="schedule"]');
        scheduleInput.style.display = scheduleOption.checked ? 'block' : 'none';
    }

    function openSocialModal(contentType, contentId) {
        document.getElementById('contentType').value = contentType;
        document.getElementById('contentId').value = contentId;
        document.getElementById('socialPublishModal').classList.add('active');
    }

    function closeSocialModal() {
        document.getElementById('socialPublishModal').classList.remove('active');
        document.getElementById('previewContainer').style.display = 'none';
        document.getElementById('previewContainer').innerHTML = '';
    }

    async function previewPosts() {
        const selectedPlatforms = Array.from(document.querySelectorAll('.platform-option.selected'))
            .map(el => el.dataset.platform);
        if (selectedPlatforms.length === 0) {
            alert('Please select at least one platform');
            return;
        }
        const contentType = document.getElementById('contentType').value;
        const contentId = document.getElementById('contentId').value;
        const customMessage = document.getElementById('customMessage').value;
        const previewContainer = document.getElementById('previewContainer');
        previewContainer.innerHTML = '<div style="text-align:center;padding:20px;color:#999;"><i class="fas fa-spinner fa-spin"></i> Loading previews...</div>';
        previewContainer.style.display = 'block';
        try {
            const promises = selectedPlatforms.map(platform =>
                fetch('/admin/social/preview', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ type: contentType, id: contentId, platform, custom_message: customMessage })
                }).then(r => r.json())
            );
            const previews = await Promise.all(promises);
            previewContainer.innerHTML = previews.map(preview => `
                <div class="preview-card">
                    <h3>
                        <i class="fab fa-${preview.platform}"></i>
                        ${preview.platform.charAt(0).toUpperCase() + preview.platform.slice(1)}
                    </h3>
                    ${preview.image ? `<img src="${preview.image}" class="preview-image" alt="Preview">` : ''}
                    <div class="preview-text">${preview.content}</div>
                    <div class="preview-meta">
                        <div>Characters: ${preview.characterCount} / ${preview.limits.text}</div>
                        ${preview.limits.images ? `<div>Max Images: ${preview.limits.images}</div>` : ''}
                    </div>
                </div>
            `).join('');
        } catch (error) {
            previewContainer.innerHTML = '<div style="text-align:center;padding:20px;color:#ef4444;">Failed to load previews. Please try again.</div>';
        }
    }

    document.getElementById('socialPublishForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const selectedPlatforms = Array.from(document.querySelectorAll('.platform-option.selected'))
            .map(el => el.dataset.platform);
        if (selectedPlatforms.length === 0) {
            alert('Please select at least one platform');
            return;
        }
        const formData = {
            type: document.getElementById('contentType').value,
            id: document.getElementById('contentId').value,
            platforms: selectedPlatforms,
            custom_message: document.getElementById('customMessage').value,
            schedule_at: document.querySelector('input[name="publish_option"]:checked').value === 'schedule'
                ? document.getElementById('scheduleAt').value
                : null
        };
        try {
            const endpoint = formData.schedule_at ? '/admin/social/schedule' : '/admin/social/publish-now';
            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            });
            const result = await response.json();
            if (response.ok && result.success) {
                alert(formData.schedule_at ? 'Posts scheduled successfully!' : 'Posts published successfully!');
                closeSocialModal();
                window.location.reload();
            } else {
                alert('Error: ' + (result.message || 'Failed to publish'));
            }
        } catch (error) {
            alert('Error: ' + error.message);
        }
    });
</script>



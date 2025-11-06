// Social Media Manager - Vanilla JavaScript Implementation
(function() {
    'use strict';

    // Icon SVG strings
    const icons = {
        Share2: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>',
        Twitter: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>',
        Facebook: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>',
        Linkedin: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>',
        Instagram: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>',
        Settings: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 1v6m0 6v6m9-9h-6m-6 0H3m15.364 6.364l-4.243-4.243m-4.242 0L5.636 17.364m12.728 0l-4.243-4.243m-4.242 0L5.636 6.636"/></svg>',
        Clock: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
        FileText: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>',
        CheckCircle: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
        XCircle: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>',
        Trash2: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>',
        Eye: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>',
        Send: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>',
        Link: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/></svg>'
    };

    // State management
    const state = {
        view: 'dashboard',
        posts: [],
        showShareModal: false,
        selectedContent: null,
        selectedPlatforms: [],
        previewPlatform: null,
        customMessages: {},
        accounts: [
            { id: 1, platform: 'Twitter', username: '@yourbrand', connected: true, color: '#1DA1F2', icon: 'Twitter', charLimit: 280 },
            { id: 2, platform: 'Facebook', username: 'YourBrand', connected: true, color: '#1877F2', icon: 'Facebook', charLimit: 63206 },
            { id: 3, platform: 'LinkedIn', username: 'your-company', connected: true, color: '#0A66C2', icon: 'Linkedin', charLimit: 3000 },
            { id: 4, platform: 'Instagram', username: '@yourbrand', connected: false, color: '#E4405F', icon: 'Instagram', charLimit: 2200 }
        ],
        projects: [
            {
                id: 1,
                type: 'project',
                title: 'E-Commerce Platform Redesign',
                description: 'A complete overhaul of the user experience with modern design patterns and improved performance.',
                url: 'https://yourwebsite.com/projects/ecommerce-redesign',
                image: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800',
                date: '2025-11-01',
                tags: ['Web Design', 'UX/UI', 'E-Commerce'],
                shared: false
            },
            {
                id: 2,
                type: 'project',
                title: 'Mobile Banking App',
                description: 'Secure and intuitive mobile banking solution with biometric authentication and real-time notifications.',
                url: 'https://yourwebsite.com/projects/mobile-banking',
                image: 'https://images.unsplash.com/photo-1563986768609-322da13575f3?w=800',
                date: '2025-10-28',
                tags: ['Mobile', 'FinTech', 'Security'],
                shared: true
            }
        ],
        articles: [
            {
                id: 1,
                type: 'article',
                title: '10 Best Practices for Modern Web Development',
                description: 'Learn the essential practices that will make your web applications faster, more secure, and maintainable.',
                url: 'https://yourwebsite.com/articles/web-dev-practices',
                image: 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800',
                date: '2025-11-05',
                tags: ['Web Development', 'Best Practices', 'Tutorial'],
                readTime: '8 min read',
                shared: false
            },
            {
                id: 2,
                type: 'article',
                title: 'The Future of AI in Design',
                description: 'Exploring how artificial intelligence is transforming the creative industry and what it means for designers.',
                url: 'https://yourwebsite.com/articles/ai-in-design',
                image: 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800',
                date: '2025-11-03',
                tags: ['AI', 'Design', 'Future Tech'],
                readTime: '12 min read',
                shared: false
            }
        ]
    };

    // Helper functions
    function getIcon(name, className = 'w-6 h-6', style = '') {
        const iconSvg = icons[name] || '';
        const styleAttr = style ? ` style="${style}"` : '';
        return `<span class="${className}" style="display: inline-flex; align-items: center; justify-content: center;${style ? ' ' + style : ''}">${iconSvg}</span>`;
    }

    function savePosts(posts) {
        localStorage.setItem('socialPosts', JSON.stringify(posts));
        state.posts = posts;
        render();
    }

    function generateDefaultMessage(content, platformId) {
        const platform = state.accounts.find(a => a.id === platformId);
        if (!platform) return '';
        const maxLength = platform.charLimit || 280;
        
        let message = '';
        const hashtags = (content.tags || []).map(tag => `#${tag.replace(/\s+/g, '')}`).join(' ');
        
        switch(platform.platform) {
            case 'Twitter':
                message = `${content.title}\n\n${content.description.substring(0, 150)}...\n\n${hashtags}\n\n${content.url}`;
                break;
            case 'Facebook':
                message = `${content.title}\n\n${content.description}\n\n${content.url}\n\n${hashtags}`;
                break;
            case 'LinkedIn':
                message = `${content.title}\n\n${content.description}\n\nRead more: ${content.url}\n\n${hashtags}`;
                break;
            case 'Instagram':
                message = `${content.title}\n\n${content.description}\n\n${hashtags}\n\nLink in bio: ${content.url}`;
                break;
            default:
                message = `${content.title}\n\n${content.description}\n\n${content.url}`;
        }
        
        return message.substring(0, maxLength);
    }

    function getCharacterCount(platformId) {
        const message = state.customMessages[platformId] || generateDefaultMessage(state.selectedContent, platformId);
        const limit = state.accounts.find(a => a.id === platformId)?.charLimit || 280;
        return { current: message.length, limit, percentage: (message.length / limit) * 100 };
    }

    // Event handlers
    function openShareModal(content) {
        state.selectedContent = content;
        state.selectedPlatforms = [];
        state.previewPlatform = null;
        state.customMessages = {};
        state.showShareModal = true;
        render();
    }

    function togglePlatform(platformId) {
        if (state.selectedPlatforms.includes(platformId)) {
            state.selectedPlatforms = state.selectedPlatforms.filter(id => id !== platformId);
        } else {
            state.selectedPlatforms = [...state.selectedPlatforms, platformId];
        }
        render();
    }

    function handleCustomMessageChange(platformId, message) {
        state.customMessages[platformId] = message;
        render();
    }

    function publishToSocialMedia() {
        if (state.selectedPlatforms.length === 0) {
            alert('Please select at least one platform');
            return;
        }

        const newPost = {
            id: Date.now(),
            contentId: state.selectedContent.id,
            contentType: state.selectedContent.type,
            title: state.selectedContent.title,
            description: state.selectedContent.description,
            url: state.selectedContent.url,
            image: state.selectedContent.image,
            platforms: [...state.selectedPlatforms],
            messages: state.selectedPlatforms.reduce((acc, platformId) => {
                acc[platformId] = state.customMessages[platformId] || generateDefaultMessage(state.selectedContent, platformId);
                return acc;
            }, {}),
            status: 'published',
            createdAt: new Date().toISOString(),
            publishedAt: new Date().toISOString()
        };

        const updatedPosts = [...state.posts, newPost];
        savePosts(updatedPosts);

        // Mark content as shared
        if (state.selectedContent.type === 'project') {
            state.projects = state.projects.map(p => 
                p.id === state.selectedContent.id ? { ...p, shared: true } : p
            );
        } else {
            state.articles = state.articles.map(a => 
                a.id === state.selectedContent.id ? { ...a, shared: true } : a
            );
        }

        state.showShareModal = false;
        alert('Successfully published to selected platforms!');
        render();
    }

    function deletePost(id) {
        if (confirm('Are you sure you want to delete this post?')) {
            savePosts(state.posts.filter(p => p.id !== id));
        }
    }

    // Render functions
    function renderPlatformPreview() {
        if (!state.previewPlatform || !state.selectedContent) {
            return `
                <div class="bg-gray-50 rounded-xl border-2 border-dashed border-gray-300 p-12 text-center">
                    ${getIcon('Eye', 'w-16 h-16 text-gray-300 mx-auto mb-4')}
                    <p class="text-gray-500">Select a platform and click "Preview" to see how your post will look</p>
                </div>
            `;
        }
        
        const account = state.accounts.find(a => a.id === state.previewPlatform);
        const message = state.customMessages[state.previewPlatform] || generateDefaultMessage(state.selectedContent, state.previewPlatform);
        const charCount = getCharacterCount(state.previewPlatform);
        const colorClass = charCount.percentage > 95 ? 'text-red-600' : charCount.percentage > 80 ? 'text-yellow-600' : 'text-green-600';
        const barColorClass = charCount.percentage > 95 ? 'bg-red-500' : charCount.percentage > 80 ? 'bg-yellow-500' : 'bg-green-500';

        return `
            <div class="bg-white rounded-xl border-2 border-gray-200 overflow-hidden">
                <div class="p-4 border-b border-gray-200" style="background-color: ${account.color}10">
                    <div class="flex items-center gap-2">
                        <span class="w-5 h-5" style="display: inline-flex; align-items: center; justify-content: center; color: ${account.color};">${icons[account.icon] || ''}</span>
                        <span class="font-bold text-gray-800">${account.platform} Preview</span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex items-start gap-3 mb-3">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center text-white font-bold">
                            YB
                        </div>
                        <div class="flex-1">
                            <div class="font-bold text-gray-900">${account.username}</div>
                            <div class="text-sm text-gray-500">Just now</div>
                        </div>
                    </div>
                    <div class="whitespace-pre-wrap text-gray-800 mb-3">${message.replace(/\n/g, '<br>')}</div>
                    ${state.selectedContent.image ? `<img src="${state.selectedContent.image}" alt="Preview" class="w-full rounded-lg mb-3 max-h-80 object-cover" />` : ''}
                    <div class="flex items-center gap-4 text-gray-500 text-sm pt-3 border-t border-gray-200">
                        <span class="flex items-center gap-1">
                            ${getIcon('Link', 'w-4 h-4')}
                            ${state.selectedContent.url}
                        </span>
                    </div>
                </div>
                <div class="px-4 pb-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Character count:</span>
                        <span class="font-semibold ${colorClass}">
                            ${charCount.current} / ${charCount.limit}
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                        <div class="h-2 rounded-full transition-all duration-300 ${barColorClass}" style="width: ${Math.min(charCount.percentage, 100)}%"></div>
                    </div>
                </div>
            </div>
        `;
    }

    function renderContent(items, type) {
        return `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                ${items.map((item, index) => `
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300">
                        ${item.image ? `
                            <div class="relative h-48 overflow-hidden">
                                <img src="${item.image}" alt="${item.title}" class="w-full h-full object-cover" />
                                ${item.shared ? `
                                    <div class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1">
                                        ${getIcon('CheckCircle', 'w-3 h-3')}
                                        Shared
                                    </div>
                                ` : ''}
                            </div>
                        ` : ''}
                        <div class="p-5">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded text-xs font-semibold uppercase">
                                    ${type}
                                </span>
                                ${item.readTime ? `
                                    <span class="text-xs text-gray-500 flex items-center gap-1">
                                        ${getIcon('Clock', 'w-3 h-3')}
                                        ${item.readTime}
                                    </span>
                                ` : ''}
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">${item.title}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">${item.description}</p>
                            ${item.tags ? `
                                <div class="flex flex-wrap gap-2 mb-4">
                                    ${item.tags.map(tag => `
                                        <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs">${tag}</span>
                                    `).join('')}
                                </div>
                            ` : ''}
                            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                <span class="text-sm text-gray-500">${new Date(item.date).toLocaleDateString()}</span>
                                <button onclick="socialMediaManager.openShareModalFromData('${type}', ${item.id})" class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg font-semibold hover:shadow-lg transition-all duration-200">
                                    ${getIcon('Share2', 'w-4 h-4')}
                                    Share
                                </button>
                            </div>
                        </div>
                    </div>
                `).join('')}
            </div>
        `;
    }

    function render() {
        const container = document.getElementById('social-media-manager');
        if (!container) return;

        let html = `
            <div class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-pink-50 p-6">
                <div class="max-w-7xl mx-auto">
                    <div class="bg-white rounded-2xl shadow-xl p-6 mb-6 border border-purple-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl">
                                    ${getIcon('Share2', 'w-8 h-8 text-white')}
                                </div>
                                <div>
                                    <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                                        Social Media Manager
                                    </h1>
                                    <p class="text-gray-600 mt-1">Share your projects and articles across platforms</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-xl p-2 mb-6 border border-purple-100">
                        <div class="flex gap-2">
                            <button onclick="socialMediaManager.setView('dashboard')" class="flex-1 px-6 py-3 rounded-xl font-semibold transition-all duration-200 ${state.view === 'dashboard' ? 'bg-gradient-to-r from-purple-600 to-pink-600 text-white shadow-lg' : 'text-gray-600 hover:bg-gray-50'}">
                                Dashboard
                            </button>
                            <button onclick="socialMediaManager.setView('projects')" class="flex-1 px-6 py-3 rounded-xl font-semibold transition-all duration-200 ${state.view === 'projects' ? 'bg-gradient-to-r from-purple-600 to-pink-600 text-white shadow-lg' : 'text-gray-600 hover:bg-gray-50'}">
                                Projects
                            </button>
                            <button onclick="socialMediaManager.setView('articles')" class="flex-1 px-6 py-3 rounded-xl font-semibold transition-all duration-200 ${state.view === 'articles' ? 'bg-gradient-to-r from-purple-600 to-pink-600 text-white shadow-lg' : 'text-gray-600 hover:bg-gray-50'}">
                                Articles
                            </button>
                        </div>
                    </div>
        `;

        if (state.view === 'dashboard') {
            html += `
                <div class="bg-white rounded-2xl shadow-xl p-6 mb-6 border border-purple-100">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        ${getIcon('Settings', 'w-6 h-6 text-purple-600')}
                        Connected Accounts
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        ${state.accounts.map(account => `
                            <div class="flex items-center gap-3 p-4 rounded-xl border-2 transition-all duration-200 hover:shadow-md cursor-pointer" style="border-color: ${account.connected ? account.color : '#E5E7EB'}; background-color: ${account.connected ? account.color + '10' : '#F9FAFB'}">
                                <span class="w-6 h-6" style="display: inline-flex; align-items: center; justify-content: center; color: ${account.color};">${icons[account.icon] || ''}</span>
                                <div class="flex-1">
                                    <div class="font-semibold text-gray-800">${account.platform}</div>
                                    <div class="text-sm text-gray-600">${account.username}</div>
                                </div>
                                ${account.connected ? `<span class="w-5 h-5 text-green-500" style="display: inline-flex; align-items: center; justify-content: center; color: rgb(34, 197, 94);">${icons.CheckCircle}</span>` : `<span class="w-5 h-5 text-gray-400" style="display: inline-flex; align-items: center; justify-content: center; color: rgb(156, 163, 175);">${icons.XCircle}</span>`}
                            </div>
                        `).join('')}
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-xl p-6 border border-purple-100">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        ${getIcon('FileText', 'w-6 h-6 text-purple-600')}
                        Published & Scheduled Posts (${state.posts.length})
                    </h2>
                    ${state.posts.length === 0 ? `
                        <div class="text-center py-12">
                            ${getIcon('Share2', 'w-16 h-16 text-gray-300 mx-auto mb-4')}
                            <p class="text-gray-500 text-lg">No posts yet. Share your projects or articles to get started!</p>
                        </div>
                    ` : `
                        <div class="space-y-4">
                            ${state.posts.map(post => `
                                <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-all duration-200">
                                    <div class="flex items-start gap-4">
                                        ${post.image ? `<img src="${post.image}" alt="${post.title}" class="w-24 h-24 rounded-lg object-cover flex-shrink-0" />` : ''}
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">PUBLISHED</span>
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800">${post.contentType.toUpperCase()}</span>
                                            </div>
                                            <h3 class="text-lg font-bold text-gray-800 mb-2">${post.title}</h3>
                                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">${post.description}</p>
                                            <div class="flex items-center gap-4">
                                                <div class="flex items-center gap-2">
                                                    ${post.platforms.map(platformId => {
                                                        const account = state.accounts.find(a => a.id === platformId);
                                                        if (!account) return '';
                                                        return `<div class="p-2 rounded-lg" style="background-color: ${account.color}20"><span class="w-4 h-4" style="display: inline-flex; align-items: center; justify-content: center; color: ${account.color};">${icons[account.icon] || ''}</span></div>`;
                                                    }).join('')}
                                                </div>
                                                <span class="text-sm text-gray-500 flex items-center gap-1">
                                                    ${getIcon('Clock', 'w-4 h-4')}
                                                    ${new Date(post.publishedAt).toLocaleString()}
                                                </span>
                                            </div>
                                        </div>
                                        <button onclick="socialMediaManager.deletePost(${post.id})" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                            ${getIcon('Trash2', 'w-5 h-5')}
                                        </button>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    `}
                </div>
            `;
        } else if (state.view === 'projects') {
            html += `
                <div class="bg-white rounded-2xl shadow-xl p-6 border border-purple-100">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Your Projects</h2>
                    ${renderContent(state.projects, 'project')}
                </div>
            `;
        } else if (state.view === 'articles') {
            html += `
                <div class="bg-white rounded-2xl shadow-xl p-6 border border-purple-100">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Your Articles</h2>
                    ${renderContent(state.articles, 'article')}
                </div>
            `;
        }

        html += `</div></div>`;

        // Share Modal
        if (state.showShareModal && state.selectedContent) {
            html += `
                <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 overflow-y-auto" onclick="if(event.target === this) socialMediaManager.closeShareModal()">
                    <div class="bg-white rounded-2xl shadow-2xl max-w-6xl w-full max-h-[95vh] overflow-y-auto" onclick="event.stopPropagation()">
                        <div class="sticky top-0 bg-white p-6 border-b border-gray-200 z-10">
                            <h2 class="text-2xl font-bold text-gray-800">Share to Social Media</h2>
                            <p class="text-gray-600 mt-1">${state.selectedContent.title}</p>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div class="space-y-6">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800 mb-4">Select Platforms</h3>
                                        <div class="space-y-3">
                                            ${state.accounts.filter(a => a.connected).map(account => {
                                                const isSelected = state.selectedPlatforms.includes(account.id);
                                                const message = state.customMessages[account.id] || generateDefaultMessage(state.selectedContent, account.id);
                                                const charCount = getCharacterCount(account.id);
                                                const colorClass = charCount.percentage > 95 ? 'text-red-600' : charCount.percentage > 80 ? 'text-yellow-600' : 'text-green-600';
                                                
                                                return `
                                                    <div>
                                                        <button onclick="socialMediaManager.togglePlatform(${account.id})" class="w-full flex items-center gap-3 p-4 rounded-xl border-2 transition-all duration-200 ${isSelected ? 'border-purple-500 bg-purple-50' : 'border-gray-200 bg-white hover:border-gray-300'}">
                                                            <span class="w-6 h-6" style="display: inline-flex; align-items: center; justify-content: center; color: ${account.color};">${icons[account.icon] || ''}</span>
                                                            <div class="flex-1 text-left">
                                                                <div class="font-semibold text-gray-800">${account.platform}</div>
                                                                <div class="text-sm text-gray-500">${account.username}</div>
                                                            </div>
                                                            ${isSelected ? `<span class="w-5 h-5" style="display: inline-flex; align-items: center; justify-content: center; color: rgb(147, 51, 234);">${icons.CheckCircle}</span>` : ''}
                                                        </button>
                                                        ${isSelected ? `
                                                            <div class="mt-3 ml-4 space-y-2">
                                                                <div class="flex items-center justify-between">
                                                                    <label class="text-sm font-semibold text-gray-700">Customize Message</label>
                                                                    <button onclick="socialMediaManager.setPreviewPlatform(${account.id})" class="flex items-center gap-1 text-sm text-purple-600 hover:text-purple-700 font-semibold">
                                                                        ${getIcon('Eye', 'w-4 h-4')}
                                                                        Preview
                                                                    </button>
                                                                </div>
                                                                <textarea oninput="socialMediaManager.handleCustomMessageChange(${account.id}, this.value)" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Write message for ${account.platform}...">${message}</textarea>
                                                                <div class="flex items-center justify-between text-xs">
                                                                    <span class="text-gray-500">Character limit: ${account.charLimit}</span>
                                                                    <span class="font-semibold ${colorClass}">
                                                                        ${charCount.current} / ${charCount.limit}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        ` : ''}
                                                    </div>
                                                `;
                                            }).join('')}
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-6">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800 mb-4">Platform Preview</h3>
                                        ${renderPlatformPreview()}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sticky bottom-0 bg-white p-6 border-t border-gray-200 flex gap-3 justify-end">
                            <button onclick="socialMediaManager.closeShareModal()" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors">
                                Cancel
                            </button>
                            <button onclick="socialMediaManager.publishToSocialMedia()" ${state.selectedPlatforms.length === 0 ? 'disabled' : ''} class="flex items-center gap-2 px-6 py-3 rounded-xl font-semibold transition-all duration-200 ${state.selectedPlatforms.length === 0 ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-gradient-to-r from-purple-600 to-pink-600 text-white hover:shadow-lg'}">
                                ${getIcon('Send', 'w-5 h-5')}
                                Publish to ${state.selectedPlatforms.length} Platform${state.selectedPlatforms.length !== 1 ? 's' : ''}
                            </button>
                        </div>
                    </div>
                </div>
            `;
        }

        container.innerHTML = html;
    }

    // Public API
    window.socialMediaManager = {
        setView: function(view) {
            state.view = view;
            render();
        },
        openShareModal: function(content) {
            openShareModal(content);
        },
        openShareModalFromData: function(type, id) {
            const items = type === 'project' ? state.projects : state.articles;
            const content = items.find(item => item.id === id);
            if (content) {
                openShareModal(content);
            }
        },
        closeShareModal: function() {
            state.showShareModal = false;
            render();
        },
        togglePlatform: function(platformId) {
            togglePlatform(platformId);
        },
        setPreviewPlatform: function(platformId) {
            state.previewPlatform = platformId;
            render();
        },
        handleCustomMessageChange: function(platformId, message) {
            handleCustomMessageChange(platformId, message);
        },
        publishToSocialMedia: function() {
            publishToSocialMedia();
        },
        deletePost: function(id) {
            deletePost(id);
        },
        render: render
    };

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        // Load posts from localStorage
        const savedPosts = JSON.parse(localStorage.getItem('socialPosts') || '[]');
        state.posts = savedPosts;
        render();
    });

    // Re-render if container already exists (for Vite HMR)
    if (document.getElementById('social-media-manager')) {
        const savedPosts = JSON.parse(localStorage.getItem('socialPosts') || '[]');
        state.posts = savedPosts;
        render();
    }
})();


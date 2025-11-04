function toggleMenu() {
  var el = document.getElementById('nav-menu');
  if (el) el.classList.toggle('active');
}

document.addEventListener('DOMContentLoaded', function () {
  var form = document.getElementById('contact-form');
  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var successMessage = document.getElementById('form-success');
      if (successMessage) {
        successMessage.textContent = "Thank you for your message! We'll get back to you soon.";
        successMessage.classList.add('active');
      }
      form.reset();
    });
  }

  // Smooth scroll for in-page anchors (index and others)
  var anchors = document.querySelectorAll('a[href^="#"]');
  if (anchors && anchors.length) {
    anchors.forEach(function(anchor){
      anchor.addEventListener('click', function(e){
        var href = this.getAttribute('href');
        if (!href || href === '#') return;
        var target = document.querySelector(href);
        if (target) {
          e.preventDefault();
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
          var nav = document.getElementById('nav-menu');
          if (nav) nav.classList.remove('active');
        }
      });
    });
  }

  // Generic hero slider + dynamic slide builder
  (function(){
    var body = document.body || document.querySelector('body');
    var pageKey = (body && body.dataset && body.dataset.page) ? body.dataset.page : '';

    // Determine assets base path robustly even under subdirectories
    var ASSET_BASE = (function(){
      var current = document.currentScript;
      if (!current) {
        var scripts = Array.from(document.scripts || []);
        current = scripts.find(function(sc){ return sc && sc.src && sc.src.indexOf('assets/js/main.js') !== -1; });
      }
      if (current && current.src) {
        // e.g. http://localhost/Project/septan-developers/public/assets/js/main.js -> .../assets/
        return current.src.replace(/assets\/[\\/]js[\\\/]main\.js.*/,'assets/');
      }
      return 'assets/';
    })();

    var heroImagesByPage = {
      // Services
      'architectural-design': [
        ASSET_BASE + 'img/amila_ruwan-liyanapathirana-wood-locally-bricks-hotel-moksha-nature-sri-lanka-designboom-03-1-b5a51208.jpg',
        ASSET_BASE + 'img/sri-lanka-60e70f72.jpg',
        ASSET_BASE + 'img/Eco-Friendly-House-Designs-in-Sri-Lanka-4-d631f37c.jpg'
      ],
      'structural-design': [
        ASSET_BASE + 'img/seamless-regeneration-in-the-jungle-5-633956dc14e9a-5316f9fa.jpg',
        ASSET_BASE + 'img/palinda-kannagara-linear-house-at-battaramulla-sri-lanka-designboom-mobile-55e43d88.jpg',
        ASSET_BASE + 'img/Eco-Friendly-House-Designs-in-Sri-Lanka-4-d631f37c.jpg'
      ],
      'bim-page': [
        ASSET_BASE + 'img/photo-1503387762-592deb58ef4e-e7177998.jpg',
        ASSET_BASE + 'img/photo-1542744173-8e7e53415bb0-60905cef.jpg',
        ASSET_BASE + 'img/photo-1454165804606-c3d57bc86b40-7891da17.jpg'
      ],
      'interior-design': [
        ASSET_BASE + 'img/photo-1618221195710-dd6b41faaea6-826e1ee1.jpg',
        ASSET_BASE + 'img/palinda-kannagara-linear-house-at-battaramulla-sri-lanka-designboom-mobile-55e43d88.jpg',
        ASSET_BASE + 'img/Eco-Friendly-House-Designs-in-Sri-Lanka-4-d631f37c.jpg'
      ],
      '3d-rendering': [
        ASSET_BASE + 'img/photo-1600607687939-ce8a6c25118c-7b3ad1b3.jpg',
        ASSET_BASE + 'img/photo-1503387762-592deb58ef4e-e7177998.jpg',
        ASSET_BASE + 'img/seamless-regeneration-in-the-jungle-5-633956dc14e9a-5316f9fa.jpg'
      ],
      'estimation-page': [
        ASSET_BASE + 'img/photo-1454165804606-c3d57bc86b40-7891da17.jpg',
        ASSET_BASE + 'img/photo-1542744173-8e7e53415bb0-60905cef.jpg',
        ASSET_BASE + 'img/photo-1503387762-592deb58ef4e-e7177998.jpg'
      ],
      'project-management': [
        ASSET_BASE + 'img/photo-1542744173-8e7e53415bb0-60905cef.jpg',
        ASSET_BASE + 'img/photo-1503387762-592deb58ef4e-e7177998.jpg',
        ASSET_BASE + 'img/photo-1454165804606-c3d57bc86b40-7891da17.jpg'
      ],
      'structural-design': [
        ASSET_BASE + 'img/photo-1503387762-592deb58ef4e-e7177998.jpg',
        ASSET_BASE + 'img/seamless-regeneration-in-the-jungle-5-633956dc14e9a-5316f9fa.jpg',
        ASSET_BASE + 'img/Eco-Friendly-House-Designs-in-Sri-Lanka-4-d631f37c.jpg'
      ],
      // Project pages
      'project-moksha': [
        ASSET_BASE + 'img/amila_ruwan-liyanapathirana-wood-locally-bricks-hotel-moksha-nature-sri-lanka-designboom-03-1-b5a51208.jpg',
        ASSET_BASE + 'img/palinda-kannagara-linear-house-at-battaramulla-sri-lanka-designboom-mobile-55e43d88.jpg',
        ASSET_BASE + 'img/seamless-regeneration-in-the-jungle-5-633956dc14e9a-5316f9fa.jpg'
      ],
      // Blog pages
      'blog-sustainable': [
        ASSET_BASE + 'img/amila_ruwan-liyanapathirana-wood-locally-bricks-hotel-moksha-nature-sri-lanka-designboom-03-1-b5a51208.jpg',
        ASSET_BASE + 'img/seamless-regeneration-in-the-jungle-5-633956dc14e9a-5316f9fa.jpg',
        ASSET_BASE + 'img/palinda-kannagara-linear-house-at-battaramulla-sri-lanka-designboom-mobile-55e43d88.jpg'
      ],
      'blog-office': [
        ASSET_BASE + 'img/seamless-regeneration-in-the-jungle-5-633956dc14e9a-5316f9fa.jpg',
        ASSET_BASE + 'img/photo-1542744173-8e7e53415bb0-60905cef.jpg',
        ASSET_BASE + 'img/photo-1503387762-592deb58ef4e-e7177998.jpg'
      ],
      'blog-minimalist': [
        ASSET_BASE + 'img/palinda-kannagara-linear-house-at-battaramulla-sri-lanka-designboom-mobile-55e43d88.jpg',
        ASSET_BASE + 'img/Eco-Friendly-House-Designs-in-Sri-Lanka-4-d631f37c.jpg',
        ASSET_BASE + 'img/sri-lanka-60e70f72.jpg'
      ]
    };

    var defaultImages = [
      ASSET_BASE + 'img/amila_ruwan-liyanapathirana-wood-locally-bricks-hotel-moksha-nature-sri-lanka-designboom-03-1-b5a51208.jpg',
      ASSET_BASE + 'img/seamless-regeneration-in-the-jungle-5-633956dc14e9a-5316f9fa.jpg',
      ASSET_BASE + 'img/palinda-kannagara-linear-house-at-battaramulla-sri-lanka-designboom-mobile-55e43d88.jpg'
    ];

    function ensureSlides(container, images){
      if (!container) return null;
      var existing = container.querySelector('.hero-slides');
      if (existing) return existing;
      var slidesWrap = document.createElement('div');
      slidesWrap.className = 'hero-slides';
      images.forEach(function(src, idx){
        var s = document.createElement('div');
        s.className = 'hero-slide' + (idx === 0 ? ' active' : '');
        s.style.backgroundImage = "url('" + src + "')";
        slidesWrap.appendChild(s);
      });
      // Insert slides as the first child so overlays/content sit above
      container.insertBefore(slidesWrap, container.firstChild);
      return slidesWrap;
    }

    // Build slides for service/blog/project heroes if needed
    var heroContainers = Array.from(document.querySelectorAll('.hero, .service-hero, .blog-hero, .project-hero'));
    heroContainers.forEach(function(cont){
      var hasSlides = cont.querySelector('.hero-slides');
      if (!hasSlides) {
        var imgs = heroImagesByPage[pageKey] || defaultImages;
        ensureSlides(cont, imgs);
      }
    });

    // Start a scoped slider for each slides container and wire prev/next controls
    var allSlidesContainers = document.querySelectorAll('.hero-slides');
    allSlidesContainers.forEach(function(wrap){
      var slides = wrap.querySelectorAll('.hero-slide');
      if (!slides || !slides.length) return;
      var idx = 0;
      var timer = setInterval(next, 4000);

      function show(i){
        slides[idx].classList.remove('active');
        idx = (i + slides.length) % slides.length;
        slides[idx].classList.add('active');
      }
      function next(){ show(idx + 1); }
      function prev(){ show(idx - 1); }

      var parentHero = wrap.closest('.service-hero, .hero, .blog-hero, .project-hero');
      if (parentHero){
        var prevBtn = parentHero.querySelector('.hero-nav .prev');
        var nextBtn = parentHero.querySelector('.hero-nav .next');
        if (prevBtn && nextBtn){
          prevBtn.addEventListener('click', function(){ clearInterval(timer); prev(); });
          nextBtn.addEventListener('click', function(){ clearInterval(timer); next(); });
        }
      }
    });
  })();

  // Index page: build cube cluster inside #cubeHolder if present
  (function(){
    var cubeHolder = document.getElementById('cubeHolder');
    var cubeScene = document.getElementById('cubeScene');
    if (!cubeHolder || !cubeScene) return;

    var n = 3; // 3x3x3
    var mid = (n - 1) / 2;
    var baseSize = 14; // px
    var gap = 2; // px

    for (var z = 0; z < n; z++){
      for (var y = 0; y < n; y++){
        for (var x = 0; x < n; x++){
          var el = document.createElement('div');
          el.className = 'cubelet';

          var rSize = baseSize - 4 + Math.round(Math.random() * 10);
          el.style.setProperty('--size', rSize + 'px');

          var ox = (x - mid) * (rSize + gap);
          var oy = (y - mid) * (rSize + gap);
          var oz = (z - mid) * (rSize + gap);
          el.style.setProperty('--tx', ox + 'px');
          el.style.setProperty('--ty', oy + 'px');
          el.style.setProperty('--tz', oz + 'px');

          var rx = (Math.random()*40 - 20).toFixed(2);
          var ry = (Math.random()*40 - 20).toFixed(2);
          el.style.transform = 'translate3d(' + ox + 'px, ' + oy + 'px, ' + oz + 'px) rotateX(' + rx + 'deg) rotateY(' + ry + 'deg)';

          el.style.animationDelay = (Math.random()*0.8).toFixed(2) + 's';
          el.style.animationDuration = (1.6 + Math.random()*1.4).toFixed(2) + 's';

          el.classList.add('animate');
          cubeHolder.appendChild(el);
        }
      }
    }

    cubeScene.addEventListener('click', function(){
      cubeHolder.animate([
        { transform: 'scale(1)' },
        { transform: 'scale(1.08)' },
        { transform: 'scale(1)' }
      ], { duration: 420, easing: 'ease-out' });
    });
  })();

  // Index page: stats reveal and count-up + map dots
  (function(){
    var statCards = document.querySelectorAll('.stat-card');
    if (!statCards || !statCards.length) return;
    var anyTriggered = false;

    function startCountIfNeeded(card){
      var el = card.querySelector('.stat-number');
      if (!el || el.dataset.counting) return;
      el.dataset.counting = '1';
      var target = Number(el.getAttribute('data-target')) || 0;
      var duration = (target > 50) ? 1500 : 1200;
      var stepTime = 16;
      var steps = Math.max(8, Math.floor(duration/stepTime));
      var inc = target/steps;
      var val = 0;
      var t = setInterval(function(){
        val += inc;
        if (val >= target - 0.5) {
          clearInterval(t);
          el.textContent = Math.round(target) + "+";
        } else {
          el.textContent = Math.floor(val);
        }
      }, stepTime);
    }

    function startMapAnimation(){
      var mapContainer = document.getElementById('mapContainer');
      if (!mapContainer || mapContainer.dataset.started) return;
      mapContainer.dataset.started = '1';

      // Ensure a visible background image inside mapContainer (local first, CDN fallback)
      var bg = mapContainer.querySelector('img.map-bg');
      if (!bg) {
        bg = document.createElement('img');
        bg.className = 'map-bg';
        bg.alt = '';
        var triedCdn = false;
        function useCdn(){
          if (triedCdn) return;
          triedCdn = true;
          bg.src = 'https://upload.wikimedia.org/wikipedia/commons/8/80/World_map_-_low_resolution.svg';
        }
        bg.onerror = useCdn;
        bg.src = ASSET_BASE + 'img/World_map_-_low_resolution-1d5a3ce1.svg';
        mapContainer.appendChild(bg);
      }

      function placeDot(el){
        el.style.left = (Math.random()*90) + '%';
        el.style.top = (Math.random()*90) + '%';
        el.style.animationDelay = (Math.random()*2) + 's';
        var s = 6 + Math.round(Math.random()*8);
        el.style.width = s + 'px';
        el.style.height = s + 'px';
      }

      function createDot(){
        var d = document.createElement('div');
        d.className = 'dot';
        placeDot(d);
        mapContainer.appendChild(d);
        return d;
      }

      for (var i=0;i<20;i++) createDot();
      setInterval(function(){
        var existing = Array.from(mapContainer.querySelectorAll('.dot'));
        var removeCount = Math.min(existing.length, Math.floor(existing.length*0.28));
        for (var i=0;i<removeCount;i++){
          var idx = Math.floor(Math.random()*existing.length);
          var el = existing[idx];
          if (el) { el.remove(); existing.splice(idx,1); }
        }
        var add = 3 + Math.floor(Math.random()*6);
        for (var j=0;j<add;j++) createDot();
      }, 5200);
    }

    var obs = new IntersectionObserver(function(entries){
      entries.forEach(function(e){
        if (e.isIntersecting){
          e.target.classList.add('visible');
          startCountIfNeeded(e.target);
          if (e.target.id === 'card-projects') startMapAnimation();
          anyTriggered = true;
        }
      });
    }, { threshold: 0.35 });

    statCards.forEach(function(c){ obs.observe(c); });

    // Fallback: if cards are already in view on load
    function elemInViewport(el){
      var r = el.getBoundingClientRect();
      return r.top < window.innerHeight * 0.8 && r.bottom > 0;
    }
    statCards.forEach(function(c){
      if (elemInViewport(c)){
        c.classList.add('visible');
        startCountIfNeeded(c);
        if (c.id === 'card-projects') startMapAnimation();
        anyTriggered = true;
      }
    });

    // Force start shortly after DOM ready
    setTimeout(function(){
      statCards.forEach(function(c){
        c.classList.add('visible');
        startCountIfNeeded(c);
        if (c.id === 'card-projects') startMapAnimation();
      });
    }, 150);

    // And on window load, in case of late layout/asset shifts
    window.addEventListener('load', function(){
      statCards.forEach(function(c){
        c.classList.add('visible');
        startCountIfNeeded(c);
        if (c.id === 'card-projects') startMapAnimation();
      });
    });
  })();

  // Index page: project filters and clickable cards
  (function(){
    var filterButtons = document.querySelectorAll('.projects-filters button');
    var projectCards = document.querySelectorAll('.project-card');
    if (filterButtons && filterButtons.length) {
      filterButtons.forEach(function(btn){
        btn.addEventListener('click', function(){
          filterButtons.forEach(function(b){ b.classList.remove('active'); });
          btn.classList.add('active');
          var filter = btn.dataset.filter;
          projectCards.forEach(function(card){
            if (!filter || filter === 'all' || card.dataset.category === filter) {
              card.classList.add('active');
            } else {
              card.classList.remove('active');
            }
          });
        });
      });
    }

    // Make service and project cards with data-href clickable
    var cards = document.querySelectorAll('.service-card[data-href], .project-card[data-href]');
    if (cards && cards.length) {
      cards.forEach(function(card){
        card.addEventListener('click', function(){
          var to = card.getAttribute('data-href');
          if (to) window.location.href = to;
        });
      });
    }
  })();

  // Optional: initialize project video if present (uses data-video-url on iframe)
  var videoIframe = document.getElementById('projectVideo');
  if (videoIframe && videoIframe.dataset && videoIframe.dataset.videoUrl) {
    try {
      var youtubeUrl = videoIframe.dataset.videoUrl;
      var idMatch = youtubeUrl.match(/(?:v=|\.be\/|embed\/)([A-Za-z0-9_-]{11})/);
      var videoId = idMatch ? idMatch[1] : null;
      if (videoId) {
        var params = new URLSearchParams({
          autoplay: '1',
          mute: '1',
          controls: '0',
          rel: '0',
          playsinline: '1',
          modestbranding: '1',
          loop: '1',
          playlist: videoId
        });
        videoIframe.src = "https://www.youtube.com/embed/" + videoId + "?" + params.toString();
      }
    } catch (e) { /* no-op */ }
  }
});


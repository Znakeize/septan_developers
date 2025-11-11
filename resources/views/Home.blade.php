<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Septan Developers - Expert construction design, consultation, and engineering services. Build your vision with innovative solutions.">
    <meta name="keywords" content="construction design, architectural design, structural engineering, building information modleing, interior design, 3D rendering, Septan Developers, Sri Lanka">
    <title>Septan Developers - Build Your Vision</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @include('partials.animations-init')
    <link rel="stylesheet" href="{{ asset('assets/css/chatbot.css') }}">
    <style>
        /* Enhanced Carousel Styles */
        .enhanced-carousel-container {
            position: relative;
            max-width: 100%;
            margin: 60px auto;
            padding: 0;
        }
        
        .enhanced-carousel-wrapper {
            position: relative;
            overflow: visible;
            padding: 40px 0 48px;
            margin: 0 auto;
        }
        
        .enhanced-carousel-track {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            position: relative;
            height: 620px;
            width: 100%;
        }
        
        .enhanced-carousel-item {
            position: absolute;
            width: 320px;
            height: 560px;
            left: 50%;
            top: 50%;
            margin-left: -160px;
            margin-top: -280px;
            transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            opacity: 0.5;
            transform: translateX(0) scale(0.85);
            z-index: 10;
            pointer-events: none;
        }
        
        .enhanced-carousel-item.active-center {
            opacity: 1 !important;
            z-index: 30;
            pointer-events: all;
        }
        
        .enhanced-carousel-item.active-side {
            opacity: 0.5 !important;
            z-index: 20;
            pointer-events: all;
        }
        
        .enhanced-carousel-item.hidden {
            opacity: 0;
            pointer-events: none;
            z-index: 1;
        }
        
        .carousel-item-image {
            width: 100%;
            height: 250px;
            background-size: cover;
            background-position: center;
            border-radius: 12px 12px 0 0;
        }
        
        .carousel-item-content {
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.1), rgba(0, 0, 0, 0.9));
            padding: 28px 24px 28px;
            height: calc(100% - 250px);
            display: flex;
            flex-direction: column;
            border-radius: 0 0 12px 12px;
            border: 1px solid rgba(220, 38, 38, 0.2);
            border-top: none;
        }
        
        .carousel-item-content h3 {
            font-size: 1.4rem;
            color: #fff;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .carousel-item-content p {
            font-size: 0.95rem;
            color: #ccc;
            line-height: 1.6;
            margin-bottom: 8px;
        }
        
        .carousel-item-content .blog-category {
            color: #dc2626;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }
        
        .carousel-item-content .blog-date {
            color: #999;
            font-size: 0.85rem;
            margin-bottom: 12px;
        }
        
        /* Navigation Buttons */
        .carousel-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: #fff;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 40;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .carousel-nav-btn:hover {
            background: rgba(220, 38, 38, 0.8);
            transform: translateY(-50%) scale(1.1);
        }
        
        .carousel-nav-btn i {
            font-size: 20px;
        }
        
        .carousel-prev {
            left: 20px;
        }
        
        .carousel-next {
            right: 20px;
        }
        
        /* Dots Indicator */
        .carousel-dots {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 16px;
        }
        
        .carousel-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 0;
        }
        
        .carousel-dot.active {
            width: 32px;
            background: #dc2626;
            border-radius: 4px;
        }
        
        .carousel-dot:hover {
            background: rgba(220, 38, 38, 0.6);
        }
        
        /* Info Text */
        .carousel-info {
            text-align: center;
            margin-top: 20px;
            color: #999;
            font-size: 0.9rem;
        }
        
        @media (max-width: 1024px) {
            .enhanced-carousel-item {
                width: 280px;
                height: 500px;
            }
            
            .carousel-nav-btn {
                width: 40px;
                height: 40px;
            }
            
            .carousel-prev {
                left: 10px;
            }
            
            .carousel-next {
                right: 10px;
            }
        }
        
        @media (max-width: 768px) {
            .enhanced-carousel-item {
                width: 90%;
                max-width: 320px;
                height: 520px;
            }
            
            .enhanced-carousel-item.active-side {
                opacity: 0;
                pointer-events: none;
            }
            
            .carousel-nav-btn {
                width: 36px;
                height: 36px;
            }
            
            .carousel-nav-btn i {
                font-size: 16px;
            }
        }
    </style>
</head>
<body data-page="index">
    @include('partials.page-loader')
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <div class="logo"><a href="{{ route('home') }}" style="display:inline-flex;align-items:center;gap:10px;text-decoration:none;">
                <img src="{{ asset('assets/img/logo-sample.svg') }}" alt="Septan" style="height:32px;display:block;"/>
                <span style="font-weight:900;letter-spacing:2px;color:#dc2626;">SEPTAN</span>
            </a></div>
            <button class="menu-toggle" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </button>
            <ul id="nav-menu">
                <li><a href="{{route('home')}}#about">About</a></li>
                <li class="dropdown">
                    <a href="{{route('home')}}#services">Services</a>
                    <ul>
                        <li><a href="{{route('services.architectural_design')}}">Architectural Design</a></li>
                        <li><a href="{{route('services.structural_design')}}">Structural Design</a></li>
			                  <li><a href="{{route('services.bim')}}">Building Information Modeling (BIM)</a></li>
                        <li><a href="{{route('services.interior_design')}}">Interior Design</a></li>
                        <li><a href="{{route('services.3d_rendering')}}">3D Rendering</a></li>
                        <li><a href="{{route('services.estimation')}}">Estimation & Consultation</a></li>
                        <li><a href="{{route('services.project_management')}}">Project Management</a></li>
                    </ul>
                </li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
                <li><a href="#blog">Blog</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-slides">
            @if(isset($heroImages) && count($heroImages) > 0)
                @foreach($heroImages as $index => $image)
                <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" style="background-image: url('{{ $image }}');"></div>
                @endforeach
            @else
                {{-- Fallback images --}}
                <div class="hero-slide active" style="background-image: url('assets/img/amila_ruwan-liyanapathirana-wood-locally-bricks-hotel-moksha-nature-sri-lanka-designboom-03-1-b5a51208.jpg');"></div>
                <div class="hero-slide" style="background-image: url('assets/img/seamless-regeneration-in-the-jungle-5-633956dc14e9a-5316f9fa.jpg');"></div>
                <div class="hero-slide" style="background-image: url('assets/img/palinda-kannagara-linear-house-at-battaramulla-sri-lanka-designboom-mobile-55e43d88.jpg');"></div>
                <div class="hero-slide" style="background-image: url('assets/img/sri-lanka-60e70f72.jpg');"></div>
                <div class="hero-slide" style="background-image: url('assets/img/Eco-Friendly-House-Designs-in-Sri-Lanka-4-d631f37c.jpg');"></div>
            @endif
        </div>
        <div class="scroll-text top">ARCHITECTURAL DESIGN • STRUCTURAL ENGINEERING • BUILDING INFORMATION MODELING (BIM) • INTERIOR DESIGN • 3D VISUALIZATION • PROJECT MANAGEMENT</div>
        <div class="hero-content">
            <div class="hero-subtitle">EXPERT CONSTRUCTION DESIGN & ENGINEERING</div>
            <h1>BUILD YOUR VISION</h1>
            <div class="hero-tagline">INNOVATIVE • SUSTAINABLE • TIMELESS</div>
            <a href="#contact" class="cta-button">Request a Quote</a>
        </div>
        <div class="scroll-text bottom">CONSTRUCTION CONSULTATION • ESTIMATION SERVICES • BUILDING DESIGN • ECO-FRIENDLY SOLUTIONS</div>
    </section>

    <!-- About Section -->
    <section id="about" class="dark" data-aos="fade-up">
        <div class="section-container">
            <h2 data-aos="fade-up" data-aos-delay="100">ABOUT <span>SEPTAN DEVELOPERS</span></h2>
            <div class="about-content" data-aos="fade-up" data-aos-delay="200">
                <p>Founded in 2020, we blend modern architecture with natural elements to create innovative spaces. We've completed over 300 projects, focusing on sustainability and client satisfaction.</p>
            </div>
        </div>
    </section>

    <!-- Stats Section with Animated Icons -->
    <section class="light" data-aos="fade-up">
        <div class="section-container">
            <h2 data-aos="fade-up" data-aos-delay="100">OUR <span>ACHIEVEMENTS</span></h2>
            <div class="stats-wrapper">
                <!-- Years Card with Cube Animation -->
                <div class="stat-card" id="card-years">
                    <div class="icon-wrap">
                        <div class="cube-scene" id="cubeScene">
                            <div class="cube-holder" id="cubeHolder"></div>
                        </div>
                    </div>
                    <div class="stat-number" data-target="5" id="years-number">0</div>
                    <div class="stat-label">Years in Business</div>
                </div>

                <!-- Projects Card with World Map Animation -->
                <div class="stat-card" id="card-projects">
                    <div class="icon-wrap">
                        <div class="map-wrap" id="mapWrap">
                            <div class="map-container" id="mapContainer">
                                <img class="map-bg" src="{{ asset('assets/img/World_map_-_low_resolution-1d5a3ce1.svg') }}" alt="" />
                            </div>
                        </div>
                    </div>
                    <div class="stat-number" data-target="300" id="projects-number">0</div>
                    <div class="stat-label">Projects Completed</div>
                    <div class="small-note">* 35+ Countries in All Around the World</div>
                </div>

                <!-- Clients Card with Handshake Animation -->
                <div class="stat-card" id="card-clients">
                    <div class="icon-wrap">
                        <svg class="handshake-scene" viewBox="0 0 200 150" xmlns="http://www.w3.org/2000/svg">
                            <g transform="translate(0,10)">
                                <g class="person" transform="translate(0,0)">
                                    <circle cx="60" cy="38" r="12" fill="rgba(255,255,255,0.94)"/>
                                    <rect x="44" y="56" width="32" height="36" rx="6" ry="6" fill="rgba(255,255,255,0.92)"/>
                                    <g class="arm arm-left" transform="translate(0,0)">
                                        <rect x="54" y="70" width="40" height="10" rx="4" ry="4" fill="rgba(255,255,255,0.95)"/>
                                        <rect x="90" y="68" width="12" height="10" rx="3" ry="3" fill="rgba(255,75,75,0.96)"/>
                                    </g>
                                    <circle cx="140" cy="34" r="12" fill="rgba(255,255,255,0.94)"/>
                                    <rect x="124" y="56" width="32" height="36" rx="6" ry="6" fill="rgba(255,255,255,0.92)"/>
                                    <g class="arm arm-right" transform="translate(0,0)">
                                        <rect x="106" y="70" width="44" height="10" rx="4" ry="4" fill="rgba(255,255,255,0.95)"/>
                                        <rect x="98" y="68" width="12" height="10" rx="3" ry="3" fill="rgba(255,75,75,0.96)"/>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div class="stat-number" data-target="135" id="clients-number">0</div>
                    <div class="stat-label">Projects Completed</div>
                    <div class="small-note">* 100% satisfaction rate</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision Mission Section -->
    <section class="dark" data-aos="fade-up">
        <div class="section-container">
            <h2 data-aos="fade-up" data-aos-delay="100">VISION & <span>MISSION</span></h2>
            <div class="vision-mission-grid">
                <div class="vm-card" data-aos="fade-up" data-aos-delay="200">
                    <h3>Vision</h3>
                    <p>To pioneer a global standard in sustainable construction, leading Sri Lanka's architectural landscape with groundbreaking innovations that set benchmarks for environmental stewardship, community enrichment, and timeless design excellence.</p>
                </div>
                <div class="vm-card" data-aos="fade-up" data-aos-delay="300">
                    <h3>Mission</h3>
                    <p>To provide exceptional architectural and engineering services, prioritizing client satisfaction, environmental responsibility, and cutting-edge technology to create timeless structures.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="light" data-aos="fade-up">
        <div class="section-container">
            <h2 data-aos="fade-up" data-aos-delay="100">OUR <span>SERVICES</span></h2>
            <div class="services-grid">
                <div class="service-card" data-href="{{route('services.architectural_design')}}" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon-wrap">
                    <svg class="house-scene" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true">
                     <defs>
                 <linearGradient id="glowGradient" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" style="stop-color:rgba(255,75,75,0.96);stop-opacity:1" />
              <stop offset="33%" style="stop-color:rgba(255,75,75,0.8);stop-opacity:0.9" />
              <stop offset="66%" style="stop-color:rgba(255,75,75,0.6);stop-opacity:0.7" />
              <stop offset="100%" style="stop-color:rgba(255,75,75,0.3);stop-opacity:0.5" />
            </linearGradient>
            <linearGradient id="windowGradient" x1="0%" y1="0%" x2="0%" y2="100%">
              <stop offset="0%" style="stop-color:rgba(255,255,255,0.92);stop-opacity:1" />
              <stop offset="100%" style="stop-color:rgba(255,255,255,0.7);stop-opacity:0.9" />
            </linearGradient>
            <pattern id="roofTexture" patternUnits="userSpaceOnUse" width="10" height="10">
              <rect x="0" y="0" width="5" height="5" fill="rgba(255,75,75,0.2)" />
              <rect x="5" y="5" width="5" height="5" fill="rgba(255,75,75,0.15)" />
            </pattern>
            <pattern id="brickTexture" patternUnits="userSpaceOnUse" width="10" height="5">
              <rect x="0" y="0" width="10" height="2" fill="rgba(255,255,255,0.1)" />
              <rect x="5" y="2" width="5" height="2" fill="rgba(255,255,255,0.1)" />
            </pattern>
            <filter id="shadow" x="-20%" y="-20%" width="140%" height="140%">
              <feDropShadow dx="2" dy="2" stdDeviation="2" flood-color="rgba(0,0,0,0.3)" />
            </filter>
          </defs>
          <path class="house-base" d="M100 100 H300 V250 H100 Z M100 100 L200 50 L300 100" />
          <path class="house-roof" d="M100 100 L200 50 L300 100 V120 H100 Z" />
          <rect class="house-detail" x="260" y="70" width="20" height="30" fill="url(#brickTexture)" />
          <rect class="house-detail" x="120" y="140" width="30" height="40" rx="2" />
          <rect class="house-detail" x="155" y="140" width="30" height="40" rx="2" />
          <rect class="house-detail" x="215" y="140" width="30" height="40" rx="2" />
          <rect class="house-detail" x="170" y="190" width="40" height="60" rx="4" />
          <rect class="house-detail" x="180" y="200" width="20" height="20" rx="2" />
          <path class="house-detail" d="M140 220 V250 M160 220 V250 M180 220 V250" />
          <path class="house-detail" d="M80 180 C90 150 110 150 120 180 C110 210 90 210 80 180 V250" />
          <path class="house-glow" d="M100 100 H300 V250 H100 Z M100 100 L200 50 L300 100" />
        </svg>
      </div>
                    <h3>Architectural Design</h3>
                    <p>Striking facades integrating stone, wood, and metal with nature. We create innovative designs that blend modern aesthetics with environmental harmony.</p>
                    
                </div>
                <div class="service-card" data-href="{{route('services.structural_design')}}" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon-wrap">
        <svg class="structure-scene" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true">
          <defs>
            <linearGradient id="glowGradient" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" style="stop-color:rgba(255,75,75,0.96);stop-opacity:1" />
              <stop offset="33%" style="stop-color:rgba(255,75,75,0.8);stop-opacity:0.9" />
              <stop offset="66%" style="stop-color:rgba(255,75,75,0.6);stop-opacity:0.7" />
              <stop offset="100%" style="stop-color:rgba(255,75,75,0.3);stop-opacity:0.5" />
            </linearGradient>
            <linearGradient id="groundGradient" x1="0%" y1="0%" x2="0%" y2="100%">
              <stop offset="0%" style="stop-color:rgba(255,255,255,0.1);stop-opacity:0.5" />
              <stop offset="100%" style="stop-color:rgba(255,255,255,0.05);stop-opacity:0.3" />
            </linearGradient>
            <linearGradient id="concreteGradient" x1="0%" y1="0%" x2="0%" y2="100%">
              <stop offset="0%" style="stop-color:rgba(255,255,255,0.15);stop-opacity:0.95" />
              <stop offset="100%" style="stop-color:rgba(255,255,255,0.05);stop-opacity:0.85" />
            </linearGradient>
            <pattern id="concreteTexture" patternUnits="userSpaceOnUse" width="8" height="8">
              <circle cx="2" cy="2" r="1.5" fill="rgba(255,255,255,0.15)" />
              <circle cx="6" cy="6" r="1" fill="rgba(255,255,255,0.1)" />
            </pattern>
            <pattern id="groundTexture" patternUnits="userSpaceOnUse" width="6" height="6">
              <rect x="0" y="0" width="3" height="3" fill="rgba(255,255,255,0.1)" />
              <rect x="3" y="3" width="3" height="3" fill="rgba(255,255,255,0.05)" />
            </pattern>
            <filter id="shadow" x="-20%" y="-20%" width="140%" height="140%">
              <feDropShadow dx="2" dy="2" stdDeviation="2" flood-color="rgba(0,0,0,0.3)" />
            </filter>
          </defs>
          <!-- Ground plane with texture -->
          <rect class="ground-plane" x="80" y="220" width="240" height="30" rx="4" />
          <rect class="ground-texture" x="80" y="220" width="240" height="30" rx="4" fill="url(#groundTexture)" />
          <!-- High-rise rebar (dense grid with diagonal bracing) -->
          <g class="rebar-highrise">
            <path d="M182 80 V220 M188 80 V220 M212 80 V220 M218 80 V220 M180 90 H220 M180 100 H220 M180 110 H220 M180 120 H220 M180 130 H220 M180 140 H220 M180 150 H220 M180 160 H220 M180 170 H220 M180 180 H220 M180 190 H220 M180 200 H220 M180 210 H220 M200 80 V60" />
          </g>
          <g class="rebar-diagonal">
            <path d="M185 80 L215 220 M215 80 L185 220" />
          </g>
          <!-- Mid-rise rebar (wider, with arches and diagonal supports) -->
          <g class="rebar-midrise">
            <path d="M100 120 V220 M140 120 V220 M100 140 H140 M100 160 H140 M100 180 H140 M110 120 C120 100 130 100 140 120 M110 140 C120 130 130 130 140 140 M110 160 C120 140 130 140 140 160 M100 120 L140 220 M140 120 L100 220 M110 220 V230 M130 220 V230" />
          </g>
          <!-- Low-rise annex rebar (sloped roof with cross-bracing) -->
          <g class="rebar-lowrise">
            <path d="M260 160 V220 M300 160 V220 M270 160 V220 M290 160 V220 M260 180 H300 M260 160 L280 140 L300 160 M260 140 H300 M260 160 L300 220 M300 160 L260 220" />
          </g>
          <!-- Concrete for high-rise (full fill) -->
          <rect class="concrete-highrise" x="180" y="80" width="40" height="140" fill="url(#concreteTexture)" />
          <rect class="concrete-highrise" x="180" y="80" width="40" height="140" fill="url(#concreteGradient)" style="opacity:0.3" />
          <!-- Concrete for mid-rise (partial fill) -->
          <rect class="concrete-midrise" x="100" y="120" width="20" height="100" fill="url(#concreteTexture)" />
          <!-- Concrete for low-rise (thin layer) -->
          <rect class="concrete-lowrise" x="260" y="160" width="40" height="20" fill="url(#concreteTexture)" />
          <!-- Force arrow on high-rise -->
          <path class="force-arrow" d="M240 100 H260 M250 90 L260 100 L250 110" />
        </svg>
      </div>

                    <h3>Structural Design</h3>
                    <p>Robust engineering for durable, safe structures. Our structural solutions ensure longevity and safety while maintaining design integrity.</p>
                    
                </div>
<div class="service-card" data-href="{{route('services.bim')}}" data-aos="fade-up" data-aos-delay="400">
       <div class="icon-wrap">
        <svg class="bim-scene" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true">
          <defs>
            <linearGradient id="glowGradient" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" style="stop-color:rgba(255,75,75,0.96);stop-opacity:1" />
              <stop offset="33%" style="stop-color:rgba(255,75,75,0.8);stop-opacity:0.9" />
              <stop offset="66%" style="stop-color:rgba(255,75,75,0.6);stop-opacity:0.7" />
              <stop offset="100%" style="stop-color:rgba(255,75,75,0.3);stop-opacity:0.5" />
            </linearGradient>
            <linearGradient id="windowGradient" x1="0%" y1="0%" x2="0%" y2="100%">
              <stop offset="0%" style="stop-color:rgba(255,255,255,0.92);stop-opacity:1" />
              <stop offset="100%" style="stop-color:rgba(255,255,255,0.7);stop-opacity:0.9" />
            </linearGradient>
            <linearGradient id="pipeGradientRed" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" style="stop-color:rgba(255,75,75,1);stop-opacity:1" />
              <stop offset="50%" style="stop-color:rgba(255,75,75,0.8);stop-opacity:0.9" />
              <stop offset="100%" style="stop-color:rgba(255,255,255,0.5);stop-opacity:0.7" />
            </linearGradient>
            <linearGradient id="pipeGradientBlue" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" style="stop-color:rgba(75,75,255,1);stop-opacity:1" />
              <stop offset="50%" style="stop-color:rgba(75,75,255,0.8);stop-opacity:0.9" />
              <stop offset="100%" style="stop-color:rgba(255,255,255,0.5);stop-opacity:0.7" />
            </linearGradient>
            <linearGradient id="pipeGradientYellow" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" style="stop-color:rgba(255,255,75,1);stop-opacity:1" />
              <stop offset="50%" style="stop-color:rgba(255,255,75,0.8);stop-opacity:0.9" />
              <stop offset="100%" style="stop-color:rgba(255,255,255,0.5);stop-opacity:0.7" />
            </linearGradient>
            <linearGradient id="timelineGradient" x1="0%" y1="0%" x2="100%" y2="0%">
              <stop offset="0%" style="stop-color:rgba(255,75,75,0.3);stop-opacity:0.5" />
              <stop offset="100%" style="stop-color:rgba(255,75,75,0);stop-opacity:0" />
            </linearGradient>
            <pattern id="renderTexture" patternUnits="userSpaceOnUse" width="10" height="5">
              <rect x="0" y="0" width="10" height="2" fill="rgba(255,255,255,0.1)" />
              <rect x="5" y="2" width="5" height="2" fill="rgba(255,255,255,0.15)" />
            </pattern>
            <pattern id="concreteTexture" patternUnits="userSpaceOnUse" width="8" height="8">
              <circle cx="2" cy="2" r="1.5" fill="rgba(255,255,255,0.15)" />
              <circle cx="6" cy="6" r="1" fill="rgba(255,255,255,0.1)" />
            </pattern>
            <pattern id="dataTexture" patternUnits="userSpaceOnUse" width="4" height="4">
              <circle cx="2" cy="2" r="1" fill="rgba(255,255,255,0.2)" />
            </pattern>
            <filter id="shadow" x="-20%" y="-20%" width="140%" height="140%">
              <feDropShadow dx="2" dy="2" stdDeviation="2" flood-color="rgba(0,0,0,0.3)" />
            </filter>
          </defs>
          <!-- Structural grid -->
          <g class="bim-grid">
            <path d="M100 100 V220 M120 100 V220 M160 100 V220 M200 100 V220 M240 100 V220 M280 100 V220 M100 100 H300 M100 140 H300 M100 180 H300 M100 220 H300" />
          </g>
          <!-- Foundation base -->
          <rect class="bim-foundation" x="100" y="220" width="200" height="20" />
          <!-- Building floors -->
          <rect class="bim-floor bim-floor-1" x="100" y="180" width="200" height="40" />
          <rect class="bim-floor bim-floor-2" x="100" y="140" width="200" height="40" />
          <rect class="bim-floor bim-floor-3" x="100" y="100" width="200" height="40" />
          <!-- Windows -->
          <rect class="bim-window bim-window-1" x="240" y="190" width="20" height="20" rx="2" />
          <rect class="bim-window bim-window-2" x="240" y="150" width="20" height="20" rx="2" />
          <rect class="bim-window bim-window-3" x="240" y="110" width="20" height="20" rx="2" />
          <!-- MEP pipes -->
          <path class="bim-pipe bim-pipe-red" d="M120 220 C140 210 160 210 180 220 V160 H240 V100" />
          <path class="bim-pipe bim-pipe-blue" d="M160 220 C180 200 200 200 220 220 V140 H260 V100" />
          <path class="bim-pipe bim-pipe-yellow" d="M200 220 C220 210 240 210 260 220 V120 H280 V100" />
          <!-- Data overlay panel -->
          <rect class="bim-data" x="260" y="80" width="80" height="60" rx="4" />
          <circle class="bim-data-node" cx="270" cy="90" r="3" />
          <circle class="bim-data-node" cx="290" cy="90" r="3" />
          <circle class="bim-data-node" cx="310" cy="90" r="3" />
          <circle class="bim-data-node" cx="270" cy="110" r="3" />
          <circle class="bim-data-node" cx="290" cy="110" r="3" />
          <circle class="bim-data-node" cx="310" cy="110" r="3" />
          <path class="bim-data-connector" d="M270 90 H290 M290 90 H310 M270 110 H290 M290 110 H310 M270 90 V110 M290 90 V110 M310 90 V110" />
          <text class="bim-data-label" x="270" y="135" font-family="Inter, sans-serif" font-size="8" text-anchor="start">Level 1</text>
          <text class="bim-data-label" x="290" y="135" font-family="Inter, sans-serif" font-size="8" text-anchor="middle">Level 2</text>
          <text class="bim-data-label" x="310" y="135" font-family="Inter, sans-serif" font-size="8" text-anchor="end">Level 3</text>
          <!-- 4D Timeline -->
          <rect class="bim-timeline" x="100" y="240" width="200" height="10" rx="2" />
          <rect class="bim-timeline-progress" x="100" y="240" width="10" height="10" rx="2" />
          <circle class="bim-marker bim-marker-1" cx="150" cy="245" r="4" />
          <circle class="bim-marker bim-marker-2" cx="190" cy="245" r="4" />
          <circle class="bim-marker bim-marker-3" cx="230" cy="245" r="4" />
          <circle class="bim-marker bim-marker-4" cx="270" cy="245" r="4" />
          <!-- Glow outline -->
          <path class="bim-glow" d="M100 100 H300 V220 H100 Z" />
        </svg>
      </div>

                    <h3>Building Information Modeling (BIM)</h3>
                    <p>Comprehensive 3D modeling for seamless project visualization, coordination, and efficient construction from concept to completion.</p>
                    
                </div>

                <div class="service-card" data-href="{{route('services.interior_design')}}" data-aos="fade-up" data-aos-delay="500">
                   <div class="icon-wrap">
        <svg class="interior-scene" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true">
          <defs>
            <linearGradient id="lampGradient" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" style="stop-color:rgba(255,75,75,0.96);stop-opacity:1" />
              <stop offset="50%" style="stop-color:rgba(255,75,75,0.7);stop-opacity:0.8" />
              <stop offset="100%" style="stop-color:rgba(255,75,75,0.3);stop-opacity:0.5" />
            </linearGradient>
            <linearGradient id="windowGradient" x1="0%" y1="0%" x2="0%" y2="100%">
              <stop offset="0%" style="stop-color:rgba(255,255,255,0.92);stop-opacity:1" />
              <stop offset="100%" style="stop-color:rgba(255,255,255,0.7);stop-opacity:0.9" />
            </linearGradient>
            <pattern id="sofaTexture" patternUnits="userSpaceOnUse" width="4" height="4">
              <circle cx="2" cy="2" r="1.5" fill="rgba(255,75,75,0.3)" />
            </pattern>
            <pattern id="rugTexture" patternUnits="userSpaceOnUse" width="6" height="6">
              <rect x="0" y="0" width="3" height="3" fill="rgba(255,255,255,0.15)" />
              <rect x="3" y="3" width="3" height="3" fill="rgba(255,255,255,0.1)" />
            </pattern>
            <pattern id="potTexture" patternUnits="userSpaceOnUse" width="5" height="5">
              <circle cx="2.5" cy="2.5" r="1.2" fill="rgba(255,255,255,0.2)" />
            </pattern>
            <pattern id="woodTexture" patternUnits="userSpaceOnUse" width="8" height="4">
              <rect x="0" y="0" width="8" height="2" fill="rgba(255,255,255,0.12)" />
              <rect x="4" y="2" width="4" height="2" fill="rgba(255,255,255,0.08)" />
            </pattern>
            <pattern id="wallTexture" patternUnits="userSpaceOnUse" width="6" height="6">
              <line x1="3" y1="0" x2="3" y2="6" stroke="rgba(255,255,255,0.1)" stroke-width="1" />
            </pattern>
            <pattern id="floorTexture" patternUnits="userSpaceOnUse" width="8" height="4">
              <line x1="0" y1="2" x2="8" y2="2" stroke="rgba(255,255,255,0.1)" stroke-width="1" />
            </pattern>
            <filter id="shadow" x="-20%" y="-20%" width="140%" height="140%">
              <feDropShadow dx="2" dy="2" stdDeviation="2" flood-color="rgba(0,0,0,0.3)" />
            </filter>
            <radialGradient id="lampGlow" cx="50%" cy="50%" r="50%">
              <stop offset="0%" style="stop-color:rgba(255,75,75,0.5);stop-opacity:0.8" />
              <stop offset="100%" style="stop-color:rgba(255,75,75,0);stop-opacity:0" />
            </radialGradient>
          </defs>
          <!-- Wall and floor -->
          <rect class="interior-wall" x="100" y="80" width="200" height="140" />
          <rect class="interior-floor" x="100" y="220" width="200" height="60" />
          <!-- Rug with fringe -->
          <rect class="interior-rug" x="100" y="220" width="200" height="60" rx="4" />
          <path class="interior-rug" d="M100 220 H110 M120 220 H130 M140 220 H150 M160 220 H170 M180 220 H190 M200 220 H210 M220 220 H230 M240 220 H250 M260 220 H270 M280 220 H290 M300 220 H310" stroke="rgba(255,255,255,0.15)" stroke-width="1" />
          <!-- Sofa with stitching and cushions -->
          <path class="interior-sofa" d="M100 180 H240 C250 180 250 190 240 190 H110 C100 190 100 180 100 180 Z" />
          <rect class="interior-sofa" x="120" y="160" width="100" height="20" rx="4" />
          <rect class="interior-sofa" x="100" y="180" width="20" height="40" rx="4" />
          <rect class="interior-sofa" x="220" y="180" width="20" height="40" rx="4" />
          <rect class="interior-sofa" x="130" y="170" width="20" height="10" rx="2" fill="url(#windowGradient)" />
          <rect class="interior-sofa" x="160" y="170" width="20" height="10" rx="2" fill="url(#windowGradient)" />
          <rect class="interior-sofa" x="190" y="170" width="15" height="15" rx="2" fill="url(#windowGradient)" />
          <path class="interior-sofa" d="M100 180 H240 M100 190 H240 M110 180 V190 M230 180 V190" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="1" />
          <!-- Coffee table with vase and books -->
          <rect class="interior-detail" x="140" y="200" width="80" height="20" rx="6" fill="url(#woodTexture)" />
          <rect class="interior-detail" x="170" y="190" width="10" height="10" rx="2" fill="url(#windowGradient)" />
          <rect class="interior-detail" x="165" y="195" width="20" height="5" rx="1" fill="url(#windowGradient)" />
          <!-- Fern with layered fronds -->
          <path class="interior-detail" d="M260 160 C270 130 290 130 300 160 C290 190 270 190 260 160" fill="url(#windowGradient)" />
          <path class="interior-detail" d="M270 150 C280 120 300 120 310 150 C300 180 280 180 270 150" fill="url(#windowGradient)" />
          <path class="interior-detail" d="M265 155 C275 125 295 125 305 155 C295 185 275 185 265 155" fill="url(#windowGradient)" />
          <path class="interior-detail" d="M260 165 C270 135 290 135 300 165 C290 195 270 195 260 165" fill="url(#windowGradient)" />
          <path class="interior-detail" d="M270 145 C280 115 300 115 310 145 C300 175 280 175 270 145" fill="url(#windowGradient)" />
          <rect class="interior-detail" x="260" y="190" width="20" height="30" rx="2" fill="url(#potTexture)" />
          <rect class="interior-detail" x="260" y="188" width="20" height="2" fill="url(#windowGradient)" />
          <!-- Chandelier-style pendant light -->
          <path class="pendant-light" d="M160 80 C180 120 140 120 160 80 M150 80 C165 110 135 110 150 80 M170 80 C185 110 155 110 170 80 M145 80 C160 115 130 115 145 80 M175 80 C190 115 160 115 175 80" />
          <circle class="pendant-light" cx="160" cy="80" r="3" fill="url(#lampGlow)" />
          <circle class="pendant-light" cx="150" cy="80" r="3" fill="url(#lampGlow)" />
          <circle class="pendant-light" cx="170" cy="80" r="3" fill="url(#lampGlow)" />
          <circle class="pendant-light" cx="145" cy="80" r="3" fill="url(#lampGlow)" />
          <circle class="pendant-light" cx="175" cy="80" r="3" fill="url(#lampGlow)" />
          <!-- Floor lamp with tripod base -->
          <path class="floor-lamp" d="M320 120 C340 160 300 160 320 120 V220 M310 220 H330 M315 220 H325 M320 210 H320 V230" />
          <path class="floor-lamp" d="M320 120 C330 140 310 140 320 120" fill="url(#lampGlow)" />
          <!-- Wall art -->
          <rect class="interior-art" x="280" y="100" width="40" height="30" rx="2" />
          <rect class="interior-art" x="275" y="95" width="50" height="40" rx="4" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="1" />
          <rect class="interior-art" x="280" y="140" width="30" height="30" rx="2" />
          <rect class="interior-art" x="275" y="135" width="40" height="40" rx="4" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="1" />
        </svg>
      </div>


                    <h3>Interior Design</h3>
                    <p>Functional and aesthetic indoor spaces. We transform interiors into inspiring environments that reflect your vision and lifestyle.</p>
                    
                </div>
                <div class="service-card" data-href="{{route('services.3d_rendering')}}" data-aos="fade-up" data-aos-delay="600">
                     <div class="icon-wrap">
        <svg class="render-scene" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true">
          <defs>
            <linearGradient id="renderGradient" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" style="stop-color:rgba(255,75,75,0.96);stop-opacity:1" />
              <stop offset="50%" style="stop-color:rgba(255,75,75,0.7);stop-opacity:0.8" />
              <stop offset="100%" style="stop-color:rgba(255,75,75,0.3);stop-opacity:0.5" />
            </linearGradient>
            <linearGradient id="renderGlow" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" style="stop-color:rgba(255,75,75,0.96);stop-opacity:1" />
              <stop offset="50%" style="stop-color:rgba(255,75,75,0.7);stop-opacity:0.8" />
              <stop offset="100%" style="stop-color:rgba(255,75,75,0.3);stop-opacity:0.5" />
            </linearGradient>
            <linearGradient id="windowGradient" x1="0%" y1="0%" x2="0%" y2="100%">
              <stop offset="0%" style="stop-color:rgba(255,255,255,0.92);stop-opacity:1" />
              <stop offset="100%" style="stop-color:rgba(255,255,255,0.7);stop-opacity:0.9" />
            </linearGradient>
            <pattern id="renderTexture" patternUnits="userSpaceOnUse" width="10" height="5">
              <rect x="0" y="0" width="10" height="2" fill="rgba(255,255,255,0.1)" />
              <rect x="5" y="2" width="5" height="2" fill="rgba(255,255,255,0.15)" />
            </pattern>
            <filter id="shadow" x="-20%" y="-20%" width="140%" height="140%">
              <feDropShadow dx="2" dy="2" stdDeviation="2" flood-color="rgba(0,0,0,0.3)" />
            </filter>
          </defs>
          <g class="render-wire">
            <path d="M120 180 L280 180 L300 220 L140 220 Z" />
            <path d="M130 140 L270 140 L290 180 L150 180 Z" />
            <path d="M140 100 L260 100 L280 140 L160 140 Z" />
            <path d="M150 60 L250 60 L270 100 L170 100 Z" />
            <path d="M140 60 L140 220 M260 60 L260 220" />
            <path d="M130 140 H110 M270 140 H290 M140 100 H120 M260 100 H280" />
            <rect x="160" y="190" width="20" height="20" fill="url(#windowGradient)" />
            <rect x="220" y="190" width="20" height="20" fill="url(#windowGradient)" />
            <rect x="170" y="150" width="20" height="20" fill="url(#windowGradient)" />
            <rect x="230" y="150" width="20" height="20" fill="url(#windowGradient)" />
            <rect x="180" y="110" width="20" height="20" fill="url(#windowGradient)" />
            <path d="M200 60 V40" />
          </g>
          <path class="render-solid" d="M120 180 L280 180 L300 220 L140 220 Z M130 140 L270 140 L290 180 L150 180 Z M140 100 L260 100 L280 140 L160 140 Z M150 60 L250 60 L270 100 L170 100 Z" />
          <path class="render-glow" d="M120 180 L280 180 L300 220 L140 220 Z M130 140 L270 140 L290 180 L150 180 Z M140 100 L260 100 L280 140 L160 140 Z M150 60 L250 60 L270 100 L170 100 Z" />
        </svg>
      </div>


                    <h3>3D Rendering & Visualization</h3>
                    <p>High-quality 3D models and virtual tours for design previews. Experience your project before construction begins.</p>
                    
                </div>
                <div class="service-card" data-href="{{route('services.estimation')}}" data-aos="fade-up" data-aos-delay="700">
                    <div class="service-icon-wrap">
                        <svg class="estimation-scene" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="barGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                    <stop offset="0%" style="stop-color:rgba(255,75,75,0.96);stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:rgba(255,75,75,0.7);stop-opacity:0.9" />
                                </linearGradient>
                            </defs>
                            <rect class="calc-icon" x="100" y="80" width="200" height="120" rx="8" />
                            <rect class="calc-icon" x="120" y="100" width="20" height="20" rx="2" />
                            <rect class="calc-icon" x="150" y="100" width="20" height="20" rx="2" />
                            <rect class="calc-icon" x="180" y="100" width="20" height="20" rx="2" />
                            <rect class="cost-bar cost-bar-1" x="140" y="120" width="30" height="100" rx="4" />
                            <rect class="cost-bar cost-bar-2" x="190" y="100" width="30" height="120" rx="4" />
                            <rect class="cost-bar cost-bar-3" x="240" y="140" width="30" height="80" rx="4" />
                        </svg>
                    </div>
                    <h3>Estimation & Consultation</h3>
                    <p>Accurate cost estimates and expert consultation services. We provide transparent pricing and professional guidance throughout your project.</p>
                    
                </div>
                <div class="service-card" data-href="{{route('services.project_management')}}" data-aos="fade-up" data-aos-delay="800">
                   <div class="service-icon-wrap">
                        <svg class="gantt-scene" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="checkGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" style="stop-color:rgba(255,75,75,0.96);stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:rgba(255,75,75,0.7);stop-opacity:0.9" />
                                </linearGradient>
                            </defs>
                            <line x1="100" y1="80" x2="300" y2="80" stroke="rgba(255,255,255,0.2)" stroke-width="2" />
                            <line x1="100" y1="120" x2="300" y2="120" stroke="rgba(255,255,255,0.2)" stroke-width="2" />
                            <rect class="task-bar task-bar-1" x="100" y="100" width="160" height="30" rx="4" />
                            <rect class="task-bar task-bar-2" x="100" y="140" width="120" height="30" rx="4" />
                            <path class="task-check" d="M260 110 L270 120 L290 100" />
                            <path class="task-check" d="M220 150 L230 160 L250 140" />
                        </svg>
                    </div>
                    <h3>Project Management</h3>
                    <p>Efficient oversight from planning to completion. We ensure your project stays on schedule and within budget.</p>
                    
                </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="dark" data-aos="fade-up">
        <div class="section-container">
            <h2 data-aos="fade-up" data-aos-delay="100">OUR <span>PROJECTS</span></h2>
            @if(isset($projects) && $projects->count() > 0)
            <div class="enhanced-carousel-container" data-carousel-type="projects">
                <div class="enhanced-carousel-wrapper" 
                     onmouseenter="pauseCarousel('projects')" 
                     onmouseleave="resumeCarousel('projects')">
                    <div class="enhanced-carousel-track" id="projects-carousel">
                        @foreach($projects as $project)
                        <div class="enhanced-carousel-item project-card" 
                             data-category="{{ $project->category }}" 
                             onclick="window.location.href='{{ route('projects.show', $project->slug) }}'"
                             data-index="{{ $loop->index }}">
                            <div class="carousel-item-image" style="background-image: url('{{ $project->main_image ? asset('storage/' . $project->main_image) : asset('assets/img/default-project.jpg') }}');"></div>
                            <div class="carousel-item-content">
                                <h3>{{ $project->title }}</h3>
                                <p><strong>Location:</strong> {{ $project->location }} | <strong>Year:</strong> {{ $project->year }}</p>
                                <p><strong>Type:</strong> {{ $project->type }}</p>
                                <p>{{ Str::limit($project->description, 150) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- Dots Indicator -->
                <div class="carousel-dots" id="projects-dots">
                    @foreach($projects as $index => $project)
                    <button class="carousel-dot {{ $index === 0 ? 'active' : '' }}" 
                            onclick="goToSlide('projects', {{ $index }})" 
                            aria-label="Go to slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
                <!-- Info Text -->
            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ route('projects.index') }}" class="cta-button">View All Projects</a>
            </div>
            @endif
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="light" data-aos="fade-up">
        <div class="section-container">
            <h2 data-aos="fade-up" data-aos-delay="100">CLIENT <span>TESTIMONIALS</span></h2>
            <div class="testimonials-grid">
                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Delivered EXCEPTIONAL work in architecture and interior design, showcasing unparalleled professionalism, creativity, and perfect brand alignment. Working with Dilan was a breeze; his deep understanding, politeness, and prompt delivery made the whole process smooth. Highly recommended! ðŸ‘"</p>
                    <div class="testimonial-author">Brianna Diaz</div>
                    <div class="testimonial-position">United States of America</div>
                </div>
                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Septan Developers truly nailed our project, showing outstanding creativity and an impressive eye for detail that aligned perfectly with our brand! ðŸ¤© Working with them was a breeze too; their proactive communication, quick responses, and willingness to go the extra mile made the whole process smooth. Highly recommend for any architecture & interior design needs!"</p>
                    <div class="testimonial-author">Jane Smith</div>
                    <div class="testimonial-position">United Kingdom</div>
                </div>
                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Septan Developers exceeded all expectations with their professionalism and meticulous attention to detail in our architecture project. Their deep understanding of design principles and proactive communication made the process seamless. Truly a top-notch experience, highly recommended! ðŸ‘Œ"</p>
                    <div class="testimonial-author">Simon Baker</div>
                    <div class="testimonial-position">Australia</div>
                </div>
                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"We hired Septan Developers for our master bedroom and walk-in project, and the results exceeded our expectations. He listened to our ideas, offered creative solutions, and perfectly balanced functionality with style. The process was smooth, with clear communication and timely revisions. His attention to detail and ability to stay within budget made the experience stress-free. Highly recommended!"</p>
                    <div class="testimonial-author">Rose Elizabeth</div>
                    <div class="testimonial-position">Ierland</div>
                </div>
                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="600">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
 			<i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"I'm fully satisfied with the delivery. I find the decoration a bit dull, but I like the idea of the furniture. It allows me to move forward with my project. Thank you, Septan Developers. Good work overall. Best of luck with your future projects."</p>
                    <div class="testimonial-author">Daniel Caba</div>
                    <div class="testimonial-position">Switzerland</div>
                </div>
<div class="testimonial-card" data-aos="fade-up" data-aos-delay="700">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
 			<i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"What can I say, Septan Developers is VERY creative! They have bold designs. They know how to maximize the space available to deliver a well-designed concept. They were able to be creative in a way to visualize our two-story loft is a way we were not. Defiantly inspired us to reimagine our space."</p>
                    <div class="testimonial-author">Amir Khalid</div>
                    <div class="testimonial-position">United Arab Emirates</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section id="blog" class="dark" data-aos="fade-up">
        <div class="section-container">
            <h2 data-aos="fade-up" data-aos-delay="100">LATEST <span>ARTICLES</span></h2>
            @if(isset($latestBlogs) && $latestBlogs->count() > 0)
            <div class="enhanced-carousel-container" data-carousel-type="blog">
                <div class="enhanced-carousel-wrapper" 
                     onmouseenter="pauseCarousel('blog')" 
                     onmouseleave="resumeCarousel('blog')">
                    <div class="enhanced-carousel-track" id="blog-carousel">
                        @foreach($latestBlogs as $blog)
                        <div class="enhanced-carousel-item blog-card" 
                             onclick="window.location.href='{{ route('blogs.show', $blog->slug) }}'"
                             data-index="{{ $loop->index }}">
                            <div class="carousel-item-image" style="background-image: url('{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('assets/img/default-blog.jpg') }}');"></div>
                            <div class="carousel-item-content">
                                <div class="blog-category">{{ $blog->category }}</div>
                                <h3>{{ $blog->title }}</h3>
                                <div class="blog-date">Published: {{ $blog->published_date->format('F d, Y') }}</div>
                                <p class="blog-excerpt">{{ Str::limit($blog->excerpt, 120) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- Dots Indicator -->
                <div class="carousel-dots" id="blog-dots">
                    @foreach($latestBlogs as $index => $blog)
                    <button class="carousel-dot {{ $index === 0 ? 'active' : '' }}" 
                            onclick="goToSlide('blog', {{ $index }})" 
                            aria-label="Go to slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
                <!-- Info Text -->
            @if($latestBlogs->count() >= 3)
            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ route('blogs.index') }}" class="cta-button">View All Articles</a>
            </div>
            @endif
            @endif
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="light" data-aos="fade-up">
        <div class="section-container">
            <h2 data-aos="fade-up" data-aos-delay="100">GET IN <span>TOUCH</span></h2>
            <div class="contact-container">
                <form id="contact-form">
                    <input type="hidden" id="csrf_token" name="csrf_token">
                    <input type="text" id="name" name="name" placeholder="Your Name" required>
                    <input type="email" id="email" name="email" placeholder="Your Email" required>
                    <input type="tel" id="phone" name="phone" placeholder="Your Phone" required>
                    <textarea id="message" name="message" placeholder="Your Message" required></textarea>
                    <button type="submit">Send Message</button>
                    <div id="form-message"></div>
                    <div id="form-success"></div>
                </form>
                <div class="contact-info-section">
                    <h3>Contact Information</h3>
                    <div class="contact-info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <strong>Office Address</strong>
                            <p>Septan Developers (Pvt) Ltd<br>Ambalangoda, Sri Lanka</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <strong>Phone</strong>
                            <p>+94 76 3132675</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <strong>Email</strong>
                            <p>septandevelopers@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="map-container-contact">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31643.45039811249!2d79.86124199999998!3d6.927078999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae183cd06a4f207:0xc2e135d975365914!2sSeptan%20Developers%20(Pvt)%20Ltd!5e0!3m2!1sen!2sus!4v1697803541000!5m2!1sen!2sus" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-social">
                <a href="https://facebook.com/SeptanDevelopers" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://instagram.com/septan_developers" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://linkedin.com/company/septan-developers-pvt-ltd" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                <a href="https://tiktok.com/@septandevelopers" target="_blank"><i class="fab fa-tiktok"></i></a>
                <a href="https://youtube.com/@SeptanDevelopers" target="_blank"><i class="fab fa-youtube"></i></a>
            </div>
            <div class="footer-links">
                <a href="#">Terms</a>
                <a href="#">Privacy</a>
            </div>
            <div class="copyright">
                &copy; 2025 Septan Developers. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    @include('partials.animations-script')
    <script>
        // Enhanced Carousel state management
        const carouselStates = {
            projects: { currentIndex: 0, autoInterval: null, isPaused: false },
            blog: { currentIndex: 0, autoInterval: null, isPaused: false }
        };

        // Initialize carousels on page load
        document.addEventListener('DOMContentLoaded', function() {
            initEnhancedCarousel('projects');
            initEnhancedCarousel('blog');
        });

        function initEnhancedCarousel(type) {
            const carousel = document.getElementById(type + '-carousel');
            if (!carousel) return;
            
            const items = carousel.querySelectorAll('.enhanced-carousel-item');
            if (items.length === 0) return;
            
            // Set initial active states
            updateEnhancedCarousel(type);
            
            // Auto-advance every 3 seconds
            carouselStates[type].autoInterval = setInterval(() => {
                if (!carouselStates[type].isPaused) {
                    slideCarousel(type, 1);
                }
            }, 3000);
        }

        function slideCarousel(type, direction) {
            const carousel = document.getElementById(type + '-carousel');
            if (!carousel) return;
            
            const items = carousel.querySelectorAll('.enhanced-carousel-item');
            if (items.length === 0) return;
            
            const totalItems = items.length;
            const state = carouselStates[type];
            
            // Update index
            state.currentIndex += direction;
            
            // Loop around
            if (state.currentIndex < 0) {
                state.currentIndex = totalItems - 1;
            } else if (state.currentIndex >= totalItems) {
                state.currentIndex = 0;
            }
            
            updateEnhancedCarousel(type);
        }

        function goToSlide(type, index) {
            const carousel = document.getElementById(type + '-carousel');
            if (!carousel) return;
            
            const items = carousel.querySelectorAll('.enhanced-carousel-item');
            if (items.length === 0 || index < 0 || index >= items.length) return;
            
            carouselStates[type].currentIndex = index;
            updateEnhancedCarousel(type);
        }

        function pauseCarousel(type) {
            carouselStates[type].isPaused = true;
        }

        function resumeCarousel(type) {
            carouselStates[type].isPaused = false;
        }

        function updateEnhancedCarousel(type) {
            const carousel = document.getElementById(type + '-carousel');
            if (!carousel) return;
            
            const items = carousel.querySelectorAll('.enhanced-carousel-item');
            if (items.length === 0) return;
            
            const state = carouselStates[type];
            const totalItems = items.length;
            const centerOffset = 350; // Distance between center cards
            
            // Update item positions and states
            items.forEach((item, index) => {
                // Calculate relative position
                let relativeIndex = index - state.currentIndex;
                
                // Handle wrap-around for circular carousel
                if (relativeIndex > totalItems / 2) {
                    relativeIndex -= totalItems;
                } else if (relativeIndex < -totalItems / 2) {
                    relativeIndex += totalItems;
                }
                
                // Remove all state classes
                item.classList.remove('active-center', 'active-side', 'hidden');
                
                // Calculate translateX position
                let translateX = relativeIndex * centerOffset;
                
                // Set position and state
                let scale = 0.85;
                if (relativeIndex === 0 || relativeIndex === -1 || relativeIndex === 1) {
                    // Center 3 cards - fully visible
                    item.classList.add('active-center');
                    scale = 1;
                } else if (relativeIndex === -2 || relativeIndex === 2) {
                    // Side 2 cards - partially visible
                    item.classList.add('active-side');
                    scale = 0.9;
                } else {
                    // Hidden cards
                    item.classList.add('hidden');
                    scale = 0.85;
                }
                
                // Apply transform with both translateX and scale
                // Start from center position (left: 50%, margin-left: -160px)
                // Then translateX from center
                item.style.transform = `translateX(${translateX}px) scale(${scale})`;
            });
            
            // Update dots indicator
            const dotsContainer = document.getElementById(type + '-dots');
            if (dotsContainer) {
                const dots = dotsContainer.querySelectorAll('.carousel-dot');
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === state.currentIndex);
                });
            }
        }
        
        // Handle window resize
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function() {
                updateEnhancedCarousel('projects');
                updateEnhancedCarousel('blog');
            }, 250);
        });
    </script>
    
    <!-- Septan AI Chatbot -->
    @include('partials.chatbot')
</body>
</html>


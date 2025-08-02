<?php
require_once 'config/config.php';
?><!DOCTYPE html>
<html lang="<?php echo $current_language; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' . SITE_NAME : SITE_NAME . ' - ' . SITE_TAGLINE; ?></title>
    <meta name="description" content="<?php echo isset($page_description) ? $page_description : SITE_DESCRIPTION; ?>">
    <meta name="keywords" content="<?php echo isset($page_keywords) ? $page_keywords : SITE_KEYWORDS; ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'vots-red': '#dc2626',
                        'vots-dark-red': '#b91c1c',
                        'vots-black': '#0f0f0f',
                        'vots-gray': '#1f1f1f',
                        'vots-light-gray': '#2d2d2d'
                    },
                    animation: {
                        'fade-in-down': 'fade-in-down 0.3s ease-out',
                        'pulse-red': 'pulse-red 2s infinite',
                    },
                    keyframes: {
                        'fade-in-down': {
                            '0%': { opacity: '0', transform: 'translateY(-10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        'pulse-red': {
                            '0%, 100%': { boxShadow: '0 0 0 0 rgba(220, 38, 38, 0.7)' },
                            '50%': { boxShadow: '0 0 0 8px rgba(220, 38, 38, 0)' }
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .glass-effect {
            backdrop-filter: blur(8px);
            background: rgba(15, 15, 15, 0.95);
        }
        
        .nav-link {
            position: relative;
            overflow: hidden;
        }
        
        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #dc2626, transparent);
            transition: left 0.4s ease;
        }
        
        .nav-link:hover::before {
            left: 100%;
        }
        
        .logo-glow {
            filter: drop-shadow(0 0 8px rgba(220, 38, 38, 0.3));
        }
        
        .mobile-menu-slide {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        
        .mobile-menu-slide.open {
            transform: translateX(0);
        }

        .hamburger {
            width: 20px;
            height: 15px;
            position: relative;
            cursor: pointer;
        }
        
        .hamburger span {
            display: block;
            position: absolute;
            height: 2px;
            width: 100%;
            background: #dc2626;
            border-radius: 1px;
            opacity: 1;
            left: 0;
            transform: rotate(0deg);
            transition: .25s ease-in-out;
        }
        
        .hamburger span:nth-child(1) { top: 0px; }
        .hamburger span:nth-child(2) { top: 7px; }
        .hamburger span:nth-child(3) { top: 14px; }
        
        .hamburger.active span:nth-child(1) {
            top: 7px;
            transform: rotate(135deg);
        }
        
        .hamburger.active span:nth-child(2) {
            opacity: 0;
            left: -50px;
        }
        
        .hamburger.active span:nth-child(3) {
            top: 7px;
            transform: rotate(-135deg);
        }
        
        .carousel-container {
            perspective: 1000px;
        }
        
        .carousel-track {
            transform-style: preserve-3d;
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .carousel-slide {
            backface-visibility: hidden;
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .carousel-slide.active {
            transform: translateZ(0) scale(1);
            opacity: 1;
            z-index: 10;
        }
        
        .carousel-slide.prev {
            transform: translateX(-100%) rotateY(45deg) scale(0.8);
            opacity: 0.6;
            z-index: 5;
        }
        
        .carousel-slide.next {
            transform: translateX(100%) rotateY(-45deg) scale(0.8);
            opacity: 0.6;
            z-index: 5;
        }
        
        .carousel-slide.hidden {
            transform: translateX(0) scale(0.5);
            opacity: 0;
            z-index: 1;
        }
        
        .floating-element {
            animation: float 6s ease-in-out infinite;
        }
        
        .floating-element:nth-child(2) {
            animation-delay: -2s;
        }
        
        .floating-element:nth-child(3) {
            animation-delay: -4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(1deg); }
            66% { transform: translateY(-10px) rotate(-1deg); }
        }
        
        .pulse-glow {
            animation: pulseGlow 3s ease-in-out infinite;
        }
        
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 20px rgba(220, 38, 38, 0.3); }
            50% { box-shadow: 0 0 40px rgba(220, 38, 38, 0.6); }
        }
        
        .text-shimmer {
            background: linear-gradient(90deg, #dc2626, #ef4444, #dc2626);
            background-size: 200% 100%;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 3s ease-in-out infinite;
        }
        
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
    </style>
</head>
<body class="bg-gray-900 min-h-screen">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 glass-effect border-b border-vots-red/20">
        <div class="container mx-auto px-3 lg:px-5">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center group">
                    <a href="<?php echo SITE_URL; ?>" class="flex items-center space-x-2 transition-transform duration-300 hover:scale-105">
                        <div class="relative">
                            <div class="w-10 h-10 bg-gradient-to-br from-vots-red to-vots-dark-red rounded-lg flex items-center justify-center logo-glow animate-pulse-red">
                                <img src="<?php echo SITE_URL; ?>/assets/images/logo.jpeg" alt="Voice of the Streets Logo" class="w-7 h-7 object-contain" />
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg font-black text-white tracking-tight">
                                Voice of the
                            </span>
                            <span class="text-sm font-bold text-vots-red -mt-1 tracking-wider">
                                STREETS
                            </span>
                        </div>
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-1">
                    <a href="<?php echo SITE_URL; ?>" class="nav-link px-3 py-2 text-gray-300 hover:text-white font-medium transition-all duration-300 hover:bg-vots-red/10 rounded-lg text-sm">
                        <i class="fas fa-home mr-2 text-vots-red text-xs"></i>Home
                    </a>
                    <a href="<?php echo SITE_URL; ?>/about.php" class="nav-link px-3 py-2 text-gray-300 hover:text-white font-medium transition-all duration-300 hover:bg-vots-red/10 rounded-lg text-sm">
                        <i class="fas fa-info-circle mr-2 text-vots-red text-xs"></i>About
                    </a>
                    <a href="<?php echo SITE_URL; ?>/programs.php" class="nav-link px-3 py-2 text-gray-300 hover:text-white font-medium transition-all duration-300 hover:bg-vots-red/10 rounded-lg text-sm">
                        <i class="fas fa-bullhorn mr-2 text-vots-red text-xs"></i>Programs
                    </a>
                    <a href="<?php echo SITE_URL; ?>/events.php" class="nav-link px-3 py-2 text-gray-300 hover:text-white font-medium transition-all duration-300 hover:bg-vots-red/10 rounded-lg text-sm">
                        <i class="fas fa-calendar mr-2 text-vots-red text-xs"></i>Events
                    </a>
                    <a href="<?php echo SITE_URL; ?>/blog.php" class="nav-link px-3 py-2 text-gray-300 hover:text-white font-medium transition-all duration-300 hover:bg-vots-red/10 rounded-lg text-sm">
                        <i class="fas fa-blog mr-2 text-vots-red text-xs"></i>Blog
                    </a>
                    <a href="<?php echo SITE_URL; ?>/gallery.php" class="nav-link px-3 py-2 text-gray-300 hover:text-white font-medium transition-all duration-300 hover:bg-vots-red/10 rounded-lg text-sm">
                        <i class="fas fa-images mr-2 text-vots-red text-xs"></i>Gallery
                    </a>
                    <a href="<?php echo SITE_URL; ?>/get-involved.php" class="nav-link px-3 py-2 text-gray-300 hover:text-white font-medium transition-all duration-300 hover:bg-vots-red/10 rounded-lg text-sm">
                        <i class="fas fa-hands-helping mr-2 text-vots-red text-xs"></i>Get Involved
                    </a>
                    <a href="<?php echo SITE_URL; ?>/contact.php" class="nav-link px-3 py-2 text-gray-300 hover:text-white font-medium transition-all duration-300 hover:bg-vots-red/10 rounded-lg text-sm">
                        <i class="fas fa-envelope mr-2 text-vots-red text-xs"></i>Contact
                    </a>
                </nav>
                
                <!-- Right Side Controls -->
                <div class="flex items-center space-x-3">
                    <!-- Language Switcher -->
                    <div class="hidden md:block relative group">
                        <select onchange="changeLanguage(this.value)" class="flex items-center space-x-2 px-3 py-2 bg-vots-gray hover:bg-vots-light-gray rounded-lg transition-all duration-300 border border-vots-red/20 hover:border-vots-red/40 text-white text-sm">
                            <option value="en" <?php echo $current_language == 'en' ? 'selected' : ''; ?>>🇺🇸 EN</option>
                            <option value="sw" <?php echo $current_language == 'sw' ? 'selected' : ''; ?>>🇰🇪 SW</option>
                            <option value="fr" <?php echo $current_language == 'fr' ? 'selected' : ''; ?>>🇫🇷 FR</option>
                        </select>
                    </div>
                    
                    <!-- CTA Button -->
                    <button class="hidden md:block bg-gradient-to-r from-vots-red to-vots-dark-red hover:from-vots-dark-red hover:to-red-700 text-white px-5 py-2 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-sm">
                        <i class="fas fa-heart mr-2 text-xs"></i>
                        Donate Now
                    </button>
                    
                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-lg bg-vots-gray hover:bg-vots-light-gray transition-colors duration-300">
                        <div class="hamburger" id="hamburger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Mobile Menu Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black/50 z-40 opacity-0 invisible transition-all duration-300"></div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed top-0 left-0 h-full w-64 max-w-[85vw] bg-vots-black border-r border-vots-red/20 z-50 mobile-menu-slide">
        <div class="p-5">
            <!-- Mobile Logo -->
            <div class="flex items-center space-x-2 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-vots-red to-vots-dark-red rounded-lg flex items-center justify-center">
                    <i class="fas fa-microphone text-white text-sm"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-base font-black text-white">Voice of the</span>
                    <span class="text-xs font-bold text-vots-red -mt-1">STREETS</span>
                </div>
            </div>
            
            <!-- Mobile Navigation -->
            <nav class="space-y-1">
                <a href="<?php echo SITE_URL; ?>" class="flex items-center space-x-3 px-3 py-2 text-gray-300 hover:text-white hover:bg-vots-red/10 rounded-lg transition-all duration-300 group text-sm">
                    <i class="fas fa-home text-vots-red group-hover:scale-110 transition-transform duration-300 text-xs"></i>
                    <span class="font-medium">Home</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/about.php" class="flex items-center space-x-3 px-3 py-2 text-gray-300 hover:text-white hover:bg-vots-red/10 rounded-lg transition-all duration-300 group text-sm">
                    <i class="fas fa-info-circle text-vots-red group-hover:scale-110 transition-transform duration-300 text-xs"></i>
                    <span class="font-medium">About</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/programs.php" class="flex items-center space-x-3 px-3 py-2 text-gray-300 hover:text-white hover:bg-vots-red/10 rounded-lg transition-all duration-300 group text-sm">
                    <i class="fas fa-bullhorn text-vots-red group-hover:scale-110 transition-transform duration-300 text-xs"></i>
                    <span class="font-medium">Programs</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/events.php" class="flex items-center space-x-3 px-3 py-2 text-gray-300 hover:text-white hover:bg-vots-red/10 rounded-lg transition-all duration-300 group text-sm">
                    <i class="fas fa-calendar text-vots-red group-hover:scale-110 transition-transform duration-300 text-xs"></i>
                    <span class="font-medium">Events</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/blog.php" class="flex items-center space-x-3 px-3 py-2 text-gray-300 hover:text-white hover:bg-vots-red/10 rounded-lg transition-all duration-300 group text-sm">
                    <i class="fas fa-blog text-vots-red group-hover:scale-110 transition-transform duration-300 text-xs"></i>
                    <span class="font-medium">Blog</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/gallery.php" class="flex items-center space-x-3 px-3 py-2 text-gray-300 hover:text-white hover:bg-vots-red/10 rounded-lg transition-all duration-300 group text-sm">
                    <i class="fas fa-images text-vots-red group-hover:scale-110 transition-transform duration-300 text-xs"></i>
                    <span class="font-medium">Gallery</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/get-involved.php" class="flex items-center space-x-3 px-3 py-2 text-gray-300 hover:text-white hover:bg-vots-red/10 rounded-lg transition-all duration-300 group text-sm">
                    <i class="fas fa-hands-helping text-vots-red group-hover:scale-110 transition-transform duration-300 text-xs"></i>
                    <span class="font-medium">Get Involved</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/contact.php" class="flex items-center space-x-3 px-3 py-2 text-gray-300 hover:text-white hover:bg-vots-red/10 rounded-lg transition-all duration-300 group text-sm">
                    <i class="fas fa-envelope text-vots-red group-hover:scale-110 transition-transform duration-300 text-xs"></i>
                    <span class="font-medium">Contact</span>
                </a>
            </nav>
            
            <!-- Mobile Language Switcher -->
            <div class="mt-6 pt-5 border-t border-vots-red/20">
                <h3 class="text-white font-semibold mb-2 text-xs uppercase tracking-wider">Language</h3>
                <select onchange="changeLanguage(this.value)" class="w-full bg-vots-gray border border-vots-red/20 rounded px-3 py-2 text-white text-sm">
                    <option value="en" <?php echo $current_language == 'en' ? 'selected' : ''; ?>>🇺🇸 English</option>
                    <option value="sw" <?php echo $current_language == 'sw' ? 'selected' : ''; ?>>🇰🇪 Kiswahili</option>
                    <option value="fr" <?php echo $current_language == 'fr' ? 'selected' : ''; ?>>🇫🇷 Français</option>
                </select>
            </div>
            
            <!-- Mobile CTA -->
            <div class="mt-6 pt-5 border-t border-vots-red/20">
                <button class="w-full bg-gradient-to-r from-vots-red to-vots-dark-red hover:from-vots-dark-red hover:to-red-700 text-white px-5 py-2 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg text-sm">
                    <i class="fas fa-heart mr-2 text-xs"></i>
                    Donate Now
                </button>
            </div>
        </div>
    </div>

 
    <script>
        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileOverlay = document.getElementById('mobile-overlay');
        const hamburger = document.getElementById('hamburger');

        function toggleMobileMenu() {
            const isOpen = mobileMenu.classList.contains('open');
            
            if (isOpen) {
                // Close menu
                mobileMenu.classList.remove('open');
                mobileOverlay.classList.remove('opacity-100', 'visible');
                mobileOverlay.classList.add('opacity-0', 'invisible');
                hamburger.classList.remove('active');
                document.body.classList.remove('overflow-hidden');
            } else {
                // Open menu
                mobileMenu.classList.add('open');
                mobileOverlay.classList.remove('opacity-0', 'invisible');
                mobileOverlay.classList.add('opacity-100', 'visible');
                hamburger.classList.add('active');
                document.body.classList.add('overflow-hidden');
            }
        }

        mobileMenuBtn.addEventListener('click', toggleMobileMenu);
        mobileOverlay.addEventListener('click', toggleMobileMenu);

        // Close menu on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileMenu.classList.contains('open')) {
                toggleMobileMenu();
            }
        });

        // Language change functionality
        function changeLanguage(lang) {
            // Create a form and submit to change language
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '';
            
            const langInput = document.createElement('input');
            langInput.type = 'hidden';
            langInput.name = 'language';
            langInput.value = lang;
            
            form.appendChild(langInput);
            document.body.appendChild(form);
            form.submit();
        }

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Header scroll effect
        let lastScrollY = window.scrollY;
        const header = document.querySelector('header');

        window.addEventListener('scroll', () => {
            const currentScrollY = window.scrollY;
            
            if (currentScrollY > 100) {
                header.classList.add('shadow-2xl');
            } else {
                header.classList.remove('shadow-2xl');
            }
            
            lastScrollY = currentScrollY;
        });
    </script>

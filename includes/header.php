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
                        'fade-in-down': 'fade-in-down 0.2s ease-out',
                        'pulse-red': 'pulse-red 2s infinite',
                    },
                    keyframes: {
                        'fade-in-down': {
                            '0%': { opacity: '0', transform: 'translateY(-5px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        'pulse-red': {
                            '0%, 100%': { boxShadow: '0 0 0 0 rgba(220, 38, 38, 0.5)' },
                            '50%': { boxShadow: '0 0 0 4px rgba(220, 38, 38, 0)' }
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .glass-effect {
            backdrop-filter: blur(6px);
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
            height: 1px;
            background: linear-gradient(90deg, transparent, #dc2626, transparent);
            transition: left 0.3s ease;
        }
        
        .nav-link:hover::before {
            left: 100%;
        }
        
        .logo-glow {
            filter: drop-shadow(0 0 4px rgba(220, 38, 38, 0.3));
        }
        
        .mobile-menu-slide {
            transform: translateX(-100%);
            transition: transform 0.2s ease-in-out;
        }
        
        .mobile-menu-slide.open {
            transform: translateX(0);
        }

        .hamburger {
            width: 16px;
            height: 12px;
            position: relative;
            cursor: pointer;
        }
        
        .hamburger span {
            display: block;
            position: absolute;
            height: 1.5px;
            width: 100%;
            background: #dc2626;
            border-radius: 1px;
            opacity: 1;
            left: 0;
            transform: rotate(0deg);
            transition: .2s ease-in-out;
        }
        
        .hamburger span:nth-child(1) { top: 0px; }
        .hamburger span:nth-child(2) { top: 5px; }
        .hamburger span:nth-child(3) { top: 10px; }
        
        .hamburger.active span:nth-child(1) {
            top: 5px;
            transform: rotate(135deg);
        }
        
        .hamburger.active span:nth-child(2) {
            opacity: 0;
            left: -20px;
        }
        
        .hamburger.active span:nth-child(3) {
            top: 5px;
            transform: rotate(-135deg);
        }
    </style>
</head>
<body class="bg-gray-900 min-h-screen">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 glass-effect border-b border-vots-red/20">
        <div class="container mx-auto px-2 lg:px-4">
            <div class="flex items-center justify-between h-12">
                <!-- Logo -->
                <div class="flex items-center group">
                    <a href="<?php echo SITE_URL; ?>" class="flex items-center space-x-1.5 transition-transform duration-200 hover:scale-105">
                        <div class="relative">
                            <div class="w-7 h-7 bg-gradient-to-br from-vots-red to-vots-dark-red rounded-md flex items-center justify-center logo-glow animate-pulse-red">
                                <img src="<?php echo SITE_URL; ?>/assets/images/logo.jpeg" alt="Voice of the Streets Logo" class="w-4 h-4 object-contain" />
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-black text-white tracking-tight leading-tight">
                                Voice of the
                            </span>
                            <span class="text-xs font-bold text-vots-red -mt-0.5 tracking-wide leading-tight">
                                STREETS
                            </span>
                        </div>
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-0.5">
                    <a href="<?php echo SITE_URL; ?>" class="nav-link px-2 py-1.5 text-gray-300 hover:text-white font-medium transition-all duration-200 hover:bg-vots-red/10 rounded-md text-xs">
                        <i class="fas fa-home mr-1 text-vots-red text-xs"></i>Home
                    </a>
                    <a href="<?php echo SITE_URL; ?>/about.php" class="nav-link px-2 py-1.5 text-gray-300 hover:text-white font-medium transition-all duration-200 hover:bg-vots-red/10 rounded-md text-xs">
                        <i class="fas fa-info-circle mr-1 text-vots-red text-xs"></i>About
                    </a>
                    <a href="<?php echo SITE_URL; ?>/programs.php" class="nav-link px-2 py-1.5 text-gray-300 hover:text-white font-medium transition-all duration-200 hover:bg-vots-red/10 rounded-md text-xs">
                        <i class="fas fa-bullhorn mr-1 text-vots-red text-xs"></i>Programs
                    </a>
                    <a href="<?php echo SITE_URL; ?>/events.php" class="nav-link px-2 py-1.5 text-gray-300 hover:text-white font-medium transition-all duration-200 hover:bg-vots-red/10 rounded-md text-xs">
                        <i class="fas fa-calendar mr-1 text-vots-red text-xs"></i>Events
                    </a>
                    <a href="<?php echo SITE_URL; ?>/blog.php" class="nav-link px-2 py-1.5 text-gray-300 hover:text-white font-medium transition-all duration-200 hover:bg-vots-red/10 rounded-md text-xs">
                        <i class="fas fa-blog mr-1 text-vots-red text-xs"></i>Blog
                    </a>
                    <a href="<?php echo SITE_URL; ?>/gallery.php" class="nav-link px-2 py-1.5 text-gray-300 hover:text-white font-medium transition-all duration-200 hover:bg-vots-red/10 rounded-md text-xs">
                        <i class="fas fa-images mr-1 text-vots-red text-xs"></i>Gallery
                    </a>
                    <a href="<?php echo SITE_URL; ?>/get-involved.php" class="nav-link px-2 py-1.5 text-gray-300 hover:text-white font-medium transition-all duration-200 hover:bg-vots-red/10 rounded-md text-xs">
                        <i class="fas fa-hands-helping mr-1 text-vots-red text-xs"></i>Get Involved
                    </a>
                    <a href="<?php echo SITE_URL; ?>/contact.php" class="nav-link px-2 py-1.5 text-gray-300 hover:text-white font-medium transition-all duration-200 hover:bg-vots-red/10 rounded-md text-xs">
                        <i class="fas fa-envelope mr-1 text-vots-red text-xs"></i>Contact
                    </a>
                </nav>
                
                <!-- Right Side Controls -->
                <div class="flex items-center space-x-2">
                    <!-- Language Switcher -->
                    <div class="hidden md:block relative group">
                        <select onchange="changeLanguage(this.value)" class="flex items-center space-x-1 px-2 py-1 bg-vots-gray hover:bg-vots-light-gray rounded-md transition-all duration-200 border border-vots-red/20 hover:border-vots-red/40 text-white text-xs">
                            <option value="en" <?php echo $current_language == 'en' ? 'selected' : ''; ?>>🇺🇸 EN</option>
                            <option value="sw" <?php echo $current_language == 'sw' ? 'selected' : ''; ?>>🇰🇪 SW</option>
                            <option value="fr" <?php echo $current_language == 'fr' ? 'selected' : ''; ?>>🇫🇷 FR</option>
                        </select>
                    </div>
                    
                    <!-- CTA Button -->
                    <button class="hidden md:block bg-gradient-to-r from-vots-red to-vots-dark-red hover:from-vots-dark-red hover:to-red-700 text-white px-3 py-1.5 rounded-md font-semibold transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-lg text-xs">
                        <i class="fas fa-heart mr-1 text-xs"></i>
                        Donate
                    </button>
                    
                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="lg:hidden p-1.5 rounded-md bg-vots-gray hover:bg-vots-light-gray transition-colors duration-200">
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
    <div id="mobile-overlay" class="fixed inset-0 bg-black/50 z-40 opacity-0 invisible transition-all duration-200"></div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed top-0 left-0 h-full w-56 max-w-[80vw] bg-vots-black border-r border-vots-red/20 z-50 mobile-menu-slide">
        <div class="p-3">
            <!-- Mobile Logo -->
            <div class="flex items-center space-x-1.5 mb-4">
                <div class="w-6 h-6 bg-gradient-to-br from-vots-red to-vots-dark-red rounded-md flex items-center justify-center">
                    <i class="fas fa-microphone text-white text-xs"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm font-black text-white leading-tight">Voice of the</span>
                    <span class="text-xs font-bold text-vots-red -mt-0.5 leading-tight">STREETS</span>
                </div>
            </div>
            
            <!-- Mobile Navigation -->
            <nav class="space-y-0.5">
                <a href="<?php echo SITE_URL; ?>" class="flex items-center space-x-2 px-2 py-1.5 text-gray-300 hover:text-white hover:bg-vots-red/10 rounded-md transition-all duration-200 group text-xs">
                    <i class="fas fa-home text-vots-red group-hover:scale-110 transition-transform duration-200 text-xs"></i>
                    <span class="font-medium">Home</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/about.php" class="flex items-center space-x-2 px-2 py-1.5 text-gray-300 hover:text-white hover:bg-vots-red/10 rounded-md transition-all duration-200 group text-xs">
                    <i class="fas fa-info-circle text-vots-red group-hover:scale-110 transition-transform duration-200 text-xs"></i>
                    <span class="font-medium">About</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/programs.php" class="flex items-center space-x-2 px-2 py-1.5 text-gray-300 hover:text-white hover:bg-vots-red/10 rounded-md transition-all duration-200 group text-xs">
                    <i class="fas fa-bullhorn text-vots-red group-hover:scale-110 transition-transform duration-200 text-xs"></i>
                    <span class="font-medium">Programs</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/events.php" class="flex items-center space-x-2 px-2 py-1.5 text-gray-300 hover:text-white hover:bg-vots-red/10 rounded-md transition-all duration-200 group text-xs">
                    <i class="fas fa-calendar text-vots-red group-hover:scale-110 transition-transform duration-200 text-xs"></i>
                    <span class="font-medium">Events</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/blog.php" class="flex items-center space-x-2 px-2 py-1.5 text-gray-300 hover:text-white hover:bg-vots-red/10 rounded-md transition-all duration-200 group text-xs">
                    <i class="fas fa-blog text-vots-red group-hover:scale-110 transition-transform duration-200 text-xs"></i>
                    <span class="font-medium">Blog</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/gallery.php" class="flex items-center space-x-2 px-2 py-1.5 text-gray-300 hover:text-white hover:bg-vots-red/10 rounded-md transition-all duration-200 group text-xs">
                    <i class="fas fa-images text-vots-red group-hover:scale-110 transition-transform duration-200 text-xs"></i>
                    <span class="font-medium">Gallery</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/get-involved.php" class="flex items-center space-x-2 px-2 py-1.5 text-gray-300 hover:text-white hover:bg-vots-red/10 rounded-md transition-all duration-200 group text-xs">
                    <i class="fas fa-hands-helping text-vots-red group-hover:scale-110 transition-transform duration-200 text-xs"></i>
                    <span class="font-medium">Get Involved</span>
                </a>
                <a href="<?php echo SITE_URL; ?>/contact.php" class="flex items-center space-x-2 px-2 py-1.5 text-gray-300 hover:text-white hover:bg-vots-red/10 rounded-md transition-all duration-200 group text-xs">
                    <i class="fas fa-envelope text-vots-red group-hover:scale-110 transition-transform duration-200 text-xs"></i>
                    <span class="font-medium">Contact</span>
                </a>
            </nav>
            
            <!-- Mobile Language Switcher -->
            <div class="mt-4 pt-3 border-t border-vots-red/20">
                <h3 class="text-white font-semibold mb-1 text-xs uppercase tracking-wider">Language</h3>
                <select onchange="changeLanguage(this.value)" class="w-full bg-vots-gray border border-vots-red/20 rounded px-2 py-1 text-white text-xs">
                    <option value="en" <?php echo $current_language == 'en' ? 'selected' : ''; ?>>🇺🇸 English</option>
                    <option value="sw" <?php echo $current_language == 'sw' ? 'selected' : ''; ?>>🇰🇪 Kiswahili</option>
                    <option value="fr" <?php echo $current_language == 'fr' ? 'selected' : ''; ?>>🇫🇷 Français</option>
                </select>
            </div>
            
            <!-- Mobile CTA -->
            <div class="mt-4 pt-3 border-t border-vots-red/20">
                <button class="w-full bg-gradient-to-r from-vots-red to-vots-dark-red hover:from-vots-dark-red hover:to-red-700 text-white px-3 py-1.5 rounded-md font-semibold transition-all duration-200 transform hover:scale-105 shadow-md text-xs">
                    <i class="fas fa-heart mr-1 text-xs"></i>
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
            
            if (currentScrollY > 50) {
                header.classList.add('shadow-lg');
            } else {
                header.classList.remove('shadow-lg');
            }
            
            lastScrollY = currentScrollY;
        });
    </script>
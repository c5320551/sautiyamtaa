<?php
require_once 'config/config.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $current_language; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' . SITE_NAME : SITE_NAME . ' - ' . SITE_TAGLINE; ?></title>
    <meta name="description" content="<?php echo isset($page_description) ? $page_description : SITE_DESCRIPTION; ?>">
    <meta name="keywords" content="<?php echo isset($page_keywords) ? $page_keywords : SITE_KEYWORDS; ?>">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'vots-red': '#dc2626',
                        'vots-black': '#1f2937',
                        'vots-gray': '#6b7280'
                    }
                }
            }
        }
    </script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/css/style.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-white text-gray-900">
    <!-- Header -->
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="<?php echo SITE_URL; ?>" class="flex items-center space-x-2">
                        <img src="<?php echo ASSETS_URL; ?>/images/logo.png" alt="<?php echo SITE_NAME; ?>" class="h-8 w-8">
                        <span class="text-xl font-bold text-vots-red">Voice of the Streets</span>
                    </a>
                </div>
                
                <!-- Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="<?php echo SITE_URL; ?>" class="text-gray-700 hover:text-vots-red transition-colors">Home</a>
                    <a href="<?php echo SITE_URL; ?>/about.php" class="text-gray-700 hover:text-vots-red transition-colors">About</a>
                    <a href="<?php echo SITE_URL; ?>/programs.php" class="text-gray-700 hover:text-vots-red transition-colors">Programs</a>
                    <a href="<?php echo SITE_URL; ?>/events.php" class="text-gray-700 hover:text-vots-red transition-colors">Events</a>
                    <a href="<?php echo SITE_URL; ?>/blog.php" class="text-gray-700 hover:text-vots-red transition-colors">Blog</a>
                    <a href="<?php echo SITE_URL; ?>/gallery.php" class="text-gray-700 hover:text-vots-red transition-colors">Gallery</a>
                    <a href="<?php echo SITE_URL; ?>/get-involved.php" class="text-gray-700 hover:text-vots-red transition-colors">Get Involved</a>
                    <a href="<?php echo SITE_URL; ?>/contact.php" class="text-gray-700 hover:text-vots-red transition-colors">Contact</a>
                </nav>
                
                <!-- Language Switcher -->
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <select onchange="changeLanguage(this.value)" class="bg-gray-100 border border-gray-300 rounded px-2 py-1 text-sm">
                            <option value="en" <?php echo $current_language == 'en' ? 'selected' : ''; ?>>English</option>
                            <option value="sw" <?php echo $current_language == 'sw' ? 'selected' : ''; ?>>Kiswahili</option>
                            <option value="fr" <?php echo $current_language == 'fr' ? 'selected' : ''; ?>>Français</option>
                        </select>
                    </div>
                    
                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="md:hidden text-gray-700 hover:text-vots-red">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden hidden bg-white border-t">
                <div class="px-4 py-2 space-y-2">
                    <a href="<?php echo SITE_URL; ?>" class="block py-2 text-gray-700 hover:text-vots-red">Home</a>
                    <a href="<?php echo SITE_URL; ?>/about.php" class="block py-2 text-gray-700 hover:text-vots-red">About</a>
                    <a href="<?php echo SITE_URL; ?>/programs.php" class="block py-2 text-gray-700 hover:text-vots-red">Programs</a>
                    <a href="<?php echo SITE_URL; ?>/events.php" class="block py-2 text-gray-700 hover:text-vots-red">Events</a>
                    <a href="<?php echo SITE_URL; ?>/blog.php" class="block py-2 text-gray-700 hover:text-vots-red">Blog</a>
                    <a href="<?php echo SITE_URL; ?>/gallery.php" class="block py-2 text-gray-700 hover:text-vots-red">Gallery</a>
                    <a href="<?php echo SITE_URL; ?>/get-involved.php" class="block py-2 text-gray-700 hover:text-vots-red">Get Involved</a>
                    <a href="<?php echo SITE_URL; ?>/contact.php" class="block py-2 text-gray-700 hover:text-vots-red">Contact</a>
                </div>
            </div>
        </div>
    </header>
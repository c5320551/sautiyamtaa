<?php
// Environment settings
define('ENVIRONMENT', 'development'); 

// Site paths
define('SITE_ROOT', dirname(dirname(__FILE__)));
define('SITE_URL', 'https://expert-adventure-g4w499qwg5jq2vxq4-8000.app.github.dev'); // Change for production
define('ADMIN_URL', SITE_URL . '/admin');
define('ASSETS_URL', SITE_URL . '/assets');
define('UPLOADS_URL', SITE_URL . '/assets/uploads');

// Site information
define('SITE_NAME', 'Voice of the Streets');
define('SITE_TAGLINE', 'Empowering Youth, Building Communities');
define('SITE_DESCRIPTION', 'A grassroots nonprofit focused on youth empowerment and community action in Nairobi, Kenya.');
define('SITE_KEYWORDS', 'youth empowerment, community development, Nairobi, Kenya, nonprofit, Sauti ya Mtaa');

// Contact information
define('CONTACT_EMAIL', 'info@sautiymtaa.co.ke'); // Change this    
define('CONTACT_PHONE', '+254 700 123 456');
define('CONTACT_ADDRESS', 'Nairobi, Kenya');

// Social media
define('FACEBOOK_URL', 'https://facebook.com/sautiymtaa');
define('TWITTER_URL', 'https://twitter.com/sautiymtaa');
define('INSTAGRAM_URL', 'https://instagram.com/sautiymtaa');
define('YOUTUBE_URL', 'https://youtube.com/c/sautiymtaa');

// Upload settings
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_IMAGE_TYPES', ['jpg', 'jpeg', 'png', 'gif', 'webp']);
define('ALLOWED_VIDEO_TYPES', ['mp4', 'avi', 'mov', 'wmv']);
define('UPLOADS_DIR', SITE_ROOT . '/assets/uploads');
define('THUMBNAILS_DIR', UPLOADS_DIR . '/thumbnails');

// Pagination settings
define('POSTS_PER_PAGE', 12);
define('EVENTS_PER_PAGE', 10);
define('PROGRAMS_PER_PAGE', 9);
define('GALLERY_PER_PAGE', 18);

// Admin settings
define('ADMIN_SESSION_TIMEOUT', 3600); // 1 hour in seconds
define('LOGIN_ATTEMPTS_LIMIT', 5);
define('LOGIN_TIMEOUT', 900); // 15 minutes

// Email settings (for contact form)
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your_email@gmail.com'); // Change this
define('SMTP_PASSWORD', 'your_app_password');    // Change this
define('SMTP_ENCRYPTION', 'tls');

// Security settings
define('CSRF_TOKEN_EXPIRY', 3600); // 1 hour
define('PASSWORD_MIN_LENGTH', 8);
define('SESSION_LIFETIME', 7200); // 2 hours

// Cache settings
define('CACHE_ENABLED', true);
define('CACHE_DURATION', 3600); // 1 hour

// Debug settings
if (ENVIRONMENT === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', SITE_ROOT . '/error.log');
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', SITE_ROOT . '/error.log');
}
<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include constants and database
require_once 'constants.php';
require_once 'database.php';

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Set default timezone
date_default_timezone_set('Africa/Nairobi');

// Language handling
$supported_languages = ['en', 'sw', 'fr'];
$default_language = 'en';

// Get current language from session or URL parameter
if (isset($_GET['lang']) && in_array($_GET['lang'], $supported_languages)) {
    $_SESSION['language'] = $_GET['lang'];
} elseif (!isset($_SESSION['language'])) {
    $_SESSION['language'] = $default_language;
}

$current_language = $_SESSION['language'];

// Include language file
require_once SITE_ROOT . '/languages/' . $current_language . '.php';

// Helper functions
require_once SITE_ROOT . '/includes/functions.php';

// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');

// CSRF token generation
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

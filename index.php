<?php
// Get the request URI and clean it
$request = $_SERVER['REQUEST_URI'];
$request = parse_url($request, PHP_URL_PATH);
$request = rtrim($request, '/'); // Remove trailing slash
if (empty($request)) $request = '/'; // Handle empty path as root

// Define base paths
define('BASE_PATH', dirname(__DIR__));
define('PAGES_PATH', BASE_PATH . '/pages/');
define('BLOGS_PATH', BASE_PATH . '/blogs/');
define('EVENTS_PATH', BASE_PATH . '/events/');
define('PROGRAMS_PATH', BASE_PATH . '/programs/');

// Function to safely require a file
function requirePage($filePath, $statusCode = 200) {
    if (file_exists($filePath)) {
        http_response_code($statusCode);
        require $filePath;
        return true;
    }
    return false;
}

// Function to handle dynamic routes
function handleDynamicRoute($pattern, $handler) {
    global $request;
    if (preg_match($pattern, $request, $matches)) {
        return $handler($matches);
    }
    return false;
}

// Route handling
switch (true) {
    // Home routes
    case ($request === '/' || $request === '/index' || $request === '/home'):
    if (!requirePage(PAGES_PATH . 'home.php')) {
        echo "Page missing: " . PAGES_PATH . 'home.php';
    }
    break;

    
    // Static page routes
    case ($request === '/about'):
        requirePage(PAGES_PATH . 'about.php');
        break;
    
    case ($request === '/contact'):
        requirePage(PAGES_PATH . 'contact.php');
        break;
    
    case ($request === '/gallery'):
        requirePage(PAGES_PATH . 'gallery.php');
        break;
    
    case ($request === '/get-involved'):
        requirePage(PAGES_PATH . 'get-involved.php');
        break;
    
    case ($request === '/search'):
        requirePage(PAGES_PATH . 'search.php');
        break;
    
    // Blog routes
    case ($request === '/blog'):
        requirePage(BLOGS_PATH . 'blog.php');
        break;
    
    // Dynamic blog post route: /blog/post-slug
    case (preg_match('/^\/blog\/([a-zA-Z0-9\-_]+)$/', $request, $matches)):
        $_GET['slug'] = $matches[1]; // Pass slug to the page
        requirePage(BLOGS_PATH . 'blog_post.php');
        break;
    
    // Events routes
    case ($request === '/events'):
        requirePage(EVENTS_PATH . 'events.php');
        break;
    
    // Dynamic event detail route: /events/event-id
    case (preg_match('/^\/events\/([0-9]+)$/', $request, $matches)):
        $_GET['id'] = $matches[1]; // Pass ID to the page
        requirePage(EVENTS_PATH . 'event_detail.php');
        break;
    
    // Programs routes
    case ($request === '/programs'):
        requirePage(PROGRAMS_PATH . 'programs.php');
        break;
    
    // Dynamic program detail route: /programs/program-id
    case (preg_match('/^\/programs\/([0-9]+)$/', $request, $matches)):
        $_GET['id'] = $matches[1]; // Pass ID to the page
        requirePage(PROGRAMS_PATH . 'program_detail.php');
        break;
    
    // API-like routes (if needed)
    case (preg_match('/^\/api\/(.+)$/', $request, $matches)):
        // Handle API requests
        header('Content-Type: application/json');
        http_response_code(501);
        echo json_encode(['error' => 'API not implemented']);
        break;
    
    // Language switching (if using language system)
    case (preg_match('/^\/lang\/([a-z]{2})$/', $request, $matches)):
        $lang = $matches[1];
        if (in_array($lang, ['en', 'sw', 'fr'])) {
            $_SESSION['language'] = $lang;
            // Redirect back to referer or home
            $redirect = $_SERVER['HTTP_REFERER'] ?? '/';
            header("Location: $redirect");
            exit;
        }
        // If invalid language, fall through to 404
        
    // Admin routes (basic protection)
    case (preg_match('/^\/admin/', $request)):
        // You might want to add authentication check here
        // For now, just block admin access through this router
        http_response_code(403);
        echo "Access denied";
        break;
    
    // 404 - Page not found
    default:
        if (!requirePage(PAGES_PATH . '404.php', 404)) {
            // Fallback if 404.php doesn't exist
            http_response_code(404);
            echo "<h1>404 - Page Not Found</h1>";
            echo "<p>The requested page could not be found.</p>";
        }
        break;
}

// Optional: Log requests for debugging (remove in production)
if (defined('DEBUG') && DEBUG) {
    error_log("Router: {$request} - " . http_response_code());
}
?>
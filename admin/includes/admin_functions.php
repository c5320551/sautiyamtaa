<?php
// Admin authentication check
function checkAdminAuth() {
    if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
        header('Location: login.php');
        exit;
    }
}

// Get dashboard statistics
function getDashboardStats($pdo) {
    $stats = [];
    
    // Count programs
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM programs");
    $stats['programs'] = $stmt->fetch()['count'];
    
    // Count events
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM events");
    $stats['events'] = $stmt->fetch()['count'];
    
    // Count blog posts
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM blog_posts");
    $stats['blog_posts'] = $stmt->fetch()['count'];
    
    // Count volunteers
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM volunteers");
    $stats['volunteers'] = $stmt->fetch()['count'];
    
    return $stats;
}

// Handle file uploads
function handleFileUpload($file, $upload_dir, $allowed_types = ['jpg', 'jpeg', 'png', 'gif']) {
    if (!isset($file['tmp_name']) || !$file['tmp_name']) {
        return false;
    }
    
    $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
    if (!in_array($file_extension, $allowed_types)) {
        return false;
    }
    
    $file_name = uniqid() . '.' . $file_extension;
    $upload_path = $upload_dir . '/' . $file_name;
    
    if (move_uploaded_file($file['tmp_name'], $upload_path)) {
        return $file_name;
    }
    
    return false;
}

// Generate slug from title
function generateSlug($title) {
    $slug = strtolower(trim($title));
    $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}

// Sanitize input
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Format date for display
function formatDate($date, $format = 'M j, Y') {
    return date($format, strtotime($date));
}

// Truncate text
function truncateText($text, $length = 150) {
    if (strlen($text) <= $length) {
        return $text;
    }
    return substr($text, 0, $length) . '...';
}
?>
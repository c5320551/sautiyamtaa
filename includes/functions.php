<?php
/**
 * Sanitize input data
 */
function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

/**
 * Generate secure random string
 */
function generate_token($length = 32) {
    return bin2hex(random_bytes($length));
}

/**
 * Verify CSRF token
 */
function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Generate CSRF token input field
 */
function csrf_token_field() {
    return '<input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">';
}

/**
 * Format date for display
 */
function format_date($date, $format = 'F j, Y') {
    return date($format, strtotime($date));
}

/**
 * Format datetime for display
 */
function format_datetime($datetime, $format = 'F j, Y g:i A') {
    return date($format, strtotime($datetime));
}

/**
 * Get time ago format
 */
function time_ago($datetime) {
    $time = time() - strtotime($datetime);
    $time = ($time < 1) ? 1 : $time;
    $tokens = [
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    ];

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '') . ' ago';
    }
}

/**
 * Generate SEO-friendly slug
 */
function generate_slug($text) {
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    return trim($text, '-');
}

/**
 * Get excerpt from content
 */
function get_excerpt($content, $length = 150, $more = '...') {
    $content = strip_tags($content);
    if (strlen($content) <= $length) {
        return $content;
    }
    return substr($content, 0, $length) . $more;
}

/**
 * Get current page URL
 */
function current_page_url() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

/**
 * Redirect to URL
 */
function redirect($url) {
    header("Location: $url");
    exit();
}

/**
 * Check if user is logged in (admin)
 */
function is_logged_in() {
    return isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']);
}

/**
 * Require admin login
 */
function require_admin_login() {
    if (!is_logged_in()) {
        redirect(ADMIN_URL . '/login.php');
    }
}

/**
 * Upload file with security checks
 */
function upload_file($file, $target_dir, $allowed_types = null) {
    if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'Upload failed'];
    }

    $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
    if ($allowed_types && !in_array($file_extension, $allowed_types)) {
        return ['success' => false, 'message' => 'File type not allowed'];
    }

    if ($file['size'] > MAX_FILE_SIZE) {
        return ['success' => false, 'message' => 'File too large'];
    }

    // Generate unique filename
    $filename = uniqid() . '.' . $file_extension;
    $target_path = $target_dir . '/' . $filename;

    // Create directory if it doesn't exist
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    if (move_uploaded_file($file['tmp_name'], $target_path)) {
        return ['success' => true, 'filename' => $filename, 'path' => $target_path];
    }

    return ['success' => false, 'message' => 'Failed to save file'];
}

/**
 * Delete file safely
 */
function delete_file($file_path) {
    if (file_exists($file_path)) {
        return unlink($file_path);
    }
    return true;
}

/**
 * Get site setting
 */
function get_setting($key, $default = '') {
    global $db, $current_language;
    
    try {
        $stmt = $db->prepare("SELECT setting_value_{$current_language} as value FROM site_settings WHERE setting_key = ?");
        $stmt->execute([$key]);
        $result = $stmt->fetch();
        
        return $result ? $result['value'] : $default;
    } catch (Exception $e) {
        error_log("Error fetching setting: " . $e->getMessage());
        return $default;
    }
}

/**
 * Get translation
 */
function t($key, $default = '') {
    global $lang;
    return isset($lang[$key]) ? $lang[$key] : $default;
}

/**
 * Get language URL
 */
function get_language_url($language) {
    $current_url = current_page_url();
    $parsed_url = parse_url($current_url);
    $query = isset($parsed_url['query']) ? $parsed_url['query'] : '';
    
    // Remove existing lang parameter
    $query = preg_replace('/&?lang=[^&]*/', '', $query);
    
    // Add new lang parameter
    $separator = empty($query) ? '?' : '&';
    return $parsed_url['scheme'] . '://' . $parsed_url['host'] . $parsed_url['path'] . 
           ($query ? '?' . $query : '') . $separator . 'lang=' . $language;
}

/**
 * Simple pagination function
 */
function paginate($total_items, $items_per_page, $current_page = 1) {
    $total_pages = ceil($total_items / $items_per_page);
    $current_page = max(1, min($current_page, $total_pages));
    $offset = ($current_page - 1) * $items_per_page;
    
    return [
        'total_items' => $total_items,
        'items_per_page' => $items_per_page,
        'total_pages' => $total_pages,
        'current_page' => $current_page,
        'offset' => $offset,
        'has_previous' => $current_page > 1,
        'has_next' => $current_page < $total_pages
    ];
}

/**
 * Log activity (for admin actions)
 */
function log_activity($action, $details = '') {
    global $db;
    
    if (!is_logged_in()) return;
    
    try {
        $stmt = $db->prepare("INSERT INTO activity_log (admin_id, action, details, ip_address, user_agent) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $_SESSION['admin_id'],
            $action,
            $details,
            $_SERVER['REMOTE_ADDR'],
            $_SERVER['HTTP_USER_AGENT']
        ]);
    } catch (Exception $e) {
        error_log("Error logging activity: " . $e->getMessage());
    }
}

/**
 * Send email (using PHP mail function - can be upgraded to SMTP)
 */
function send_email($to, $subject, $message, $headers = '') {
    $default_headers = "From: " . CONTACT_EMAIL . "\r\n";
    $default_headers .= "Reply-To: " . CONTACT_EMAIL . "\r\n";
    $default_headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    $headers = $headers ? $headers : $default_headers;
    
    return mail($to, $subject, $message, $headers);
}
?>
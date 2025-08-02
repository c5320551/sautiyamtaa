<?php
define('ENVIRONMENT', 'development');
require_once 'config/database.php';

$db = new Database();
$pdo = $db->getConnection();

if ($pdo) {
    echo "<h3 style='color: green;'>✅ Class-based DB connection successful!</h3>";
} else {
    echo "<h3 style='color: red;'>❌ Failed to connect:</h3>";
    echo $db->getError();
}

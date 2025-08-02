<?php
session_start();

// Get current language
$lang = $_SESSION['lang'] ?? 'en';
require_once "languages/$lang.php";

$page_title = $translations['page_not_found'] ?? 'Page Not Found';
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Voice of the Streets</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-gray-50">
    <?php include 'includes/header.php'; ?>

    <main class="container mx-auto px-4 py-16">
        <div class="text-center">
            <div class="mb-8">
                <h1 class="text-9xl font-bold text-red-600">404</h1>
            </div>
            
            <h2 class="text-3xl font-bold text-gray-900 mb-4">
                <?php echo $translations['page_not_found'] ?? 'Page Not Found'; ?>
            </h2>
            
            <p class="text-lg text-gray-600 mb-8 max-w-md mx-auto">
                <?php echo $translations['404_message'] ?? 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.'; ?>
            </p>
            
            <div class="space-x-4">
                <a href="index.php" 
                   class="bg-red-600 text-white px-6 py-3 rounded-md hover:bg-red-700 transition-colors">
                    <?php echo $translations['home'] ?? 'Home'; ?>
                </a>
                
                <a href="javascript:history.back()" 
                   class="bg-gray-200 text-gray-800 px-6 py-3 rounded-md hover:bg-gray-300 transition-colors">
                    <?php echo $translations['go_back'] ?? 'Go Back'; ?>
                </a>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
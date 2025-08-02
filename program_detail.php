<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Get current language
$lang = $_SESSION['lang'] ?? 'en';
require_once "languages/$lang.php";

// Get program ID from URL
$program_id = $_GET['id'] ?? null;
if (!$program_id) {
    header('Location: programs.php');
    exit;
}

// Fetch program details
$stmt = $pdo->prepare("SELECT * FROM programs WHERE id = ? AND status = 'active'");
$stmt->execute([$program_id]);
$program = $stmt->fetch();

if (!$program) {
    header('Location: 404.php');
    exit;
}

$page_title = $program['title_' . $lang] ?? $program['title_en'];
$page_description = substr(strip_tags($program['description_' . $lang] ?? $program['description_en']), 0, 160);
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?> - Voice of the Streets</title>
    <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-gray-50">
    <?php include 'includes/header.php'; ?>

    <main class="container mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <ol class="flex space-x-2 text-sm text-gray-600">
                <li><a href="index.php" class="hover:text-red-600"><?php echo $translations['home']; ?></a></li>
                <li>/</li>
                <li><a href="programs.php" class="hover:text-red-600"><?php echo $translations['programs']; ?></a></li>
                <li>/</li>
                <li class="text-gray-900"><?php echo htmlspecialchars($page_title); ?></li>
            </ol>
        </nav>

        <!-- Program Detail -->
        <article class="bg-white rounded-lg shadow-lg overflow-hidden">
            <?php if ($program['image']): ?>
            <div class="h-96 bg-gray-200">
                <img src="assets/uploads/programs/<?php echo htmlspecialchars($program['image']); ?>" 
                     alt="<?php echo htmlspecialchars($page_title); ?>"
                     class="w-full h-full object-cover">
            </div>
            <?php endif; ?>
            
            <div class="p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-4"><?php echo htmlspecialchars($page_title); ?></h1>
                
                <div class="flex items-center space-x-4 mb-6 text-sm text-gray-600">
                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full">
                        <?php echo htmlspecialchars($program['category']); ?>
                    </span>
                    <span><?php echo $translations['updated']; ?>: <?php echo date('M d, Y', strtotime($program['updated_at'])); ?></span>
                </div>
                
                <div class="prose max-w-none">
                    <?php echo nl2br(htmlspecialchars($program['description_' . $lang] ?? $program['description_en'])); ?>
                </div>
                
                <div class="mt-8 pt-8 border-t">
                    <a href="get-involved.php" class="bg-red-600 text-white px-6 py-3 rounded-md hover:bg-red-700 transition-colors">
                        <?php echo $translations['get_involved']; ?>
                    </a>
                </div>
            </div>
        </article>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
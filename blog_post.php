<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Get current language
$lang = $_SESSION['lang'] ?? 'en';
require_once "languages/$lang.php";

// Get post ID from URL
$post_id = $_GET['id'] ?? null;
if (!$post_id) {
    header('Location: blog.php');
    exit;
}

// Fetch post details
$stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE id = ? AND status = 'published'");
$stmt->execute([$post_id]);
$post = $stmt->fetch();

if (!$post) {
    header('Location: 404.php');
    exit;
}

$page_title = $post['title_' . $lang] ?? $post['title_en'];
$page_description = substr(strip_tags($post['content_' . $lang] ?? $post['content_en']), 0, 160);
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
                <li><a href="blog.php" class="hover:text-red-600"><?php echo $translations['blog']; ?></a></li>
                <li>/</li>
                <li class="text-gray-900"><?php echo htmlspecialchars($page_title); ?></li>
            </ol>
        </nav>

        <!-- Blog Post -->
        <article class="bg-white rounded-lg shadow-lg overflow-hidden max-w-4xl mx-auto">
            <?php if ($post['featured_image']): ?>
            <div class="h-96 bg-gray-200">
                <img src="assets/uploads/blog/<?php echo htmlspecialchars($post['featured_image']); ?>" 
                     alt="<?php echo htmlspecialchars($page_title); ?>"
                     class="w-full h-full object-cover">
            </div>
            <?php endif; ?>
            
            <div class="p-8">
                <div class="flex items-center justify-between mb-6">
                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">
                        <?php echo htmlspecialchars($post['category']); ?>
                    </span>
                    <span class="text-gray-500 text-sm">
                        <?php echo date('M d, Y', strtotime($post['created_at'])); ?>
                    </span>
                </div>
                
                <h1 class="text-3xl font-bold text-gray-900 mb-6"><?php echo htmlspecialchars($page_title); ?></h1>
                
                <div class="prose max-w-none">
                    <?php echo nl2br(htmlspecialchars($post['content_' . $lang] ?? $post['content_en'])); ?>
                </div>
                
                <div class="mt-8 pt-8 border-t">
                    <a href="blog.php" class="text-red-600 hover:text-red-800 font-medium">
                        ← <?php echo $translations['back_to_blog'] ?? 'Back to Blog'; ?>
                    </a>
                </div>
            </div>
        </article>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
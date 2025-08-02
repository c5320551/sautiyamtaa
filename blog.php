<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Get current language
$lang = $_SESSION['lang'] ?? 'en';
require_once "languages/$lang.php";

// Pagination
$page = $_GET['page'] ?? 1;
$limit = 6;
$offset = ($page - 1) * $limit;

// Category filter
$category = $_GET['category'] ?? '';

// Build query
$where_clause = "WHERE status = 'published'";
$params = [];

if ($category) {
    $where_clause .= " AND category = ?";
    $params[] = $category;
}

// Fetch blog posts
$stmt = $pdo->prepare("SELECT * FROM blog_posts $where_clause ORDER BY created_at DESC LIMIT ? OFFSET ?");
$params[] = $limit;
$params[] = $offset;
$stmt->execute($params);
$posts = $stmt->fetchAll();

// Count total posts
$count_stmt = $pdo->prepare("SELECT COUNT(*) FROM blog_posts $where_clause");
$count_stmt->execute(array_slice($params, 0, -2));
$total_posts = $count_stmt->fetchColumn();
$total_pages = ceil($total_posts / $limit);

// Get categories for filter
$cat_stmt = $pdo->prepare("SELECT DISTINCT category FROM blog_posts WHERE status = 'published'");
$cat_stmt->execute();
$categories = $cat_stmt->fetchAll(PDO::FETCH_COLUMN);

$page_title = $translations['blog'] ?? 'Blog';
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Voice of the Streets</title>
    <meta name="description" content="Read our latest news, stories, and updates from the community">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-gray-50">
    <?php include 'includes/header.php'; ?>

    <main class="container mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4"><?php echo $page_title; ?></h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                <?php echo $translations['blog_subtitle'] ?? 'Stories, updates, and insights from our community'; ?>
            </p>
        </div>

        <!-- Category Filter -->
        <?php if ($categories): ?>
        <div class="mb-8 flex flex-wrap gap-2 justify-center">
            <a href="blog.php" 
               class="px-4 py-2 rounded-full <?php echo !$category ? 'bg-red-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100'; ?>">
                <?php echo $translations['all'] ?? 'All'; ?>
            </a>
            <?php foreach ($categories as $cat): ?>
            <a href="blog.php?category=<?php echo urlencode($cat); ?>" 
               class="px-4 py-2 rounded-full <?php echo $category === $cat ? 'bg-red-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100'; ?>">
                <?php echo htmlspecialchars($cat); ?>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Blog Posts Grid -->
        <?php if ($posts): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <?php foreach ($posts as $post): ?>
            <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                <?php if ($post['featured_image']): ?>
                <div class="h-48 bg-gray-200">
                    <img src="assets/uploads/blog/<?php echo htmlspecialchars($post['featured_image']); ?>" 
                         alt="<?php echo htmlspecialchars($post['title_' . $lang] ?? $post['title_en']); ?>"
                         class="w-full h-full object-cover">
                </div>
                <?php endif; ?>
                
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm text-red-600 font-medium">
                            <?php echo htmlspecialchars($post['category']); ?>
                        </span>
                        <span class="text-sm text-gray-500">
                            <?php echo date('M d, Y', strtotime($post['created_at'])); ?>
                        </span>
                    </div>
                    
                    <h2 class="text-xl font-bold text-gray-900 mb-3">
                        <?php echo htmlspecialchars($post['title_' . $lang] ?? $post['title_en']); ?>
                    </h2>
                    
                    <p class="text-gray-600 mb-4">
                        <?php echo substr(strip_tags($post['content_' . $lang] ?? $post['content_en']), 0, 120); ?>...
                    </p>
                    
                    <a href="blog_post.php?id=<?php echo $post['id']; ?>" 
                       class="inline-block bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors">
                        <?php echo $translations['read_more'] ?? 'Read More'; ?>
                    </a>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
        <div class="flex justify-center space-x-2">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?php echo $i; ?><?php echo $category ? '&category=' . urlencode($category) : ''; ?>" 
               class="px-4 py-2 rounded-md <?php echo $i == $page ? 'bg-red-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100'; ?>">
                <?php echo $i; ?>
            </a>
            <?php endfor; ?>
        </div>
        <?php endif; ?>

        <?php else: ?>
        <div class="text-center py-12">
            <p class="text-gray-600"><?php echo $translations['no_posts'] ?? 'No blog posts available.'; ?></p>
        </div>
        <?php endif; ?>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
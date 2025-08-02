<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Get current language
$lang = $_SESSION['lang'] ?? 'en';
require_once "languages/$lang.php";

// Category filter
$category = $_GET['category'] ?? '';

// Build query
$where_clause = "WHERE status = 'active'";
$params = [];

if ($category) {
    $where_clause .= " AND category = ?";
    $params[] = $category;
}

// Fetch gallery items
$stmt = $pdo->prepare("SELECT * FROM gallery $where_clause ORDER BY created_at DESC");
$stmt->execute($params);
$gallery_items = $stmt->fetchAll();

// Get categories for filter
$cat_stmt = $pdo->prepare("SELECT DISTINCT category FROM gallery WHERE status = 'active'");
$cat_stmt->execute();
$categories = $cat_stmt->fetchAll(PDO::FETCH_COLUMN);

$page_title = $translations['gallery'] ?? 'Gallery';
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Voice of the Streets</title>
    <meta name="description" content="Explore our photo and video gallery showcasing community activities and events">
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
                <?php echo $translations['gallery_subtitle'] ?? 'Moments from our community activities and events'; ?>
            </p>
        </div>

        <!-- Category Filter -->
        <?php if ($categories): ?>
        <div class="mb-8 flex flex-wrap gap-2 justify-center">
            <a href="gallery.php" 
               class="px-4 py-2 rounded-full <?php echo !$category ? 'bg-red-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100'; ?>">
                <?php echo $translations['all'] ?? 'All'; ?>
            </a>
            <?php foreach ($categories as $cat): ?>
            <a href="gallery.php?category=<?php echo urlencode($cat); ?>" 
               class="px-4 py-2 rounded-full <?php echo $category === $cat ? 'bg-red-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100'; ?>">
                <?php echo htmlspecialchars($cat); ?>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Gallery Grid -->
        <?php if ($gallery_items): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <?php foreach ($gallery_items as $item): ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow gallery-item" 
                 data-type="<?php echo $item['type']; ?>" 
                 data-src="assets/uploads/gallery/<?php echo htmlspecialchars($item['file_name']); ?>">
                
                <div class="aspect-square bg-gray-200 relative cursor-pointer">
                    <?php if ($item['type'] === 'image'): ?>
                        <img src="assets/uploads/gallery/<?php echo htmlspecialchars($item['file_name']); ?>" 
                             alt="<?php echo htmlspecialchars($item['title_' . $lang] ?? $item['title_en']); ?>"
                             class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center bg-gray-800 text-white">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="ml-2">Video</span>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-30 transition-opacity flex items-center justify-center">
                        <span class="text-white opacity-0 hover:opacity-100 transition-opacity">
                            <?php echo $translations['view'] ?? 'View'; ?>
                        </span>
                    </div>
                </div>
                
                <div class="p-4">
                    <h3 class="text-sm font-semibold text-gray-900 mb-2">
                        <?php echo htmlspecialchars($item['title_' . $lang] ?? $item['title_en']); ?>
                    </h3>
                    <p class="text-xs text-gray-600">
                        <?php echo htmlspecialchars($item['category']); ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php else: ?>
        <div class="text-center py-12">
            <p class="text-gray-600"><?php echo $translations['no_gallery_items'] ?? 'No gallery items available.'; ?></p>
        </div>
        <?php endif; ?>
    </main>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center">
        <div class="max-w-4xl max-h-full p-4">
            <img id="lightbox-image" class="max-w-full max-h-full object-contain" src="" alt="">
            <video id="lightbox-video" class="max-w-full max-h-full hidden" controls>
                <source src="" type="video/mp4">
            </video>
        </div>
        <button id="close-lightbox" class="absolute top-4 right-4 text-white text-4xl hover:text-gray-300">
            &times;
        </button>
    </div>

    <?php include 'includes/footer.php'; ?>
    
    <script>
        // Simple lightbox functionality
        document.addEventListener('DOMContentLoaded', function() {
            const galleryItems = document.querySelectorAll('.gallery-item');
            const lightbox = document.getElementById('lightbox');
            const lightboxImage = document.getElementById('lightbox-image');
            const lightboxVideo = document.getElementById('lightbox-video');
            const closeLightbox = document.getElementById('close-lightbox');
            
            galleryItems.forEach(item => {
                item.addEventListener('click', function() {
                    const type = this.dataset.type;
                    const src = this.dataset.src;
                    
                    if (type === 'image') {
                        lightboxImage.src = src;
                        lightboxImage.classList.remove('hidden');
                        lightboxVideo.classList.add('hidden');
                    } else {
                        lightboxVideo.querySelector('source').src = src;
                        lightboxVideo.load();
                        lightboxVideo.classList.remove('hidden');
                        lightboxImage.classList.add('hidden');
                    }
                    
                    lightbox.classList.remove('hidden');
                });
            });
            
            closeLightbox.addEventListener('click', function() {
                lightbox.classList.add('hidden');
                lightboxVideo.pause();
            });
            
            lightbox.addEventListener('click', function(e) {
                if (e.target === lightbox) {
                    lightbox.classList.add('hidden');
                    lightboxVideo.pause();
                }
            });
        });
    </script>
</body>
</html>
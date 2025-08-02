<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Get current language
$lang = $_SESSION['lang'] ?? 'en';
require_once "languages/$lang.php";

$search_query = trim($_GET['q'] ?? '');
$results = [];

if ($search_query) {
    // Search in programs
    $stmt = $pdo->prepare("SELECT 'program' as type, id, title_en, title_sw, title_fr, description_en, description_sw, description_fr, image, created_at FROM programs WHERE (title_en LIKE ? OR title_sw LIKE ? OR title_fr LIKE ? OR description_en LIKE ? OR description_sw LIKE ? OR description_fr LIKE ?) AND status = 'active'");
    $search_term = '%' . $search_query . '%';
    $stmt->execute([$search_term, $search_term, $search_term, $search_term, $search_term, $search_term]);
    $program_results = $stmt->fetchAll();
    
    // Search in events
    $stmt = $pdo->prepare("SELECT 'event' as type, id, title_en, title_sw, title_fr, description_en, description_sw, description_fr, image, created_at FROM events WHERE (title_en LIKE ? OR title_sw LIKE ? OR title_fr LIKE ? OR description_en LIKE ? OR description_sw LIKE ? OR description_fr LIKE ?) AND status = 'active'");
    $stmt->execute([$search_term, $search_term, $search_term, $search_term, $search_term, $search_term]);
    $event_results = $stmt->fetchAll();
    
    // Search in blog posts
    $stmt = $pdo->prepare("SELECT 'blog' as type, id, title_en, title_sw, title_fr, content_en as description_en, content_sw as description_sw, content_fr as description_fr, featured_image as image, created_at FROM blog_posts WHERE (title_en LIKE ? OR title_sw LIKE ? OR title_fr LIKE ? OR content_en LIKE ? OR content_sw LIKE ? OR content_fr LIKE ?) AND status = 'published'");
    $stmt->execute([$search_term, $search_term, $search_term, $search_term, $search_term, $search_term]);
    $blog_results = $stmt->fetchAll();
    
    // Combine results
    $results = array_merge($program_results, $event_results, $blog_results);
    
    // Sort by created_at desc
    usort($results, function($a, $b) {
        return strtotime($b['created_at']) - strtotime($a['created_at']);
    });
}

$page_title = $translations['search_results'] ?? 'Search Results';
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width -device-width, initial-scale=1.0">
   <title><?php echo $page_title; ?> - Voice of the Streets</title>
   <meta name="description" content="Search results for Voice of the Streets website">
   <script src="https://cdn.tailwindcss.com"></script>
   <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-gray-50">
   <?php include 'includes/header.php'; ?>

   <main class="container mx-auto px-4 py-8">
       <!-- Search Header -->
       <div class="mb-8">
           <h1 class="text-3xl font-bold text-gray-900 mb-4"><?php echo $page_title; ?></h1>
           <?php if ($search_query): ?>
           <p class="text-lg text-gray-600">
               <?php echo $translations['search_for'] ?? 'Search results for'; ?>: 
               <span class="font-semibold">"<?php echo htmlspecialchars($search_query); ?>"</span>
               <span class="text-sm text-gray-500 ml-2">(<?php echo count($results); ?> <?php echo $translations['results_found'] ?? 'results found'; ?>)</span>
           </p>
           <?php endif; ?>
       </div>

       <!-- Search Form -->
       <div class="mb-8">
           <form method="GET" class="max-w-md">
               <div class="flex">
                   <input type="text" name="q" value="<?php echo htmlspecialchars($search_query); ?>" 
                          placeholder="<?php echo $translations['search_placeholder'] ?? 'Search...'; ?>"
                          class="flex-1 px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-red-500">
                   <button type="submit" 
                           class="bg-red-600 text-white px-6 py-2 rounded-r-md hover:bg-red-700 transition-colors">
                       <?php echo $translations['search'] ?? 'Search'; ?>
                   </button>
               </div>
           </form>
       </div>

       <!-- Search Results -->
       <?php if ($search_query && $results): ?>
       <div class="space-y-6">
           <?php foreach ($results as $result): ?>
           <article class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
               <div class="flex items-start space-x-4">
                   <?php if ($result['image']): ?>
                   <div class="w-24 h-24 bg-gray-200 rounded-lg flex-shrink-0">
                       <img src="assets/uploads/<?php echo $result['type']; ?>s/<?php echo htmlspecialchars($result['image']); ?>" 
                            alt="<?php echo htmlspecialchars($result['title_' . $lang] ?? $result['title_en']); ?>"
                            class="w-full h-full object-cover rounded-lg">
                   </div>
                   <?php endif; ?>
                   
                   <div class="flex-1">
                       <div class="flex items-center space-x-2 mb-2">
                           <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">
                               <?php 
                               switch($result['type']) {
                                   case 'program':
                                       echo $translations['program'] ?? 'Program';
                                       break;
                                   case 'event':
                                       echo $translations['event'] ?? 'Event';
                                       break;
                                   case 'blog':
                                       echo $translations['blog_post'] ?? 'Blog Post';
                                       break;
                               }
                               ?>
                           </span>
                           <span class="text-gray-500 text-sm">
                               <?php echo date('M d, Y', strtotime($result['created_at'])); ?>
                           </span>
                       </div>
                       
                       <h2 class="text-xl font-bold text-gray-900 mb-2">
                           <a href="<?php echo $result['type']; ?>_detail.php?id=<?php echo $result['id']; ?>" 
                              class="hover:text-red-600 transition-colors">
                               <?php echo htmlspecialchars($result['title_' . $lang] ?? $result['title_en']); ?>
                           </a>
                       </h2>
                       
                       <p class="text-gray-600 mb-3">
                           <?php echo substr(strip_tags($result['description_' . $lang] ?? $result['description_en']), 0, 200); ?>...
                       </p>
                       
                       <a href="<?php echo $result['type']; ?>_detail.php?id=<?php echo $result['id']; ?>" 
                          class="text-red-600 hover:text-red-800 font-medium">
                           <?php echo $translations['read_more'] ?? 'Read More'; ?> →
                       </a>
                   </div>
               </div>
           </article>
           <?php endforeach; ?>
       </div>
       
       <?php elseif ($search_query && !$results): ?>
       <div class="text-center py-12">
           <div class="mb-6">
               <svg class="w-16 h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
               </svg>
           </div>
           <h2 class="text-2xl font-bold text-gray-900 mb-4">
               <?php echo $translations['no_results'] ?? 'No results found'; ?>
           </h2>
           <p class="text-gray-600 mb-6">
               <?php echo $translations['no_results_message'] ?? 'Try adjusting your search terms or browse our content below.'; ?>
           </p>
           <div class="space-x-4">
               <a href="programs.php" class="bg-red-600 text-white px-6 py-3 rounded-md hover:bg-red-700 transition-colors">
                   <?php echo $translations['browse_programs'] ?? 'Browse Programs'; ?>
               </a>
               <a href="blog.php" class="bg-gray-200 text-gray-800 px-6 py-3 rounded-md hover:bg-gray-300 transition-colors">
                   <?php echo $translations['browse_blog'] ?? 'Browse Blog'; ?>
               </a>
           </div>
       </div>
       
       <?php else: ?>
       <div class="text-center py-12">
           <div class="mb-6">
               <svg class="w-16 h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
               </svg>
           </div>
           <h2 class="text-2xl font-bold text-gray-900 mb-4">
               <?php echo $translations['search_our_content'] ?? 'Search our content'; ?>
           </h2>
           <p class="text-gray-600">
               <?php echo $translations['search_description'] ?? 'Find programs, events, and blog posts that interest you.'; ?>
           </p>
       </div>
       <?php endif; ?>
   </main>

   <?php include 'includes/footer.php'; ?>
</body>
</html>
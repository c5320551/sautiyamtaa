<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Get current language
$lang = $_SESSION['lang'] ?? 'en';
require_once "languages/$lang.php";

// Get event ID from URL
$event_id = $_GET['id'] ?? null;
if (!$event_id) {
    header('Location: events.php');
    exit;
}

// Fetch event details
$stmt = $pdo->prepare("SELECT * FROM events WHERE id = ? AND status = 'active'");
$stmt->execute([$event_id]);
$event = $stmt->fetch();

if (!$event) {
    header('Location: 404.php');
    exit;
}

$page_title = $event['title_' . $lang] ?? $event['title_en'];
$page_description = substr(strip_tags($event['description_' . $lang] ?? $event['description_en']), 0, 160);
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
                <li><a href="events.php" class="hover:text-red-600"><?php echo $translations['events']; ?></a></li>
                <li>/</li>
                <li class="text-gray-900"><?php echo htmlspecialchars($page_title); ?></li>
            </ol>
        </nav>

        <!-- Event Detail -->
        <article class="bg-white rounded-lg shadow-lg overflow-hidden">
            <?php if ($event['image']): ?>
            <div class="h-96 bg-gray-200">
                <img src="assets/uploads/events/<?php echo htmlspecialchars($event['image']); ?>" 
                     alt="<?php echo htmlspecialchars($page_title); ?>"
                     class="w-full h-full object-cover">
            </div>
            <?php endif; ?>
            
            <div class="p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-4"><?php echo htmlspecialchars($page_title); ?></h1>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="md:col-span-2">
                        <div class="prose max-w-none">
                            <?php echo nl2br(htmlspecialchars($event['description_' . $lang] ?? $event['description_en'])); ?>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold mb-4"><?php echo $translations['event_details'] ?? 'Event Details'; ?></h3>
                        <div class="space-y-3">
                            <div>
                                <span class="font-medium text-gray-700"><?php echo $translations['date'] ?? 'Date'; ?>:</span>
                                <span class="text-gray-900"><?php echo date('M d, Y', strtotime($event['event_date'])); ?></span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700"><?php echo $translations['time'] ?? 'Time'; ?>:</span>
                                <span class="text-gray-900"><?php echo date('g:i A', strtotime($event['event_time'])); ?></span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700"><?php echo $translations['location'] ?? 'Location'; ?>:</span>
                                <span class="text-gray-900"><?php echo htmlspecialchars($event['location']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="border-t pt-8">
                    <a href="get-involved.php" class="bg-red-600 text-white px-6 py-3 rounded-md hover:bg-red-700 transition-colors">
                        <?php echo $translations['register_now'] ?? 'Register Now'; ?>
                    </a>
                </div>
            </div>
        </article>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
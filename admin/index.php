<?php
session_start();
require_once '../config/database.php';
require_once 'includes/admin_functions.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: login.php');
    exit;
}

// Get dashboard statistics
$stats = getDashboardStats($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Voice of the Streets</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-red': '#DC2626',
                        'brand-black': '#1F2937',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100">
    <?php include 'includes/admin_header.php'; ?>

    <div class="flex">
        <?php include 'includes/admin_nav.php'; ?>
        
        <main class="flex-1 p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-brand-black">Dashboard</h1>
                <p class="text-gray-600">Welcome back, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Programs</p>
                            <p class="text-2xl font-semibold text-gray-900"><?php echo $stats['programs']; ?></p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Events</p>
                            <p class="text-2xl font-semibold text-gray-900"><?php echo $stats['events']; ?></p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Blog Posts</p>
                            <p class="text-2xl font-semibold text-gray-900"><?php echo $stats['blog_posts']; ?></p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 text-red-600">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Volunteers</p>
                            <p class="text-2xl font-semibold text-gray-900"><?php echo $stats['volunteers']; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Blog Posts -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Recent Blog Posts</h3>
                    </div>
                    <div class="p-6">
                        <?php
                        $stmt = $pdo->prepare("SELECT title, created_at, status FROM blog_posts ORDER BY created_at DESC LIMIT 5");
                        $stmt->execute();
                        $recent_posts = $stmt->fetchAll();
                        ?>
                        
                        <?php if ($recent_posts): ?>
                            <div class="space-y-3">
                                <?php foreach ($recent_posts as $post): ?>
                                    <div class="flex items-center justify-between py-2">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($post['title']); ?></p>
                                            <p class="text-xs text-gray-500"><?php echo date('M j, Y', strtotime($post['created_at'])); ?></p>
                                        </div>
                                        <span class="px-2 py-1 text-xs rounded-full <?php echo $post['status'] == 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                                            <?php echo ucfirst($post['status']); ?>
                                        </span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-gray-500 text-sm">No blog posts yet.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Recent Events -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Upcoming Events</h3>
                    </div>
                    <div class="p-6">
                        <?php
                        $stmt = $pdo->prepare("SELECT title, event_date, event_time FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC LIMIT 5");
                        $stmt->execute();
                        $upcoming_events = $stmt->fetchAll();
                        ?>
                        
                        <?php if ($upcoming_events): ?>
                            <div class="space-y-3">
                                <?php foreach ($upcoming_events as $event): ?>
                                    <div class="flex items-center justify-between py-2">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($event['title']); ?></p>
                                            <p class="text-xs text-gray-500"><?php echo date('M j, Y g:i A', strtotime($event['event_date'] . ' ' . $event['event_time'])); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-gray-500 text-sm">No upcoming events.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
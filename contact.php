<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Get current language
$lang = $_SESSION['lang'] ?? 'en';
require_once "languages/$lang.php";

$success_message = '';
$error_message = '';

// Handle contact form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    if ($name && $email && $subject && $message) {
        try {
            // Save to database
            $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, message, status, created_at) VALUES (?, ?, ?, ?, 'new', NOW())");
            $stmt->execute([$name, $email, $subject, $message]);
            
            // Send email (basic implementation)
            $to = 'info@voiceofthestreets.org'; // Replace with actual email
            $email_subject = "Contact Form: " . $subject;
            $email_body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
            $headers = "From: $email\r\nReply-To: $email\r\n";
            
            if (mail($to, $email_subject, $email_body, $headers)) {
                $success_message = $translations['contact_success'] ?? 'Thank you for your message! We will get back to you soon.';
            } else {
                $success_message = $translations['contact_saved'] ?? 'Your message has been saved. We will contact you soon.';
            }
        } catch (Exception $e) {
            $error_message = $translations['contact_error'] ?? 'Sorry, there was an error sending your message. Please try again.';
        }
    } else {
        $error_message = $translations['required_fields'] ?? 'Please fill in all required fields.';
    }
}

$page_title = $translations['contact'] ?? 'Contact Us';
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Voice of the Streets</title>
    <meta name="description" content="Get in touch with Voice of the Streets - your community organization in Nairobi">
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
                <?php echo $translations['contact_subtitle'] ?? 'We\'d love to hear from you. Get in touch with our team.'; ?>
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6"><?php echo $translations['send_message'] ?? 'Send us a Message'; ?></h2>
                
                <?php if ($success_message): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    <?php echo $success_message; ?>
                </div>
                <?php endif; ?>
                
                <?php if ($error_message): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <?php echo $error_message; ?>
                </div>
                <?php endif; ?>
                
                <form method="POST" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            <?php echo $translations['name'] ?? 'Name'; ?> *
                        </label>
                        <input type="text" id="name" name="name" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            <?php echo $translations['email'] ?? 'Email'; ?> *
                        </label>
                        <input type="email" id="email" name="email" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                            <?php echo $translations['subject'] ?? 'Subject'; ?> *
                        </label>
                        <input type="text" id="subject" name="subject" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                            <?php echo $translations['message'] ?? 'Message'; ?> *
                        </label>
                        <textarea id="message" name="message" rows="6" required 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"></textarea>
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-red-600 text-white py-3 px-6 rounded-md hover:bg-red-700 transition-colors font-medium">
                        <?php echo $translations['send_message'] ?? 'Send Message'; ?>
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="space-y-8">
                <!-- Contact Details -->
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6"><?php echo $translations['contact_info'] ?? 'Contact Information'; ?></h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-red-600 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <p class="font-medium text-gray-900"><?php echo $translations['address'] ?? 'Address'; ?></p>
                                <p class="text-gray-600">Kibera, Nairobi, Kenya</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-red-600 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                            <div>
                                <p class="font-medium text-gray-900"><?php echo $translations['phone'] ?? 'Phone'; ?></p>
                                <p class="text-gray-600">+254 XXX XXX XXX</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-red-600 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            <div>
                                <p class="font-medium text-gray-900"><?php echo $translations['email'] ?? 'Email'; ?></p>
                                <p class="text-gray-600">info@voiceofthestreets.org</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Map Placeholder -->
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6"><?php echo $translations['find_us'] ?? 'Find Us'; ?></h3>
                    <div class="bg-gray-200 h-64 rounded-lg flex items-center justify-center">
                        <p class="text-gray-500"><?php echo $translations['map_placeholder'] ?? 'Google Maps integration coming soon'; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
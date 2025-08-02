<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Get current language
$lang = $_SESSION['lang'] ?? 'en';
require_once "languages/$lang.php";

$success_message = '';
$error_message = '';

// Handle volunteer form submission
if ($_POST['action'] === 'volunteer') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $interests = trim($_POST['interests'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    if ($name && $email && $phone) {
        try {
            $stmt = $pdo->prepare("INSERT INTO volunteers (name, email, phone, interests, message, status, created_at) VALUES (?, ?, ?, ?, ?, 'pending', NOW())");
            $stmt->execute([$name, $email, $phone, $interests, $message]);
            $success_message = $translations['volunteer_success'] ?? 'Thank you for your interest! We will contact you soon.';
        } catch (Exception $e) {
            $error_message = $translations['volunteer_error'] ?? 'Sorry, there was an error. Please try again.';
        }
    } else {
        $error_message = $translations['required_fields'] ?? 'Please fill in all required fields.';
    }
}

$page_title = $translations['get_involved'] ?? 'Get Involved';
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Voice of the Streets</title>
    <meta name="description" content="Join our mission to empower youth and strengthen communities in Nairobi">
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
                <?php echo $translations['get_involved_subtitle'] ?? 'Be part of the change in your community'; ?>
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Volunteer Section -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6"><?php echo $translations['volunteer'] ?? 'Volunteer'; ?></h2>
                
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
                    <input type="hidden" name="action" value="volunteer">
                    
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
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:focus:ring-2 focus:ring-red-500">
                   </div>
                   
                   <div>
                       <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                           <?php echo $translations['phone'] ?? 'Phone'; ?> *
                       </label>
                       <input type="tel" id="phone" name="phone" required 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                   </div>
                   
                   <div>
                       <label for="interests" class="block text-sm font-medium text-gray-700 mb-2">
                           <?php echo $translations['interests'] ?? 'Areas of Interest'; ?>
                       </label>
                       <select id="interests" name="interests" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                           <option value=""><?php echo $translations['select_interest'] ?? 'Select an area'; ?></option>
                           <option value="youth_mentorship"><?php echo $translations['youth_mentorship'] ?? 'Youth Mentorship'; ?></option>
                           <option value="community_outreach"><?php echo $translations['community_outreach'] ?? 'Community Outreach'; ?></option>
                           <option value="education"><?php echo $translations['education'] ?? 'Education'; ?></option>
                           <option value="health"><?php echo $translations['health'] ?? 'Health'; ?></option>
                           <option value="environment"><?php echo $translations['environment'] ?? 'Environment'; ?></option>
                           <option value="other"><?php echo $translations['other'] ?? 'Other'; ?></option>
                       </select>
                   </div>
                   
                   <div>
                       <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                           <?php echo $translations['message'] ?? 'Message'; ?>
                       </label>
                       <textarea id="message" name="message" rows="4" 
                                 class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                                 placeholder="<?php echo $translations['volunteer_message_placeholder'] ?? 'Tell us why you want to volunteer...'; ?>"></textarea>
                   </div>
                   
                   <button type="submit" 
                           class="w-full bg-red-600 text-white py-3 px-6 rounded-md hover:bg-red-700 transition-colors font-medium">
                       <?php echo $translations['submit_application'] ?? 'Submit Application'; ?>
                   </button>
               </form>
           </div>

           <!-- Donation Section -->
           <div class="bg-white rounded-lg shadow-lg p-8">
               <h2 class="text-2xl font-bold text-gray-900 mb-6"><?php echo $translations['donate'] ?? 'Donate'; ?></h2>
               
               <p class="text-gray-600 mb-6">
                   <?php echo $translations['donation_text'] ?? 'Your donation helps us continue our work in the community. Every contribution makes a difference.'; ?>
               </p>
               
               <!-- M-Pesa Donation -->
               <div class="mb-8">
                   <h3 class="text-lg font-semibold text-gray-900 mb-4"><?php echo $translations['mpesa_donation'] ?? 'M-Pesa Donation'; ?></h3>
                   <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                       <p class="text-sm text-gray-700 mb-2"><?php echo $translations['mpesa_instructions'] ?? 'Send your donation via M-Pesa:'; ?></p>
                       <p class="font-mono text-lg font-bold text-green-700">Paybill: 123456</p>
                       <p class="font-mono text-lg font-bold text-green-700">Account: VOICESTREETS</p>
                       <p class="text-sm text-gray-600 mt-2"><?php echo $translations['mpesa_note'] ?? 'Use your phone number as reference'; ?></p>
                   </div>
               </div>
               
               <!-- Online Donation Placeholder -->
               <div class="mb-8">
                   <h3 class="text-lg font-semibold text-gray-900 mb-4"><?php echo $translations['online_donation'] ?? 'Online Donation'; ?></h3>
                   <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                       <p class="text-sm text-gray-700 mb-4"><?php echo $translations['online_donation_text'] ?? 'Secure online donations coming soon. For now, please use M-Pesa or contact us directly.'; ?></p>
                       <button disabled class="w-full bg-gray-300 text-gray-500 py-3 px-6 rounded-md cursor-not-allowed">
                           <?php echo $translations['donate_online'] ?? 'Donate Online (Coming Soon)'; ?>
                       </button>
                   </div>
               </div>
               
               <!-- Partnership Section -->
               <div>
                   <h3 class="text-lg font-semibold text-gray-900 mb-4"><?php echo $translations['partnership'] ?? 'Partnership'; ?></h3>
                   <p class="text-gray-600 mb-4">
                       <?php echo $translations['partnership_text'] ?? 'Interested in partnering with us? We welcome collaborations with organizations that share our vision.'; ?>
                   </p>
                   <a href="contact.php" 
                      class="inline-block bg-red-600 text-white py-3 px-6 rounded-md hover:bg-red-700 transition-colors">
                       <?php echo $translations['contact_us'] ?? 'Contact Us'; ?>
                   </a>
               </div>
           </div>
       </div>
   </main>

   <?php include 'includes/footer.php'; ?>
</body>
</html>
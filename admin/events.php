<?php
session_start();
require_once '../config/database.php';
require_once 'includes/admin_functions.php';

checkAdminAuth();

// Handle form submissions
if ($_POST) {
    $action = $_POST['action'] ?? '';
    
    if ($action == 'add' || $action == 'edit') {
        $id = $_POST['id'] ?? 0;
        $title = sanitizeInput($_POST['title']);
        $description = sanitizeInput($_POST['description']);
        $event_date = $_POST['event_date'];
        $event_time = $_POST['event_time'];
        $location = sanitizeInput($_POST['location']);
        $status = $_POST['status'];
        $registration_required = isset($_POST['registration_required']) ? 1 : 0;
        
        // Handle image upload
        $image_name = '';
        if (isset($_FILES['image']) && $_FILES['image']['tmp_name']) {
            $image_name = handleFileUpload($_FILES['image'], '../assets/uploads/events');
        }
        
        if ($action == 'add') {
            $sql = "INSERT INTO events (title, description, event_date, event_time, location, status, registration_required, image, created_at) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
            $params = [$title, $description, $event_date, $event_time, $location, $status, $registration_required, $image_name];
        } else {
            if ($image_name) {
                $sql = "UPDATE events SET title=?, description=?, event_date=?, event_time=?, location=?, status=?, registration_required=?, image=?, updated_at=NOW() WHERE id=?";
                $params = [$title, $description, $event_date, $event_time, $location, $status, $registration_required, $image_name, $id];
            } else {
                $sql = "UPDATE events SET title=?, description=?, event_date=?, event_time=?, location=?, status=?, registration_required=?, updated_at=NOW() WHERE id=?";
                $params = [$title, $description, $event_date, $event_time, $location, $status, $registration_required, $id];
            }
        }
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        
        header('Location: events.php?success=1');
        exit;
    }
    
    if ($action == 'delete') {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
        $stmt->execute([$id]);
        
        header('Location: events.php?deleted=1');
        exit;
    }
}

// Get events
$stmt = $pdo->query("SELECT * FROM events ORDER BY event_date DESC");
$events = $stmt->fetchAll();

// Get single event for editing
$edit_event = null;
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->execute([$edit_id]);
    $edit_event = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events - Admin</title>
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
    <?php include 'includes/admin_header.php; ?>
    <?php include 'includes/admin_header.php'; ?>

   <div class="flex">
       <?php include 'includes/admin_nav.php'; ?>
       
       <main class="flex-1 p-8">
           <div class="flex justify-between items-center mb-8">
               <h1 class="text-3xl font-bold text-brand-black">Manage Events</h1>
               <button onclick="showAddForm()" class="bg-brand-red text-white px-4 py-2 rounded-lg hover:bg-red-700">
                   Add New Event
               </button>
           </div>

           <!-- Success Messages -->
           <?php if (isset($_GET['success'])): ?>
               <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                   Event saved successfully!
               </div>
           <?php endif; ?>

           <?php if (isset($_GET['deleted'])): ?>
               <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                   Event deleted successfully!
               </div>
           <?php endif; ?>

           <!-- Add/Edit Form -->
           <div id="eventForm" class="bg-white rounded-lg shadow p-6 mb-8 <?php echo $edit_event ? '' : 'hidden'; ?>">
               <h2 class="text-xl font-bold mb-4"><?php echo $edit_event ? 'Edit Event' : 'Add New Event'; ?></h2>
               
               <form method="POST" enctype="multipart/form-data">
                   <input type="hidden" name="action" value="<?php echo $edit_event ? 'edit' : 'add'; ?>">
                   <?php if ($edit_event): ?>
                       <input type="hidden" name="id" value="<?php echo $edit_event['id']; ?>">
                   <?php endif; ?>
                   
                   <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                       <div>
                           <label class="block text-sm font-medium text-gray-700 mb-2">Event Title</label>
                           <input type="text" name="title" required 
                                  value="<?php echo $edit_event ? htmlspecialchars($edit_event['title']) : ''; ?>"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-brand-red focus:border-brand-red">
                       </div>
                       
                       <div>
                           <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                           <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-brand-red focus:border-brand-red">
                               <option value="draft" <?php echo ($edit_event && $edit_event['status'] == 'draft') ? 'selected' : ''; ?>>Draft</option>
                               <option value="published" <?php echo ($edit_event && $edit_event['status'] == 'published') ? 'selected' : ''; ?>>Published</option>
                           </select>
                       </div>
                       
                       <div>
                           <label class="block text-sm font-medium text-gray-700 mb-2">Event Date</label>
                           <input type="date" name="event_date" required 
                                  value="<?php echo $edit_event ? $edit_event['event_date'] : ''; ?>"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-brand-red focus:border-brand-red">
                       </div>
                       
                       <div>
                           <label class="block text-sm font-medium text-gray-700 mb-2">Event Time</label>
                           <input type="time" name="event_time" required 
                                  value="<?php echo $edit_event ? $edit_event['event_time'] : ''; ?>"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-brand-red focus:border-brand-red">
                       </div>
                       
                       <div>
                           <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                           <input type="text" name="location" 
                                  value="<?php echo $edit_event ? htmlspecialchars($edit_event['location']) : ''; ?>"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-brand-red focus:border-brand-red">
                       </div>
                       
                       <div>
                           <label class="block text-sm font-medium text-gray-700 mb-2">Event Image</label>
                           <input type="file" name="image" accept="image/*" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-brand-red focus:border-brand-red">
                           <?php if ($edit_event && $edit_event['image']): ?>
                               <p class="text-sm text-gray-600 mt-1">Current: <?php echo htmlspecialchars($edit_event['image']); ?></p>
                           <?php endif; ?>
                       </div>
                   </div>
                   
                   <div class="mt-6">
                       <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                       <textarea name="description" rows="4" required 
                                 class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-brand-red focus:border-brand-red"><?php echo $edit_event ? htmlspecialchars($edit_event['description']) : ''; ?></textarea>
                   </div>
                   
                   <div class="mt-6">
                       <label class="flex items-center">
                           <input type="checkbox" name="registration_required" value="1" 
                                  <?php echo ($edit_event && $edit_event['registration_required']) ? 'checked' : ''; ?>
                                  class="mr-2">
                           <span class="text-sm text-gray-700">Registration Required</span>
                       </label>
                   </div>
                   
                   <div class="mt-6 flex space-x-4">
                       <button type="submit" class="bg-brand-red text-white px-6 py-2 rounded-lg hover:bg-red-700">
                           <?php echo $edit_event ? 'Update Event' : 'Add Event'; ?>
                       </button>
                       <button type="button" onclick="hideForm()" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                           Cancel
                       </button>
                   </div>
               </form>
           </div>

           <!-- Events List -->
           <div class="bg-white rounded-lg shadow overflow-hidden">
               <table class="min-w-full divide-y divide-gray-200">
                   <thead class="bg-gray-50">
                       <tr>
                           <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                           <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                           <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                           <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                           <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                       </tr>
                   </thead>
                   <tbody class="bg-white divide-y divide-gray-200">
                       <?php foreach ($events as $event): ?>
                           <tr>
                               <td class="px-6 py-4 whitespace-nowrap">
                                   <div>
                                       <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($event['title']); ?></div>
                                       <div class="text-sm text-gray-500"><?php echo truncateText($event['description'], 50); ?></div>
                                   </div>
                               </td>
                               <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                   <?php echo date('M j, Y', strtotime($event['event_date'])); ?><br>
                                   <span class="text-gray-500"><?php echo date('g:i A', strtotime($event['event_time'])); ?></span>
                               </td>
                               <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                   <?php echo htmlspecialchars($event['location']); ?>
                               </td>
                               <td class="px-6 py-4 whitespace-nowrap">
                                   <span class="px-2 py-1 text-xs font-semibold rounded-full <?php echo $event['status'] == 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                                       <?php echo ucfirst($event['status']); ?>
                                   </span>
                               </td>
                               <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                   <a href="events.php?edit=<?php echo $event['id']; ?>" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                   <button onclick="deleteEvent(<?php echo $event['id']; ?>)" class="text-red-600 hover:text-red-900">Delete</button>
                               </td>
                           </tr>
                       <?php endforeach; ?>
                   </tbody>
               </table>
           </div>
       </main>
   </div>

   <script>
       function showAddForm() {
           document.getElementById('eventForm').classList.remove('hidden');
       }
       
       function hideForm() {
           document.getElementById('eventForm').classList.add('hidden');
       }
       
       function deleteEvent(id) {
           if (confirm('Are you sure you want to delete this event?')) {
               const form = document.createElement('form');
               form.method = 'POST';
               form.innerHTML = `
                   <input type="hidden" name="action" value="delete">
                   <input type="hidden" name="id" value="${id}">
               `;
               document.body.appendChild(form);
               form.submit();
           }
       }
   </script>
</body>
</html>
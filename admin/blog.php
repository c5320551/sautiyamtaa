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
        $content = $_POST['content']; // Don't sanitize content as it may contain HTML
        $excerpt = sanitizeInput($_POST['excerpt']);
        $author = sanitizeInput($_POST['author']);
        $category = sanitizeInput($_POST['category']);
        $tags = sanitizeInput($_POST['tags']);
        $status = $_POST['status'];
        $slug = generateSlug($title);
        
        // Handle featured image upload
        $image_name = '';
        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['tmp_name']) {
            $image_name = handleFileUpload($_FILES['featured_image'], '../assets/uploads/blog');
        }
        
        if ($action == 'add') {
            $sql = "INSERT INTO blog_posts (title, slug, content, excerpt, author, category, tags, status, featured_image, created_at) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
            $params = [$title, $slug, $content, $excerpt, $author, $category, $tags, $status, $image_name];
        } else {
            if ($image_name) {
                $sql = "UPDATE blog_posts SET title=?, slug=?, content=?, excerpt=?, author=?, category=?, tags=?, status=?, featured_image=?, updated_at=NOW() WHERE id=?";
                $params = [$title, $slug, $content, $excerpt, $author, $category, $tags, $status, $image_name, $id];
            } else {
                $sql = "UPDATE blog_posts SET title=?, slug=?, content=?, excerpt=?, author=?, category=?, tags=?, status=?, updated_at=NOW() WHERE id=?";
                $params = [$title, $slug, $content, $excerpt, $author, $category, $tags, $status, $id];
            }
        }
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        
        header('Location: blog.php?success=1');
        exit;
    }
    
    if ($action == 'delete') {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM blog_posts WHERE id = ?");
        $stmt->execute([$id]);
        
        header('Location: blog.php?deleted=1');
        exit;
    }
}

// Get blog posts
$stmt = $pdo->query("SELECT * FROM blog_posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll();

// Get single post for editing
$edit_post = null;
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE id = ?");
    $stmt->execute([$edit_id]);
    $edit_post = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Blog - Admin</title>
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
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-brand-black">Manage Blog</h1>
                <button onclick="showAddForm()" class="bg-brand-red text-white px-4 py-2 rounded-lg hover:bg-red-700">
                    Add New Post
                </button>
            </div>

            <!-- Success Messages -->
            <?php if (isset($_GET['success'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    Blog post saved successfully!
                </div>
            <?php endif; ?>

            <!-- Add/Edit Form -->
            <div id="blogForm" class="bg-white rounded-lg shadow p-6 mb-8 <?php echo $edit_post ? '' : 'hidden'; ?>">
                <h2 class="text-xl font-bold mb-4"><?php echo $edit_post ? 'Edit Post' : 'Add New Post'; ?></h2>
                
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="<?php echo $edit_post ? 'edit' : 'add'; ?>">
                    <?php if ($edit_post): ?>
                        <input type="hidden" name="id" value="<?php echo $edit_post['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Post Title</label>
                            <input type="text" name="title" required 
                                   value="<?php echo $edit_post ? htmlspecialchars($edit_post['title']) : ''; ?>"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-brand-red focus:border-brand-red">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Author</label>
                            <input type="text" name="author" required 
                                   value="<?php echo $edit_post ? htmlspecialchars($edit_post['author']) : ''; ?>"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-brand-red focus:border-brand-red">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                            <input type="text" name="category" 
                                   value="<?php echo $edit_post ? htmlspecialchars($edit_post['category']) : ''; ?>"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-brand-red focus:border-brand-red">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tags (comma-separated)</label>
                            <input type="text" name="tags" 
                                   value="<?php echo $edit_post ? htmlspecialchars($edit_post['tags']) : ''; ?>"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-brand-red focus:border-brand-red">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-brand-red focus:border-brand-red">
                                <option value="draft" <?php echo ($edit_post && $edit_post['status'] == 'draft') ? 'selected' : ''; ?>>Draft</option>
                                <option value="published" <?php echo ($edit_post && $edit_post['status'] == 'published') ? 'selected' : ''; ?>>Published</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                            <input type="file" name="featured_image" accept="image/*" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-brand-red focus:border-brand-red">
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
                        <textarea name="excerpt" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-brand-red focus:border-brand-red"><?php echo $edit_post ? htmlspecialchars($edit_post['excerpt']) : ''; ?></textarea>
                    </div>
                    
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                        <textarea name="content" rows="10" required 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-brand-red focus:border-brand-red"><?php echo $edit_post ? htmlspecialchars($edit_post['content']) : ''; ?></textarea>
                    </div>
                    
                    <div class="mt-6 flex space-x-4">
                        <button type="submit" class="bg-brand-red text-white px-6 py-2 rounded-lg hover:bg-red-700">
                            <?php echo $edit_post ? 'Update Post' : 'Add Post'; ?>
                        </button>
                        <button type="button" onclick="hideForm()" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>

            <!-- Posts List -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Post</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($posts as $post): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($post['title']); ?></div>
                                        <div class="text-sm text-gray-500"><?php echo truncateText($post['excerpt'], 50); ?></div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo htmlspecialchars($post['author']); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo htmlspecialchars($post['category']); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full <?php echo $post['status'] == 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                                        <?php echo ucfirst($post['status']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo date('M j, Y', strtotime($post['created_at'])); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="blog.php?edit=<?php echo $post['id']; ?>" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                    <button onclick="deletePost(<?php echo $post['id']; ?>)" class="text-red-600 hover:text-red-900">Delete</button>
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
            document.getElementById('blogForm').classList.remove('hidden');
        }
        
        function hideForm() {
            document.getElementById('blogForm').classList.add('hidden');
        }
        
        function deletePost(id) {
            if (confirm('Are you sure you want to delete this post?')) {
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
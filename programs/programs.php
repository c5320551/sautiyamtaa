<?php
$page_title = 'Our Programs';
$page_description = 'Discover our youth empowerment programs and community initiatives';
include 'includes/header.php';

// Get programs from database (basic implementation)
try {
    $stmt = $db->prepare("SELECT * FROM programs WHERE is_active = 1 ORDER BY sort_order, id DESC");
    $stmt->execute();
    $programs = $stmt->fetchAll();
} catch (Exception $e) {
    $programs = [];
}
?>

<div class="container mx-auto px-4 py-20">
    <div class="text-center mb-12">
        <h1 class="text-5xl font-bold mb-4">Our Programs</h1>
        <p class="text-xl text-gray-700">Discover our youth empowerment initiatives</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if (!empty($programs)): ?>
            <?php foreach ($programs as $program): ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <?php if ($program['image_url']): ?>
                        <img src="<?php echo UPLOADS_URL . '/' . $program['image_url']; ?>" alt="<?php echo htmlspecialchars($program['title_' . $current_language]); ?>" class="w-full h-48 object-cover">
                    <?php else: ?>
                        <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                            <i class="fas fa-image text-gray-500 text-4xl"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($program['title_' . $current_language]); ?></h3>
                        <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($program['short_description_' . $current_language]); ?></p>
                        <a href="<?php echo SITE_URL; ?>/program/<?php echo $program['slug']; ?>" class="text-vots-red hover:text-red-700 font-semibold">
                            Learn More →
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Placeholder content -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                    <i class="fas fa-image text-gray-500 text-4xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Leadership Development</h3>
                    <p class="text-gray-600 mb-4">Developing the next generation of community leaders through mentorship and training programs.</p>
                    <a href="#" class="text-vots-red hover:text-red-700 font-semibold">Learn More →</a>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                    <i class="fas fa-image text-gray-500 text-4xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Skills Training</h3>
                    <p class="text-gray-600 mb-4">Providing practical skills training to enhance
    employability and entrepreneurship opportunities.</p>   
                    <a href="#" class="text-vots-red hover:text-red-700 font-semibold">Learn More →</a>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                    <i class="fas fa-image text-gray-500 text-4xl"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Community Outreach</h3>
                    <p class="text-gray-600 mb-4">Engaging with local communities to address pressing social issues and create positive change.</p>
                    <a href="#" class="text-vots-red hover:text-red-700 font-semibold">Learn More →</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="text-center mt-12">
        <a href="<?php echo SITE_URL; ?>/programs.php" class="bg-vots-red text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
            View All Programs
        </a>
    </div>
</div>
<?php
include 'includes/footer.php';
?>
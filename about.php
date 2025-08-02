<?php
$page_title = 'About Us';
$page_description = 'Learn about Voice of the Streets and our mission to empower youth and build communities in Nairobi';
include 'includes/header.php';
?>

<div class="container mx-auto px-4 py-20">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-5xl font-bold mb-8 text-center">About Voice of the Streets</h1>
        <p class="text-xl text-gray-700 mb-12 text-center">
            Empowering youth and building stronger communities through grassroots initiatives in Nairobi, Kenya.
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-16">
            <div>
                <h2 class="text-3xl font-bold mb-4">Our Story</h2>
                <p class="text-gray-700 mb-4">
                    Voice of the Streets (Sauti ya Mtaa) was founded with a simple yet powerful vision: to create positive change in our communities by empowering young people and fostering community action.
                </p>
                <p class="text-gray-700 mb-4">
                    Born from the streets of Nairobi, our organization understands the challenges faced by youth in urban communities. We believe that every young person has the potential to be a leader and changemaker.
                </p>
                <p class="text-gray-700">
                    Through our programs and initiatives, we provide the tools, support, and opportunities needed for young people to reach their full potential and become agents of positive change in their communities.
                </p>
            </div>
            <div>
                <img src="<?php echo ASSETS_URL; ?>/images/placeholders/about-image.jpg" alt="About Us" class="rounded-lg shadow-md">
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <div class="text-center">
                <div class="bg-vots-red text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-eye text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Our Vision</h3>
                <p class="text-gray-600">
                    A community where every young person has the opportunity to thrive and contribute meaningfully to society.
                </p>
            </div>
            <div class="text-center">
                <div class="bg-vots-red text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-bullseye text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Our Mission</h3>
                <p class="text-gray-600">
                    To empower youth through education, skills development, and community engagement programs.
                </p>
            </div>
            <div class="text-center">
                <div class="bg-vots-red text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-heart text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Our Values</h3>
                <p class="text-gray-600">
                    Integrity, inclusivity, empowerment, community, and sustainable impact guide everything we do.
                </p>
            </div>
        </div>
        
        <div class="bg-gray-50 rounded-lg p-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Join Our Mission</h2>
            <p class="text-gray-700 mb-6">
                Together, we can create lasting change and build stronger communities. Your support makes a difference.
            </p>
            <a href="<?php echo SITE_URL; ?>/get-involved.php" class="bg-vots-red text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                Get Involved
            </a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

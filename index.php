<?php
$page_title = 'Home';
$page_description = 'Voice of the Streets - Empowering youth and building communities in Nairobi, Kenya';
include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-vots-red to-red-600 text-white">
    <div class="container mx-auto px-4 py-20">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">
                Empowering Youth, Building Communities
            </h1>
            <p class="text-xl md:text-2xl mb-8 opacity-90">
                Join us in creating positive change in our communities through youth empowerment and community action.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo SITE_URL; ?>/get-involved.php" class="bg-white text-vots-red px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Get Involved
                </a>
                <a href="<?php echo SITE_URL; ?>/about.php" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-vots-red transition-colors">
                    Learn More
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Mission Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-bold mb-8">Our Mission</h2>
            <p class="text-lg text-gray-700 mb-12">
                Voice of the Streets (Sauti ya Mtaa) is dedicated to empowering young people and building stronger communities through grassroots initiatives, education, and community action in Nairobi, Kenya.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="text-4xl text-vots-red mb-4">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Youth Empowerment</h3>
                    <p class="text-gray-600">Providing skills, opportunities, and support to help young people reach their full potential.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="text-4xl text-vots-red mb-4">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Community Building</h3>
                    <p class="text-gray-600">Bringing people together to create positive change and build stronger neighborhoods.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="text-4xl text-vots-red mb-4">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Sustainable Impact</h3>
                    <p class="text-gray-600">Creating lasting change through sustainable programs and community ownership.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Programs Section -->
<section class="py-20">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4">Our Programs</h2>
            <p class="text-lg text-gray-700">Discover our youth empowerment initiatives</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Program cards will be loaded dynamically from database -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="<?php echo ASSETS_URL; ?>/images/placeholders/program1.jpg" alt="Program" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Leadership Development</h3>
                    <p class="text-gray-600 mb-4">Developing the next generation of community leaders through mentorship and training programs.</p>
                    <a href="<?php echo SITE_URL; ?>/programs.php" class="text-vots-red hover:text-red-700 font-semibold">Learn More →</a>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="<?php echo ASSETS_URL; ?>/images/placeholders/program2.jpg" alt="Program" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Skills Training</h3>
                    <p class="text-gray-600 mb-4">Providing practical skills training to enhance employability and entrepreneurship opportunities.</p>
                    <a href="<?php echo SITE_URL; ?>/programs.php" class="text-vots-red hover:text-red-700 font-semibold">Learn More →</a>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="<?php echo ASSETS_URL; ?>/images/placeholders/program3.jpg" alt="Program" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Community Outreach</h3>
                    <p class="text-gray-600 mb-4">Engaging with local communities to address pressing social issues and create positive change.</p>
                    <a href="<?php echo SITE_URL; ?>/programs.php" class="text-vots-red hover:text-red-700 font-semibold">Learn More →</a>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-12">
            <a href="<?php echo SITE_URL; ?>/programs.php" class="bg-vots-red text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                View All Programs
            </a>
        </div>
    </div>
</section>

<!-- Events Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4">Upcoming Events</h2>
            <p class="text-lg text-gray-700">Join us at our community events</p>
        </div>
        
        <div class="max-w-4xl mx-auto">
            <!-- Event cards will be loaded dynamically from database -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h3 class="text-xl font-semibold mb-2">Youth Leadership Summit</h3>
                        <p class="text-gray-600 mb-2">Annual gathering of young leaders from across Nairobi to discuss community development strategies.</p>
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-calendar mr-2"></i>
                            <span>December 15, 2024</span>
                            <i class="fas fa-map-marker-alt ml-4 mr-2"></i>
                            <span>Nairobi Community Center</span>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="<?php echo SITE_URL; ?>/events.php" class="bg-vots-red text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-12">
            <a href="<?php echo SITE_URL; ?>/events.php" class="bg-vots-red text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                View All Events
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-vots-red text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold mb-6">Ready to Make a Difference?</h2>
        <p class="text-xl mb-8 opacity-90">Join our community of changemakers and help us build a better future.</p>
        <a href="<?php echo SITE_URL; ?>/get-involved.php" class="bg-white text-vots-red px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
            Get Involved Today
        </a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

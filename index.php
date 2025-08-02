<?php
// Include configuration and language handling
require_once 'config/config.php';


$page_title = 'Home';
$page_description = 'Voice of the Streets - Empowering youth and building communities in Nairobi, Kenya';


// Include header
include 'includes/header.php';
?>

<!-- Main Content -->
<main class="pt-16">
    <?php
    // Import sections dynamically
    $sections = [
        'hero',
        'about-preview',
        'programs-preview', 
        'events-preview',
        'testimonials',
        'get-involved',
        'latest-news'
    ];
    
    foreach($sections as $section) {
        $section_file = "includes/sections/{$section}.php";
        if(file_exists($section_file)) {
            include $section_file;
        } else {
            // Fallback for missing sections
            echo "<!-- Section {$section}.php not found -->\n";
        }
    }
    ?>
</main>

<?php
// Include footer
include 'includes/footer.php';
?>
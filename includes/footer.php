
    <!-- Footer -->
    <footer class="bg-vots-black text-white mt-20">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About Column -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Voice of the Streets</h3>
                    <p class="text-gray-300 mb-4">
                        Empowering youth and building stronger communities in Nairobi, Kenya through grassroots initiatives and community action.
                    </p>
                    <div class="flex space-x-4">
                        <a href="<?php echo FACEBOOK_URL; ?>" class="text-gray-300 hover:text-white"><i class="fab fa-facebook"></i></a>
                        <a href="<?php echo TWITTER_URL; ?>" class="text-gray-300 hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="<?php echo INSTAGRAM_URL; ?>" class="text-gray-300 hover:text-white"><i class="fab fa-instagram"></i></a>
                        <a href="<?php echo YOUTUBE_URL; ?>" class="text-gray-300 hover:text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="<?php echo SITE_URL; ?>/about.php" class="text-gray-300 hover:text-white">About Us</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/programs.php" class="text-gray-300 hover:text-white">Programs</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/events.php" class="text-gray-300 hover:text-white">Events</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/blog.php" class="text-gray-300 hover:text-white">Blog</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/gallery.php" class="text-gray-300 hover:text-white">Gallery</a></li>
                    </ul>
                </div>
                
                <!-- Get Involved -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Get Involved</h3>
                    <ul class="space-y-2">
                        <li><a href="<?php echo SITE_URL; ?>/get-involved.php" class="text-gray-300 hover:text-white">Volunteer</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/get-involved.php#donate" class="text-gray-300 hover:text-white">Donate</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/get-involved.php#partner" class="text-gray-300 hover:text-white">Partner with Us</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/contact.php" class="text-gray-300 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Contact Info</h3>
                    <div class="space-y-2 text-gray-300">
                        <p><i class="fas fa-envelope mr-2"></i> <?php echo CONTACT_EMAIL; ?></p>
                        <p><i class="fas fa-phone mr-2"></i> <?php echo CONTACT_PHONE; ?></p>
                        <p><i class="fas fa-map-marker-alt mr-2"></i> <?php echo CONTACT_ADDRESS; ?></p>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
                <p>&copy; 2024 Voice of the Streets (Sauti ya Mtaa). All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="<?php echo ASSETS_URL; ?>/js/main.js"></script>
    <script>
        // Language switcher
        function changeLanguage(lang) {
            const url = new URL(window.location);
            url.searchParams.set('lang', lang);
            window.location = url.toString();
        }
        
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>

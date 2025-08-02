<!-- About Preview Section -->
<section id="about" class="py-10 bg-vots-gray relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-0 right-0 w-64 h-64 bg-vots-red/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-vots-red/10 rounded-full blur-3xl"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="grid lg:grid-cols-2 gap-8 items-center">
            <!-- Content -->
            <div class="space-y-4">
                <div class="space-y-3">
                    <span class="inline-block px-3 py-1 bg-vots-red/20 text-vots-red text-xs font-semibold rounded-full uppercase tracking-wider">
                        About Us
                    </span>
                    <h2 class="text-2xl md:text-3xl font-black text-white leading-tight">
                        Empowering Communities Through 
                        <span class="bg-gradient-to-r from-vots-red to-red-500 bg-clip-text text-transparent">
                            Grassroots Action
                        </span>
                    </h2>
                </div>
                
                <p class="text-gray-300 text-base leading-relaxed">
                    Sauti Ya Mtaa is a community-driven organization dedicated to amplifying the voices of marginalized communities. We believe in the power of grassroots movements to create sustainable change and build stronger, more resilient neighborhoods.
                </p>
                
                <div class="space-y-3">
                    <div class="flex items-start space-x-3 group">
                        <div class="flex-shrink-0 w-8 h-8 bg-vots-red/20 rounded-lg flex items-center justify-center group-hover:bg-vots-red/30 transition-colors duration-300">
                            <i class="fas fa-bullhorn text-vots-red text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-bold text-base mb-1">Community Advocacy</h3>
                            <p class="text-gray-400 text-sm">Amplifying community voices in policy discussions and decision-making processes.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3 group">
                        <div class="flex-shrink-0 w-8 h-8 bg-vots-red/20 rounded-lg flex items-center justify-center group-hover:bg-vots-red/30 transition-colors duration-300">
                            <i class="fas fa-graduation-cap text-vots-red text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-bold text-base mb-1">Education & Training</h3>
                            <p class="text-gray-400 text-sm">Providing skills development and educational programs for community empowerment.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3 group">
                        <div class="flex-shrink-0 w-8 h-8 bg-vots-red/20 rounded-lg flex items-center justify-center group-hover:bg-vots-red/30 transition-colors duration-300">
                            <i class="fas fa-seedling text-vots-red text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-bold text-base mb-1">Sustainable Development</h3>
                            <p class="text-gray-400 text-sm">Implementing long-term solutions for community growth and environmental sustainability.</p>
                        </div>
                    </div>
                </div>
                
                <div class="pt-3">
                    <a href="<?php echo SITE_URL; ?>/about.php" 
                       class="inline-flex items-center space-x-2 bg-gradient-to-r from-vots-red to-vots-dark-red hover:from-vots-dark-red hover:to-red-700 text-white px-4 py-2 rounded-lg font-semibold text-sm transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <span>Learn More About Us</span>
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
            
            <!-- Visual Element -->
            <div class="relative">
                <div class="relative bg-gradient-to-br from-vots-black to-vots-gray rounded-xl p-5 border border-vots-red/20 shadow-2xl">
                    <!-- Mission Statement -->
                    <div class="text-center space-y-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-vots-red to-vots-dark-red rounded-xl flex items-center justify-center mx-auto shadow-lg">
                            <i class="fas fa-heart text-white text-lg"></i>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-black text-white mb-2">Our Mission</h3>
                            <p class="text-gray-300 text-sm leading-relaxed">
                                "To create inclusive spaces where every community member has the opportunity to thrive, contribute, and be heard in shaping their future."
                            </p>
                        </div>
                        
                        <!-- Stats -->
                        <div class="grid grid-cols-2 gap-3 pt-4 border-t border-vots-red/20">
                            <div class="text-center">
                                <div class="text-lg font-black text-vots-red">100%</div>
                                <div class="text-xs text-gray-400">Community-Led</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-black text-vots-red">24/7</div>
                                <div class="text-xs text-gray-400">Support Available</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Floating Elements -->
                <div class="absolute -top-2 -right-2 w-10 h-10 bg-vots-red/20 rounded-xl rotate-12 animate-pulse"></div>
                <div class="absolute -bottom-2 -left-2 w-8 h-8 bg-vots-red/30 rounded-lg -rotate-12 animate-pulse delay-1000"></div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Custom CSS for VOTS colors - add this to your existing stylesheet */
    .bg-vots-gray { background-color: #1a1a1a; }
    .bg-vots-black { background-color: #0a0a0a; }
    .bg-vots-red { background-color: #dc2626; }
    .text-vots-red { color: #dc2626; }
    .bg-vots-dark-red { background-color: #991b1b; }
</style>
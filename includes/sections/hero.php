<section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-vots-black via-gray-900 to-vots-gray">
    <!-- Enhanced Background Elements -->
    <div class="absolute inset-0">
        <!-- Animated Background Shapes -->
        <div class="floating-element absolute top-20 left-10 w-64 h-64 bg-vots-red/10 rounded-full blur-3xl"></div>
        <div class="floating-element absolute bottom-20 right-10 w-96 h-96 bg-vots-red/5 rounded-full blur-3xl"></div>
        <div class="floating-element absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-vots-red/3 rounded-full blur-3xl"></div>
        
        <!-- Enhanced Grid Pattern -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23dc2626" fill-opacity="0.05"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
        
        <!-- Radial Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-radial from-transparent via-vots-black/20 to-vots-black/60"></div>
    </div>

    <!-- Split Layout Container -->
    <div class="relative z-10 container mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-8 items-center min-h-screen">
            
            <!-- Left Side - Content -->
            <div class="text-center lg:text-left space-y-6 relative">
                <!-- Overlay for enhanced contrast -->
                <div class="absolute inset-0 bg-black/70 lg:bg-black/80 rounded-2xl pointer-events-none z-0 -m-6"></div>
                <div class="relative z-10 p-6">     
                    <!-- Main Heading -->
                    <div class="space-y-3">
                        <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-black text-white leading-tight">
                            <span class="block mb-1">Amplifying</span>
                            <span class="text-shimmer block">Community Voices</span>
                        </h1>
                        
                        <!-- Subtitle -->
                        <p class="text-base md:text-lg text-gray-300 leading-relaxed">
                            Empowering grassroots communities through advocacy, education, and sustainable development programs that create lasting change from the ground up.
                        </p>
                    </div>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start">
                        <button class="group bg-gradient-to-r from-vots-red to-vots-dark-red hover:from-vots-dark-red hover:to-red-700 text-white px-6 py-3 rounded-lg font-bold text-base transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-vots-red/25 flex items-center justify-center space-x-2 pulse-glow">
                            <i class="fas fa-hands-helping group-hover:animate-bounce"></i>
                            <span>Get Involved</span>
                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform text-sm"></i>
                        </button>
                        
                        <button class="group border-2 border-vots-red text-vots-red hover:bg-vots-red hover:text-white px-6 py-3 rounded-lg font-bold text-base transition-all duration-300 transform hover:scale-105 flex items-center justify-center space-x-2">
                            <i class="fas fa-bullhorn group-hover:animate-pulse"></i>
                            <span>Our Programs</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Enhanced 3D Carousel -->
            <div class="carousel-container relative h-80 lg:h-[420px]">
                <!-- Carousel Track -->
                <div class="carousel-track relative w-full h-full">
                    <!-- Slides -->
                    <div class="carousel-slide absolute inset-0 active">
                        <div class="relative w-full h-full rounded-xl overflow-hidden shadow-xl group">
                            <img src="<?php echo SITE_URL; ?>/assets/images/hero/10-frame-assembled-hive-kits-no-bees-821599 (1).webp" 
                                alt="Community Gathering" 
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">   
                             <div class="absolute inset-0 bg-gradient-to-t from-vots-black/80 via-transparent to-transparent"></div>
                            <div class="absolute bottom-4 left-4 right-4">
                                <h3 class="text-white text-lg font-bold mb-1">Community Gatherings</h3>
                                <p class="text-gray-300 text-sm">Building stronger connections through local events</p>
                            </div>
                            <div class="absolute top-3 right-3 bg-vots-red/90 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                Featured
                            </div>
                        </div>
                    </div>
                    
                    <div class="carousel-slide absolute inset-0 next">
                        <div class="relative w-full h-full rounded-xl overflow-hidden shadow-xl group">
                            <img src="<?php echo SITE_URL; ?>/assets/images/hero/2001809_thumbnail_1080x810.jpg" 
                                alt="Community Gathering" 
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">  
                            <div class="absolute inset-0 bg-gradient-to-t from-vots-black/80 via-transparent to-transparent"></div>
                            <div class="absolute bottom-4 left-4 right-4">
                                <h3 class="text-white text-lg font-bold mb-1">Educational Programs</h3>
                                <p class="text-gray-300 text-sm">Empowering through knowledge and skills development</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="carousel-slide absolute inset-0 hidden">
                        <div class="relative w-full h-full rounded-xl overflow-hidden shadow-xl group">
                           <img src="<?php echo SITE_URL; ?>/assets/images/hero/2001815_bee-hive-1_1080x1440.jpg" 
                                alt="Community Gathering" 
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">  
                            <div class="absolute inset-0 bg-gradient-to-t from-vots-black/80 via-transparent to-transparent"></div>
                            <div class="absolute bottom-4 left-4 right-4">
                                <h3 class="text-white text-lg font-bold mb-1">Sustainable Development</h3>
                                <p class="text-gray-300 text-sm">Creating lasting environmental and social impact</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="carousel-slide absolute inset-0 hidden">
                        <div class="relative w-full h-full rounded-xl overflow-hidden shadow-xl group">
                             <img src="<?php echo SITE_URL; ?>/assets/images/hero/children-200066_1280.jpg" 
                                alt="Community Gathering" 
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">  
                            <div class="absolute inset-0 bg-gradient-to-t from-vots-black/80 via-transparent to-transparent"></div>
                            <div class="absolute bottom-4 left-4 right-4">
                                <h3 class="text-white text-lg font-bold mb-1">Advocacy & Voice</h3>
                                <p class="text-gray-300 text-sm">Amplifying community voices for positive change</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="carousel-slide absolute inset-0 hidden">
                        <div class="relative w-full h-full rounded-xl overflow-hidden shadow-xl group">
                          <img src="<?php echo SITE_URL; ?>/assets/images/hero/D1UAu6jW0AA0i0G.jfif" 
                                alt="Community Gathering" 
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">  
                            <div class="absolute inset-0 bg-gradient-to-t from-vots-black/80 via-transparent to-transparent"></div>
                            <div class="absolute bottom-4 left-4 right-4">
                                <h3 class="text-white text-lg font-bold mb-1">Youth Development</h3>
                                <p class="text-gray-300 text-sm">Investing in the next generation of leaders</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Carousel Controls -->
                <button id="prevBtn" class="absolute left-3 top-1/2 transform -translate-y-1/2 z-20 bg-vots-red/80 hover:bg-vots-red text-white p-2 rounded-full transition-all duration-300 hover:scale-110 shadow-lg">
                    <i class="fas fa-chevron-left text-sm"></i>
                </button>
                
                <button id="nextBtn" class="absolute right-3 top-1/2 transform -translate-y-1/2 z-20 bg-vots-red/80 hover:bg-vots-red text-white p-2 rounded-full transition-all duration-300 hover:scale-110 shadow-lg">
                    <i class="fas fa-chevron-right text-sm"></i>
                </button>
                
                <!-- Carousel Indicators -->
                <div class="absolute bottom-3 left-1/2 transform -translate-x-1/2 z-20 flex space-x-2">
                    <button class="carousel-indicator w-2 h-2 bg-vots-red rounded-full transition-all duration-300 active" data-slide="0"></button>
                    <button class="carousel-indicator w-2 h-2 bg-white/40 rounded-full transition-all duration-300" data-slide="1"></button>
                    <button class="carousel-indicator w-2 h-2 bg-white/40 rounded-full transition-all duration-300" data-slide="2"></button>
                    <button class="carousel-indicator w-2 h-2 bg-white/40 rounded-full transition-all duration-300" data-slide="3"></button>
                    <button class="carousel-indicator w-2 h-2 bg-white/40 rounded-full transition-all duration-300" data-slide="4"></button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce z-20">
        <div class="w-6 h-10 border-2 border-vots-red rounded-full flex justify-center cursor-pointer hover:border-red-400 transition-colors">
            <div class="w-1 h-3 bg-vots-red rounded-full mt-2 animate-pulse"></div>
        </div>
    </div>
</section>

<style>
    .carousel-container {
        perspective: 1000px;
    }
    
    .carousel-track {
        transform-style: preserve-3d;
        transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .carousel-slide {
        backface-visibility: hidden;
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .carousel-slide.active {
        transform: translateZ(0) scale(1);
        opacity: 1;
        z-index: 10;
    }
    
    .carousel-slide.prev {
        transform: translateX(-100%) rotateY(45deg) scale(0.8);
        opacity: 0.6;
        z-index: 5;
    }
    
    .carousel-slide.next {
        transform: translateX(100%) rotateY(-45deg) scale(0.8);
        opacity: 0.6;
        z-index: 5;
    }
    
    .carousel-slide.hidden {
        transform: translateX(0) scale(0.5);
        opacity: 0;
        z-index: 1;
    }
    
    .floating-element {
        animation: float 6s ease-in-out infinite;
    }
    
    .floating-element:nth-child(2) {
        animation-delay: -2s;
    }
    
    .floating-element:nth-child(3) {
        animation-delay: -4s;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        33% { transform: translateY(-20px) rotate(1deg); }
        66% { transform: translateY(-10px) rotate(-1deg); }
    }
    
    .pulse-glow {
        animation: pulseGlow 3s ease-in-out infinite;
    }
    
    @keyframes pulseGlow {
        0%, 100% { box-shadow: 0 0 20px rgba(220, 38, 38, 0.3); }
        50% { box-shadow: 0 0 40px rgba(220, 38, 38, 0.6); }
    }
    
    .text-shimmer {
        background: linear-gradient(90deg, #dc2626, #ef4444, #dc2626);
        background-size: 200% 100%;
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: shimmer 3s ease-in-out infinite;
    }
    
    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
</style>

<script>
    // Carousel Functionality
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-slide');
    const indicators = document.querySelectorAll('.carousel-indicator');
    const totalSlides = slides.length;
    
    function updateSlideClasses() {
        slides.forEach((slide, index) => {
            slide.classList.remove('active', 'prev', 'next', 'hidden');
            
            if (index === currentSlide) {
                slide.classList.add('active');
            } else if (index === (currentSlide - 1 + totalSlides) % totalSlides) {
                slide.classList.add('prev');
            } else if (index === (currentSlide + 1) % totalSlides) {
                slide.classList.add('next');
            } else {
                slide.classList.add('hidden');
            }
        });
        
        // Update indicators
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === currentSlide);
            indicator.style.backgroundColor = index === currentSlide ? '#dc2626' : 'rgba(255, 255, 255, 0.4)';
        });
    }
    
    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateSlideClasses();
    }
    
    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateSlideClasses();
    }
    
    function goToSlide(slideIndex) {
        currentSlide = slideIndex;
        updateSlideClasses();
    }
    
    // Event listeners
    document.getElementById('nextBtn').addEventListener('click', nextSlide);
    document.getElementById('prevBtn').addEventListener('click', prevSlide);
    
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => goToSlide(index));
    });
    
    // Auto-play carousel
    let autoplayInterval = setInterval(nextSlide, 5000);
    
    // Pause auto-play on hover
    const carouselContainer = document.querySelector('.carousel-container');
    carouselContainer.addEventListener('mouseenter', () => {
        clearInterval(autoplayInterval);
    });
    
    carouselContainer.addEventListener('mouseleave', () => {
        autoplayInterval = setInterval(nextSlide, 5000);
    });
    
    // Initialize carousel
    updateSlideClasses();
</script>
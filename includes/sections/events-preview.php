<?php
// Fetch events from database
try {
    $db = new Database();
    $pdo = $db->getConnection();
    
    // Get featured event
    $featuredStmt = $pdo->prepare("
        SELECT * FROM events 
        WHERE is_featured = 1 AND event_date >= CURDATE() AND status = 'upcoming'
        ORDER BY event_date ASC 
        LIMIT 1
    ");
    $featuredStmt->execute();
    $featuredEvent = $featuredStmt->fetch();
    
    // Get upcoming events (non-featured)
    $eventsStmt = $pdo->prepare("
        SELECT * FROM events 
        WHERE is_featured = 0 AND event_date >= CURDATE() AND status = 'upcoming'
        ORDER BY event_date ASC 
        LIMIT 4
    ");
    $eventsStmt->execute();
    $upcomingEvents = $eventsStmt->fetchAll();
    
} catch (Exception $e) {
    error_log("Error fetching events: " . $e->getMessage());
    $featuredEvent = null;
    $upcomingEvents = [];
}

// Helper function to format date
function formatEventDate($date) {
    return date('M j', strtotime($date));
}

// Helper function to format time
function formatEventTime($startTime, $endTime) {
    $start = date('g:i A', strtotime($startTime));
    $end = date('g:i A', strtotime($endTime));
    return $start . ' - ' . $end;
}
?>

<!-- Events Preview Section -->
<section id="events" class="py-16 bg-vots-gray relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-0 left-1/4 w-80 h-80 bg-vots-red/5 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-64 h-64 bg-vots-red/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16 space-y-4">
            <span class="inline-block px-4 py-2 bg-vots-red/20 text-vots-red text-sm font-semibold rounded-full uppercase tracking-wider">
                Upcoming Events
            </span>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-white leading-tight">
                Join Us in Making 
                <span class="bg-gradient-to-r from-vots-red to-red-500 bg-clip-text text-transparent">
                    Change Happen
                </span>
            </h2>
            <p class="text-gray-300 text-lg max-w-2xl mx-auto">
                Connect with your community through our engaging events, workshops, and advocacy initiatives.
            </p>
        </div>
        
        <!-- Events Grid -->
        <div class="grid lg:grid-cols-2 gap-8 mb-12">
            <?php if ($featuredEvent): ?>
            <!-- Featured Event -->
            <div class="lg:col-span-2 bg-gradient-to-r from-vots-black to-vots-gray rounded-2xl border border-vots-red/20 overflow-hidden group hover:border-vots-red/40 transition-all duration-500 shadow-2xl hover:shadow-vots-red/10">
                <div class="p-8">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="flex-1 space-y-4">
                            <div class="flex items-center space-x-4">
                                <span class="px-3 py-1 bg-vots-red text-white text-xs font-bold rounded-full uppercase tracking-wider">
                                    Featured Event
                                </span>
                                <span class="text-gray-400 text-sm">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    <?php echo date('F j, Y', strtotime($featuredEvent['event_date'])); ?>
                                </span>
                            </div>
                            
                            <h3 class="text-2xl md:text-3xl font-black text-white group-hover:text-vots-red transition-colors duration-300">
                                <?php echo htmlspecialchars($featuredEvent['title']); ?>
                            </h3>
                            
                            <p class="text-gray-300 leading-relaxed">
                                <?php echo htmlspecialchars($featuredEvent['description']); ?>
                            </p>
                            
                            <div class="flex flex-wrap gap-4 text-sm">
                                <div class="flex items-center text-gray-400">
                                    <i class="fas fa-clock mr-2 text-vots-red"></i>
                                    <?php echo formatEventTime($featuredEvent['start_time'], $featuredEvent['end_time']); ?>
                                </div>
                                <div class="flex items-center text-gray-400">
                                    <i class="fas fa-map-marker-alt mr-2 text-vots-red"></i>
                                    <?php echo htmlspecialchars($featuredEvent['location']); ?>
                                </div>
                                <?php if ($featuredEvent['expected_attendees'] > 0): ?>
                                <div class="flex items-center text-gray-400">
                                    <i class="fas fa-users mr-2 text-vots-red"></i>
                                    <?php echo $featuredEvent['expected_attendees']; ?>+ Expected Attendees
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="pt-4">
                                <button class="bg-gradient-to-r from-vots-red to-vots-dark-red hover:from-vots-dark-red hover:to-red-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                    Register Now
                                </button>
                            </div>
                        </div>
                        
                        <div class="md:w-64 flex-shrink-0">
                            <div class="bg-vots-black/50 rounded-xl p-6 border border-vots-red/20 h-full flex flex-col justify-center items-center text-center">
                                <div class="w-16 h-16 bg-gradient-to-br from-vots-red to-vots-dark-red rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                                    <i class="<?php echo htmlspecialchars($featuredEvent['icon_class']); ?> text-white text-2xl"></i>
                                </div>
                                <h4 class="text-white font-bold mb-2">Your Voice Matters</h4>
                                <p class="text-gray-400 text-sm">Come share your experiences and help shape our community's future.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Upcoming Events -->
            <?php if (!empty($upcomingEvents)): ?>
                <?php foreach ($upcomingEvents as $event): ?>
                <div class="bg-vots-black/50 backdrop-blur-sm border border-vots-red/20 rounded-2xl p-6 group hover:border-vots-red/40 transition-all duration-500 transform hover:scale-105 hover:shadow-2xl hover:shadow-vots-red/10">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="w-12 h-12 bg-gradient-to-br from-vots-red to-vots-dark-red rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <i class="<?php echo htmlspecialchars($event['icon_class']); ?> text-white"></i>
                            </div>
                            <span class="text-gray-400 text-sm">
                                <i class="far fa-calendar-alt mr-1"></i>
                                <?php echo formatEventDate($event['event_date']); ?>
                            </span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-white group-hover:text-vots-red transition-colors duration-300">
                            <?php echo htmlspecialchars($event['title']); ?>
                        </h3>
                        
                        <p class="text-gray-400 text-sm leading-relaxed">
                            <?php echo htmlspecialchars(substr($event['description'], 0, 120) . (strlen($event['description']) > 120 ? '...' : '')); ?>
                        </p>
                        
                        <div class="space-y-2 text-xs text-gray-500">
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-2 text-vots-red w-4"></i>
                                <?php echo formatEventTime($event['start_time'], $event['end_time']); ?>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-2 text-vots-red w-4"></i>
                                <?php echo htmlspecialchars($event['location']); ?>
                            </div>
                        </div>
                        
                        <div class="pt-4 border-t border-vots-red/10">
                            <button class="w-full bg-vots-red/10 hover:bg-vots-red hover:text-white text-vots-red px-4 py-2 rounded-lg font-semibold transition-all duration-300 text-sm">
                                Learn More
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <?php if (!$featuredEvent): ?>
                <!-- No events fallback -->
                <div class="lg:col-span-2 text-center py-12">
                    <div class="w-16 h-16 bg-vots-red/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calendar-alt text-vots-red text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">No Upcoming Events</h3>
                    <p class="text-gray-400">Check back soon for new community events and activities.</p>
                </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        
        <!-- CTA Section -->
        <div class="text-center">
            <a href="<?php echo SITE_URL; ?>/events.php" 
               class="inline-flex items-center space-x-2 bg-gradient-to-r from-vots-red to-vots-dark-red hover:from-vots-dark-red hover:to-red-700 text-white px-8 py-4 rounded-xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-vots-red/25">
                <span>View All Events</span>
                <i class="fas fa-calendar-alt"></i>
            </a>
        </div>
    </div>
</section>
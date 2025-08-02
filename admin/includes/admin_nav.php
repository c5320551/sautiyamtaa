<nav class="bg-white w-64 shadow-sm h-screen">
    <div class="p-4">
        <ul class="space-y-2">
            <li>
                <a href="index.php" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'bg-brand-red text-white' : ''; ?>">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-9 9a1 1 0 001.414 1.414L2 12.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-4.586l.293.293a1 1 0 001.414-1.414l-9-9z"></path>
                    </svg>
                    Dashboard
                </a>
            </li>
            
            <li>
                <a href="programs.php" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 <?php echo basename($_SERVER['PHP_SELF']) == 'programs.php' ? 'bg-brand-red text-white' : ''; ?>">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Programs
                </a>
            </li>
            
            <li>
                <a href="events.php" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 <?php echo basename($_SERVER['PHP_SELF']) == 'events.php' ? 'bg-brand-red text-white' : ''; ?>">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                    Events
                </a>
            </li>
            
            <li>
                <a href="blog.php" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 <?php echo basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'bg-brand-red text-white' : ''; ?>">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"></path>
                    </svg>
                    Blog
                </a>
            </li>
            
            <li>
                <a href="gallery.php" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 <?php echo basename($_SERVER['PHP_SELF']) == 'gallery.php' ? 'bg-brand-red text-white' : ''; ?>">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                    </svg>
                    Gallery
                </a>
            </li>
            
            <li>
                <a href="volunteers.php" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 <?php echo basename($_SERVER['PHP_SELF']) == 'volunteers.php' ? 'bg-brand-red text-white' : ''; ?>">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                    Volunteers
                </a>
            </li>
            
            <li>
                <a href="messages.php" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 <?php echo basename($_SERVER['PHP_SELF']) == 'messages.php' ? 'bg-brand-red text-white' : ''; ?>">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                    </svg>
                    Messages
                </a>
            </li>
        </ul>
    </div>
</nav>
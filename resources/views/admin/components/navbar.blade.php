<nav class="bg-gray-900 text-gray-200 p-4 flex justify-between items-center">
    <div class="flex items-center space-x-4">
        <!-- Logo -->
        <div class="text-xl font-bold">Acme Inc.</div>
        <!-- Navigation Items -->
        <ul class="hidden md:flex space-x-4">
            <li><a href="#" class="hover:text-gray-400">Dashboard</a></li>
            <li><a href="#" class="hover:text-gray-400">E-Commerce</a></li>
            <li><a href="#" class="hover:text-gray-400">Community</a></li>
            <li><a href="#" class="hover:text-gray-400">Finance</a></li>
            <li><a href="#" class="hover:text-gray-400">Job Board</a></li>
        </ul>
    </div>

    <div class="flex items-center space-x-4">
        <!-- Notification Icon -->
        <div class="relative">
            <button class="focus:outline-none">
                <span class="material-icons">notifications</span>
                <span class="absolute top-0 right-0 block h-2 w-2 bg-red-600 rounded-full"></span>
            </button>
        </div>
        <!-- Dark Mode Toggle -->
        <button id="theme-toggle" class="p-2 rounded-full focus:outline-none">
            <span id="theme-icon" class="material-icons">brightness_6</span>
        </button>
        <!-- User Profile Dropdown -->
        <div class="relative">
            <button class="flex items-center focus:outline-none">
                <span class="material-icons">account_circle</span>
                <span class="ml-2">Acme Inc.</span>
            </button>
            <!-- Dropdown menu can be added here if needed -->
        </div>
    </div>
</nav>

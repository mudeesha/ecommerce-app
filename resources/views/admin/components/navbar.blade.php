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


        

        <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName" class="flex items-center text-sm pe-1 font-medium text-gray-900 rounded-full hover:text-blue-600 dark:hover:text-blue-500 md:me-0 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white" type="button">
            <span class="sr-only">Open user menu</span>
            <img class="w-8 h-8 me-2 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="user photo">
            Bonnie Green
            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
        </button>
        <!-- Dropdown menu -->
        <div id="dropdownAvatarName" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
            <div class="font-medium ">Pro User</div>
            <div class="truncate">name@flowbite.com</div>
        </div>
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">
            <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
            </li>
            <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
            </li>
        </ul>
        <form method="POST" action="{{ route('logout') }}" class="block px-4 py-2">
                @csrf
            <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" href="{{ __('Log Out') }}">Sign out</button>
        </form>
        </div>






            
        </div>
    </div>
</nav>

<link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" /><script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
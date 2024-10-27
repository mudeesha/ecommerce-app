<div id="sidebar" class="bg-gray-800 text-gray-200 w-64 h-screen">
    <div class="p-4 border-b border-gray-700">
        <h2 class="text-xl font-semibold">Admin Dashboard</h2>
    </div>

    <!-- Navigation Links -->
    <nav class="mt-6">
        <ul>
            <!-- Dashboard -->
            <li class="mb-2">
                <a href="{{url('admin/dashboard')}}" class="flex items-center p-3 hover:bg-gray-700 rounded-lg">
                    <span class="material-icons mr-3">dashboard</span>
                    <span>Main Dashboard</span>
                </a>
            </li>

            <!-- E-Commerce Dropdown -->
            <li class="mb-2">
                <button class="flex items-center justify-between w-full p-3 hover:bg-gray-700 rounded-lg"
                    onclick="toggleDropdown('ecommerce-dropdown')">
                    <span class="flex items-center">
                        <span class="material-icons mr-3">shopping_cart</span>
                        <span>E-Commerce</span>
                    </span>
                    <span class="material-icons">expand_more</span>
                </button>
                <ul id="ecommerce-dropdown" class="pl-8 mt-1 hidden">
                    <li><a href="{{url('admin/category/view')}}" class="block p-2 hover:bg-gray-700 rounded-lg">Category</a></li>
                    <li><a href="#" class="block p-2 hover:bg-gray-700 rounded-lg">Orders</a></li>
                    <li><a href="#" class="block p-2 hover:bg-gray-700 rounded-lg">Products</a></li>
                    <li><a href="#" class="block p-2 hover:bg-gray-700 rounded-lg">Customers</a></li>
                </ul>
            </li>

            <!-- Community Dropdown -->
            <li class="mb-2">
                <button class="flex items-center justify-between w-full p-3 hover:bg-gray-700 rounded-lg"
                    onclick="toggleDropdown('community-dropdown')">
                    <span class="flex items-center">
                        <span class="material-icons mr-3">people</span>
                        <span>Community</span>
                    </span>
                    <span class="material-icons">expand_more</span>
                </button>
                <ul id="community-dropdown" class="pl-8 mt-1 hidden">
                    <li><a href="#" class="block p-2 hover:bg-gray-700 rounded-lg">Forums</a></li>
                    <li><a href="#" class="block p-2 hover:bg-gray-700 rounded-lg">Groups</a></li>
                </ul>
            </li>

            <!-- Finance Dropdown -->
            <li class="mb-2">
                <button class="flex items-center justify-between w-full p-3 hover:bg-gray-700 rounded-lg"
                    onclick="toggleDropdown('finance-dropdown')">
                    <span class="flex items-center">
                        <span class="material-icons mr-3">account_balance_wallet</span>
                        <span>Finance</span>
                    </span>
                    <span class="material-icons">expand_more</span>
                </button>
                <ul id="finance-dropdown" class="pl-8 mt-1 hidden">
                    <li><a href="#" class="block p-2 hover:bg-gray-700 rounded-lg">Invoices</a></li>
                    <li><a href="#" class="block p-2 hover:bg-gray-700 rounded-lg">Expenses</a></li>
                </ul>
            </li>

            <!-- Tasks -->
            <li class="mb-2">
                <a href="#" class="flex items-center p-3 hover:bg-gray-700 rounded-lg">
                    <span class="material-icons mr-3">task</span>
                    <span>Tasks</span>
                </a>
            </li>

            <!-- Messages -->
            <li class="mb-2">
                <a href="#" class="flex items-center p-3 hover:bg-gray-700 rounded-lg">
                    <span class="material-icons mr-3">message</span>
                    <span>Messages</span>
                    <span class="ml-auto bg-blue-600 text-white px-2 py-1 text-sm rounded-full">4</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

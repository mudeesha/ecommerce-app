<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Admin Dashboard</title>

    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-gray-900 text-gray-200 dark:bg-gray-900 dark:text-gray-200">

    <div class="flex h-screen">
        <!-- Sidebar Component -->
        <div class="w-64">
            @include('admin.components.sidebar')
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar Component -->
            @include('admin.components.navbar')

            <!-- Main Dashboard Content -->
            <div class="flex-1 p-6 overflow-y-auto">
                <!-- Dashboard Header Component -->
                <div>
                    @include('admin.components.dashboard-header')
                </div>

                <!-- Top Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    <!-- Include Card Components -->
                    @include('admin.components.card1')
                    @include('admin.components.card2')
                    @include('admin.components.card3')
                </div>

                <!-- Table -->
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-6">
                    @include('admin.components.table1')
                </div>

                <!-- Bottom Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>@include('admin.components.direct-vs-indirect-card')</div>
                    <div>@include('admin.components.real-time-value-card')</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <!-- Chart.js for charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Theme toggle script -->
    <script src="{{ asset('js/theme.js') }}"></script>
</body>
</html>

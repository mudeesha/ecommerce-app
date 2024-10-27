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
                    <div class="bg-gray-800 p-4 rounded-lg shadow">

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="categoryTable">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Category ID
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Category Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Table content --}}
                                </tbody>
                            </table>
                            <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
                                <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing <span class="font-semibold text-gray-900 dark:text-white">1-10</span> of <span class="font-semibold text-gray-900 dark:text-white">1000</span></span>
                                <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                                    <li>
                                        <a href="#" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                                    </li>
                                    <li>
                                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Chart.js for charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Theme toggle script -->
    <script src="{{ asset('js/theme.js') }}"></script>

</body>
</html>

<script type="text/javascript">
    // Fetch data function with pagination
    function fetchCategories(searchKeyword = '', page = 1) {
        $.ajax({
            url: '/admin/category',
            type: 'GET',
            data: {
                search: searchKeyword,
                page: page
            },
            success: function(data) {
                let tableBody = $('#categoryTable tbody');
                tableBody.empty();

                // Loop through the data and generate table rows
                data.data.forEach(function(category) {
                    let row = `


                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                ${category.id}
                            </th>
                            <td class="px-6 py-4">
                                ${category.category_name}
                            </td>
                            <td class="px-6 py-4">
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                            </td>
                        </tr>
                    `;
                    tableBody.append(row);
                });

                // Generate pagination links
                generatePagination(data);
            },
            error: function(err) {
                console.error('Error fetching categories:', err);
            }
        });
    }

    // Function to generate pagination buttons
    function generatePagination(data) {
        let pagination = $('#pagination');
        pagination.empty(); // Clear the existing pagination

        let currentPage = data.current_page;
        let lastPage = data.last_page;

        // Previous button
        if (currentPage > 1) {
            pagination.append(`<li class="page-item"><a class="page-link" href="#" onclick="fetchCategories('', ${currentPage - 1})">Previous</a></li>`);
        }

        // Page numbers
        for (let i = 1; i <= lastPage; i++) {
            let activeClass = (i === currentPage) ? 'active' : '';
            pagination.append(`<li class="page-item ${activeClass}"><a class="page-link" href="#" onclick="fetchCategories('', ${i})">${i}</a></li>`);
        }

        // Next button
        if (currentPage < lastPage) {
            pagination.append(`<li class="page-item"><a class="page-link" href="#" onclick="fetchCategories('', ${currentPage + 1})">Next</a></li>`);
        }
    }


    $(document).ready(function() {
        // Fetch data when the page loads
        fetchCategories();


        // Event listener for search input
        $('#search-category').on('keyup', function() {
            let searchKeyword = $(this).val();
            fetchCategories(searchKeyword); // Fetch categories based on the search keyword
        });


        // add category
        $('#save-add-category-btn').on('click', function() {
            let categoryName = $('#add-category_name').val();

            // Send AJAX request to add the category
            $.ajax({
                url: '/admin/category',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Include CSRF token
                    category_name: categoryName
                },
                success: function(response) {
                    // Show success message
                    swal("Category added successfully!", {
                        icon: "success",
                    }).then(() => {
                        $('#add-category_name').val('');
                        $('#categoryAddModal .close').trigger('click');

                        fetchCategories();
                    });
                },
                error: function(err) {
                    console.error('Error adding category:', err);

                    // Show error message
                    swal("Error", "There was an issue adding the category.", "error");
                }
            });
        });

        // Edit data
        $(document).on('click', '.edit-category-btn', function() {
            let categoryId = $(this).data('id');

            // Fetch category data using AJAX
            $.ajax({
                url: '/admin/category/' + categoryId,
                type: 'GET',
                success: function(data) {
                    // Populate modal form fields with category data
                    $('#category_name').val(data.category_name);
                    $('#category_id').val(data.id);

                    // Show the modal
                    $('#categoryEditModal').modal('show');
                },
                error: function(err) {
                    console.error(err);
                }
            });
        });

        // Save edited data
        $('#save-category-btn').on('click', function() {
            let categoryId = $('#category_id').val();
            let categoryName = $('#category_name').val();

            // Send AJAX request to update the category
            $.ajax({
                url: '/admin/category/' + categoryId,
                type: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    category_name: categoryName
                },
                success: function(response) {
                    // Hide the modal after saving
                    $('#categoryEditModal').trigger('click');

                    // Reload the category data
                    fetchCategories();
                },
                error: function(err) {
                    console.error(err);
                }
            });
        });

        //delete function
        function deleteCategory(categoryId) {
            // Perform AJAX request to delete the category
            $.ajax({
                url: '/admin/category/' + categoryId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    // Show success message
                    swal("Category deleted successfully!", {
                        icon: "success",
                    });
                    fetchCategories();
                },
                error: function(err) {
                    console.error("Error deleting category:", err);
                    swal("Error", "There was an issue deleting the category.", "error");
                }
            });
        }

        // Confirmation for deletion
        window.confirmation = function(ev) {
            ev.preventDefault();
            var categoryId = ev.currentTarget.getAttribute('data-id');

            // SweetAlert confirmation
            swal({
                title: "Are you sure you want to delete this?",
                text: "Once deleted, this category cannot be recovered.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    deleteCategory(categoryId);
                }
            });
        };
    });
</script>

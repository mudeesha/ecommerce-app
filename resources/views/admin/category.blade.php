<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Admin Dashboard</title>

    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
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
                    {{-- <div class="bg-gray-800 p-4 rounded-lg shadow"> --}}

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            {{-- search bar --}}
                            <div class="pb-4 bg-white dark:bg-gray-900 flex items-center justify-between">
                                <label for="table-search" class="sr-only">Search</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                                </div>

                                <!-- Add button -->
                                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                    Add a Category
                                </button>
                            </div>
                            {{-- table --}}
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

                    {{-- </div> --}}
                </div>







  <!-- Main modal -->
  <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                      Create New Product
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <form class="p-4 md:p-5">
                  <div class="grid gap-4 mb-4 grid-cols-2">
                      <div class="col-span-2">
                          <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                          <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                      </div>
                      <div class="col-span-2 sm:col-span-1">
                          <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                          <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                      </div>
                      <div class="col-span-2 sm:col-span-1">
                          <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                          <select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                              <option selected="">Select category</option>
                              <option value="TV">TV/Monitors</option>
                              <option value="PC">PC</option>
                              <option value="GA">Gaming/Console</option>
                              <option value="PH">Phones</option>
                          </select>
                      </div>
                      <div class="col-span-2">
                          <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Description</label>
                          <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product description here"></textarea>
                      </div>
                  </div>
                  <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                      <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                      Add new product
                  </button>
              </form>
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
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

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

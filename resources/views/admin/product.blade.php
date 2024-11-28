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

    <!-- Add Toastify CSS and JS via CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>


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
                @include('admin.components.success-toster')
                @include('admin.components.error-toster')

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
                                    <input type="text" id="search-category" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items"> product
                                </div>

                                <!-- Add button -->
                                <button data-modal-target="product-add-modal" data-modal-toggle="product-add-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" onclick="loadCategories()">
                                    Add a Category
                                </button>
                            </div>
                            {{-- table --}}
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="categoryTable">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            ID
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Description
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Category
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Price
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Discount Price
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Quantity
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Is Active
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Image
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Rating
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Review
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Meta Title
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Meta Description
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
                                <ul id="pagination" class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">

                                </ul>
                            </nav>

                        </div>

                    {{-- </div> --}}
                </div>

                <!-- Add Product Modal -->
                <div id="product-add-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white product-modal-des">
                                    Add a Product
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white close-btn" data-modal-toggle="product-add-modal" onclick="$('#add-product-form').find('input, textarea').each(function() { $(this).css('border', ''); $(this).next('span').addClass('hidden').text(''); });">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <form id="add-product-form" class="p-4 md:p-5 add-product-form" enctype="multipart/form-data" novalidate>
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <!-- Product Name -->
                                    <div class="col-span-2">
                                        <label for="product_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
                                        <input type="text" validate_type="" limit="255" is_required="true" name="name" id="product_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                                        <span class="hidden mt-2 text-sm text-red-600 dark:text-red-500">//append here</span>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-span-2">
                                        <label for="product_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                        <textarea name="description" id="product_description" validate_type="" limit="255" is_required="true" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product description"></textarea>
                                        <span class="hidden mt-2 text-sm text-red-600 dark:text-red-500">//append here</span>
                                    </div>

                                    <!-- Category -->
                                    <div class="col-span-2">
                                        <label for="product_category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                        <select name="category_id" id="product_category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <!-- Add categories here -->
                                        </select>
                                        <span class="hidden mt-2 text-sm text-red-600 dark:text-red-500">//append here</span>
                                    </div>

                                    <!-- Price -->
                                    <div>
                                        <label for="product_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                        <input type="number" validate_type="float" limit="" is_required="true" step="0.01" name="price" id="product_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="0.00" required="">
                                        <span class="hidden mt-2 text-sm text-red-600 dark:text-red-500">//append here</span>
                                    </div>

                                    <!-- Discount Price -->
                                    <div>
                                        <label for="product_discount_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Discount Price</label>
                                        <input type="number" validate_type="float" limit="" is_required="false" step="0.01" name="discount_price" id="product_discount_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="0.00">
                                        <span class="hidden mt-2 text-sm text-red-600 dark:text-red-500">//append here</span>
                                    </div>

                                    <!-- Quantity -->
                                    <div>
                                        <label for="product_quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                                        <input type="number" validate_type="digits" limit="" is_required="true" name="quantity" id="product_quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter stock quantity">
                                        <span class="hidden mt-2 text-sm text-red-600 dark:text-red-500">//append here</span>
                                    </div>

                                    <!-- Is Active -->
                                    <div>
                                        <label for="product_is_active" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Is Active</label>
                                        <select name="is_active" id="product_is_active" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        <span class="hidden mt-2 text-sm text-red-600 dark:text-red-500">//append here</span>
                                    </div>

                                    <!-- Main Image -->
                                    <div class="col-span-2">
                                        <label for="product_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Main Image</label>
                                        <input type="file" name="main_image_url" id="product_image" validate_type="" limit="255" is_required="false" accept="image/*" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <span class="hidden mt-2 text-sm text-red-600 dark:text-red-500">//append here</span>
                                    </div>

                                    <!-- Meta Title -->
                                    <div class="col-span-2">
                                        <label for="product_meta_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta Title</label>
                                        <input type="text" validate_type="" limit="255" is_required="true" name="meta_title" id="product_meta_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type meta title">
                                        <span class="hidden mt-2 text-sm text-red-600 dark:text-red-500">//append here</span>
                                    </div>

                                    <!-- Meta Description -->
                                    <div class="col-span-2">
                                        <label for="product_meta_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meta Description</label>
                                        <textarea name="meta_description" id="product_meta_description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type meta description"></textarea>
                                        <span class="hidden mt-2 text-sm text-red-600 dark:text-red-500">//append here</span>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <button id="add-product-btn" type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Product</button>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- Edit modal -->
                <button id="category-edit-modal-toggle-btn" data-modal-target="category-edit-modal" data-modal-toggle="category-edit-modal" class="hidden block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button"></button>

                <div id="category-edit-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white category-modal-des">
                                    Update a Category
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white close-btn" data-modal-toggle="category-edit-modal" onclick="$('#edit-category-form').find('input').each(function() { $(this).css('border', ''); $(this).next('span').addClass('hidden').text(''); });">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <form id="edit-category-form" class="p-4 md:p-5 edit-category-form" novalidate>
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <label for="edit_category_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                        <input type="text" validate_type="" limit="255" is_required="true" name="edit_category_name" id="edit_category_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500" placeholder="Type product name" required="">
                                        <span class="hidden mt-2 text-sm text-red-600 dark:text-red-500"></span>
                                        <input type="hidden" name="category_id" id="category_id">
                                    </div>
                                </div>
                                <button id="update-category-btn" type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Save
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- delete modal --}}
                <button id="category-delete-modal-toggle-btn" data-modal-target="category-delete-modal" data-modal-toggle="category-delete-modal" class="hidden block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button"></button>

                <div id="category-delete-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white close-btn" data-modal-hide="category-delete-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <input type="hidden" name="delete-id" id="delete-id">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                                <button id="category-delete-btn" data-modal-hide="category-delete-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                    Yes, I'm sure
                                </button>
                                <button data-modal-hide="category-delete-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Chart.js for charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Theme toggle script -->
    <script src="{{ asset('js/theme.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>


</body>
</html>

<script type="text/javascript">

    $(document).ready(function() {
        // Fetch data when the page loads
        fetchCategories();

        // Event listener for search input
        $('#search-category').on('keyup', function() {
            let searchKeyword = $(this).val();
            fetchCategories(searchKeyword); // Fetch categories based on the search keyword
        });

        // Add Product
        $('#add-product-btn').on('click', function(event) {
            event.preventDefault();

            // Validate data
            const form = $('#add-product-form');
            const validation = validateForm(form);
            if (!validation) {
                return;
            }
            console.log("validation: true");


            // Gather form data
            let formData = new FormData(form[0]);
            // for (let [key, value] of formData.entries()) {
            //     console.log(`${key}: ${value}`);
            // }
            formData.append('_token', '{{ csrf_token() }}'); // Include CSRF token

            $.ajax({
                url: '/admin/product',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    tosterAlert("success", response.message);
                    $('#product-add-modal .close-btn').trigger('click');
                    form[0].reset();
                    form.find("input, textarea").next("span").addClass("hidden").text("");
                    fetchCategories();
                },
                error: function(xhr) {
                    // Handle validation errors returned by Laravel
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        for (const key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                tosterAlert("error", errors[key][0]);
                            }
                        }
                    } else {
                        console.error('Error adding product:', xhr);
                        tosterAlert("error", "An unexpected error occurred.");
                    }
                }
            });
        });

        // Edit data
        $(document).on('click', '.edit-btn', function(event) {
            event.preventDefault();

            let categoryId = $(this).data('id');

            // Fetch a category
            $.ajax({
                url: '/admin/category/' + categoryId,
                type: 'GET',
                success: function(data) {
                    // Populate modal form fields with category data
                    $('#edit_category_name').val(data.name);
                    $('#category_id').val(data.id);

                    // $('#category-edit-modal-toggle-btn').trigger('click');
                },
                error: function(err) {
                    tosterAlert("error", err);
                }
            });
        });

        // Save edited data
        $('#update-category-btn').on('click', function(event) {
            event.preventDefault();

            // Validate data
            const form = $('#edit-category-form');
            const validation = validateForm(form);
            if (!validation) {
                return;
            }

            let categoryId = $('#category_id').val();
            let categoryName = $('#edit_category_name').val();

            // Send AJAX request to update the category
            $.ajax({
                url: '/admin/category/' + categoryId,
                type: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: categoryName
                },
                success: function(response) {
                    tosterAlert("success",response.message);
                    $('#category-edit-modal .close-btn').trigger('click');
                    form.find('input').val('');
                    form.find("input").next("span").addClass("hidden").text("");
                    fetchCategories();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        for (const key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                tosterAlert("error", errors[key][0]);
                            }
                        }
                    } else {
                        console.error('Error Update category:', xhr);
                        tosterAlert("error", "An unexpected error occurred.");
                    }
                }
            });
        });

        //delete function
        $('#category-delete-btn').on('click', function(event) {
            event.preventDefault();

            let categoryId = $('#delete-id').val();

            // Perform AJAX request to delete the category
            $.ajax({
                url: '/admin/category/' + categoryId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    tosterAlert("success",response.message);
                    $('#category-delete-modal .close-btn').trigger('click');
                    fetchCategories();
                },
                error: function(xhr) {
                    console.error("Error deleting category:", xhr);
                    let errorMessage = xhr.responseJSON && xhr.responseJSON.error ? xhr.responseJSON.error : "An error occurred while deleting the category.";
                    tosterAlert("error", errorMessage);
                }
            });
        });
    });

    // Validation function
    function validateForm(form) {
        console.log(form);

        let isValid = true;

        form.find("input").each(function() {
            const validateType = $(this).attr("validate_type");
            console.log(validateType);
            const limit = parseInt($(this).attr("limit"), 10);
            const isRequired = $(this).attr("is_required") === "true";
            const value = $(this).val().trim();
            const errorSpan = $(this).next("span");

            // Clear previous error messages
            errorSpan.addClass("hidden").text("");

            // Required field check
            if (isRequired && value === "") {
                errorSpan.removeClass("hidden").text("This field is required.");
                isValid = false;
                return false; // Exit early for this field
            }

            // Length limit check
            if (value.length > limit) {
                errorSpan.removeClass("hidden").text(`Exceeds maximum length of ${limit} characters.`);
                isValid = false;
                return false;
            }

            // Type-specific validation
            if (validateType === "email" && value !== "" && !/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(value)) {
                errorSpan.removeClass("hidden").text("Invalid email format.");
                isValid = false;
                return false;
            } else if (validateType === "digits" && value !== "" && !/^\d+$/.test(value)) {
                errorSpan.removeClass("hidden").text("Digits only allowed.");
                isValid = false;
                return false;
            } else if (validateType === "float" && value !== "" && !/^\d+(\.\d+)?$/.test(value)) {
                errorSpan.removeClass("hidden").text("Float numbers only.");
                isValid = false;
                return false;
            } else if (validateType === "text" && value !== "" && !/^[a-zA-Z\s]+$/.test(value)) {
                errorSpan.removeClass("hidden").text("Text only (letters and spaces allowed).");
                isValid = false;
                return false;
            }
        });

        return isValid;
    }

    function tosterAlert(status, message) {
        var successToast = $("#toast-success");
        var errorToast = $("#toast-warning");

        if (status === "success") {
            successToast.find(".description").text(message);
            successToast.removeClass("hidden").fadeIn().delay(3000).fadeOut();
        } else if (status === "error") {
            errorToast.find(".description").text(message);
            errorToast.removeClass("hidden").fadeIn().delay(3000).fadeOut();
        }
    }

    // Fetch data function with pagination
    function fetchCategories(searchKeyword = '', page = 1) {
        $.ajax({
            url: '/admin/product',
            type: 'GET',
            data: {
                search: searchKeyword,
                page: page
            },
            success: function(data) {
                let tableBody = $('#categoryTable tbody');
                tableBody.empty();

                // Loop through the data and generate table rows
                data.data.forEach(function(product) {
                    let imageUrl = product.main_image_url ? `/storage/${product.main_image_url}` : '/images/placeholder.png'; // Use a placeholder if no image
                    let row = `
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                ${product.id}
                            </th>
                            <td class="px-6 py-4">
                                ${product.name}
                            </td>
                            <td class="px-6 py-4">
                                ${product.description}
                            </td>
                            <td class="px-6 py-4">
                                ${product.category_id}
                            </td>
                            <td class="px-6 py-4">
                                ${product.price}
                            </td>
                            <td class="px-6 py-4">
                                ${product.discount_price}
                            </td>
                            <td class="px-6 py-4">
                                ${product.stock_quantity}
                            </td>
                            <td class="px-6 py-4">
                                ${product.is_active}
                            </td>
                            <td class="p-4">
                                <img src="${imageUrl}" alt="${product.name}" class="w-16 md:w-32 max-w-full max-h-full">
                            </td>
                            <td class="px-6 py-4">
                                ${product.rating}
                            </td>
                            <td class="px-16 py-4">
                                ${product.num_reviews}
                            </td>
                            <td class="px-6 py-4">
                                ${product.meta_title}
                            </td>
                            <td class="px-6 py-4">
                                ${product.meta_description}
                            </td>
                            <td class="px-6 py-4">
                                <button class="edit-btn font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2" onclick="toggleModal('#category-edit-modal-toggle-btn')" data-id="${product.id}">Edit</button>
                                <button class="delete-btn font-medium text-red-600 dark:text-red-500 hover:underline" onclick="toggleModal('#category-delete-modal-toggle-btn')"  data-id="${product.id}">Delete</button>
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

    //pagination
    function generatePagination(data) {
        let pagination = $('#pagination');
        pagination.empty();

        let currentPage = data.current_page;
        let lastPage = data.last_page;

        // Previous button
        if (currentPage > 1) {
            pagination.append(`<li><a class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="#" onclick="fetchCategories('', ${currentPage - 1})">Previous</a></li>`);
        }

        // Page numbers
        for (let i = 1; i <= lastPage; i++) {
            let activeClass = (i === currentPage)
                ? 'active bg-gray-500 text-white' // No border class for active link
                : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white';
            pagination.append(`<li><a class="flex items-center justify-center px-3 h-8 leading-tight ${activeClass}" href="#" onclick="fetchCategories('', ${i})">${i}</a></li>`);
        }
        // Next button
        if (currentPage < lastPage) {
            pagination.append(`<li><a class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="#" onclick="fetchCategories('', ${currentPage + 1})">Next</a></li>`);
        }
    }

    //Toggal modal
    function toggleModal(btn_id){
        $(btn_id).trigger('click');
    }

    // Load categories and populate dropdown
    function loadCategories() {
        $.ajax({
            url: '/admin/category',
            type: 'GET',
            data: { all: 'true' },
            success: function(response) {
                console.log("res: ", response);

                const categoryDropdown = $('#product_category');
                categoryDropdown.empty();

                if (response && Array.isArray(response)) {
                    response.forEach(function(category) {
                        categoryDropdown.append(new Option(category.name, category.id));
                    });
                } else {
                    console.error("No categories found in response data.");
                    tosterAlert("error", "Failed to load categories.");
                }
            },
            error: function(xhr) {
                console.error('Error loading categories:', xhr);
                tosterAlert("error", "Failed to load categories.");
            }
        });
    }
</script>

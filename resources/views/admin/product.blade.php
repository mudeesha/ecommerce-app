<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')

    <style type="text/css">
      input[type='text'] {
        width: 400px;
        height:  50px;
      }

      .div_deg {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 30px;
      }

      .table_container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 30px;
      }

      .table_deg {
        width: 100%;
        table-layout: auto;
        text-align: center;
        margin: auto;
        /* border: 2px solid #DB6574; */
        margin-top: 15px;
        width: 600px;
      }

      th {
        background-color: skyblue;
        padding: 15px;
        font-size: 20px;
        font-weight: bold;
        color: white;
      }

      td {
        color: white;
        padding: 10px;
        border: 1px solid skyblue;
      }
      .add-btn-wrappper {
        width: 100%; /* Take full width of the container */
        margin-bottom: 10px; /* Add margin below the button for spacing */
        display: flex; /* Ensure button aligns properly */
        justify-content: space-between; /* Distribute input and button */
        align-items: center;
      }

      #search-category {
        flex-grow: 1; /* Make input take available space */
        margin-right: 10px; /* Space between input and button */
      }

      .table-wrapper {
        display: inline-block; /* Ensure the container wraps the table */
        margin: 0 auto; /* Center the table container horizontally */
        text-align: center;
    }

    </style>
  </head>
  <body>
    <!-- header start -->
    @include('admin.header')
    <!-- header end -->

    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

            <h1 style="color:white;">Products</h1>


            <div class="table_container">
                <div class="table-wrapper">

                    <div class="add-btn-wrappper">
                        <input type="text" id="search-category" placeholder="Search categories..." class="form-control">
                        <button class="btn btn-primary add-btn" type="submit" data-toggle="modal" data-target="#categoryAddModal">Add category</button>
                    </div>
                    <table class="table_deg" id="categoryTable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table Content -->
                        </tbody>
                    </table>

                    <!-- Pagination links -->
                    <nav>
                        <ul id="product-pagination" class="pagination justify-content-center">
                            <!-- Pagination buttons will be appended here -->
                        </ul>
                    </nav>

                    <!-- Add Modal -->
                    <div class="modal fade" id="productAddModal" tabindex="-1" role="dialog" aria-labelledby="productAddModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add a New Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <form id="add-product-form">
                                    <label for="product_title">Title</label>
                                    <input name="product_title" id="add-product-title" value="" class="form-control">

                                    <label for="product_description">Description</label>
                                    <input name="product_description" id="add-product-description" value="" class="form-control">

                                    <label for="product_image">Image</label>
                                    <input name="product_image" id="add-product-image" value="" class="form-control">

                                    <label for="product_price">Price</label>
                                    <input name="product_price" id="add-product-price" value="" class="form-control">

                                    <label for="product_category">Category</label>
                                    <input name="product_category" id="add-product-category" value="" class="form-control">

                                    <label for="product_quantity">Quantity</label>
                                    <input name="product_quantity" id="add-product-quantity" value="" class="form-control">

                                    <input type="hidden" name="add-product-id" id="add-product-id">
                                </form>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="save-add-product-btn">Save changes</button>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="productEditModal" tabindex="-1" role="dialog" aria-labelledby="productEditModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <form id="edit-product-form">
                                    <label for="product_title">Title</label>
                                    <input name="product_title" id="edit-product-title" value="" class="form-control">

                                    <label for="product_description">Description</label>
                                    <input name="product_description" id="edit-product-description" value="" class="form-control">

                                    <label for="product_image">Image</label>
                                    <input name="product_image" id="edit-product-image" value="" class="form-control">

                                    <label for="product_price">Price</label>
                                    <input name="product_price" id="edit-product-price" value="" class="form-control">

                                    <label for="product_category">Category</label>
                                    <input name="product_category" id="edit-product-category" value="" class="form-control">

                                    <label for="product_quantity">Quantity</label>
                                    <input name="product_quantity" id="edit-product-quantity" value="" class="form-control">

                                    <input type="hidden" name="edit-product-id" id="edit-product-id">
                                </form>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="save-edit-product-btn">Save changes</button>
                            </div>
                        </div>
                        </div>
                    </div>

                <div>
            </div>
      </div>
    </div>



  </body>
</html>


<script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
<script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
<script src="{{ asset('admincss/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('admincss/js/charts-home.js') }}"></script>
<script src="{{ asset('admincss/js/front.js') }}"></script>


<script type="text/javascript">
            // Fetch data function with pagination
        function fetchCategories(searchKeyword = '', page = 1) {
            $.ajax({
                url: '/get_categories',
                type: 'GET',
                data: {
                    search: searchKeyword, // Pass the search keyword to the server
                    page: page // Pass the current page
                },
                success: function(data) {
                    let tableBody = $('#categoryTable tbody');
                    tableBody.empty();  // Clear existing rows if any

                    // Loop through the data and generate table rows
                    data.data.forEach(function(category) {  // `data.data` because of pagination object
                        let row = `
                            <tr>
                                <td>${category.category_name}</td>
                                <td>
                                    <button type="button" class="btn btn-success edit-category-btn" data-toggle="modal" data-target="#categoryEditModal" data-id="${category.id}">Edit</button>
                                    <button type="button" class="btn btn-danger" onclick="confirmation(event)" data-id="${category.id}">Delete</button>
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
            // Get the category name from the input field
            let categoryName = $('#add-category_name').val();

            // Send AJAX request to add the category
            $.ajax({
                url: '/add_category', // Update with your route
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
                        // Clear the input field and hide the modal
                        $('#add-category_name').val(''); // Clear input
                        $('#categoryAddModal .close').trigger('click');

                        // Reload categories
                        fetchCategories(); // Refresh the category table
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
                url: '/get_category/' + categoryId,
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
                url: '/update_category/' + categoryId,
                type: 'POST',
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

        // Separate delete function
        function deleteCategory(categoryId) {
            // Perform AJAX request to delete the category
            $.ajax({
                url: '/delete_category/' + categoryId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',  // Include CSRF token for Laravel
                },
                success: function(response) {
                    // Show success message
                    swal("Category deleted successfully!", {
                        icon: "success",
                    });

                    // Reload the categories table after deletion
                    fetchCategories();
                },
                error: function(err) {
                    console.error("Error deleting category:", err);

                    // Show error message
                    swal("Error", "There was an issue deleting the category.", "error");
                }
            });
        }

        // Confirmation for deletion
        window.confirmation = function(ev) {
            ev.preventDefault();

            // Get the category ID from the button's data-id attribute
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
                    // Call the delete function
                    deleteCategory(categoryId);
                }
            });
        };
    });
</script>

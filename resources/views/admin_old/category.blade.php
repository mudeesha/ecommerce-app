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
        width: 100%;
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      #search-category {
        flex-grow: 1;
        margin-right: 10px;
      }

      .table-wrapper {
        display: inline-block;
        margin: 0 auto;
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

            <h1 style="color:white;">Add Category</h1>


            <div class="table_container">
                <div class="table-wrapper">

                    <div class="add-btn-wrappper">
                        <input type="text" id="search-category" placeholder="Search categories..." class="form-control">
                        <button class="btn btn-primary add-btn" type="submit" data-toggle="modal" data-target="#categoryAddModal">Add category</button>
                    </div>
                    <table class="table_deg" id="categoryTable">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table Content -->
                        </tbody>
                    </table>

                    <!-- Pagination links -->
                    <nav>
                        <ul id="pagination" class="pagination justify-content-center">
                            <!-- Pagination -->
                        </ul>
                    </nav>

                    <!-- Add Modal -->
                    <div class="modal fade" id="categoryAddModal" tabindex="-1" role="dialog" aria-labelledby="categoryAddModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add a New Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <form id="edit-category-form">
                                    <label for="category_name">Category Name</label>
                                    <input name="category_name" id="add-category_name" value="" class="form-control">
                                    <input type="hidden" name="category_id" id="category_id">
                                </form>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="save-add-category-btn">Save changes</button>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="categoryEditModal" tabindex="-1" role="dialog" aria-labelledby="categoryEditModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <form id="edit-category-form">
                                    <label for="category_name">Category Name</label>
                                    <input name="category_name" id="category_name" value="" class="form-control">
                                    <input type="hidden" name="category_id" id="category_id">
                                </form>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="save-category-btn">Save changes</button>
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

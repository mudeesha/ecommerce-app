<section class="shop_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
            Latest Productsii
            </h2>
        </div>
        <div class="row" id="main-row">
            {{-- products --}}
        </div>
        <div class="btn-box">
            <a href="">
            View All Products
            </a>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- Close Button -->
                    <button type="button" class="btn-close close-button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-body">
                        <div class="row">
                            <!--Image and Thumbnails -->
                            <div class="col-4" style="border-right: 1px solid #ddd; padding-right: 20px;">
                                <img src="https://via.placeholder.com/300" alt="Main Product Image" class="img-fluid mb-3">
                                <div class="thumbs">
                                    <img src="" alt="Thumbnail" class="img-thumbnail mb-2">
                                    <img src="" alt="Thumbnail" class="img-thumbnail mb-2">
                                    <img src="" alt="Thumbnail" class="img-thumbnail mb-2">
                                </div>
                            </div>

                            <!--Product Details -->
                            <div class="col-5 px-4">
                                <h5 class="text-danger mb-3 sale-banner"></h5>
                                <h4 class="mb-1 original-price"></h4>
                                <p class="text-muted">
                                    <s class="original-price"></s> <span class="text-danger">55% off</span>
                                </p>
                                <p class="small text-muted">Ends: Nov. 19, 13:29 (GMT+5.5)</p>
                                <h6 class="mt-4 product-name"></h6>
                                <p class="small description">Rechargeable Wet Dry Three-In-One Sweeping Machine for Home</p>
                                <h6 class="mt-3">Color: Black Charging</h6>
                                <div class="d-flex gap-2 mt-2">
                                    <img src="https://via.placeholder.com/50" alt="Color Option" class="img-thumbnail">
                                    <img src="https://via.placeholder.com/50" alt="Color Option" class="img-thumbnail">
                                </div>
                                <h6 class="mt-4">Quantity:</h6>
                                <div class="d-flex align-items-center mt-2">
                                    <button class="btn btn-outline-secondary btn-sm quantity-decrease" id="quantity-decrease">-</button>
                                    <span class="mx-3" id="quantity-display">1</span>
                                    <button class="btn btn-outline-secondary btn-sm quantity-increase" id="quantity-increase">+</button>
                                </div>
                                <p class="small text-muted mt-2 stock"></p>
                            </div>

                            <!--Seller Info and Add to Cart -->
                            <div class="col-3" style="background-color: #f9f9f9; padding: 20px; border-left: 1px solid #ddd;">
                                <h6 class="mb-3">Sold by</h6>
                                <p class="small">Shop1103441067 Store (Trader)</p>
                                <h6 class="mt-4">Delivery</h6>
                                <p class="small text-muted">Free shipping<br>Delivery: Nov. 29 - Dec. 13</p>
                                <h6 class="mt-4">Security & Privacy</h6>
                                <p class="small text-muted">We protect your personal details and keep them secure.</p>
                                <button class="btn btn-danger btn-block mt-4 add-to-cart-btn" id="add-to-cart-btn">Add to cart</button>
                                <button class="btn btn-outline-secondary btn-block mt-2">View Details</button>
                                <p class="small mt-3 text-center">12.2K Likes</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
  </section>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">

    $(document).ready(function() {
        // Fetch data when the page loads
        fetchProducts();

        // Event listener for search input
        $('#search-category').on('keyup', function() {
            let searchKeyword = $(this).val();
            fetchCategories(searchKeyword); // Fetch categories based on the search keyword
        });

        //Get a product for preview
        $('#main-row').on('click', '.preview-btn', function () {
            let productId = $(this).attr('data-id');
            console.log("id; ", productId);


            // Make the AJAX call
            $.ajax({
                url: `/home/product/${productId}`, // Route to fetch product details
                type: 'GET',
                success: function (response) {
                    let imageUrl = response.main_image_url ? `/storage/${response.main_image_url}` : '/images/placeholder.png';

                    // Populate modal fields with response data
                    $('#previewModal .modal-body img.img-fluid').attr('src', response.image);
                    $('#previewModal .sale-banner').text(`Save LKR ${response.discount_price}`);
                    $('#previewModal .price').text(`LKR (${response.price || 0} - ${response.discount_price || 0})`);
                    $('#previewModal .original-price').text(`LKR ${response.price}`);
                    $('#previewModal .product-name').text(response.name);
                    $('#previewModal .description').text(response.description);
                    // $('#previewModal .thumbs img').each((index, element) => {
                    //     if (response.main_image_url[index]) {
                    //         $(element).attr('src', response.thumbnails[index]);
                    //     }
                    // });
                    $('#previewModal .thumbs img').attr('src', imageUrl);
                    $('#previewModal .stock').text(`${response.stock_quantity} available`);
                    $('#previewModal .add-to-cart-btn').attr('data-id', response.id);
                },
                error: function () {
                    alert('Failed to load product details. Please try again.');
                }
            });
        });


        //Add to cart--------------------------------------------------------------------------------------------------------------------------
        // Default quantity
        let quantity = 1;

        // Handle quantity increase
        $(document).on('click', '#quantity-increase', function () {
            quantity++;
            $('#quantity-display').text(quantity);
        });

        // Handle quantity decrease
        $(document).on('click', '#quantity-decrease', function () {
            if (quantity > 1) {
                quantity--;
                $('#quantity-display').text(quantity);
            }
        });

        $(document).on('click', '.add-to-cart-btn', function () {
            let productId = $(this).attr('data-id');
            console.log(productId);
            console.log(quantity);

            $.ajax({
                url: '/cart/add',
                type: 'POST',
                data: {
                    product_id: productId,
                    quantity: quantity,
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    alert(response.message);
                    // updateCartCount();
                },
                error: function(xhr) {
                    // validation errors returned by laravel
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        for (const key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                tosterAlert("error", errors[key][0]);
                            }
                        }
                    } else {
                        console.error('Error adding category:', xhr);
                        tosterAlert("error", "An unexpected error occurred.");
                    }
                }
            });
        });



    });


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
    function fetchProducts(searchKeyword = '', page = 1) {
        $.ajax({
            url: '/home/product',
            type: 'GET',
            data: {
                search: searchKeyword,
                page: page
            },
            success: function(data) {
                let mainRow = $('#main-row');
                mainRow.empty();

                // Loop through the data and generate table rows
                data.data.forEach(function(product) {
                    let imageUrl = product.main_image_url ? `/storage/${product.main_image_url}` : '/images/placeholder.png'; // Use a placeholder if no image
                    let row = `
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="box">
                                <div class="img-box">
                                    <img src="${imageUrl}" alt="${product.name}">
                                </div>
                                <div class="detail-box">
                                    <h6>${product.name}</h6>
                                    <h6>Price<span>Rs ${product.price}</span></h6>
                                </div>
                                <div class="priview-btn-box">
                                    <button type="button" class="preview-btn btn btn-dark" data-toggle="modal" data-target="#previewModal" data-id="${product.id}">See priview</button>
                                </div>
                                <div class="new">
                                    <span>New</span>
                                </div>
                            </div>
                        </div>
                    `;
                    mainRow.append(row);
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

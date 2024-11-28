


        <div class="row isotope-grid product-wraper">

            {{-- products --}}
            {{-- <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                <!-- Block2 -->
                <div class="block2">
                    <div class="block2-pic hov-img0">
                        <img src="images/product-01.jpg" alt="IMG-PRODUCT">

                        <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                            Quick View
                        </a>
                    </div>

                    <div class="block2-txt flex-w flex-t p-t-14">
                        <div class="block2-txt-child1 flex-col-l ">
                            <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                Esprit Ruffle Shirt
                            </a>

                            <span class="stext-105 cl3">
                                $16.64
                            </span>
                        </div>

                        <div class="block2-txt-child2 flex-r p-t-3">
                            <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                <img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
                                <img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
                            </a>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- Modal -->
        </div>

        <!-- Load more -->
        <div class="flex-c-m flex-w w-full p-t-45">
            <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                Load More
            </a>
        </div>





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
        $('.product-wraper').on('click', '.js-show-modal1', function () {
            let productId = $(this).attr('data-id');
            console.log("id; ", productId);


            // Make the AJAX call
            $.ajax({
                url: `/home/product/${productId}`, // Route to fetch product details
                type: 'GET',
                success: function (response) {
                    let imageUrl = response.main_image_url ? `/storage/${response.main_image_url}` : '/images/placeholder.png';

                    // Populate modal fields with response data
                    $('#previewModal img.main-image').attr('src', imageUrl);
                    $('#previewModal .discount').text(`Save LKR ${response.discount_price}`);
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
            $('#quantity-display').value(quantity);
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
                    swal(response.message);
                    // updateCartCount();
                },
                error: function(xhr) {
                    if (xhr.status === 400) {
                        swal(xhr.responseJSON.error); // Show the "already added" message
                    } else if (xhr.status === 422) {
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
            success: function (data) {
                let mainRow = $('.product-wraper');
                mainRow.empty();

                // Loop through the data and generate product cards
                data.data.forEach(function (product) {
                    let imageUrl = product.main_image_url
                        ? `/storage/${product.main_image_url}`
                        : '/images/placeholder.png'; // Use a placeholder if no image
                    let row = `
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <img src="${imageUrl}" alt="IMG-PRODUCT">
                                    <button class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" data-id="${product.id}">
                                        Quick View
                                    </button>
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            ${product.name}
                                        </a>
                                        <span class="stext-105 cl3" style="text-decoration: line-through; color: grey;">LKR ${product.price}</span>
                                        <span class="stext-105 cl3"> LKR ${product.price - product.discount_price}</span>
                                    </div>

                                    <div class="block2-txt-child2 flex-r p-t-3">
                                        <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                            <img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
                                            <img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    mainRow.append(row);
                });
            },
            error: function (err) {
                console.error('Error fetching products:', err);
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
    $(document).on('click', '.js-show-modal1', function (e) {
        e.preventDefault();
        $('.js-modal1').addClass('show-modal1');
    });

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

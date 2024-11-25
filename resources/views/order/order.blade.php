<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Cream background for the entire page */
        body {
            background-color: #f5f5f5;
        }

        /* White background for tiles */
        .section-bordered {
            background-color: #ffffff;
            border-radius: 2px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Right summary section */
        .summary-section {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 2px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Styling for the "Place Order" button */
        .place-order-btn {
            background-color: #ff6a00;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 8px;
        }

        .place-order-btn:hover {
            background-color: #e65a00;
        }

        /* Link styling */
        .change-link {
            color: #007bff;
            font-size: 14px;
            cursor: pointer;
        }

        .change-link:hover {
            text-decoration: underline;
        }

        /* Product card styling */
        .card-product {
            border-radius: 2px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            width: 80px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8">
                <!-- Shipping Address Section -->
                <div class="section-bordered">
                    <h5 class="mb-3">Shipping Address</h5>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-0">New York, New York, United States, 10026</p>
                        <span class="change-link">Change</span>
                    </div>
                </div>

                <!-- Payment Methods Section -->
                <div class="section-bordered">
                    <h5 class="mb-3">Payment Methods</h5>
                    <span class="change-link">Select Payment Method</span>
                </div>

                <!-- Product Section -->
                <div class="card-product p-3 mb-4">
                    <div class="d-flex">
                        <img src="https://via.placeholder.com/80" alt="Product Image" class="product-image me-3">
                        <div>
                            <h6 class="mb-1">Women Dresses Summer Sexy Dress Ladies</h6>
                            <p class="text-muted mb-1">Dark blue, M</p>
                            <p class="mb-0">US $10.99</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <div class="summary-section">
                    <h5 class="mb-4">Summary</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total item costs</span>
                        <span>US $10.99</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 text-danger">
                        <span>Saved</span>
                        <span>-US $0.11</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Promo Code</span>
                        <span>
                            <input type="text" class="form-control form-control-sm" placeholder="Enter code">
                        </span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total shipping</span>
                        <span>US $0.66</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <strong>Total</strong>
                        <strong>US $11.54</strong>
                    </div>
                    <button class="btn place-order-btn w-100">Place order</button>
                    <p class="text-muted mt-2 text-center" style="font-size: 12px;">
                        Upon clicking 'Place Order', I confirm I have read and acknowledged all
                        <a href="#" class="text-decoration-none">terms and policies</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

// $(document).ready(function () {
//     // Load cart items on page load
//     fetchCartItems();

//     // Fetch cart items via AJAX
//     function fetchCartItems() {
//         $.ajax({
//             url: '{{ route("cart.items") }}',
//             type: 'GET',
//             success: function (response) {
//                 console.log(response);

//                 if (response.status) {
//                     renderCartItems(response.data); // Populate cart items
//                     updateCartSummary(response.data); // Update summary
//                 } else {
//                     showEmptyCartMessage();
//                 }
//             },
//             error: function (xhr) {
//                 console.error('Error showing cart:', xhr);
//             }
//         });
//     }

//     // Render cart items dynamically
//     function renderCartItems(items) {
//         const cartWrapper = $('.col-lg-8');
//         cartWrapper.find('.card').remove(); // Clear existing items

//         if (items.length === 0) {
//             showEmptyCartMessage();
//             return;
//         }

//         let cartHTML = '';
//         items.forEach(item => {
//             let imageUrl = item.product.main_image_url ? `/storage/${item.product.main_image_url}` : '/images/placeholder.png';
//             cartHTML += `
//             <div class="card mb-3">
//                 <div class="card-body cart-item d-flex align-items-center">
//                     <input type="checkbox" class="form-check-input me-3" cart-item-id="${item.id}">
//                     <img src="${imageUrl}" alt="Product" class="rounded" width="80">
//                     <div class="ms-3">
//                         <h6 class="mb-0">${item.product.name}</h6>
//                         <small class="text-muted">${item.shop_name}</small>
//                         ${item.is_almost_sold_out ? '<div class="text-danger small">Almost sold out</div>' : ''}
//                     </div>
//                     <div class="ms-auto">
//                         <h6 class="text-danger">LKR ${parseFloat(item.product.price).toFixed(2)}</h6>
//                         <div class="quantity-control mt-2">
//                             <button class="btn btn-outline-secondary btn-sm btn-decrease" cart-item-id="${item.id}">-</button>
//                             <span class="mx-2 quantity">${item.quantity}</span>
//                             <button class="btn btn-outline-secondary btn-sm btn-increase" cart-item-id="${item.id}">+</button>
//                         </div>
//                     </div>
//                 </div>
//             </div>`;
//         });

//         cartWrapper.prepend(cartHTML);
//     }

//     // Update the cart summary dynamically
//     function updateCartSummary(items) {
//         let subtotal = 0, shipping = 289.42, saved = 0;

//         items.forEach(item => {
//             subtotal += item.product.price * item.quantity;
//             saved += item.product.discount || 0;
//         });

//         const total = subtotal + shipping - saved;

//         $('.cart-summary .d-flex span').eq(1).text(`LKR ${subtotal.toFixed(2)}`);
//         $('.cart-summary .d-flex span').eq(3).text(`LKR ${shipping.toFixed(2)}`);
//         $('.cart-summary .d-flex span').eq(5).text(`- LKR ${saved.toFixed(2)}`);
//         $('.cart-summary .d-flex strong').eq(1).text(`LKR ${total.toFixed(2)}`);
//     }

//     // Handle quantity update
//     $(document).on('click', '.btn-increase, .btn-decrease', function () {
//         const cartId = $(this).attr('cart-item-id');
//         console.log(cartId);

//         const quantityElement = $(this).siblings('.quantity');
//         let quantity = parseInt(quantityElement.text());
//         const action = $(this).hasClass('btn-increase') ? 'increase' : 'decrease';

//         if (action === 'increase') {
//             quantity++;
//         } else if (quantity > 1) {
//             quantity--;
//         }

//         // Update quantity via AJAX
//         $.ajax({
//             url: '{{ route("cart.update") }}',
//             type: 'POST',
//             data: {
//                 id: cartId,
//                 quantity: quantity,
//                 _token: '{{ csrf_token() }}'
//             },
//             success: function (response) {
//                 if (response.status) {
//                     fetchCartItems(); // Refresh cart
//                 } else {
//                     alert(response.message);
//                 }
//             },
//             error: function () {
//                 alert('Failed to update quantity.');
//             }
//         });
//     });

//     // Handle cart item removal
//     $(document).on('click', '.btn-remove', function () {
//         const selectedItems = [];
//         $('.form-check-input:checked').each(function () {
//             selectedItems.push($(this).attr('cart-item-id'));
//         });

//          // If no items are selected, alert the user
//         if (selectedItems.length === 0) {
//             alert('Please select items to delete.');
//             return;
//         }

//         // Remove item via AJAX
//         $.ajax({
//             url: '{{ route("cart.remove") }}',
//             type: 'post',
//             data: {
//                 itemIds: selectedItems,
//                 _token: '{{ csrf_token() }}'
//             },
//             success: function (response) {
//                 console.log("hi");
//                 console.log(response);

//                 // alert(response.message);
//                 fetchCartItems();
//             },
//             error: function (xhr) {
//                 alert('An error occurred. Please try again.');
//                 console.error(xhr.responseText);
//             }
//         });
//     });

//     // Show empty cart message
//     function showEmptyCartMessage() {
//         const cartWrapper = $('.col-lg-8');
//         cartWrapper.find('.card').remove(); // Clear existing items
//         cartWrapper.append('<p class="text-center text-muted">Your cart is empty.</p>');
//     }

//     // Delete selected items
//     $('.text-danger').click(function (e) {
//         e.preventDefault();
//         const selectedItems = [];

//         $('.cart-item input[type="checkbox"]:checked').each(function () {
//             selectedItems.push($(this).attr('cart-item-id'));
//         });

//         if (selectedItems.length === 0) {
//             alert('No items selected.');
//             return;
//         }

//         // Remove selected items via AJAX
//         $.ajax({
//             url: '{{ route("cart.remove") }}',
//             type: 'POST',
//             data: {
//                 cart_ids: selectedItems,
//                 _token: '{{ csrf_token() }}'
//             },
//             success: function (response) {
//                 alert(response.message);
//                 fetchCartItems();
//             },
//             error: function (xhr) {
//                 alert('An error occurred. Please try again.');
//                 console.error(xhr.responseText);
//             }
//         });
//     });
// });


</script>

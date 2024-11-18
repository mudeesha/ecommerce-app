<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .cart-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }

        .cart-item .quantity-control {
            display: flex;
            align-items: center;
        }

        .cart-summary {
            background-color: #f8f9fa;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .btn-checkout {
            background-color: #d70018;
            color: #fff;
            font-weight: bold;
        }

        .btn-checkout:hover {
            background-color: #a50010;
        }

        .payment-methods img {
            height: 25px;
            margin-right: 8px;
        }

        .buyer-protection {
            margin-top: 20px;
            font-size: 14px;
            color: #6c757d;
        }
    </style>
</head>



<div class="container my-5">
    <div class="row">
        <!-- Cart Items wrap -->
        <div class="col-lg-8 cart-wrap">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Cart (3)</h4>
                <a href="#" class="text-danger">Delete selected items</a>
            </div>

            {{-- cart item --}}
            {{-- <div class="card mb-3">
                <div class="card-body cart-item d-flex align-items-center">
                    <input type="checkbox" class="form-check-input me-3">
                    <img src="https://via.placeholder.com/80" alt="Product">
                    <div class="ms-3">
                        <h6 class="mb-0">Original Silicone Case for Apple iPhone</h6>
                        <small class="text-muted">Shop1103441067 Store</small>
                        <div class="text-danger small">Almost sold out</div>
                    </div>
                    <div class="ms-auto">
                        <h6 class="text-danger">LKR 289.42</h6>
                        <div class="quantity-control mt-2">
                            <button class="btn btn-outline-secondary btn-sm">-</button>
                            <span class="mx-2">1</span>
                            <button class="btn btn-outline-secondary btn-sm">+</button>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>

        <!-- Cart Summary -->
        <div class="col-lg-4">
            <div class="cart-summary">
                <h5>Summary</h5>
                <div class="d-flex justify-content-between">
                    <span>Subtotal</span>
                    <span>LKR 2,069.92</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Shipping fee</span>
                    <span>LKR 289.42</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Saved</span>
                    <span class="text-danger">- LKR 309.88</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <strong>Total</strong>
                    <strong>LKR 2,049.46</strong>
                </div>
                <button class="btn btn-checkout w-100 mt-3">Checkout (3)</button>

                <h6 class="mt-4">Pay with</h6>
                <div class="payment-methods d-flex">
                    <img src="https://via.placeholder.com/40" alt="Visa">
                    <img src="https://via.placeholder.com/40" alt="Mastercard">
                    <img src="https://via.placeholder.com/40" alt="Paypal">
                </div>
                <div class="buyer-protection">
                    <strong>Buyer Protection:</strong><br>
                    Get full refund if the item is not as described or if not delivered.
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

$(document).ready(function () {
    // Load cart items on page load
    fetchCartItems();

    // Fetch cart items via AJAX
    function fetchCartItems() {
        $.ajax({
            url: '{{ route("cart.items") }}',
            type: 'GET',
            success: function (response) {
                console.log(response);

                if (response.status) {
                    renderCartItems(response.data); // Populate cart items
                    updateCartSummary(response.data); // Update summary
                } else {
                    showEmptyCartMessage();
                }
            },
            error: function (xhr) {
                console.error('Error showing cart:', xhr);
            }
        });
    }

    // Render cart items dynamically
    function renderCartItems(items) {
        const cartWrapper = $('.col-lg-8');
        cartWrapper.find('.card').remove(); // Clear existing items

        if (items.length === 0) {
            showEmptyCartMessage();
            return;
        }

        let cartHTML = '';
        items.forEach(item => {
            cartHTML += `
            <div class="card mb-3">
                <div class="card-body cart-item d-flex align-items-center">
                    <input type="checkbox" class="form-check-input me-3" data-cart-id="${item.id}">
                    <img src="" alt="Product" class="rounded" width="80">
                    <div class="ms-3">
                        <h6 class="mb-0">${item.product.name}</h6>
                        <small class="text-muted">${item.shop_name}</small>
                        ${item.is_almost_sold_out ? '<div class="text-danger small">Almost sold out</div>' : ''}
                    </div>
                    <div class="ms-auto">
                        <h6 class="text-danger">LKR ${parseFloat(item.product.price).toFixed(2)}</h6>
                        <div class="quantity-control mt-2">
                            <button class="btn btn-outline-secondary btn-sm btn-decrease" data-cart-id="${item.id}">-</button>
                            <span class="mx-2 quantity">${item.quantity}</span>
                            <button class="btn btn-outline-secondary btn-sm btn-increase" data-cart-id="${item.id}">+</button>
                        </div>
                    </div>
                </div>
            </div>`;
        });

        cartWrapper.prepend(cartHTML);
    }

    // Update the cart summary dynamically
    function updateCartSummary(items) {
        let subtotal = 0, shipping = 289.42, saved = 0;

        items.forEach(item => {
            subtotal += item.product.price * item.quantity;
            saved += item.product.discount || 0;
        });

        const total = subtotal + shipping - saved;

        $('.cart-summary .d-flex span').eq(1).text(`LKR ${subtotal.toFixed(2)}`);
        $('.cart-summary .d-flex span').eq(3).text(`LKR ${shipping.toFixed(2)}`);
        $('.cart-summary .d-flex span').eq(5).text(`- LKR ${saved.toFixed(2)}`);
        $('.cart-summary .d-flex strong').eq(1).text(`LKR ${total.toFixed(2)}`);
    }

    // Handle quantity update
    $(document).on('click', '.btn-increase, .btn-decrease', function () {
        const cartId = $(this).data('cart-id');
        const quantityElement = $(this).siblings('.quantity');
        let quantity = parseInt(quantityElement.text());
        const action = $(this).hasClass('btn-increase') ? 'increase' : 'decrease';

        if (action === 'increase') {
            quantity++;
        } else if (quantity > 1) {
            quantity--;
        }

        // Update quantity via AJAX
        $.ajax({
            url: '{{ route("cart.update") }}',
            type: 'POST',
            data: {
                cart_id: cartId,
                quantity: quantity,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.status) {
                    fetchCartItems(); // Refresh cart
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert('Failed to update quantity.');
            }
        });
    });

    // Handle cart item removal
    $(document).on('click', '.btn-remove', function () {
        const cartId = $(this).data('cart-id');

        // Remove item via AJAX
        $.ajax({
            url: '{{ route("cart.remove") }}',
            type: 'POST',
            data: {
                cart_id: cartId,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.status) {
                    fetchCartItems(); // Refresh cart
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert('Failed to remove item.');
            }
        });
    });

    // Show empty cart message
    function showEmptyCartMessage() {
        const cartWrapper = $('.col-lg-8');
        cartWrapper.find('.card').remove(); // Clear existing items
        cartWrapper.append('<p class="text-center text-muted">Your cart is empty.</p>');
    }

    // Delete selected items
    $('.text-danger').click(function (e) {
        e.preventDefault();
        const selectedItems = [];

        $('.cart-item input[type="checkbox"]:checked').each(function () {
            selectedItems.push($(this).data('cart-id'));
        });

        if (selectedItems.length === 0) {
            alert('No items selected.');
            return;
        }

        // Remove selected items via AJAX
        $.ajax({
            url: '{{ route("cart.remove") }}',
            type: 'POST',
            data: {
                cart_ids: selectedItems,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.status) {
                    fetchCartItems(); // Refresh cart
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert('Failed to delete selected items.');
            }
        });
    });
});


</script>

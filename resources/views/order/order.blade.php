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
            background-color: #d70018;;
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

        /* modal */
        .modal-header {
        border-bottom: none;
        }

        .modal-title {
        font-size: 18px;
        font-weight: bold;
        }

        /* Payment Options */
        .payment-option {
        cursor: pointer;
        background-color: #f9f9f9;
        transition: background-color 0.3s ease;
        }

        .payment-option:hover {
        background-color: #eef5ff;
        }

        .payment-option p {
        font-size: 16px;
        }

        /* Radio Button Customization */
        .form-check-input {
        transform: scale(1.3);
        accent-color: #007bff;
        }

        /* Add New Card Link */
        #addNewCard {
        font-size: 14px;
        font-weight: bold;
        text-decoration: underline;
        }

        #addNewCard:hover {
        text-decoration: none;
        }

        /* Alert Styling */
        .alert-success {
        background-color: #e9f7ef;
        color: #155724;
        font-size: 14px;
        display: flex;
        align-items: center;
        }

        /* Continue Button */
        .btn-primary {
        background-color: #007bff;
        border: none;
        font-size: 16px;
        font-weight: bold;
        padding: 10px;
        }


    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8 order-items">
                <!-- Shipping Address Section -->
                <div class="section-bordered">
                    <h5 class="mb-3">Shipping Address</h5>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-0 shipping-address"></p>
                        <span class="change-link">Change</span>
                    </div>
                </div>

                <!-- Payment Methods Section -->
                <div class="section-bordered">
                    <h5 class="mb-3">Payment Methods</h5>
                    <span class="change-link select-payment" data-bs-toggle="modal" data-bs-target="#paymentMethodModal">Select Payment Method</span>
                </div>

                <!-- Product Section -->
                {{-- <div class="card-product p-3 mb-4">
                    <div class="d-flex">
                        <img src="https://via.placeholder.com/80" alt="Product Image" class="product-image me-3">
                        <div>
                            <h6 class="mb-1">Women Dresses Summer Sexy Dress Ladies</h6>
                            <p class="text-muted mb-1">Dark blue, M</p>
                            <p class="mb-0">US $10.99</p>
                        </div>
                    </div>
                </div> --}}
            </div>

            <!-- Right Column -->
            <div class="col-lg-4 summary-wrapper">
                <div class="summary-section">
                    <h5 class="mb-4">Summary</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total item costs</span>
                        <span class="total-item-costs"></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 text-danger">
                        <span>Saved</span>
                        <span class="saved"></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Promo Code</span>
                        <span>
                            <input type="text" class="form-control form-control-sm" placeholder="Enter code">
                        </span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total shipping</span>
                        <span class="delivery-fee"></span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <strong>Total</strong>
                        <strong class="total-cost"></strong>
                    </div>
                    <button class="btn place-order-btn w-100">Place order</button>
                    <p class="text-muted mt-2 text-center" style="font-size: 12px;">
                        Upon clicking 'Place Order', I confirm I have read and acknowledged all
                        <a href="#" class="text-decoration-none">terms and policies</a>.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 payment-wrapper d-none">
                <div class="summary-section">
                    <h5 class="mb-4">Payment Details</h5>
                    <div class="mb-3">
                        <label for="cardholder-name" class="form-label">Cardholder's Name</label>
                        <input type="text" class="form-control form-control-sm" id="cardholder-name" placeholder="Enter cardholder's name">
                    </div>
                    <div class="mb-3">
                        <label for="card-number" class="form-label">Card Number</label>
                        <input type="text" class="form-control form-control-sm" id="card-number" placeholder="Enter card number">
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="expiration-date" class="form-label">Expiration</label>
                            <input type="text" class="form-control form-control-sm" id="expiration-date" placeholder="MM/YY">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="cvv" class="form-label">CVV</label>
                            <input type="text" class="form-control form-control-sm" id="cvv" placeholder="CVV">
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span class="subtotal"></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping</span>
                        <span class="delivery-fee"></span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <strong>Total</strong>
                        <strong class="total-cost"></strong>
                    </div>
                    <button class="btn place-order-btn w-100">Pay</button>
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

<!-- Payment Method Modal -->
<div class="modal fade" id="paymentMethodModal" tabindex="-1" aria-labelledby="paymentMethodModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header border-0">
          <h5 class="modal-title fw-bold" id="paymentMethodModalLabel">Choose payment method</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
          <!-- Payment Option 1: Credit or Debit Card -->
          <div class="payment-option d-flex align-items-center justify-content-between p-3 mb-3 border rounded">
            <div class="d-flex align-items-center">
              <img src="https://via.placeholder.com/50x30?text=Card" alt="Card Icon" class="me-3" style="width: 50px; height: 30px;">
              <div>
                <p class="mb-0 fw-bold">Credit or Debit Card</p>
              </div>
            </div>
            <input class="form-check-input" type="radio" name="paymentMethod" id="creditCardOption">
          </div>
          <!-- Payment Option 2: Cash on Delivery -->
          <div class="payment-option d-flex align-items-center justify-content-between p-3 mb-3 border rounded">
            <div class="d-flex align-items-center">
              <img src="https://via.placeholder.com/50x30?text=Cash" alt="Cash Icon" class="me-3" style="width: 50px; height: 30px;">
              <div>
                <p class="mb-0 fw-bold">Cash on Delivery</p>
              </div>
            </div>
            <input class="form-check-input" type="radio" name="paymentMethod" id="codOption">
          </div>
          <!-- Add New Card -->
          <div class="text-center">
            <a href="#" id="addNewCard" class="text-primary fw-bold text-decoration-none">+ Add new card</a>
          </div>
          <!-- Security Notice -->
          <div class="alert alert-success d-flex align-items-center mt-4 p-3 rounded-3">
            <i class="bi bi-shield-lock-fill me-2"></i>
            <small>We adhere entirely to the data security standards of the payment card industry.</small>
          </div>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-primary w-100 fw-bold" data-bs-dismiss="modal" aria-label="Close">Continue</button>
        </div>
      </div>
    </div>
  </div>


</html>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<script>
    var total = 0, discount = 0, deliveryFee = 300;

    $(document).ready(function () {
        function loadOrderData(cartIds) {
            $.ajax({
                url: '{{ route("order.data") }}',
                type: 'POST',
                data: {
                    cart_ids: cartIds,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.status) {
                        console.log(response.data);
                        renderOrderDetails(response.data);
                    } else {
                        alert(response.message || 'Failed to load order data.');
                    }
                },
                error: function (xhr) {
                    console.error('Error loading order data:', xhr);
                }
            });
        }

        function renderOrderDetails(data) {
            const address = data.user.address;
            $('.shipping-address').text(address);

            let itemsHTML = '';

            data.items.forEach(item => {
                let imageUrl = item.image ? `/storage/${item.image}` : '/images/placeholder.png';
                total += item.price * item.quantity;
                discount += item.discount || 0;

                itemsHTML += `
                    <div class="card-product p-3 mb-4">
                        <div class="d-flex">
                            <img src="${imageUrl}" alt="Product Image" class="product-image me-3">
                            <div>
                                <h6 class="mb-1">${item.name}</h6>
                                <p class="text-muted mb-1">${item.description}</p>
                                <p class="mb-0">LKR ${item.price}</p>
                            </div>
                        </div>
                    </div>`;
            });

            $('.order-items').append(itemsHTML);

            //Update the summary
            const totalCost = total + deliveryFee - discount;
            $('.total-item-costs').text(`LKR ${total}`);
            $('.delivery-fee').text(`LKR ${deliveryFee}`);
            $('.saved').text(`- LKR ${discount}`);
            $('.total-cost').text(`LKR ${totalCost}`);
        }

        //Fetch data for the initial load
        const cartIds = {!! json_encode(request('cart_ids', [])) !!};
        console.log("cart ids: ", cartIds);
        
        loadOrderData(cartIds);


        $(document).on('click', '.place-order-btn', function () {

            const paymentMethod = $('input[name="paymentMethod"]:checked').attr('id');
            console.log(paymentMethod);

            if (!paymentMethod) {
                alert("Please select a payment method before placing the order!");
                return;
            }

            if (paymentMethod === 'creditCardOption') {
                $('.summary-wrapper').addClass('d-none');
                $('.payment-wrapper').removeClass('d-none');
                
                console.log(total, discount, deliveryFee);

            }
        });

    });



</script>

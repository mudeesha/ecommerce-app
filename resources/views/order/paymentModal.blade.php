<head>
    <style>
       .custom-modal body {
            height: 100vh;
            justify-content: center;
            align-items: center;
            display: flex;
            background-color: #eee;
            z-index: 1101;
        }
        .custom-modal .launch {
            height: 50px;
        }
        .custom-modal .close {
            font-size: 21px;
            cursor: pointer;
        }
        .custom-modal .modal-body {
            height: 450px;
        }
        .custom-modal .nav-tabs {
            border: none !important;
        }
        .custom-modal .nav-tabs .nav-link.active {
            color: #495057;
            background-color: #fff;
            border-color: #ffffff #ffffff #fff;
            border-top: 3px solid blue !important;
        }
        .custom-modal .nav-tabs .nav-link {
            margin-bottom: -1px;
            border: 1px solid transparent;
            border-top-left-radius: 0rem;
            border-top-right-radius: 0rem;
            border-top: 3px solid #eee;
            font-size: 20px;
        }
        .custom-modal .nav-tabs .nav-link:hover {
            border-color: #e9ecef #ffffff #ffffff;
        }
        .custom-modal .nav-tabs {
            display: table !important;
            width: 100%;
        }
        .custom-modal .nav-item {
            display: table-cell;
        }
        .custom-modal .form-control {
            border-bottom: 1px solid #eee !important;
            border: none;
            font-weight: 600;
        }
        .custom-modal .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #8bbafe;
            outline: 0;
            box-shadow: none;
        }
        .custom-modal .inputbox {
            position: relative;
            margin-bottom: 20px;
            width: 100%;
        }
        .custom-modal .inputbox span {
            position: absolute;
            top: 7px;
            left: 11px;
            transition: 0.5s;
        }
        .custom-modal .inputbox i {
            position: absolute;
            top: 13px;
            right: 8px;
            transition: 0.5s;
            color: #3F51B5;
        }
        .custom-modal input::-webkit-outer-spin-button,
        .custom-modal input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .custom-modal .inputbox input:focus ~ span,
        .custom-modal .inputbox input:valid ~ span {
            transform: translateX(-0px) translateY(-15px);
            font-size: 12px;
        }
        .custom-modal .pay button {
            height: 47px;
            border-radius: 37px;
        }

    </style>
</head>


{{-- <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"> --}}
<div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
          <div class="modal-body">
             <div class="text-right">
                <i class="fa fa-close close" data-bs-dismiss="modal"></i>
             </div>
             <div class="tabs mt-3">
                <!-- Tabs for Payment Methods -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                   <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="visa-tab" data-toggle="tab" href="#visa" role="tab" aria-controls="visa" aria-selected="true">
                         <img src="https://i.imgur.com/sB4jftM.png" width="80">
                      </a>
                   </li>
                   <li class="nav-item" role="presentation">
                      <a class="nav-link" id="paypal-tab" data-toggle="tab" href="#paypal" role="tab" aria-controls="paypal" aria-selected="false">
                         <img src="https://i.imgur.com/yK7EDD1.png" width="80">
                      </a>
                   </li>
                </ul>
                <!-- Tab Content -->
                <div class="tab-content" id="myTabContent">
                   <div class="tab-pane fade show active" id="visa" role="tabpanel" aria-labelledby="visa-tab">
                      <div class="mt-4 mx-4">
                         <div class="text-center">
                            <h5>Credit card</h5>
                         </div>
                         <div class="form mt-3">
                            <!-- Cardholder Name -->
                            <div class="inputbox">
                               <input type="text" id="cardholder-name" name="cardholder_name" class="form-control" required="required">
                               <span>Cardholder Name</span>
                            </div>

                            <!-- Stripe Card Input -->
                            <div class="inputbox">
                               <div id="card-element" class="form-control"></div> <!-- Stripe will render the card input here -->
                               <span>Card Number</span>
                            </div>

                            <!-- Expiration Date and CVV -->
                            <div class="d-flex flex-row">
                               <div class="inputbox">
                                  <input type="text" id="expiration-date" name="expiration_date" class="form-control" required="required">
                                  <span>Expiration Date</span>
                               </div>
                               <div class="inputbox">
                                  <input type="text" id="cvv" name="cvv" class="form-control" required="required">
                                  <span>CVV</span>
                               </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="px-5 pay">
                               <button id="add-card-form" class="btn btn-success btn-block">Add Card</button>
                            </div>

                            <!-- Card errors display -->
                            <div id="card-errors" role="alert"></div>
                         </div>
                      </div>
                   </div>
                   <!-- Paypal Tab -->
                   <div class="tab-pane fade" id="paypal" role="tabpanel" aria-labelledby="paypal-tab">
                      <div class="px-5 mt-5">
                         <div class="inputbox">
                            <input type="text" name="paypal-email" class="form-control" required="required">
                            <span>Paypal Email Address</span>
                         </div>
                         <div class="pay px-5">
                            <button class="btn btn-primary btn-block">Add Paypal</button>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ config('services.stripe.key') }}');
</script>


<script>
    $(document).ready(function () {

        const stripe = Stripe('{{ config("services.stripe.key") }}');  // Your Stripe public key
        const elements = stripe.elements();
        let card = null;

        // Initialize Stripe elements only when the modal is shown
        $('#staticBackdrop').on('shown.bs.modal', function () {
            console.log("Modal is now open");

            // Create the Stripe card element if it hasn't been created yet
            if (!card) {
                // Create the card element only once
                card = elements.create('card', {
                    style: {
                        base: {
                            fontSize: '16px',
                            color: '#32325d',
                            '::placeholder': {
                                color: '#aab7c4'
                            }
                        },
                        invalid: {
                            color: '#fa755a',
                            iconColor: '#fa755a'
                        }
                    }
                });

                // Mount the card element to the div with id 'card-element'
                card.mount('#card-element');

                // Handle real-time validation errors
                card.addEventListener('change', function (event) {
                    const displayError = document.getElementById('card-errors');
                    if (event.error) {
                        displayError.textContent = event.error.message;
                    } else {
                        displayError.textContent = '';
                    }
                });
            }
        });

        // Handle form submission (click event on the "Add Card" button)
        $(document).on('click', '#add-card-form', function (e) {
            e.preventDefault();

            // Get the cardholder name
            const cardholderName = $('#cardholder-name').val().trim();
            if (!cardholderName) {
                alert('Please enter the cardholder name.');
                return;
            }

            // Create a Stripe payment method from the card element
            stripe.createPaymentMethod({
                type: 'card',
                card: card,
                billing_details: { name: cardholderName }
            }).then(function (result) {
                if (result.error) {
                    // Display error in #card-errors div
                    const errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // If the PaymentMethod is created, send it to the server
                    saveCardToServer(result.paymentMethod.id);  // Use paymentMethod.id instead of token.id
                }
            });
        });

        // Send the paymentMethod ID to the server
        function saveCardToServer(paymentMethodId) {
            $.ajax({
                url: '/add-card',
                type: 'POST',
                data: {
                    paymentMethodId: paymentMethodId,
                    cardholder_name: $('#cardholder-name').val().trim(),
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.status==false) {
                        swal(response.message);
                        console.error(response.error);
                    } else {
                        if(response.error="card_exist"){
                            swal(response.message);
                        } else {
                            swal(response.message);
                        }
                    }
                },
                error: function (xhr) {
                    console.log('Request failed: ' + xhr.responseText);
                }
            });
        }
    });


</script>



<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Handlers\Customer\OrderHandler;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\PaymentMethod;
use App\Models\Card;
use Stripe\PaymentIntent;
use App\Mail\PaymentSuccessMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class PaymentController extends Controller
{

    public function addCard(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'cardholder_name' => 'required|string',
            'paymentMethodId' => 'required|string',
        ]);

        try {
            // Set Stripe API Key
            Stripe::setApiKey(config('services.stripe.secret'));

            // Assuming you have authenticated users
            $user = auth()->user();

            // Create or retrieve a Stripe customer
            if (!$user->stripe_customer_id) {
                $customer = Customer::create([
                    'email' => $user->email,
                ]);
                $user->stripe_customer_id = $customer->id;
                $user->save();
            } else {
                $customer = Customer::retrieve($user->stripe_customer_id);
            }

            // Attach the PaymentMethod to the customer
            $paymentMethodId = $request->paymentMethodId; // Get the paymentMethodId from the request

            // Attach the payment method
            $paymentMethod = PaymentMethod::retrieve($paymentMethodId);
            $paymentMethod->attach(['customer' => $customer->id]);
            \Log::error("customer id: " . $paymentMethod->customer);


            // Check if the card already exists
            $existingCard = Card::where('stripe_card_id', $paymentMethod->id)->first();

            if (!$existingCard) {
                // Save the card details in the database only if it doesn't already exist
                Card::create([
                    'user_id' => $user->id,
                    'cardholder_name' => $request->cardholder_name,
                    'stripe_card_id' => $paymentMethod->id,
                    'card_last4' => $paymentMethod->card->last4,
                    'stripe_customer_id' => $paymentMethod->customer,
                    'expiration_date' => $paymentMethod->card->exp_month . '/' . $paymentMethod->card->exp_year, // Format expiration date as MM/YYYY
                ]);

                return response()->json(['status' => true, 'error'=>'', 'message' => 'Card added successfully']);
            } else {
                return response()->json(['status' => true, 'error' => 'card_exist', 'message' => 'Card already exists in the database']);
            }
        } catch (\Exception $e) {
            // Log the error message for debugging purposes
            \Log::error("Error adding card: " . $e->getMessage());

            return response()->json(['status' => false, 'error' => $e->getMessage(), 'message' => 'card adind faield, please contact support team.']);
        }
    }


    public function makePayment(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'amount' => 'required|numeric|min:0.5', // Minimum charge of 50 cents
        ]);

        try {
            // Set Stripe API Key
            Stripe::setApiKey(config('services.stripe.secret'));

            $user = auth()->user();

            // Retrieve default card for the user
            $card = Card::where('user_id', $user->id)->first();
            \Log::debug("user card: " . $card);
            if (!$card) {
                \Log::debug("card not found: ");
                return response()->json(['status' => false, 'error'=>'card_not_found', 'message' => 'No card found for this user']);
            }

            // Retrieve the order data from the session
            $orderData = session('order_data');
            $prices = session('order_prices');
            $orderAddress = session('order_address');

            // \Log::debug($orderData);
            // \Log::debug($prices);
            // \Log::debug($orderAddress);


            if (!$orderData) {
                \Log::debug("order data not found");
                return response()->json(['status' => false, 'error'=>'order_not_found', 'message' => 'Order data not found']);
            } elseif (!$prices){
                \Log::debug("prices not found");
                return response()->json(['status' => false, 'error'=>'prices_not_found', 'message' => 'Prices not found']);
            } elseif (!$orderAddress) {
                \Log::debug("address data not found");
                return response()->json(['status' => false, 'error'=>'address_not_found', 'message' => 'Address not found']);
            }

            try {
                //create order
                $orderHandler = new OrderHandler();

                $createdOrderId = $orderHandler->createOrder($user->id, $orderData, $prices, $orderAddress, $paymentType = 'card', $paymentStatus = 'pending');
                \Log::debug("order created!");
                try{
                    // Create a PaymentIntent
                    $paymentIntent = PaymentIntent::create([
                        'amount' => $request->amount * 100, // Amount in cents
                        'currency' => 'lkr',
                        'customer' => $card->stripe_customer_id,
                        'payment_method' => $card->stripe_card_id,
                        'off_session' => true,
                        'confirm' => true,
                    ]);
                    \Log::debug("payment success");

                    // Update the order payment status to 'done'
                    $orderHandler->updateOrderPaymentStatus($createdOrderId, 'done');
                    \Log::debug("Payment order status to done: " . $createdOrderId);

                    // Send the success email
                    \Log::debug("Created order ID: " . $createdOrderId . ", Type: " . gettype($createdOrderId));
                    Mail::to($user->email)->send(new PaymentSuccessMail($user, $orderData, $createdOrderId, $prices));
                    \Log::debug("Payment success email sent to: " . $user->email);

                    return response()->json([
                        'message' => 'Payment Success!.',
                        'status' => true,
                    ], 200);

                }catch(\Exception $e){
                    // Return Stripe error
                    \Log::error("Stripe payment failed: " . $e->getMessage());
                    return response()->json([
                        'message' => 'Payment failed, please try again.',
                        'details' => $e->getMessage()
                    ], 500);
                }

            } catch(\Exception $e) {
                // Return Stripe error
                \Log::error("Stripe payment failed: " . $e->getMessage());
                return response()->json([
                    'message' => 'Payment failed, please try again.',
                    'details' => $e->getMessage()
                ], 500);
            }
            \Log::debug("end ");

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }


}

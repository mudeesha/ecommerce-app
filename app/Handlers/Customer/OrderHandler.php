<?php

namespace App\Handlers\Customer;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Handlers\ProductHandler;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;

class OrderHandler
{
    public function fetchOrderDetails(array $cartIds)
    {
        $items = Cart::with('product')
            ->whereIn('id', $cartIds)
            ->get()
            ->map(function ($cart) {
                return [
                    'id' => $cart->id,
                    'name' => $cart->product->name,
                    'price' => $cart->product->price,
                    'quantity' => $cart->quantity,
                    'discount' => $cart->product->discount ?? 0,
                    'image' => $cart->product->main_image_url ?? '/images/placeholder.png',
                    'description' => $cart->product->description
                ];
            });

        $user = User::find(auth()->id());

        return [
            'items' => $items,
            'user' => [
                'address' => $user->address ?? 'No address found'
            ]
        ];
    }

    public function createOrder($userId, $orderData, $prices, $orderAddress, $paymentType, $paymentStatus)
    {
        DB::beginTransaction();

        try {
            // Combine the shipping address into a single string
            $shippingAddress = implode(", ", array_filter([
                $orderAddress['address_line1'],
                $orderAddress['address_line2'],
                $orderAddress['address_line3'],
                $orderAddress['district'],
                $orderAddress['zip_code'],
            ]));

            // Calculate total price including shipping
            $totalPrice = $prices[0]['cartTotal'] + $prices[0]['shipping'];

            // Create the order
            $order = Order::create([
                'user_id' => $userId,
                'shipping_address' => $shippingAddress,
                'total_price' => $totalPrice,
                'payment_type' => $paymentType,
                'payment_status' => $paymentStatus,
            ]);

            // Add each item in the order
            foreach ($orderData as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['newPrice'],
                ]);
            }

            DB::commit();
            try {
                $producthandler = new ProductHandler;
                $producthandler->updateProductStockAfterPayment($orderData);
                \Log::debug('updated product table!');

            } catch (\Exception $e){
                \Log::error('Error updating product table after order: ' . $e->getMessage());
            }

            //Return the created order's ID
            return $order->id;

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error creating order: ' . $e->getMessage());
            throw $e;
        }

    }

    public function updateOrderPaymentStatus($orderId, $status) {
        try {
            $order = Order::find($orderId);
            if ($order) {
                $order->payment_status = $status;
                $order->save();
                \Log::debug("Order payment status updated to 'done'.");
            } else {
                \Log::warning("Order not found for Order ID: " . $orderId);
            }
        } catch (\Exception $e) {
            \Log::error("Failed to update order payment status: " . $e->getMessage());
        }
    }

    public function clearOrderSession($orderData, $prices, $orderAddress)
    {
        \Log::debug('Clearing order session:');
        \Log::debug('Order Data: ' . json_encode($orderData));
        \Log::debug('Prices: ' . json_encode($prices));
        \Log::debug('Order Address: ' . json_encode($orderAddress));

        try {
            //clear the session data
            session()->forget('order_data');
            session()->forget('order_prices');
            session()->forget('order_address');
        } catch(\Exception $e){
            \Log::error("Order session cleared faield: " . $e->getMessage());
        }

        \Log::debug('Order session cleared successfully.');
    }







}

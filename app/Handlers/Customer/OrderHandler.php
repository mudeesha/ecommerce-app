<?php

namespace App\Handlers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;

class OrderHandler
{
    public function createOrder(array $data)
    {
        $user = auth()->user(); // Get the authenticated user

        // Create the order
        $order = Order::create([
            'user_id' => $user->id,
            'shipping_address' => $user->shipping_address, // Use the address from the user table
            'payment_method' => $data['payment_method'],
            'total_amount' => $this->calculateTotalAmount($data['cart_items']),
        ]);

        // Add items to the order
        foreach ($data['cart_items'] as $item) {
            $cart = Cart::find($item['id']);
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $item['quantity'],
                'price' => $cart->product->price,
            ]);
        }

        // Remove cart items
        Cart::whereIn('id', array_column($data['cart_items'], 'id'))->delete();

        return $order;
    }

    private function calculateTotalAmount($cartItems)
    {
        $total = 0;
        foreach ($cartItems as $item) {
            $cart = Cart::find($item['id']);
            $total += $cart->product->price * $item['quantity'];
        }
        return $total;
    }
}

<?php

namespace App\Handlers\Customer;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;

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


}

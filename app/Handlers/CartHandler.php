<?php

namespace App\Handlers;

use App\Models\Cart;

use Exception;

class CartHandler
{

    public function fetchCartDetails()
    {
        $userId = auth()->id();
        return Cart::where('user_id', $userId)->with('product')->get();
    }

    public function add(array $data): void
    {
        \Log::alert('p-id: ', $data);
        try {
            Cart::create([
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'user_id' => auth()->id(),
            ]);
        } catch (Exception $e) {
            \Log::error('Error adding product to cart', [
                'user_id' => auth()->id(),
                'data' => $data,
                'error' => $e->getMessage(),
            ]);
            throw new Exception('Error adding product to cart: ' . $e->getMessage());
        }
    }

    public function updateCartItem($data)
    {
        $cartItem = Cart::where('id', $data['cart_id'])
            ->where('user_id', auth()->id())
            ->first();

        if ($cartItem) {
            $cartItem->update(['quantity' => $data['quantity']]);
            return ['message' => 'Cart updated successfully!', 'status' => true];
        }

        return ['message' => 'Cart item not found.', 'status' => false];
    }

    public function removeCartItem($data)
    {
        $cartItem = Cart::where('id', $data['cart_id'])
            ->where('user_id', auth()->id())
            ->first();

        if ($cartItem) {
            $cartItem->delete();
            return ['message' => 'Item removed from cart.', 'status' => true];
        }

        return ['message' => 'Cart item not found.', 'status' => false];
    }
}

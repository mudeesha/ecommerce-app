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

    public function add(array $data)
    {
        try {
            $exists = Cart::where('product_id', $data['product_id'])
                ->where('user_id', auth()->id())
                ->exists();

            if ($exists) {
                return response()->json(['error' => 'This item is already added to the cart'], 400);
            }

            Cart::create([
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'user_id' => auth()->id(),
            ]);

            return response()->json(['message' => 'Item added to cart successfully'], 200);
        } catch (Exception $e) {
            \Log::error('Error adding product to cart', [
                'user_id' => auth()->id(),
                'data' => $data,
                'error' => $e->getMessage(),
            ]);

            return response()->json(['error' => 'An error occurred while adding the item to the cart.'], 500);
        }
    }

    public function updateCartItem($data)
    {
        $cartItem = Cart::where('id', $data['id'])
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
        try {
            // Delete the selected cart items
            Cart::whereIn('id', $data['itemIds'])->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete items. Please try again.']);
        }
    }
}

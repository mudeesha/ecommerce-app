<?php

namespace App\Http\Requests\User\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderAddRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'shipping_address' => 'required|string|max:255',
            'payment_method' => 'required|string|max:50',
            'cart_items' => 'required|array',
            'cart_items.*.id' => 'required|exists:carts,id',
            'cart_items.*.quantity' => 'required|integer|min:1',
        ];
    }
}

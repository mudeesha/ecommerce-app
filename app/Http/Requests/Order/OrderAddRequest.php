<?php

namespace App\Http\Requests\Order;

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
            'cart_ids' => 'required|array|min:1',
            'cart_ids.*' => 'exists:carts,id',
        ];
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Requests\User\Cart\CartAddRequest;
use App\Http\Requests\User\Cart\CartUpdateRequest;
use App\Http\Requests\User\Cart\CartRemoveRequest;
use App\Services\User\CartService;
use Illuminate\Http\JsonResponse;


class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cartDetails = $this->cartService->getCartDetails();
        return view('cart.index');
    }

    public function fetch()
    {
        $cartDetails = $this->cartService->getCartDetails();
        return response()->json(['status' => true, 'data' => $cartDetails]);
    }

    public function store(CartAddRequest $request): JsonResponse
    {
        try {
            return $this->cartService->addCart($request->validated());
        } catch (Exception $e) {
            \Log::error('Error adding to Cart: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to add to Cart'], 500);
        }
    }

    public function update(CartUpdateRequest $request)
    {
        $response = $this->cartService->updateCartItem($request->validated());
        return response()->json($response);
    }

    public function remove(CartRemoveRequest $request)
    {
        // Retrieve the validated cart IDs
        $cartIds = $request->validated()['cart_ids'];

        // Pass the cart IDs to the service
        $response = $this->cartService->removeCartItem(['itemIds' => $cartIds]);

        return response()->json($response);
    }
}

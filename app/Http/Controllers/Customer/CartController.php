<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Requests\User\Cart\CartAddRequest;
use App\Http\Requests\User\Cart\CartUpdateRequest;
use App\Http\Requests\User\Cart\CartRemoveRequest;
use App\Services\Customer\CartService;
use App\Services\Customer\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;


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
            //Extract the product ID and quantity from the request
            $productId = $request->validated()['product_id'];
            $quantity = $request->validated()['quantity'];

            $productService = new ProductService();
            $productService->checkAvailability($productId, $quantity);

            $isAvailable = $productService->checkAvailability($productId, $quantity);

            if (!$isAvailable) {
                return response()->json(['error' => 'Insufficient stock for the requested quantity'], 400);
            }

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
        try {
            // Retrieve the validated cart IDs
            $cartIds = $request->validated()['cart_ids'];

            $this->cartService->removeCartItem(['itemIds' => $cartIds]);
            return response()->json(['message' => 'Cart item(s) deleted successfully']);
        } catch (Exception $e) {
            \Log::error('Error deleting cart item(s): ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}

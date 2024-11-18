<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Requests\User\Cart\CartAddRequest;
use App\Services\User\CartService;
use Illuminate\Http\JsonResponse;


class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CartAddRequest $request): JsonResponse
    {
        try {
            $this->cartService->addCart($request->validated());
            return response()->json(['message' => 'Added into the Cart successfully'], 201);
        } catch (Exception $e) {
            \Log::error('Error adding to Cart: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to add to Cart'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}

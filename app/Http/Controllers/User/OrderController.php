<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderAddRequest;
use App\Services\User\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Exception\CardException;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function create(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'cart' => 'required|array',
            'prices' => 'required|array',
        ]);

        $cartData = $request->input('cart');  // Cart items
        $prices = $request->input('prices');

        $user = auth()->user();
        $address = $user->address;

        session(['order_data' => $cartData, 'order_prices' => $prices, 'order_address' => $address]);
        return response()->json(['status' => true]);
    }

    public function index()
    {
        $order = session('order_data');
        $prices = session('order_prices');
        $order_address = session('order_address');

        // Pass both the order data and prices to the view
        return view('order.index', compact('order', 'prices', 'order_address'));
    }



}

<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderAddRequest;
use App\Services\Customer\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Exception\CardException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\OrderItem;


class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function create(Request $request)
    {
        //Validate incoming request
        $request->validate([
            'cart' => 'required|array',
            'prices' => 'required|array',
        ]);

        $cartData = $request->input('cart');  // Cart items
        $prices = $request->input('prices');
        \Log::debug('cart items: ' , (array)$cartData );

        $user = auth()->user();

        $address = [
            'address_line1' => $user->address_line1,
            'address_line2' => $user->address_line2,
            'address_line3' => $user->address_line3,
            'district' => $user->district,
            'zip_code' => $user->zip_code,
        ];

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

    public function orders()
    {

        // Pass both the order data and prices to the view
        return view('order.order_list');
    }

    public function getAll(){
        try {
            $orderItems = OrderItem::with('order')
            ->whereHas('order', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();

            if ($orderItems->isEmpty()) {
                return response()->json([
                    'message' => 'No order items found for the user.',
                    'data' => []
                ]);
            }

            return response()->json($orderItems->toArray());
        } catch (\Exception $e) {
            return $e;
        }
    }


}

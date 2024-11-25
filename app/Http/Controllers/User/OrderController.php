<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderAddRequest;
use App\Services\User\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function loadOrder(OrderAddRequest $request)
    {
        return view('order/index', ['cart_ids' => $request->cart_ids]);
    }

    public function getOrderData(OrderAddRequest $request)
    {
        $data = $this->orderService->getOrderDetails($request->validated());
        return response()->json(['status' => true, 'data' => $data]);
    }

}

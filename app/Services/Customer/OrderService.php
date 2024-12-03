<?php

namespace App\Services\Customer;

use App\Handlers\Customer\OrderHandler;
use Illuminate\Support\Facades\DB;

class OrderService
{
    protected $orderHandler;

    public function __construct(OrderHandler $orderHandler)
    {
        $this->orderHandler = $orderHandler;
    }

    public function getOrderDetails(array $data)
    {
        return $this->orderHandler->fetchOrderDetails($data['cart_ids']);
    }
}

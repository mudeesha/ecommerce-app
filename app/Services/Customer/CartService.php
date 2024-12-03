<?php

namespace App\Services\Customer;

use App\Handlers\CartHandler;
use Exception;

class CartService
{
    protected $cartHandler;

    public function __construct(CartHandler $cartHandler)
    {
        $this->cartHandler = $cartHandler;
    }

    public function addCart(array $data)
    {
        return $this->cartHandler->add($data);
    }

    // Fetch cart details
    public function getCartDetails()
    {
        return $this->cartHandler->fetchCartDetails();
    }

    // Update cart item
    public function updateCartItem($data)
    {
        return $this->cartHandler->updateCartItem($data);
    }

    // Remove cart item
    public function removeCartItem($data)
    {
        return $this->cartHandler->removeCartItem($data);
    }
}

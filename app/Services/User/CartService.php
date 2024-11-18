<?php

namespace App\Services\User;

use App\Handlers\CartHandler;
use Exception;

class CartService
{
    protected $carttHandler;

    public function __construct(CartHandler $carttHandler)
    {
        $this->carttHandler = $carttHandler;
    }

    public function addCart(array $data)
    {
        $this->carttHandler->add($data);
    }

    // public function fetchProducts(array $params)
    // {
    //     return $this->productHandler->index($params);
    // }

    // public function getProductById($id)
    // {
    //     return $this->productHandler->fetchProductById($id);
    // }

    // public function updateProduct(array $data, $id)
    // {
    //     $this->productHandler->updateProduct($data, $id);
    // }

    // public function deleteProduct($id)
    // {
    //     $this->productHandler->deleteProduct($id);
    // }
}

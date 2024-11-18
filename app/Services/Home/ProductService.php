<?php

namespace App\Services\Home;

use App\Handlers\ProductHandler;
use Exception;

class ProductService
{
    protected $productHandler;

    public function __construct(ProductHandler $productHandler)
    {
        $this->productHandler = $productHandler;
    }


    public function fetchProducts(array $params)
    {
        return $this->productHandler->index($params);
    }


    public function getProductById($id)
    {
        return $this->productHandler->fetchProductById($id);
    }

    public function updateProduct(array $data, $id)
    {
        $this->productHandler->updateProduct($data, $id);
    }

    public function deleteProduct($id)
    {
        $this->productHandler->deleteProduct($id);
    }
}

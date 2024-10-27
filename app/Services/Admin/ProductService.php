<?php

namespace App\Services\Admin;

use App\Handlers\Admin\ProductHandler;
use Exception;

class ProductService
{
    protected $productHandler;

    public function __construct(ProductHandler $productHandler)
    {
        $this->productHandler = $productHandler;
    }

    public function index(array $params)
    {
        return $this->productHandler->index($params);
    }

    public function store(array $data)
    {
        return $this->productHandler->store($data);
    }

    public function fetchProductById($id)
    {
        return $this->productHandler->fetchProductById($id);
    }

    public function update(array $data, $id)
    {
        return $this->productHandler->update($data, $id);
    }

    public function delete($id)
    {
        return $this->productHandler->delete($id);
    }
}

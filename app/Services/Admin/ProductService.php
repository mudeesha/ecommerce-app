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

    public function fetchProducts(array $params)
    {
        return $this->productHandler->index($params);
    }

    public function addProduct(array $data)
    {
        // Check if there is an image file in the data
        if (isset($data['main_image_url']) && $data['main_image_url'] instanceof \Illuminate\Http\UploadedFile) {
            $imagePath = $data['main_image_url']->store('admin/product_images', 'public');
            $data['main_image_url'] = $imagePath; // Store the path to be saved in the database
        }

        $this->productHandler->store($data);

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

<?php

namespace App\Services\Admin;

use App\Handlers\Admin\CategoryHandler;
use Exception;

class CategoryService
{
    protected $categoryHandler;

    public function __construct(CategoryHandler $categoryHandler)
    {
        $this->categoryHandler = $categoryHandler;
    }

    public function fetchCategories(array $params)
    {
        return $this->categoryHandler->index($params);
    }

    public function addCategory(array $data)
    {
        $this->categoryHandler->store($data);
    }

    public function getCategoryById($id)
    {
        return $this->categoryHandler->fetchCategoryById($id);
    }

    public function updateCategory(array $data, $id)
    {
        $this->categoryHandler->updateCategory($data, $id);
    }

    public function deleteCategory($id)
    {
        $this->categoryHandler->deleteCategory($id);
    }
}

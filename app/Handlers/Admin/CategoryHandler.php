<?php

namespace App\Handlers\Admin;

use App\Models\category;
use Exception;

class CategoryHandler
{
    public function fetchCategories(array $params)
    {
        $search = $params['search'] ?? null;

        \Log::info('Searching categories with parameters:', $params); // Log parameters

        try {
            $categories = category::when($search, function($query) use ($search) {
                return $query->where('category_name', 'LIKE', '%' . $search . '%');
            })->paginate(7);

            return $categories;
        } catch (Exception $e) {
            \Log::error('Error fetching categories: ' . $e->getMessage()); // Log the error
            throw new Exception('Error fetching categories: ' . $e->getMessage());
        }
    }



    public function createCategory(array $data)
    {
        try {
            $category = new Category();
            $category->category_name = $data['category_name'];
            $category->save();
        } catch (Exception $e) {
            throw new Exception('Error adding category: ' . $e->getMessage());
        }
    }

    //
}

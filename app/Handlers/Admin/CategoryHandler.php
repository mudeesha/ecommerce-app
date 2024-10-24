<?php

namespace App\Handlers\Admin;

use App\Models\category;
use Exception;

class CategoryHandler
{
    public function index(array $params)
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



    public function store(array $category_inputs)
    {
        try {
            $category = new Category();
            $category->category_name = $category_inputs['category_name'];
            $category->save();
        } catch (Exception $e) {
            throw new Exception('Error adding category: ' . $e->getMessage());
        }
    }

    public function fetchCategoryById($id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                throw new Exception('Category not found');
            }

            return $category;
        } catch (Exception $e) {
            throw new Exception('Error fetching category: ' . $e->getMessage());
        }
    }

    public function updateCategory(array $data, $id)
    {
        try {
            // Find category by ID
            $category = Category::findOrFail($id);

            // Update category name
            $category->category_name = $data['category_name'];
            $category->save();

            return ['success' => true, 'message' => 'Category Updated Successfully.'];
        } catch (Exception $e) {
            throw new Exception('Error updating category: ' . $e->getMessage());
        }
    }

    public function deleteCategory($id)
    {
        try {
            $category = Category::find($id);
            if ($category) {
                $category->delete();
                return ['message' => 'Category deleted successfully!'];
            } else {
                throw new Exception('Category not found.');
            }
        } catch (Exception $e) {
            throw new Exception('Error deleting category: ' . $e->getMessage());
        }
    }
}

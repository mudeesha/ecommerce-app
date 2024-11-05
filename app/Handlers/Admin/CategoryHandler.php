<?php

namespace App\Handlers\Admin;

use App\Models\Category;
use App\Models\AdminLog;
use App\Services\Admin\AdminLogService;

use Exception;

class CategoryHandler
{
    protected $adminLogService;

    public function __construct(AdminLogService $adminLogService)
    {
        $this->adminLogService = $adminLogService;
    }

    public function index(array $params)
    {
        $search = $params['search'] ?? null;

        try {
            return Category::when($search, function($query) use ($search) {
                return $query->where('name', 'LIKE', '%' . $search . '%');
            })->paginate(7);
        } catch (Exception $e) {
            throw new Exception('Error fetching categories: ' . $e->getMessage());
        }
    }

    public function store(array $data)
    {
        try {
            $category = new Category();
            $category->name = $data['name'];
            $category->created_by = auth()->id();
            $category->save();

            $this->adminLogService->logAction(auth()->id(), 'create', 'categories', $category->id, 'Created a new category');

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
            $category = Category::findOrFail($id);
            $originalData = $category->getOriginal();

            $category->fill($data);
            $category->save();

            $this->adminLogService->logAction(auth()->id(), 'update', 'categories', $category->id, 'Update a category', $originalData, $data);
            
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

                $this->adminLogService->logAction(auth()->id(), 'delete', 'categories', $category->id, 'Deleate a category');
            } else {
                throw new Exception('Category not found.');
            }
        } catch (Exception $e) {
            throw new Exception('Error deleting category: ' . $e->getMessage());
        }
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CategoryAddRequest;
use App\Http\Requests\Admin\CategoryFetchRequest;
use App\Http\Requests\Admin\CategoryShowRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Http\Requests\Admin\CategoryDeleteRequest;
use App\Services\Admin\CategoryService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Exception;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(CategoryFetchRequest $request): JsonResponse
    {
        try {
            $categories = $this->categoryService->fetchCategories($request->validated());
            return response()->json($categories);
        } catch (Exception $e) {
            \Log::error('Error fetching categories: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching categories.'], 500);
        }
    }

    public function store(CategoryAddRequest $request): JsonResponse
    {
        try {
            $this->categoryService->addCategory($request->validated());
            return response()->json(['message' => 'Category added successfully'], 201);
        } catch (Exception $e) {
            \Log::error('Error adding category: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to add category'], 500);
        }
    }

    public function show(CategoryShowRequest $request, $id): JsonResponse
    {
        try {
            $category = $this->categoryService->getCategoryById($id);
            return response()->json($category);
        } catch (Exception $e) {
            \Log::error('Error fetching category: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching the category.'], 500);
        }
    }

    public function update(CategoryUpdateRequest $request, $id): JsonResponse
    {
        try {
            $this->categoryService->updateCategory($request->validated(), $id);
            return response()->json(['message' => 'Category updated successfully']);
        } catch (Exception $e) {
            \Log::error('Error updating category: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update category'], 500);
        }
    }

    public function destroy(CategoryDeleteRequest $request, $id): JsonResponse
    {
        try {
            $this->categoryService->deleteCategory($id);
            return response()->json(['message' => 'Category deleted successfully']);
        } catch (Exception $e) {
            \Log::error('Error deleting category: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}

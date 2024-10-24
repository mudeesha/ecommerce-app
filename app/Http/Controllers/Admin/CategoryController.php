<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CategoryAddRequest;
use App\Http\Requests\Admin\CategoryFetchRequest;
use App\Http\Requests\Admin\CategoryShowRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Http\Requests\Admin\CategoryDeleteRequest;
use App\Handlers\Admin\CategoryHandler;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $categoryHandler;

    public function __construct(CategoryHandler $categoryHandler)
    {
        $this->categoryHandler = $categoryHandler;
    }


    public function index(CategoryFetchRequest $request): JsonResponse
    {
        try {
            $categories = $this->categoryHandler->index($request->validated());
            return response()->json($categories);
        } catch (Exception $e) {
            \Log::error('Error fetching categories: ' . $e->getMessage()); // Log the error
            return response()->json([
                'error' => 'An error occurred while fetching categories.',
                'message' => $e->getMessage() // Provide more detail here
            ], 500);
        }
    }


    public function store(CategoryAddRequest $request): JsonResponse
    {
        try {
            $this->categoryHandler->store($request->validated());
            toastr()->closeButton()->success('Category Added Successfully.');

            return response()->json(['message' => 'Category added successfully'], 201);
        } catch (Exception $e) {
            \Log::error('Error adding category: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to add category'], 500);
        }
    }

    public function show(CategoryShowRequest $request, $id): JsonResponse
    {
        try {
            $category = $this->categoryHandler->fetchCategoryById($id);
            return response()->json($category);
        } catch (Exception $e) {
            \Log::error('Error fetching category: ' . $e->getMessage());
            return response()->json([
                'error' => 'An error occurred while fetching the category.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(CategoryUpdateRequest $request, $id): JsonResponse
    {
        try {
            // Use handler to process the update
            $result = $this->categoryHandler->updateCategory($request->validated(), $id);

            // Show toastr message for success (optional)
            toastr()->closeButton()->success($result['message']);

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            \Log::error('Error updating category: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update category'], 500);
        }
    }

    public function destroy(CategoryDeleteRequest $request, $id): JsonResponse
    {
        try {
            // Use handler to process the deletion
            $result = $this->categoryHandler->deleteCategory($id);
            return response()->json(['message' => $result['message']]);
        } catch (Exception $e) {
            \Log::error('Error deleting category: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}


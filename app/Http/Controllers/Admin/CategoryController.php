<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CategoryAddRequest;
use App\Http\Requests\Admin\CategoryFetchRequest;
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


    public function getCategories(CategoryFetchRequest $request): JsonResponse
    {
        try {
            $categories = $this->categoryHandler->fetchCategories($request->validated());
            return response()->json($categories);
        } catch (Exception $e) {
            \Log::error('Error fetching categories: ' . $e->getMessage()); // Log the error
            return response()->json([
                'error' => 'An error occurred while fetching categories.',
                'message' => $e->getMessage() // Provide more detail here
            ], 500);
        }
    }


    public function addCategory(CategoryAddRequest $request): JsonResponse
    {
        // Automatically validated by CategoryAddRequest
        try {
            $this->categoryHandler->createCategory($request->validated());
            toastr()->closeButton()->success('Category Added Successfully.');

            return response()->json(['message' => 'Category added successfully'], 201);
        } catch (Exception $e) {
            \Log::error('Error adding category: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to add category'], 500);
        }
    }

    // Other admin product management methods...
}


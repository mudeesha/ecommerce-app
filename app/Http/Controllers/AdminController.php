<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use Flasher\Toastr\Prime\ToastrInterface;

class AdminController extends Controller
{
    public function view_category() {
        return view('admin.category');
    }

    public function getCategories(Request $request) {
        $search = $request->input('search');
        $perPage = 7; // Number of items per page

        $categories = Category::when($search, function($query, $search) {
            return $query->where('category_name', 'LIKE', '%' . $search . '%');
        })->paginate($perPage);

        return response()->json($categories);
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        try {
            $category = new Category();
            $category->category_name = $request->category_name;
            $category->save();
            toastr()->closeButton()->success('Category Added Successfully.');

            return response()->json(['message' => 'Category added successfully'], 201);
        } catch (\Exception $e) {
            \Log::error('Error adding category: '.$e->getMessage());
            return response()->json(['error' => 'Failed to add category'], 500);
        }
    }

    public function deleteCategory($id) {
        $category = Category::find($id);

        if ($category) {
            $category->delete();
            return response()->json(['message' => 'Category deleted successfully!']);
        } else {
            return response()->json(['error' => 'Category not found.'], 404);
        }
    }


    public function get_category($id) {
        $category = Category::find($id);
        return response()->json($category);
    }

    public function update_category(Request $request, $id) {
        $category = Category::find($id);
        $category->category_name = $request->category_name;
        $category->save();
        toastr()->closeButton()->success('Category Updated Successfully.');

        return response()->json(['success' => true]);
    }


}

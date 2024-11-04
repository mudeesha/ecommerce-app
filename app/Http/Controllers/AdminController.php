<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Product;
use Flasher\Toastr\Prime\ToastrInterface;

class AdminController extends Controller
{

    //product
    public function returnView() {
        return view('admin.product');
    }

    public function index(Request $request) {
        $search = $request->input('search');
        $perPage = 7; // Number of items per page

        $data = Product::when($search, function($query, $search) {
            return $query->where('title', 'LIKE', '%' . $search . '%');
        })->paginate($perPage);

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $category = new Category();
            $category->name = $request->name;
            $category->save();
            toastr()->closeButton()->success('Category Added Successfully.');

            return response()->json(['message' => 'Category added successfully'], 201);
        } catch (\Exception $e) {
            \Log::error('Error adding category: '.$e->getMessage());
            return response()->json(['error' => 'Failed to add category'], 500);
        }
    }

    public function destroy($id) {
        $category = Category::find($id);

        if ($category) {
            $category->delete();
            return response()->json(['message' => 'Category deleted successfully!']);
        } else {
            return response()->json(['error' => 'Category not found.'], 404);
        }
    }


    public function show($id) {
        $category = Category::find($id);
        return response()->json($category);
    }

    public function update(Request $request, $id) {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        toastr()->closeButton()->success('Category Updated Successfully.');

        return response()->json(['success' => true]);
    }
}

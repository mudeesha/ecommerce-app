<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use Flasher\Toastr\Prime\ToastrInterface;

class AdminController extends Controller
{
    public function view_category() {
        $data = category::all();
        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request) {

        $category = new Category;
        $category->category_name = $request->category;
        $category->save();

        toastr()->closeButton()->success('Category Added Successfully.');

        return redirect()->back();

    }

    public function delete_category($id) {
        $data = Category::find($id);
        $data->delete();
        toastr()->closeButton()->success('Category Deleted Successfully.');
        return redirect()->back();
    }

}

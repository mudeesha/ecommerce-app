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

    public function add_category(Request $request) {

        $category = new Category;
        $category->category_name = $request->category;
        $category->save();

        toastr()->closeButton()->success('category Added Successfully.');

        return redirect()->back();

    }
}

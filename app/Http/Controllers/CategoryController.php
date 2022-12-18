<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(){
        return view('category.create');
    }


    /**
     * Store a newly created Product.
     */
    public function store(Request $request){

        $request->validate([
            'category' => 'required',
        ]);
        $category = new Category();
        $category->category = $request->input('category');
        $category->save();
        return redirect()->back()->with('Category added sucessfully!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductController extends Controller
{
    /**
     * Display listing of the products
     * @return void
     */
    public function index(){
        $products = Products::paginate(10);
    }

    /**
     * Show the form for creating a new Product.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    
    public function create(){
        return view('product.create');
    }


    /**
     * Store a newly created Product.
     */
    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:6|max:40',
            'type' => 'required',
            'category' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);
        $filename = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('images/products',$filename,'public');
        Products::create($request->all());
        return redirect('/');
    }

    /**
     * Show Product page
     * @param Products $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Products $product){
        return view('product.show', ['product' => $product]);
    }

    /**
     * Edit Product page
     * @param Products $product
     */
    public function edit(Products $product){
        return view('product.edit', ['product' => $product]);
    }

    /**
     * Update Product information
     * @param Request $request
     * @param Products $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Products $product){
        $product->update($request->all());
        return view('product.show', ['product' => $product]);
    }


    /**
     * Deletes product from database
     * @param Products $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Products $product){
        $product->delete();
        return redirect('/');
    }
}

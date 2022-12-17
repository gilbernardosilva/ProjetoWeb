<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductController extends Controller
{
    /**
     * Display listing of the products
     * @return void
     */
    public function index(){
        //$cart = Cart::content();
        //$products = Product::latest()->paginate(4);

        return view('index');
    }

    /**
     * Show the form for creating a new Product.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function create(){
        return view('products.create');
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
        $request->file('image')->store('/public/images/products');
        $product = new Product;
        $product->name = $request->input('name');
        $product->type = $request->input('type');
        $product->category = $request->input('category');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->image = $filename;
        $product->path = $request->file('image')->hashName();
        $product->save();
        return redirect()->back()->with('Product added sucessfully!');
    }

    /**
     * Show Product page
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Product $product){
        return view('products.show', ['product' => $product]);
    }

    /**
     * Edit Product page
     * @param Product $product
     */
    public function edit(Product $product){
        return view('product.edit', ['product' => $product]);
    }

    /**
     * Update Product information
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Product $product){
        $product->update($request->all());
        return view('product.show', ['product' => $product]);
    }


    /**
     * Deletes product from database
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Product $product){
        $product->delete();
        return redirect('/');
    }
}

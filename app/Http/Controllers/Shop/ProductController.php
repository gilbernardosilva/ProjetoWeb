<?php

namespace App\Http\Controllers\Shop;

use App\Models\Game;
use App\Models\User;
use App\Models\Product;
use App\Models\Platform;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'asc')->paginate(10);
        return view('products.index', compact('products'));
    }

    public function indexShop(){
        $products = Product::orderBy('id', 'asc')->latest()->paginate(12);
        $productsPromo = Product::orderBy('discount', 'desc')->where('discount','>',0)->paginate(12);
        return view('index', compact('products', 'productsPromo'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function create()
    {
        $users=User::all();
        $games=Game::all();
        $platforms=Platform::all();
        return view('products.create',compact('games','platforms','users'));
    }

    public function createProduct()
    {
        $games=Game::all();
        $platforms=Platform::all();
        return view('products.createProduct',compact('games','platforms'));
    }



    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|integer',
            'platform_id' => 'required|integer',
            'game_id' => 'required|integer',
            'price' => 'required|numeric',
            'key' => 'required',
            'discount' => 'required|integer|between:0,100',
        ]);
        $product = new Product();
        $product->platform_id = $request->input('platform_id');
        $product->game_id = $request->input('game_id');
        $product->key = $request->input('key');
        $product->price = $request->input('price');
        $product->discount = $request->input('discount');
        $product->user_id = Auth::id();
        if(Auth::id()){
            $user=User::find(Auth::id());
            $user->products()->save($product);
        }

        $product->save();
        return redirect()->back()->with('success', 'Product created successfully!');

    }

    public function update(Request $request,Product $product)
    {

        $request->validate([
            'user_id'=>'sometimes|integer',
            'platform_id' => 'required|integer',
            'game_id' => 'required|integer',
            'price' => 'required|numeric',
            'discount' => 'required|integer|between:0,100',
        ]);
        $product->update($request->all());

        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    public function edit(Product $product)
    {
        $users=User::all();
        $games=Game::all();
        $platforms=Platform::all();
        return view('products.edit',compact('games','platforms','users','product'));
    }

}

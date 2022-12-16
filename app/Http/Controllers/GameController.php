<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Platform;
use Illuminate\Http\Request;

class GameController extends Controller
{
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
        return view('games.create');
    }


    /**
     * Store a newly created Product.
     */
    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:6|max:40',
            'category' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);
        $filename = $request->file('image')->getClientOriginalName();
        $request->file('image')->store('/public/images/products');
        $game = new Game;
        $game->name = $request->input('name');
        DB::insert('insert into categories (id, name) values (?, ?)', [1, 'Dayle']);
        // $product->category = $request->input('category');
        $game->description = $request->input('description');
        //$product->image = $filename;
       // $product->path = $request->file('image')->hashName();
        $game->save();
        return redirect()->back()->with('Product added sucessfully!');
    }
}

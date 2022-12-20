<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public function searchProducts(Request $request)
    {

        if ($request->search) {
            $searchProducts = Product::join('games', 'products.game_id', '=', 'games.id')
                ->where('games.name', 'LIKE', '%' . $request->search . '%')
                ->paginate(15);
                $categories = Category::all()->pluck('category', 'id');

            return view('products.list', compact('searchProducts', 'categories'));
        } else {

            return redirect()->back()->with('message', 'Empty Search');
        }
    }
}

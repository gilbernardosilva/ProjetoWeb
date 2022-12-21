<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Platform;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public $priceInput;

    protected $queryString = [
        'priceInput' => ['except' => '', 'as' => 'price'],
    ];
    public function searchProducts(Request $request)
    {

        if ($request->search) {
            $searchProducts = Product::join('games', 'products.game_id', '=', 'games.id')
                ->where('games.name', 'ilike', '%' . $request->search . '%')
                ->when($this->priceInput, function ($q) {
                    $q->when($this->priceInput == 'high-to-low', function ($q2) {
                        $q2->orderBy('price', 'DESC');
                    })
                        ->when($this->priceInput == 'low-to-high', function ($q2) {
                            $q2->orderBy('price', 'ASC');
                        });
                })
                ->paginate(15);
            $categories = Platform::all()->pluck('name', 'id');

            return view('livewire.products-list', compact('searchProducts', 'categories'));
        } else {

            return redirect()->back()->with('message', 'Empty Search');
        }
    }
}

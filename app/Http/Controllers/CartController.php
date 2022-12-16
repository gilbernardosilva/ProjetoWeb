<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Http\Request;

class CartController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   /*
        Cart::add(
            $request->input('product_id'),
            $request->input('product_name'),
            1,
            $request->input('product_price'),
    );
    return redirect()->route('mainpage')->with('message', 'Successfully added');
*/
    }


}

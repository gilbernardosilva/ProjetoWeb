<?php

namespace App\Http\Controllers\Shop;

use App\Models\Game;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function show(Order $order){
        $games= Game::all();
        return view ('orders.show',compact('order','games'));
    }

    public function index(){

        $user = Auth::user();
        $orders = Order::Where('user_id',$user->id)->paginate(10);

        return view('orders.index',compact('orders'));
    }
}

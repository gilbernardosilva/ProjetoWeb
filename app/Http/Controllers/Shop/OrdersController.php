<?php

namespace App\Http\Controllers\Shop;

use App\Models\Game;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

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

    public function downloadPDF($orderID){
        $order = Order::find($orderID);
        $slug = Str::slug($order->created_at, '-');
        $fileName = 'invoice_' .$slug. '.pdf';
        $pathToFile = storage_path('app/public/invoices/'. $fileName);
        return response()->download($pathToFile, 'invoice_'. $fileName.'.pdf', [
            'Content-Type' => 'application/pdf',
        ]);    }
}

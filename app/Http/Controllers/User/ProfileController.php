<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Address;
use App\Models\Review;
use App\Models\Order;
use App\Models\Game;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{

    public function edit(User $user, Address $address, Photo $photo)
    {
        return view('profile.edit', compact('user', 'address', 'photo'));
    }

    public function show(User $user)
    {
        $userID = $user->id;
        $hideWriteOwnReview = Auth::user()->id;
        $role = $user->role;
        $address = $user->address;
        $photo = $user->photo;
        $reviews = Review::where('user_id', $user->id)->paginate(4);
        //$reviewer = User::where('id', $reviews->reviewer_id)->Storage::paginate(4);
        $sellingProducts = Product::where('user_id', $user->id)->paginate(8);
        $orders = Order::where('user_id', $user->id)->get();
        $orderItems = new OrderItem;
        $game = new Game;             
        $orderedItems = $orderItems->toArray();
        $games = $game->toArray();
        $i = 0;
        $j = 0;      
        foreach ($orders as $order) {
            if ($order->status == 'paid') {
                $orderedItems[$i] = OrderItem::where('order_id', $order->id)->get();
                $o = $i;
                foreach($orderedItems[$o] as $orderItem){
                    $games[$j] = Game::where('id', $orderItem->game_id)->get();
                    $o++;
                    $j++;
                }
            }
            $i++;
        }
        //$i--;
        //$j--;
        //dd($j);
        dd($games);
        //dd($orderedItems);
        //if(is_object($orderedItems[0])){
            return view('profile.show', compact('hideWriteOwnReview', 'userID', 'user', 'address', 'photo', 'sellingProducts', 'role', 'reviews', 'orderedItems', 'games', 'i', 'j'));
        /*}else{
            return view('profile.show', compact('hideWriteOwnReview', 'userID', 'user', 'address', 'photo', 'sellingProducts', 'role', 'reviews', 'orderedItems', 'games'));
        }*/
    }

    public function storeAddress(Request $request)
    {

        $user = auth()->user();

        $request->validate([
            'street' => 'required|string|max:50',
            'city' => 'required|string|max:20',
            'state' => 'required|string|max:20',
            'zip_code' => 'required|string|max:10',
        ]);

        $address = new Address([
            'street' => $request->input('street'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'zip_code' => $request->input('zip_code')
        ]);

        $user->address()->save($address);
        return Redirect::back()->with('success', 'Your address has been stored successfully!');
    }

    public function updateAddress(Request $request)
    {
        $user= auth()->user();
        $address=$user->address;
        $request->validate([
            'street' => 'required|string|max:50',
            'city' => 'required|string|max:20',
            'state' => 'required|string|max:20',
            'zip_code' => 'required|string|max:10',
        ]);

        $address->update([
            'street' => $request->input('street'),
            'city' => $request->input('city'),
            'zip_code' => $request->input('zip_code'),
            'state' => $request->input('state'),
        ]);

        return Redirect::back()->with('success', 'Your address has been updated!');
    }


    public function storePhoto(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);
        $request->file('image')->store('public/images');

        $photo = new Photo();
        $photo->name = $request->file('image')->getClientOriginalName();
        $photo->path = $request->file('image')->hashName();
        $user = Auth::user();
        $photo->user_id = $user->id;
        $photo->save();
        return redirect()->back()->with('success', 'Image has been stored successfully');
    }
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);
        $request->file('image')->store('public/images');

        $user=Auth::user();
        $oldPhoto=$user->photo;
        Storage::delete('public/images/' . $oldPhoto->path);
        $oldPhoto->delete();
        $photo = new Photo();
        $photo->name = $request->file('image')->getClientOriginalName();
        $photo->path = $request->file('image')->hashName();
        $photo->user_id=$user->id;
        $photo->save();
        return Redirect::back()->with('success', 'Your address has been updated!');
    }


}

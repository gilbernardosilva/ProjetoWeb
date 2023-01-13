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

    public function show(User $user)
    {
        $photo = $user->photo;
        $userAuth = Auth::user();
        $reviews = Review::where('user_id', $user->id)->get();
        //$order_items = OrderItem::where('user_id', $user->id)->get();
        //$games = Game::where('id',$order_items->game_id);
        $average = round($reviews->average('rating'));
        $sellingProducts = Product::where('user_id', $user->id)->paginate(8);
        return view('profile.show',compact('user','photo','reviews','sellingProducts','userAuth','average'));
    }

    public function edit()
    {
        $user = auth()->user();
        $address = $user->address;
        $photo = $user->photo;

        return view('profile.edit', compact('user', 'address', 'photo'));
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

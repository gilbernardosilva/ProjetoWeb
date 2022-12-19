<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function index(){
        return view ('products.index');
    }

    public function show()
    {
        $user = auth()->user();
        $address = $user->address;
        $photo = $user->photo;

        return view('profile.edit', compact('user', 'address', 'photo'));
    }


    public function update(Request $request)
    {

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }


    protected function updateAddress(Address $address){

    }
}

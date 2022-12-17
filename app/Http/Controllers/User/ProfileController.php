<?php

namespace App\Http\Controllers\User;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $address = Address::where('user_id', $user->id)->first();

        return view('profile', [
            'user' => $user,
            'address' => $address,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $address = Address::where('user_id', $user->id)->first();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            'address_line_1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        $address->Street = $request->input('address_line_1');
        $address->city = $request->input('city');
        $address->state = $request->input('state');
        $address->zip_code = $request->input('zip_code');
        $address->save();

        return Redirect::back()->with('success', 'Your profile has been updated!');
    }
}

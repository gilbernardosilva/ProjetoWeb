<?php

namespace App\Http\Controllers\User;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $address = $user->address;

        return view('user.update-profile', [
            'user' => $user,
            'address' => $address,
        ]);
    }

    public function updateUserInfo(Request $request)
    {
        $user = Auth::user();
        dd($request->all());

        $request->validate([
            'password' => 'nullable|string|min:6|confirmed',
        ]);


        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);

        return Redirect::back()->with('success', 'Your password has been updated!');
    }


    public function updateAddressInfo(Request $request)
    {

        $user = Auth::user();
        $address = $user->address;

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

    public function updatePhotoInfo(Request $request)
    {

        $user = Auth::user();

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        if($user->photo){
            $fileName=public_path('images\\' .$user->photo);
            File::delete($fileName);
        }

        $user->update([
            'photo' => $imageName,
        ]);

        return Redirect::back()->with('success', 'Your address has been updated!');
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AddressController extends Controller
{
    public function store(Request $request)
    {

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

        $address->save();
        return Redirect::back()->with('success', 'Your address has been created!');
    }

    public function update(Request $request, User $user)
    {
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
}

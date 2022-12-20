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


    public function index()
    {
        $addresses = Address::orderBy('id', 'asc')->paginate(10);

        return view('addresses.index', compact('addresses'));
    }

    public function show(Address $address)
    {
        return view('addresses.show', compact('address'));
    }

    public function create()
    {
        return view('addresses.create');
    }

    public function edit(Address $address)
    {
        return view('addresses.edit', compact('address'));
    }

    public function destroy(Address $address)
    {
        $address->delete();

        return redirect()->back()->with('success', 'Address deleted successfully');
    }

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

    public function update(Request $request,Address $address)
    {
        $request->validate([
            'street' => 'required|string|max:50',
            'city' => 'required|string|max:20',
            'state' => 'required|string|max:20',
            'zip_code' => 'required|string|max:10',
        ]);

        $address->update($request->all());
        return Redirect::back()->with('success', 'Your address has been updated!');
    }
}

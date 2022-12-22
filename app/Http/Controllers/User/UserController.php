<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{


    public function index()
    {
        $users = User::orderBy('id', 'asc')->paginate(10);

        return view('users.index', compact('users'));
    }

    public function admin()
    {
        return view('admin');
    }

    public function create()
    {
        return view('users.create');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $password = $request->input('password');
        $hashedPassword = Hash::make($password);
        $request->merge(['password'=> $hashedPassword]);
        User::create($request->all());
        return redirect()->back()->with('success', 'User stored successfully');
    }


    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }


    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $password = $request->input('password');
        $hashedPassword = Hash::make($password);
        $request->replace(['password'=> $hashedPassword]);
        $user->update($request->all());

        return redirect()->back()->with('success', 'User updated successfully');
    }


    public function createSeller()
    {
        return view('users.becomeseller');
    }

    public function storeSeller(Request $request){

        $user=Auth::user();
        if(!$user->address){

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
        }

        $request->validate([
            'nif' => 'required|string|max:10',
        ]);
        $user->role='seller';
        $user->nif=$request->input('nif');
        $user->save();
        return redirect('/')->with('success', 'You have become a seller successfully');
    }
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
    }


}

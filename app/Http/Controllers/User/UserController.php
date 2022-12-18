<?php

namespace App\Http\Controllers\User;

use App\Models\User;
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


    public function create()
    {
        return view('users.create');
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
        $request->replace(['password'=> $hashedPassword]);
        User::create($request->all());
        return redirect()->route('dashboard')->with('success', 'User inserted successfully');
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

        return redirect()->route('dashboard')->with('success', 'User updated successfully');
    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('dashboard')->with('success', 'User deleted successfully');
    }

    public function createPhoto(Request $request)
    {

        return view('users.photo.create');
    }


    public function updatePhoto(Request $request,User $user)
    {

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

        return redirect()->route('dashboard')->with('success', 'Your photo has been updated!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Display listing of the users
     * @return void
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', ["users" => $users]);
    }

    /**
     * Show the form for creating a new User.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function create()
    {
        return view('users.create');
    }


    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
           
            $request->validate([
                'name' => 'required|min:6|max:12',
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required',
                'address' => 'required',
                'password' => 'required|min:8|max:20',
                'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            ]);
            $filename = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('images/users',$filename,'public');
            User::create($request->all());
        }else{
            $request->validate([
                'name' => 'required|min:6|max:12',
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required',
                'address' => 'required',
                'password' => 'required|min:8|max:20',
            ]);
            User::create($request->all());
        }
        
        return view('users.create');
    }

    /**
     * Show user profile
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(User $user)
    {
        return view('user.show', ['user' => $user]);
    }

    /**
     * Edit user profile 
     * @param User $user
     */
    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update user information
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect('/');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/');
    }
}

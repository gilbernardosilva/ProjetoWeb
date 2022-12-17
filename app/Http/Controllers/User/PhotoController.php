<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class PhotoController extends Controller
{
    public function update(Request $request)
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

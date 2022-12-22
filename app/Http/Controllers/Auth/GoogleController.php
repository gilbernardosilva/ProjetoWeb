<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use App\Models\Photo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleCallback()
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();

            $finduser = User::where('social_id', $user->id)->first();

            if($finduser){
                Auth::login($finduser);
                return redirect('/');

            }else{
                $password=Hash::make(Str::random(5));
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id'=> $user->id,
                    'social_type'=> 'google',
                    'role' => 'user',
                    'password' => $password,
                ]);

                $photoUrl = $user->getAvatar();
                $photoContents = file_get_contents($photoUrl);
                $photoPath = '/public/images/' . $user->email . '.jpg';
                Storage::put($photoPath, $photoContents);
                $photo = new Photo;
                $photo->name= Hash::make(Str::random(5));
                $photo->user_id = $newUser->getKey();
                $photo->path = $user->email . '.jpg';
                $newUser->photo()->save($photo);
                $photo->save();
                Auth::login($newUser);
                return redirect('/');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Models\Game;
use App\Models\User;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{

    public function index(Request $request)
    {
        $photos = Photo::orderBy('id', 'asc')->paginate(10);

        return view('photos.index', compact('photos'));
    }


    public function create()
    {
        $users = User::all();
        $games = Game::all();
        return view('photos.create', compact(['users', 'games']));
    }

    public function store(Request $request)
    {
        if ($request->user_id) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            ]);


            $oldPhoto = Photo::where('user_id', $request->user_id)->first();

            if ($oldPhoto) {
                Storage::delete('public/images/' . $oldPhoto->path);
                $oldPhoto->delete();
            }

            $request->file('image')->store('public/images');
            $photo = new Photo();
            $photo->name = $request->file('image')->getClientOriginalName();
            $photo->path = $request->file('image')->hashName();
            $photo->user_id = $request->user_id;
            $user = User::find($request->user_id);

            $user->photo()->save($photo);
            return redirect()->back()->with('success', 'Image has been stored successfully');
        } else if ($request->game_id) {
            $request->validate([
                'thumbnail' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'image1' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'image2' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'image3' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            ]);
            $oldPhotos = Photo::where('game_id', $request->game_id)->get();

            foreach ($oldPhotos as $oldPhoto) {
                Storage::delete('public/images/' . $oldPhoto->path);
                $oldPhoto->delete();
            }
            foreach (['thumbnail', 'image1', 'image2', 'image3'] as $image) {
                $request->file($image)->store('public/images');
                $photo = new Photo();
                $photo->name = $request->file($image)->getClientOriginalName();
                $photo->path = $request->file($image)->hashName();
                $photo->game_id = $request->game_id;
                $game = Game::find($request->game_id);
                $game->photo()->save($photo);
            }
            return redirect()->back()->with('success', 'Images have been stored successfully');
        } else {
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            ]);
            $request->file('image')->store('public/images');
            $photo = new Photo();
            $photo->name = $request->file('image')->getClientOriginalName();
            $photo->path = $request->file('image')->hashName();
            $photo->save();
            return redirect()->back()->with('success', 'Image has been stored successfully');
        }
    }

    public function show(Photo $photo)
    {
        return view('photos.show', compact('photo'));
    }


    public function edit(Photo $photo)
    {
        return view('photos.edit', compact('photo'));
    }
    public function destroy(Photo $photo)
    {
        Storage::delete('public/images/' . $photo->path);
        $photo->delete();
        return redirect()->back()->with('success', 'Photo deleted successfully');
    }
}

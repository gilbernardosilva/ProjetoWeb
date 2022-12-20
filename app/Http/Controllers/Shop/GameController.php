<?php

namespace App\Http\Controllers\Shop;

use App\Models\Game;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::orderBy('id', 'asc')->paginate(10);

        return view('games.index', compact('games'));
    }

    public function show(Game $game)
    {
        return view('games.show', compact('game'));
    }

    public function create()
    {
        $categories=Category::all();
        return view('games.create',compact('categories'));
    }


    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()->back()->with('success', 'Game deleted successfully');
    }

    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string',
        ]);
        $game = new Game();
        $game->category_id = $request->input('category_id');
        $game->name = $request->input('name');
        $game->description = $request->input('description');
        $game->save();

        return redirect()->back()->with('success', 'Game created successfully!');

    }

    public function update(Request $request,Game $game)
    {

        $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $game->update($request->all());

        return redirect()->back()->with('success', 'Game updated successfully!');
    }

    public function edit(Game $game)
    {
        $categories=Category::all();
        return view('games.edit',compact('game','categories'));
    }

}

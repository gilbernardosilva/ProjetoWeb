<?php

namespace App\Http\Controllers\Shop;

use App\Models\Platform;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlatformController extends Controller
{
    public function index()
    {
        $platforms = Platform::orderBy('id', 'asc')->paginate(10);
        return view('platforms.index', compact('platforms'));
    }

    public function show(Platform $platform)
    {
        return view('platforms.show', compact('platform'));
    }

    public function create()
    {
        return view('platforms.create');
    }

    public function destroy(Platform $platform)
    {
        $platform->delete();
        return redirect()->back()->with('success', 'Platform deleted successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:8',
        ]);
        $platform = new platform();
        $platform->name = $request->input('name');
        $platform->save();
        return redirect()->back()->with('success', 'Platform created successfully!');
    }

    public function update(Request $request,Platform $platform)
{
        $request->validate([
            'name' => 'required|string|max:8',
        ]);

        $platform->update($request->all());
        return redirect()->back()->with('success', 'Platform updated successfully!');
    }

    public function edit(Platform $platform)
    {
        return view('platforms.edit',compact('platform'));
    }

    public function platforms(Platform $platform){
        $searchProducts = Product::where('platform_id', $platform->id)->paginate(12);
        return view('livewire.products-list', compact('searchProducts'));
    }

    public function allPlatforms(){
        $searchProducts = Product::paginate(20);
        return view('livewire.products-list', compact('searchProducts'));
    }
}

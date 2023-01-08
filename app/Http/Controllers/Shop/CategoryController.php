<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Game;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('id', 'asc')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:8',
        ]);
        $category = new Category();
        $category->name = $request->input('name');
        $category->save();
        return redirect()->back()->with('success', 'Category created successfully!');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:8',
        ]);

        $category->update($request->all());
        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function categories($category)
    {
        $gameCategory = Game::where('category_id', $category)->get();
        $searchProducts = array();
        foreach ($gameCategory as $categories) {
            $searchProducts = Product::where('game_id', $categories->id)->paginate(12);
        }
        if (!empty($searchProducts)) {
            return view('livewire.products-list', compact('searchProducts'));
        } else {
            return view('livewire.products-list-empty');
        }
    }

    public function allCategories()
    {
        $searchProducts = Product::paginate(20);
        return view('livewire.products-list', compact('searchProducts'));
    }
}

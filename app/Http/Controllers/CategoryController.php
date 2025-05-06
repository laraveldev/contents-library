<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $category = Category::create($request->only('name'));

        return view('categories.show', compact('category'));
    }

    public function show(int $id)
    {
        $category = Category::findOrFail($id);

        return view('categories.show', compact('category'));
    }


    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, int $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->input('name');         
        $category->save();

       return redirect()->route('categories.show', $category)->with('success', 'kategory yangilandi!');
    }

    public function destroy( $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories')->with('success', 'Kategoriya ochirildi!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();

        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $author = Author::create($request->only('name'));
        return view('authors.show', compact('author'));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
{
    
    $author = Author::with('contents')->findOrFail($id);
    return view('authors.show', compact('author'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $author = Author::findOrFail($id);

    $author->name = $request->input('name');
         
    $author->save();

    

    return redirect()->route('authors.show', $author)->with('success', 'author yangilandi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $author = Author::findOrFail($id);
    $author->delete();

    return redirect()->route('authors')->with('success', 'author ochirildi!');
    }
}

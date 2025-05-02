<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Content;
use App\Models\Genere;
use App\Models\Author;
use Illuminate\Contracts\View\View;

use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = Content::all();

        return view('contents.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $categories = Category::pluck('name', 'id');
    $authors = Author::pluck('name', 'id');
    $generes = Genere::pluck('name', 'id');

    return view('contents.create', compact('categories', 'authors', 'generes'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    

    $content = Content::create($request->only('title', 'description', 'url', 'category_id'));

    $content->authors()->sync($request->authors);
    $content->generes()->sync($request->generes);

    return view('contents.show', compact('content'));
}



    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $content = Content::with(['category', 'authors', 'generes'])->findOrFail($id);
    return view('contents.show', compact('content'));
}




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Content $content)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        //
    }
    public function adminIndex()
    {
        $categories = Category::all('id', 'name')->pluck('name', 'id');
        $genres     = Genere::all('id', 'name')->pluck('name', 'id');

        return view('contents.show', compact('categories', 'genres'));
    }
}

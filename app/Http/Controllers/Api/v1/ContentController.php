<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
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
        $categories = Category::pluck('name', 'id');
        $authors = Author::pluck('name', 'id');
        $generes = Genere::pluck('name', 'id');
        
        return view('contents.edit', compact('categories', 'authors', 'generes','content'));
        
    }


    public function update(Request $request, string $id) 
{
    $content = Content::findOrFail($id);

    $content->title = $request->input('title');
    $content->description = $request->input('description');
    $content->url = $request->input('url'); 
    $content->category_id = $request->input('category_id');     
    $content->save();

    if ($request->has('authors')) {
        $content->authors()->sync($request->input('authors')); // bu kerak
    }

    if ($request->has('generes')) {
        $content->generes()->sync($request->input('generes')); // bu ham
    }

    return redirect()->route('contents.show', $content)->with('success', 'Kontent yangilandi!');
}

    public function destroy($id)
{
    $content = Content::findOrFail($id);
    $content->delete();

    return redirect()->route('contents')->with('success', 'Kontent ochirildi!');
}




    public function adminIndex()
    {
        $categories = Category::all('id', 'name')->pluck('name', 'id');
        $genres     = Genere::all('id', 'name')->pluck('name', 'id');

        return view('contents.show', compact('categories', 'genres'));
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Content;
use App\Models\Genere;
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
        $categories = Category::all('id', 'name')->pluck('name', 'id');
        $genres     = Genere::all('id', 'name')->pluck('name', 'id');

        return view('admin.index', compact('categories', 'genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $content = Content::query()->create([
            'title'       => $request->get('title'),
            'description' => $request->get('description'),
            'url'         => $request->get('url'),
            'category_id' => $request->get('category_id'),
        ]);

        $content->generes()->attach($request->get('genere_id'));

        return redirect('/contents')->with('success', 'Content created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content)
    {
        
        $content->load('authors','generes');
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

        return view('admin.index', compact('categories', 'genres'));
    }
}

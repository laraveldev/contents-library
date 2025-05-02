<?php

namespace App\Http\Controllers;

use App\Models\Genere;
use Illuminate\Http\Request;

class GenereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $generes = Genere::all();

        return view('generes.index', compact('generes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('generes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $genere = Genere::create($request->only('name'));
        return view('generes.show', compact('genere'));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $genidere)
    {
        $genere = Genere::findOrFail($id);
    return view('generes.show', compact('generes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genere $genere)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genere $genere)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genere $genere)
    {
        //
    }
}

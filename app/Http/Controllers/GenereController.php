<?php

namespace App\Http\Controllers;

use App\Models\Genere;
use Illuminate\Http\Request;

class GenereController extends Controller
{

    public function index()
    {      
        $generes = Genere::all();

        return view('generes.index', compact('generes'));
    }

    public function create()
    {
        return view('generes.create');
    }

    public function store(Request $request)
    {
        $genere = Genere::create($request->only('name'));

        return view('generes.show', compact('genere'));
    }

    public function show(int $id)
    {
        $genere = Genere::findOrFail($id);

        return view('generes.show', compact('genere'));
    }

    public function edit(Genere $genere)
    {
        return view('generes.edit', compact('genere'));
    }

    public function update(Request $request,  $id)
    {
        $genere = Genere::findOrFail($id);

        $genere->name = $request->input('name');       
        $genere->save();

        return redirect()->route('generes.show', $genere)->with('success', 'kategory yangilandi!');
    }

    public function destroy( $id)
    {
        $genere = Genere::findOrFail($id);
        $genere->delete();

        return redirect()->route('generes')->with('success', 'GEnere ochirildi!');
    }
}

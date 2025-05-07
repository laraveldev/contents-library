<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    public function index()
    {
        $authors = Author::all();

        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $author = Author::create($request->only('name'));
        return view('authors.show', compact('author'));
    }

    public function show(int $id)
    {
    
    $author = Author::with('contents')->findOrFail($id);
    return view('authors.show', compact('author'));
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request,  $id)
    {
        $author = Author::findOrFail($id);
        $author->name = $request->input('name');        
        $author->save();

        return redirect()->route('authors.show', $author)->with('success', 'author yangilandi!');
    }

    public function destroy( $id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return redirect()->route('authors')->with('success', 'author ochirildi!');
    }
}

public function makeAdmin(User $user)
    {
        // Faol foydalanuvchi super admin (id = 1) bo‘lishi kerak
        if (auth()->user()->id !== 1) {
            return redirect()->back()->with('error', 'Faqat Super Admin admin tayinlay oladi.');
        }

        if (!$user->hasRole('admin')) {
            $user->assignRole('admin');
        }

        return redirect()->back()->with('success', "$user->name admin sifatida tayinlandi.");
    }

    // Foydalanuvchidan adminlikni olib tashlash
    public function removeAdmin(User $user)
    {
        // Faol foydalanuvchi super admin (id = 1) bo‘lishi kerak
        if (auth()->user()->id !== 1) {
            return redirect()->back()->with('error', 'Faqat Super Admin adminlik huquqini olib tashlay oladi.');
        }

        if ($user->hasRole('admin')) {
            $user->removeRole('admin');
        }

        return redirect()->back()->with('success', "$user->name endi admin emas.");
    }

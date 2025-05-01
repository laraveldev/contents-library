<?php

namespace App\Http\Controllers;
use App\Models\Content;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $contents = Content::all();

        return view('home', compact('contents')); 
    }
    
}

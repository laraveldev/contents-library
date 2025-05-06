<?php

namespace App\Http\Controllers;
use App\Models\Content;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $contents = Content::all();

        return view('dashboard', compact('contents'));
    }
}

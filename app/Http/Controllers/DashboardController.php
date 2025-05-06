<?php

namespace App\Http\Controllers;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Services\GreetingService;

class DashboardController extends Controller
{
    protected $greeting;


    public function __construct(GreetingService $greeting)
    {
        $this->greeting = $greeting;
    }

    public function index()
    {
        $message = $this->greeting->greet("Elnurbek");
        $contents = Content::all();

        return view('dashboard', compact('contents','message'));
    }
}

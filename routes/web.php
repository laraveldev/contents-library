<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenereController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

//Profile uchun
Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

//Content uchun
Route::get('/contents', [ContentController::class, 'index'])->name('contents');



//Author uchun
Route::get('/authors', [AuthorController::class, 'index'])->name('authors');



//Categories uchun
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');



//Genre uchun
Route::get('/generes', [GenereController::class, 'index'])->name('generes');





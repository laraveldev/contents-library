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
Route::get('/contents/create', [ContentController::class, 'create'])->name('create.contents');
Route::post('/contents/store', [ContentController::class, 'store'])->name('create.store');
Route::get('/contents/{id}', [ContentController::class, 'show'])->name('contents.show');

//Author uchun
Route::get('/authors', [AuthorController::class, 'index'])->name('authors');
Route::get('/authors/create', [AuthorController::class, 'create'])->name('create.authors');
Route::post('/authors/store', [AuthorController::class, 'store'])->name('create.store');
Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');


//Categories uchun
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('create.categories');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('create.store');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');


//Genre uchun
Route::get('/generes', [GenereController::class, 'index'])->name('generes');
Route::get('/generes/create', [GenereController::class, 'create'])->name('create.generes');
Route::post('/generes/store', [GenereController::class, 'store'])->name('create.store');
Route::get('/generes/{id}', [GenereController::class, 'show'])->name('generes.show');




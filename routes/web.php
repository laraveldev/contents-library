<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenereController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AddAdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\SuperAdminOnly;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // ---------------------------
    // ADMIN ROUTELARI (faqat admin)
    // ---------------------------
    Route::middleware('role:admin')->group(function () {
        
        // Content
        Route::get('/contents/create', [ContentController::class, 'create'])->name('create.contents');
        Route::post('/contents/store', [ContentController::class, 'store'])->name('content.store');
        Route::get('/contents/edit/{content}', [ContentController::class, 'edit'])->name('contents.edit');
        Route::put('/contents/{content}', [ContentController::class, 'update'])->name('contents.update');
        Route::delete('/contents/{content}', [ContentController::class, 'destroy'])->name('contents.destroy');

        // Author
        Route::get('/authors/create', [AuthorController::class, 'create'])->name('create.authors');
        Route::post('/authors/store', [AuthorController::class, 'store'])->name('author.store');
        Route::get('/authors/edit/{author}', [AuthorController::class, 'edit'])->name('authors.edit');
        Route::put('/authors/{author}', [AuthorController::class, 'update'])->name('authors.update');
        Route::delete('/authors/{id}', [AuthorController::class, 'destroy'])->name('authors.destroy');

        // Category
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('create.categories');
        Route::post('/categories/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/categories/edit/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // Genere
        Route::get('/generes/create', [GenereController::class, 'create'])->name('create.generes');
        Route::post('/generes/store', [GenereController::class, 'store'])->name('genere.store');
        Route::get('/generes/edit/{genere}', [GenereController::class, 'edit'])->name('generes.edit');
        Route::put('/generes/{genere}', [GenereController::class, 'update'])->name('generes.update');
        Route::delete('/generes/{id}', [GenereController::class, 'destroy'])->name('generes.destroy');
        
        // Admin add and delet       
        Route::get('/users', [AdminController::class, 'index'])->middleware(['auth', 'role:admin', SuperAdminOnly::class])->name('users');
        Route::post('/users/{user}/make-admin', [AdminController::class, 'makeAdmin'])->middleware(['auth', 'role:admin', SuperAdminOnly::class])->name('users.makeAdmin');
        Route::delete('/users/{user}/remove-admin', [AdminController::class, 'removeAdmin'])->middleware(['auth', 'role:admin', SuperAdminOnly::class])->name('users.removeAdmin');
        Route::get('/users/create',[AddAdminController::class, 'create'])->middleware(['auth', 'role:admin', SuperAdminOnly::class])->name('admin.create');
        Route::post('/users/store',[AddAdminController::class, 'store'])->middleware(['auth', 'role:admin', SuperAdminOnly::class])->name('admin.store');
        Route::delete('/users/{user}', [AdminController::class, 'destroy'])->middleware(['auth', 'role:admin', SuperAdminOnly::class])->name('users.destroy');

    });

    // Profil uchun (har ikki rol uchun ochiq)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ---------------------------
    // USER KO'RISH ROUTELARI (har ikkala rol uchun ochiq)
    // ---------------------------
    Route::get('/contents', [ContentController::class, 'index'])->name('contents');
    Route::get('/contents/{id}', [ContentController::class, 'show'])->name('contents.show');
    Route::post('/contents/{id}/like', [ContentController::class, 'like'])->name('contents.like');
    Route::post('/contents/{id}/dislike', [ContentController::class, 'dislike'])->name('contents.dislike');

    Route::get('/authors', [AuthorController::class, 'index'])->name('authors');
    Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

    Route::get('/generes', [GenereController::class, 'index'])->name('generes');
    Route::get('/generes/{id}', [GenereController::class, 'show'])->name('generes.show');
});

require __DIR__.'/auth.php';






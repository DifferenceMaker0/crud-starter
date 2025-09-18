<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ArticleController; 
// use App\Http\Middleware\EnsureTokenIsValid; // Assuming you have a custom middleware
use App\Http\Controllers\PostsController;  
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SelfAuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', [PagesController::class, 'index'])->name('pages.index');
Route::get('/about', [PagesController::class, 'about'])->name('pages.about');
Route::get('/services', [PagesController::class, 'services'])->name('pages.services');   
Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
Route::get('/posts/read/{id}', [PostsController::class, 'read'])->name('posts.read');
Route::post('/posts/{post}', [PostsController::class, 'store']);


Route::resource('posts', PostsController::class)
    ->only(['edit', 'destroy', 'update', 'create'])
    ->middleware('auth');  
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); 
}); 

Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');











// Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
// Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
// Route::get('/articles', [ArticleController::class, 'index'])->name('articles.list');
// Route::get('/admin/users', [AdminController::class, 'users']);
// Route::resource('posts', PostsController::class);
// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'], function () {
        
//     })->name('dashboard');
//     Route::get('/profile', function () {
//         // ...
//     });
//     Route::get('/settings', function () {
//         // ...
//     });
// }); 

// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route::get('/login', [SelfAuthController::class, 'authenticate'])->name('auth.login');
// Route::get('/register', [SelfAuthController::class, 'register'])->name('auth.register');

// Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
// Route::get('/articles', [ArticleController::class, 'index'])->name('articles.list');
// Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
// Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
// Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
// Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
// Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
// Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

// Route::get('/', function () {
//     return view('welcome');
// });

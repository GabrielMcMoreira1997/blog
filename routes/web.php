<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmailController;

use App\Http\Controllers\CkEditorController;

Route::get('/login', function(){
return view('auth.login');
})->name('login');

Route::get('/', [HomeController::class, 'index']);
Route::get('/post/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/politica-de-privacidade', [HomeController::class, 'policy'])->name('policy');

Route::post('/subscrition', [EmailController::class, 'register'])->name('newslatter.register');
Route::get('/unsubscrition', [EmailController::class, 'unregister'])->name('newslatter.unregister');

Route::middleware('auth')->group(function () {
    
    Route::get('/list', [PostController::class, 'list'])->name('posts.list');
    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/edit/{slug}', [PostController::class, 'edit'])->name('posts.edit');
    
    Route::post('/create', [PostController::class, 'store'])->name('posts.store');
    Route::put('/update', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/delete/{slug}', [PostController::class, 'delete'])->name('posts.delete');
    
});

require __DIR__.'/auth.php';
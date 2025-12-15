<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

Route::get('/', function () {
    // return view('welcome', ['posts' => Post::all()]);
    return view('welcome', ['posts' => Post::paginate(3)]);
})->name('home');

Route::get('test', function () {
    return 'This is a test route.';
});

Route::get('/create', [PostController::class, 'create']);

Route::post('/store', [PostController::class, 'ourFileStore'])->name('store');

Route::get('/edit/{id}', [PostController::class, 'editData'])->name('edit');

Route::post('/update/{id}', [PostController::class, 'updateData'])->name('update');

Route::get('/delete/{id}', [PostController::class, 'deleteData'])->name('delete');

Route::get('/search', [PostController::class, 'search'])->name('search');

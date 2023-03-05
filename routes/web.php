<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('article');
});

Route::get('/articles', [
    ArticleController::class,
    'index'
])->name('article');

Route::get('/articles/detail/{id}', [
    ArticleController::class,
    'detail'
])->name('article.detail');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/articles/add', [ArticleController::class, 'add']);

Route::post('/articles/add', [
    ArticleController::class,
    'create'
]);

Route::get('/articles/delete/{id}', [
    ArticleController::class,
    'delete'
]);

Route::get('/articles/edit/{id}', [
    ArticleController::class,
    'edit'
]);

Route::post('/articles/edit/{id}', [
    ArticleController::class,
    'edited'
]);

Route::post('/comments/add', [
    CommentController::class,
    'add'
]);

Route::get('/comments/delete/{id}', [
    CommentController::class,
    'delete'
]);

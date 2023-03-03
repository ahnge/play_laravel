<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

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
    return view('welcome');
});

Route::get('/articles', [
    ArticleController::class,
    'index'
])->name('article');

Route::get('/articles/detail/{id}', [
    ArticleController::class,
    'detail'
])->name('article.detail');

Route::get('/article/more', function () {
    return redirect()->route('article');
});

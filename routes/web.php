<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('article/{vue?}', function(){
    return view('article-view');
})->where('vue', '.*?');
 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::apiResource('/articles', App\Http\Controllers\ArticleController::class);
Route::post('/articles-edit/{article}', [App\Http\Controllers\ArticleController::class, 'update'])->name('articles.update');
Route::apiResource('/comments', CommentController::class);


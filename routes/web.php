<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Test;

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
    return view('welcome');
});

Route::get('foo', function() {
    return 'This page may only manager';
})->middleware('manager');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('articles', ArticleController::class);
Route::get('articles/{id}/delete', [ArticleController::class, 'delete']);

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'getIndex'])->name('home.index');
Route::get('/{id}-{alt_name}.html', [HomeController::class, 'getPost'])->name('home.get_post')->whereNumber('id')->where('alt_name', '[a-z0-9-.]+');
Route::get('/novinki', [HomeController::class, 'getLastNews'])->name('home.lastnews');
Route::get('/popular', [HomeController::class, 'getPopular'])->name('home.popular');
Route::any('/search', [HomeController::class, 'search'])->name('home.search');

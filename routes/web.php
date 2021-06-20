<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\ArtistsController;

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

Route::get('/albums', [AlbumsController::class, 'getIndex'])->name('albums.index');
Route::get('/album/{id}-{slug}.html', [AlbumsController::class, 'getShow'])->name('albums.get-show')->whereNumber('id')->where('slug', '[a-z0-9-.]+');

Route::get('/artists', [ArtistsController::class, 'getIndex'])->name('artists.index');
Route::get('/artist/{id}-{slug}.html', [ArtistsController::class, 'getShow'])->name('artists.get-show')->whereNumber('id')->where('slug', '[a-z0-9-.]+');

Route::get('/genre/{genre}', [HomeController::class, 'getGenre'])->name('genre.view')->where('slug', '[a-z0-9-.]+');
Route::get('/{alt_name}', [HomeController::class, 'getCategory'])->name('category.view')->where('alt_name', '[a-z0-9-.]+');

Route::get('/parser/topmp3', [\App\Http\Controllers\ParserController::class, 'topmp3'])->name('parser.topmp3');
Route::get('/parser/hittj', [\App\Http\Controllers\ParserController::class, 'hittj'])->name('parser.hittj');
Route::get('/parser/kzmp3', [\App\Http\Controllers\ParserController::class, 'kzmp3'])->name('parser.kzmp3');
Route::get('/parser/starmediakg', [\App\Http\Controllers\ParserController::class, 'starmediakg'])->name('parser.starmediakg');
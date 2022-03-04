<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DepanController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KategoriController;

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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [DepanController::class, 'index']);
Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('buku/index', [BukuController::class,'index']);

Route::get('kategori/index', [KategoriController::class,'index']);
Route::get('kategori/create', [KategoriController::class,'create']);

Route::post('kategori/create', [KategoriController::class,'store']);

Route::get('kategori/{id}', [KategoriController::class,'destroy']);

Route::get('kategori/edit/{id}', [KategoriController::class,'edit']);

Route::put('kategori/{id}', [KategoriController::class,'update']);

Route::get('/cari', [KategoriController::class, 'cari'])->name('cari');

Route::get('buku/create', [BukuController::class, 'create']);

Route::post('buku/create', [BukuController::class, 'store']);

Route::get('buku/{id}',[BukuController::class,'destroy']);

Route::get('/search', [BukuController::class, 'search'])->name('search');

Route::get('buku/edit/{id}',[BukuController::class,'edit']);

Route::put('buku/{id}',[BukuController::class,'update']);

Route::get('/mencari', [DepanController::class, 'mencari'])->name('mencari');
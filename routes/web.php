<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

//Route Buku
Route::resource('buku', 'BukuController');

//Route Penerbit
Route::resource('penerbit', 'PenerbitController');

//Route Author
Route::resource('author', 'AuthorController');

//Route peminjaman
Route::resource('pinjaman', 'PinjamanController');
Route::get('pinjaman/create/{buku_id}', 'PinjamanController@create');

//Route Stock
Route::resource('stock', 'StockController');
Route::get('stock/create/{buku_id}', 'StockController@create');
Route::post('stock/create/{buku_id}', 'StockController@store');

//Route Profile => User
Route::resource('user', 'UserController');

Route::get('/home', 'HomeController@index')->name('home');

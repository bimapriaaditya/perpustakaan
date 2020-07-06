<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

//Route Buku
Route::resource('buku', 'BukuController');

//Route Author
Route::resource('author', 'AuthorController');

//Route Penerbit
Route::resource('penerbit', 'PenerbitController');

Route::middleware('auth')->group(function(){

    //Route peminjaman
    Route::resource('pinjaman', 'PinjamanController');
    Route::get('pinjaman/create/{buku_id}', 'PinjamanController@create');

    //Route Stock
    Route::resource('stock', 'StockController');

    //Route Profile => User
    Route::resource('user', 'UserController');
    Route::get('profil','UserController@profil');

});



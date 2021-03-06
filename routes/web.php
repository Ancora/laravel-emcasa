<?php

use Illuminate\Support\Facades\Auth;
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
Route::resource('/produtos', 'ProdutosController');
Route::post('/produtos/search', 'ProdutosController@search');
Route::post('/produtos/order', 'ProdutosController@order');
Route::get('/contato', 'ContatosController@index');
Route::post('/contatos/enviar', 'ContatosController@enviar');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

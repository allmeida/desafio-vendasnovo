<?php

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

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/pessoa', 'PessoaController');
Route::resource('/fabricante', 'FabricanteController');
Route::resource('/produto', 'ProdutoController');
Route::resource('/venda', 'VendaController');

Route::get('lista-clientes', 'PessoaController@listaClientes')->name('lista.clientes');
Route::get('lista-produtos', 'ProdutoController@listaProdutos')->name('lista.produtos');

Route::get('relatoriopessoa', 'PessoaController@relatorio')->name('relatorio.pessoas');

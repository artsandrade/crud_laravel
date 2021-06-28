<?php

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
    return view('painel.inicio');
})->name('painel_get');

Route::prefix('clientes')->group(function () {
    Route::get('/', function () {
        return view('clientes.clientes');
    })->name('clientes_get');

    Route::get('alterar', function () {
        return view('clientes.alterar');
    })->name('clientes_alterar_get');

    Route::get('cadastrar', function () {
        return view('clientes.cadastrar');
    })->name('clientes_cadastrar_get');

    Route::get('visualizar', function () {
        return view('clientes.visualizar');
    })->name('clientes_visualizar_get');
});

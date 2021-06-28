<?php

use App\Http\Controllers\clientesController;
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
    Route::get('/', [clientesController::class, 'clientesGet'])->name('clientes_get');

    Route::get('alterar', [clientesController::class, 'alterarClienteGet'])->name('clientes_alterar_get');

    Route::post('alterar', [clientesController::class, 'alterarClientePost'])->name('clientes_alterar_postt');

    Route::get('cadastrar', [clientesController::class, 'cadastrarClienteGet'])->name('clientes_cadastrar_get');

    Route::post('cadastrar', [clientesController::class, 'cadastrarClientePost'])->name('clientes_cadastrar_post');

    Route::get('visualizar', [clientesController::class, 'visualizarClienteGet'])->name('clientes_visualizar_get');

    Route::post('remover', [clientesController::class, 'removerClientePost'])->name('clientes_remover_post');
});

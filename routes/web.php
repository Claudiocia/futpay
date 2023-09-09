<?php

use App\Http\Controllers\ContaController;
use App\Http\Controllers\FutpayController;
use App\Http\Controllers\LogadoController;
use App\Http\Controllers\MovimentoController;
use App\Http\Controllers\PlataformaController;
use App\Http\Controllers\TaxaController;
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

//Rotas abertas ao público
Route::get('/', [FutpayController::class, 'index'])->name('/');

//Rotas dos usuarios logados
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->get('/dashboard', [LogadoController::class, 'index'])->name('dashboard');

Route::group(['prefix' => 'logado', 'as' => 'logado.', 'middleware' => 'can:logado'
], function (){
    Route::put('users.update/{user}', [LogadoController::class, 'update'])->name('users.update');
    Route::get('users.edit/{user}', [LogadoController::class, 'edit'])->name('users.edit');
    Route::get('users.show/{user}', [LogadoController::class, 'show'])->name('users.show');
    Route::get('users.gerar-dep/{conta}', [LogadoController::class, 'gerarDeposito'])->name('users.gerar-dep');
    Route::put('users.depositar/{conta}', [LogadoController::class, 'depositar'])->name('users.depositar');
    Route::get('users.gerar-saq/{conta}', [LogadoController::class, 'gerarSaque'])->name('users.gerar-saq');
    Route::get('users.confirma-saq/{conta}', [LogadoController::class, 'confirmaSaque'])->name('users.confirma-saq');
    Route::put('users.sacar/{conta}', [LogadoController::class, 'sacar'])->name('users.sacar');
    Route::get('users.extrato/{conta}', [LogadoController::class, 'extrato'])->name('users.extrato');
    Route::get('users.extrato-detail/{movimento}', [LogadoController::class, 'extratoDetail'])->name('users.extrato-detail');
});

Route::group([
    'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'can:admin'
], function (){

    Route::name('dashboard-admin')->get('dashboard-admin', [UserController::class, 'admin']);
    Route::resource('users', UserController::class);
    Route::resource('plataformas', PlataformaController::class);
    Route::resource('contas', ContaController::class);
    Route::get('contas/{conta}/confirm', [ContaController::class, 'confirm'])->name('contas.confirm');
    Route::resource('movimentos', MovimentoController::class);
    Route::get('movimentos/{movimento}/confirma', [MovimentoController::class, 'confirma'])->name('movimentos.confirma');
    Route::get('movimentos/{movimento}/recusa', [MovimentoController::class, 'recusa'])->name('movimentos.recusa');
    Route::resource('taxas', TaxaController::class);
});

<?php

use App\Http\Controllers\FutpayController;
use App\Http\Controllers\LogadoController;
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

Route::group(['prefix' => 'logado', 'as' => 'logado.', 'middleware' => 'autorizador:logado'
], function (){

});

Route::group([
    'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'can:admin'
], function (){

    Route::name('dashboard-admin')->get('dashboard-admin', [UserController::class, 'admin']);
    Route::resource('users', UserController::class);
});

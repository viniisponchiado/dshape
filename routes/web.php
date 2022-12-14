<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MeasurementsController;
use App\Models\Measurements;
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

// Página inicial
Route::get('/', function () {
    return view('layouts/landing');
});


// Rota para fazer Login
Route::get('/login', function () {
    return view('layouts/login');
})->name('login');

Route::post('/auth',[LoginController::class,'auth']);
Route::get('/logout',[LoginController::class,'logout']);

//Rota para registrar um usuário
Route::get('/register', function () {
    return view('layouts/register');
});


Route::group(['middleware' =>'auth'],function(){
// Rota Home
Route::get('/home', [DashboardController::class, 'index']);
// Rota que abre a lista de medidas cadastradas
Route::get('/measurements', [MeasurementsController::class,'index']);
// Rota que abre o formulário para cadastrar nova medida
Route::get('/measurements/new', function () {
    return view('measurements/form');
});
// Rota que salva no banco de dados uma nova medida
Route::post('/measurements/new',[MeasurementsController::class,'store']);

//Rota que exclui uma medida do banco de dados
Route::delete('/measurements/{id}',[MeasurementsController::class,'destroy']);

//Rota que altera uma medida do banco de dados
Route::put('/measurements/{id}',[MeasurementsController::class,'update']);

// Rota que retorna uma medida específica do banco de dados
Route::get('/measurements/{id}',[MeasurementsController::class,'show']);
});



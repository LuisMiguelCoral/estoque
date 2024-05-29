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

use App\Http\Controllers\ProdutoController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('produtos', ProdutoController::class)->middleware('auth');

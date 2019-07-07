<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
Route::get('/teste-metodo-api', function (Request $request) {
    return "Teste está funcionando";
});
// Retornando todos os dados passado via corpo da requisição
Route::post('/post-teste-retorna-dados-form', function (Request $request) {
    return $request->all();
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

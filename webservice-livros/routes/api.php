<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth as auth;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|             ____________Padrão_____________
| Todos os novos métodos são criados acima dos mais antigos.
 */

Route::post('/login-usuario',"UsuarioController@login");

Route::middleware('auth:api')->get('/usuario', function (Request $request) {
    return $request->user();
});

Route::post('/cadastrar-usuario','CadastroUsuarioController@CadastrarUsuario');

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

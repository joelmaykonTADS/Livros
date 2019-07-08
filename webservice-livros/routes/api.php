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
|         
|
 */

/**
 * ---------------------------------------------------------
 *  MÉTODOS USANDO A CAMADA DE CONTROLLERS
 * ---------------------------------------------------------
 */

Route::middleware('auth:api')->post('/criar/livro',"LivroController@criarLivro");
Route::post('/login-usuario',"UsuarioController@login");
Route::post('/cadastrar-usuario',"UsuarioController@cadastro");


/*
|-----------------------------------------------------------
|   MÉTODOS  PARA TESTES INICIAIS NA API
|-----------------------------------------------------------
*/
// testando se retorna um usuario pelo id
Route::get('/teste-usuario-id',function(){
    $user = User::find(1);
    return $user;
});
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
Route::middleware('auth:api')->get('/usuario', function (Request $request) {
    return $request->user();
});

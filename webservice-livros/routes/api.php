<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
Route::middleware('auth:api')->get('/usuario', function (Request $request) {
    return $request->user();
});
Route::post('/cadastrar-usuario', function (Request $request) {
    $data = $request->all();
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        ]);
        $user->token = $user->createToken($user->email)->accessToken;
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

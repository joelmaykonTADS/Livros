<?php

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

Route::post('/login-usuario', function (Request $request) {
    // Dados passado via corpo da requisição
    $data = $request->all();

    //Validação de dados do login
    $validacao = Validator::make($data, [
        'email' => 'required|string|max:255|email',
        'password' => 'required|string',
    ]);
    //Retorna os erros que possivelmente ocorrerão caso os requisitos da validação não forem atendidos
    if ($validacao->fails()) {
        return $validacao->errors();
    };
    if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
        $user = auth()->user();
        $user->token = $user->createToken($user->email)->accessToken;
        return $user;
    }else{
        return ['status' => false, 'msg' => "Não autorizado"];
    } 
});

Route::middleware('auth:api')->get('/usuario', function (Request $request) {
    return $request->user();
});

Route::post('/cadastrar-usuario', function (Request $request) {
    // Dados passado via corpo da requisição
    $data = $request->all();

    //Validação de dados cadastrais
    $validacao = Validator::make($data, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255|email|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ]);
    //Retorna os erros que possivelmente ocorrerão caso os requisitos da validação não forem atendidos
    if ($validacao->fails()) {
        return $validacao->errors();
    };

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

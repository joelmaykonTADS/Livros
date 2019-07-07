<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth as auth;

class UsuarioController extends Controller
{
    //Metodo para o usuario fazer login
    public function Login(Request $request)
    {
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
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = auth()->user();
            $user->token = $user->createToken($user->email)->accessToken;
            return $user;
        } else {
            return ['status' => false, 'msg' => "Não autorizado"];
        }
    }
}

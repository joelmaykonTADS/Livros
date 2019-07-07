<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CadastroUsuarioController extends Controller
{
    //Método cadastrar usuário
    public function CadastrarUsuario(Request $request)
    {
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
    }
}

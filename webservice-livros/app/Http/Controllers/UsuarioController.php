<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->all();

        $valiacao = Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        if ($valiacao->fails()) {
            return ['status' => false, "validacao" => true, "erros" => $valiacao->errors()];
        }

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = auth()->user();
            $user->token = $user->createToken($user->email)->accessToken;
            //$user->imagem = asset($user->imagem);
            return ['status' => true, "usuario" => $user];
        } else {
            return ['status' => false];
        }
    }

    public function cadastro(Request $request)
    {
        $data = $request->all();

        $valiacao = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($valiacao->fails()) {
            return ['status' => false, "validacao" => true, "erros" => $valiacao->errors()];
        }
        $imagem = "/perfils/padrao.jpg";

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'imagem' => $imagem,
        ]);
        $user->token = $user->createToken($user->email)->accessToken;
        //$user->imagem = asset($user->imagem);

        return ['status' => true, "usuario" => $user];
    }
}

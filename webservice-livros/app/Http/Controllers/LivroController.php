<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Livro;
class LivroController extends Controller
{
    //
    public function criarLivro(Request $request){
        $data = $request->all();
        //retorna o usuário que fez a requisição atual
        $user = $request->user();

        //validação
        $livro = new Livro;
        $livro->texto = $data['texto'];
        $livro->imagem = $data['imagem'] ? $data['imagem']:'#';
        $livro->link = $data['link'] ? $data['link']:'#';
        $livro->data = date('Y-m-d H:i:s');
        // Salva o livro
        $user->livros()->save($livro);

        return ['status' => true, "livros" => $user->livros];
    }

}

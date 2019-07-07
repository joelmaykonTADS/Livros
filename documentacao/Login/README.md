# Login na API
importar o `use Auth;`
Implementação do metodo HTTP/POST onde as informações são `email` e  `password` com algumas validações como requerido  o email e senha para concluir o login entre outras validações.
```
    //Validação de dados do login
    $validacao = Validator::make($data, [
        'email' => 'required|string|max:255|email',
        'password' => 'required|string',
    ]);
    //Retorna os erros que possivelmente ocorrerão caso os requisitos da validação não forem atendidos
    if ($validacao->fails()) {
        return $validacao->errors();
    };
```
Usando a classe Auth do Laravel para fazer a autenticação usando o método estático para fazer a validação.

Se entrar no teste é poque o usuário teve suas credencias verificadas e autenticadas senão o usuário não estar autorizado:
```
    if(Auth::attemp(['email'=>$data['email'],'password'=>$data['password']])){
        $user = auth()->user();
        $user->token = $user->createToken($user->email)->accessToken;
        return $user;
    }else{
        return ['status' => false, 'msg' => "Não autorizado"];
    } 
```

### Criação de Cotrollers

Isolando implementação do login em um controlador

comando para gerar controlador: `php artisan make:controller LoginController`
Lógica do método de login transferida para o controlador
```
app
-Http
--Controllers
---Usuariocontroller.php
```
```
routes
-api.php
//rota para o controlador e acesso ao método login
Route::post('/login-usuario',"UsuarioController@login");
```
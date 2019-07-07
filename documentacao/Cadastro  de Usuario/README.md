### Criação de Cotrollers

Isolando implementação do cadastro em um controlador

comando para gerar controlador: `php artisan make:controller CadastroUsuarioController`
Lógica do método de cadastrar usuário transferida para o controlador
```
app
-Http
--Controllers
---CadastroUsuarioController.php
```
```
routes
-api.php
//rota para o controlador e acesso ao método login
Route::post('/cadastrar-usuario',"CadastroUsuarioController@cadastrar-usuario");
```
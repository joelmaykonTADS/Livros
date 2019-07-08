# Livros
## Documentação do sistema
 * [Login](https://github.com/joelmaykonTADS/Livros/blob/master/documentacao/Login/README.md)
 * [Cadastrar usuário](https://github.com/joelmaykonTADS/Livros/tree/master/documentacao/Cadastro%20%20de%20Usuario/README.md)
 * [Usuário criar livro](https://github.com/joelmaykonTADS/Livros/blob/master/documentacao/Livro/README.md)
### Projeto básico para cadastro de livros
 * Construção de um serviço web que utiliza métodos HTTP, para servir dados vindo de um banco de dados e expor esses dados para outras aplicações consumirem seguindo uma arquitetura distribuida do tipo REST
 ![Arquitetura REST Exemplo](https://cdn-images-1.medium.com/max/1600/1*MB6Yb2aOpx9r-ItuwXWNWw.jpeg)

## Documentaçao Laravel - Versão 5.5
### Instalação do Framework

Link da documentação: https://laravel.com/docs/5.5

Foi utilizado o composer para instalação do Laravel

Link da ferramenta: https://getcomposer.org/doc/00-intro.md

### Criação de um projeto no sistema operacional Debian
Execute o comando abaixo no passo 1:
 * `composer create-project --prefer-dist laravel/laravel webservice-livros "5.6.*"`
     * `--prefer-dist laravel/laravel` é o comando para a escolha da distribuição do laravel e a versão é a 5.5

### Configuração do passport (API Authentication) para verificação de autorização e autenticação no Laravel

Link da documentação: https://laravel.com/docs/5.5/passport

Foi utilizado o recurso de [acesso a tokens](https://laravel.com/docs/5.5/passport#personal-access-tokens), que permite que os usuários tenha acesso API e pode servir como uma abordagem mais simples para a emissão de tokens de acesso em geral.

Para instalação do passport, entre na pasta raiz do webservice criado e execute o comando abaixo:
 ```
 composer require laravel/passport
 ```
Registrar o seriviço do passaport no arquivo `config/app.php` na área `Application Service Providers...`
 ```
 Laravel\Passport\PassportServiceProvider::class,
 ```
Rodar o comando `php artisan passport:install` para gerar as chaves criptografadas do passport


### Configuração do banco de dados (SQLite) para laravel

No arquivo .env na raiz do projeto usar a seguinte configração

```  
DB_CONNECTION=sqlite
```

Apagar as 3 linhas abaixo:
```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```
Dentro do diretório config no arquivo database.php tem o seguite código que aponta para o sqlite

```
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
        ],
```

Dentro do diretório database foi criado o arquivo database.sqlite que é o banco de dados [SQLite](https://www.sqlite.org/index.html)

Para instalar o SQLite é necessário usar o seguinte comando:
`sudo apt-get install php7.0-sqlite
 && sudo apt-get install php-sqlite3`

Para usar o SQLite  é necessário alterar no php.ini do PHP instalado no seu sistema operacional das linhas abaixo:
```
;extension=pdo_sqlite
;extension=pdo_mysql
;extension=sqlite3
```
removendo o ";" da frente da linha 

### Execução de migrates no Laravel

Dentro do diretório migrates se encontra arquivos específicos para criação de tabelas e outras atividades relacionadas a manipulaçao de banco de dados.

as principais migrates são para criação da tabela de usuários e tabela resetar senhas que foram criadas automaticamente quando o passport foi instalando usando o composer.

O comando a seguir serve para executar as migrations
`php artisan migrate -v`

### Execução da aplicação localmente

Utiliza-se o comnado a seguir:
` php artisan serve`
### Ferramenta para testar as rotas da API
A ferramenta chama-ser Postman 
Link para download: https://www.getpostman.com/downloads/
### Rotas da API
No arquivo routes/api.php


Para acessa a rota usando o postman ou um navegador
usar a seguinte URL: http:localhost:8000/api/teste-metodo-api
Na pasta Postman se encontra um json que pode ser aberto no Postman para execução dos testes de rotas

Exemplo de uma rota de teste GET
```
Route::get('/teste-metodo-api', function(Request $request){
    return "Teste está funcionando";
   });
```

Exemplo de uma rota de teste POST

```
// Retornando todos os dados passado via corpo da requisição
Route::post('/post-teste-retorna-dados-form', function (Request $request) {
    return $request->all();
});
```
No caso de um teste do metodo anterior que é do tipo POST, Usando o Postman deve-se passa os dados no "body" da requisição usando chave e valor


## Cadastro de Usuários

### Criação de uma rota  em:
```
routes/
- api.php
```
O método `/cadastrar-usuario` utiliza a classe User como modelo, o eloquent para manipular ações de CRUD usando o metódo `create` e o [Hash::make](https://laravel.com/docs/5.0/hashing) do laravel para criptografar a senha, é passado três chaves(name, email e password) via requisição HTTP/POST que são respctivamente os três atributos da classe User:

```
app
- User.php
```

O campo email é atributo único:
``` 
database
- migrations
-- 2014_10_12_000000_createUsers_table.php

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
```


### Criando um Token para acesso aos metodos da API:

É utilizado o email do usuário para criar o token e armazena no atributo token da classe User(Usuário)

```
$user->token = $user->createToken($user->email)->accessToken;
```
O método de cadastro de usuário se encontra na pasta Postman deve-se passa os dados no "body" da requisição usando chave e valor: name:"", email:"" e password:""


## Autenticação de Usuarios

Usamos autenticação que já é disponibilizada pelo Laravel:
Link da documentação: https://laravel.com/docs/5.5/authentication

### Criação de uma rota  em:
O método é o `/usuario` 
```
routes/
- api.php
```
Ao acessar a rota passar os seguites dados no cabeçalho(Headers) da requisição:
```
"Autorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjcwM2NkZjIzMjhmMzIwZjNlNDExNTQyNTBmM2I2ZDM5MTJmYTYxMjc2NTU1Yjc2ZTYxOTc4NjhlYjdiZjAyOTYwZjM3ZDdkYWNkZDYxMTdjIn0.eyJhdWQiOiIxIiwianRpIjoiNzAzY2RmMjMyOGYzMjBmM2U0MTE1NDI1MGYzYjZkMzkxMmZhNjEyNzY1NTViNzZlNjE5Nzg2OGViN2JmMDI5NjBmMzdkN2RhY2RkNjExN2MiLCJpYXQiOjE1NjI1MDg4OTIsIm5iZiI6MTU2MjUwODg5MiwiZXhwIjoxNTk0MTMxMjkyLCJzdWIiOiI4Iiwic2NvcGVzIjpbXX0.OIPEunPVx0D9JF_N-vJB2xWd58qKjdGRmnKtDxj0KQfqST63Igt2zocAaMNEcKA7rFzDO8AYqDHjRavNB2GpD4Hx_K1m6kRaDpxbSlZkivqAw7-gQkARouyYC-cmX6LY-6EV03zpNmA70HyCM9kOOLXbPRoqIX5fOFKYR0iHvClS4JkyWkjemYguESddXY-6d3XaayJ4V1f3twOVhHJl_GJEnlhyHaoVPdr6--dpXNDn92bVRTRq8uctXyVj8Hcp-KAhvAikOFgcse9ZqJGPqzQfylEjGvHm5qRBmC4xgvRWfh_dvdxvyYowQ8rM9hDqfT5f59ZIJX7yvVKYrGgzzWCEnyN975ghc0DlHH1wZtHwC8dDZMPrunKuqdMmmyRLJAK7l4uwpaLaVM7r9IuYImWuBokLmGaZKHFU84bt5su6QCHlS6IuzrT7nsapKhROh6qP8mwoiHYJS9FRnyH70BgKNhxQIldrF1p22ywPVBlc8eZ9blH04JBrQUOaqLhz612t_MZqSM5DDTzAH9MLhBlqtdP4WBqLFicfr8zvwHVBJwj-K4oKVwQvGMpIdW7omAZAeeZBeXwVjqB4oOuSji5-2ZuGdwXhbaPRlQFrGL-rOg2BgbpjQdjqMBxMKbokp1mJof4y8Ar50emsPvpRa7c-BUnpMEDQ8KRdjkZwx-w"

```

```
Route::middleware('auth:api')->get('/usuario', function (Request $request) {
    return $request->user();
});
```
## Validação dos dados antes de cadastrar usuário 
Usamos a validação disponibilizada pelo Laravel
Link da documentação: https://laravel.com/docs/5.5/validation

Dentro do arquivo no método `/cadastrar-usuario`: 
```
routes/
- api.php`
```
```
    //Validação de dados cadastrais
    $validacao = Validator::make($data,[
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255|email|unique:users',
        'password' =>'required|string|min:6|confirmed', 
    ]);
    //Retorna os erros que possivelmente ocorrerão caso os requisitos da validação não forem atendidos
    if($validacao->fails()){
        return  $validacao->errors();
    };
```

É adicionado o campo `password_confirmation` que seria uma repetição da senha(`password`) para passar na validação que pede a comfirmação da senha do usuário na  criação de uma nova conta. 
### Tradução para português

Repositório: https://github.com/enniosousa/laravel-5.5-pt-BR-localization

Extraia os arquivos, copiar para `root/resources/lang/pt-br` se não existir o diretório pt-br pode criar.

Configuração para usar a tradução: 

```
// Linha 81 do arquivo config/app.php
'locale' => 'pt-br',
```

## Biblioteca do CORS no Laravel
Repositório: https://github.com/barryvdh/laravel-cors
### Instalação
no arquivo `config/app.php` adicione `Barryvdh\Cors\ServiceProvider::class,`

no arquivo `app/Http/Kernel.php` adicione no `protected $middlewareGroups` adicione `\Barryvdh\Cors\HandleCors::class,`

Execute o comando `composer require barryvdh/laravel-cors`

Execute o comando `php artisan vendor:publish --provider="Barryvdh\Cors\ServiceProvider"`

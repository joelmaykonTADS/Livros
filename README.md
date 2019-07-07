# Livros
## Projeto para cadastro de livros
 * Construção de um serviço web que utiliza métodos HTTP, para servir dados vindo de um banco de dados e expor esses dados para outras aplicações consumirem seguindo uma arquitetura distribuida do tipo REST
 ![Arquitetura REST Exemplo](https://cdn-images-1.medium.com/max/1600/1*MB6Yb2aOpx9r-ItuwXWNWw.jpeg)

## Laravel - Versão 5.5
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

 * `composer require laravel/passport "4.0"`


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

Dentro do diretório database foi criado o arquivo database.sqlite

Para poder usar o SQLite é necessário usar o seguinte comando:
`sudo apt-get install php7.0-sqlite
 && sudo apt-get install php-sqlite3`

E deve alterar no php.ini do PHP instalado no seu sistema operacional das linhas 
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
usar a seguite URL: http:localhost:8000/api/teste-metodo-api
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
No caso de um teste do metodo anterior que é do tipo POST, Usando o Postman deve-se passa os dados no "body" da requisição de forma chave e valor





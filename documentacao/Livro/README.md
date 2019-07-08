# CRIAR Livro

## Planejamento do banco de dados




![livro](https://cdn.shopify.com/s/files/1/0155/7645/products/laravel-featured_large.png?v=1432129716)


```
Livro
    id          integer
    user_id     integer unsigned
    titulo      string
    texto       string
    imagem      string
    link_livro  string
    data        dateTime
```

#### Criando Modelos e Migrações:

`php artisan make:model Livro -m`

#### Usando o eloquent para configurar as migrations e seu relacionamentos 
Link da documentação: https://laravel.com/docs/5.5/eloquent
Um  Usuario tem muitos Livros

Modelo User

```
    public function livros(){
        return $this->hasMany('App\Models\Livro');
    }
```

Modelo Livros

```
    public function user(){
        return $this->belongsTo('App\User');
    }
```
Migration usando um relacionamento um para muitos

```
    public function up()
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->longText('texto');
            $table->string('imagem');
            $table->string('link');
            $table->dateTime('data');
            $table->timestamps();
        });
    }
```
### Metodos usando as classes de modelo User e Livro

metodo de teste de retorno de um usuario passando o id default 1
```
// testando se retorna um usuario pelo id
Route::get('/teste-usuario-id',function(){
    $user = User::find(1);
    return $user;
});

##### Controlador para Livro

```
    public function criarLivro(Request $request){
        $data = $request->all();
        //retorna o usuário que fez a requisição atual
        $user = $request->user();

        //validação
        $livro = new Livro;
        $livro->texto = $data['texto'];
        $livro->imagem = $data['imagem'] ? $data['imagem']:'#';
        $livro->link = $data['link'] ? $data['link']:'#';
        $livro->data = data('Y-m-d H:i:s');
        // Salva o livro
        $users->livros()->save($livro);

        return ['status' => true, "usuario" => $user->livros];
    }
```

Rota de acesso a criação de Livros
Authorization `authorization` e `Bearer + token`
Body da reuqisição:
```
{
    texto : "string",
    imagem : "string",
    link : "string"
}

```

```
Route::middleware('auth:api')->post('/criar/livro',"LivroController@criarLivro");

```

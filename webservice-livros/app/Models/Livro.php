<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','texto','imagem','link','data'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    
    
    
    
    
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $fillable = ['imovel_id', 'nome', 'descricao', 'slug'];


    public function imovel()
    {
    return $this->belongsToMany(Imovel::class, 'imoveis_categorias');
    }
}

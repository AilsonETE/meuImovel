<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil_Usuario extends Model
{
    use HasFactory;

    protected $table = 'perfil_usuarios';
    protected $fillable = ['telefone', 'celular', 'descricao', 'sobre',
    'redes_sociais'];

    public function user(){
        return $this->belongsTo(User::class);
    }

}

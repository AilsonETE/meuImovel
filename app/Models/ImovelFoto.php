<?php

namespace App\Models;

use App\Models\Imovel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImovelFoto extends Model
{
    use HasFactory;
    protected $table = 'fotos_imoveis';
    protected $fillable = ['imovel_id','foto', 'is_thumb'];

    public function imovel(){

        return $this->BelongsTo(Imovel::class);
    }
}

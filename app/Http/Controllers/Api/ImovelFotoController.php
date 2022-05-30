<?php

namespace App\Http\Controllers\Api;

use App\Models\ImovelFoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImovelFotoController extends Controller
{
    private $imovelFoto;
    public function __construct(ImovelFoto $imovelFoto)
    {
        $this->imovelFoto = $imovelFoto;

    }

    public function setThumb($fotoId, $imovelId)
    {
        try
        {
            $foto = $this->imovelFoto
            ->where('imovel_id', $imovelId)
            ->where('is_thumb', true);

            if($foto->count()) $foto->fist()->update(['is_thumb' => false]);
             $foto->$this->imovelFoto->find($fotoId);
             $foto->update(['is_thumb' => true]);

            return response()->json([
                'data' => [
                    'msg' => 'Is_thumb Atualizado com sucesso'
                ]
            ], 200);


          }

           catch(\Exception $e){
            return response()->json(['Erro' => $e->getMessage()], 401);

           }
    }

    public function remove($fotoId)
    {
        try
        {
             $foto = $this->imovelFoto->find($fotoId);
            
             if($foto){

              //  Storage::disk('public')->delete($foto->foto);
             }

            return response()->json([
                'data' => [
                    'msg' => 'Is_thumb Atualizado com sucesso'
                ]
            ], 200);


          }

           catch(\Exception $e){
            return response()->json(['Erro' => $e->getMessage()], 401);

           }
    }
}

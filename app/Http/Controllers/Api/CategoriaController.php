<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Models\Categoria;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaRequest;

class CategoriaController extends Controller
{

    private $categoria;
    public function __construct(Categoria $categoria)
    {
        $this->categoria  = $categoria;

    }


    public function index()
    {
        $categoria = $this->categoria->paginate('10');

        return response()->json($categoria, 200);
    }


    public function store(CategoriaRequest $request)
    {
        $data = $request->all();

        try{

           $imovel = $this->categoria->create($data);

           return response()->json([
               'data' => [
                   'msg' => 'Categoria cadastrada com sucesso'
               ]
           ], 200);

        }catch(\Exception $e){
           $message = new ApiMessages($e->getMessage());
           return response()->json($message->getMessage(), 401);

        }
    }


    public function show($id)
    {
        try{
            $categoria = $this->categoria->findOrFail($id);

            return response()->json([
                'data' => [ $categoria
                ]
            ], 200);

         }catch(\Exception $e){
            return response()->json(['Erro' => $e->getMessage()], 401);

         }
    }


    public function update(CategoriaRequest $request, $id)
    {
        $data = $request->all();

        try{
           $categoria = $this->categoria->findOrFail($id); #se tiver exceção ja testa
           $categoria->update($data);

           return response()->json([
               'data' => [
                   'msg' => 'Categoria Atualizada com sucesso'
               ]
           ], 200);

        }catch(\Exception $e){
           return response()->json(['Erro' => $e->getMessage()], 401);

        }

    }


    public function destroy($id)
    {

        try{
            $categoria = $this->categoria->findOrFail($id); #se tiver exceção ja testa
            $categoria->delete();

            return response()->json([
                'data' => [
                    'msg' => 'Imovel excluido com sucesso'
                ]
            ], 200);

         }catch(\Exception $e){
            return response()->json(['Erro' => $e->getMessage()], 401);

         }

    }

    public function imovel($id){

        try {
        
            $categoria = $this->categoria->findOrFail($id);

            return response()->json([
                'data' => [ $categoria->imovel                    
                ]
            ], 200);
        
        }catch(\Exception $e){
          return response()->json(['Erro' => $e->getMessage()], 401);

        }
    }
}

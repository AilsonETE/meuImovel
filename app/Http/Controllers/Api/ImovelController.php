<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Models\Imovel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImovelRequest;

class ImovelController extends Controller
{
    private $imovel;
    public function __construct(Imovel $imovel)
    {
        $this-> imovel = $imovel;

    }

    public function index(){
      //  $imovel = $this->imovel->paginate('10');

      $imovel = auth('api')->user()->imovel();

      return response()->json($imovel->paginate(10), 200);

    }

    public function show($id){
        try{
            $imovel =  auth('api')->user()->imovel()->with('foto')->findOrFail($id);

            return response()->json([
                'data' => [ $imovel
                ]
            ], 200);

         }catch(\Exception $e){
            return response()->json(['Erro' => $e->getMessage()], 401);

         }

    }

    public function store(ImovelRequest $request){
         $data = $request->all();
         $data['user_id']= auth('api')->user()->id;

      //   dd($request->file('foto'));
      $imagens = $request->file('foto');

         try{

            $imovel = $this->imovel->create($data);

            if(isset($data['categorias'])&& count($data['categorias'])) {
                $imovel->categorias()->sync($data['categorias']);
            }

            //salvando a imagem no driver local
            if ($imagens){
                $imagensUploud = [];
                foreach ($imagens as $imagem){

                  //dd( $path = $imagem->store('images', 'public'));

                 $path = $imagem->store('images', 'public');

                 $imagensUploud[] = ['foto'=> $path, 'is_thumb' => false];

                }

                $imovel->foto()->createMany($imagensUploud);

            }

            return response()->json([
                'data' => [
                    'msg' => 'Imovel cadastrado com sucesso'
                ]
            ], 200);

         }catch(\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);

         }
    }

    public function update($id, ImovelRequest $request){
        $data = $request->all();
        $imagens =  $request->file('foto');

        try{
           $imovel = $this->imovel->findOrFail($id); #se tiver exceção ja testa
           $imovel->update($data);
           //dd($data);
           if(isset($data['categoria'])&& count($data['categoria'])) {
            $imovel->categoria()->sync($data['categoria']);
        }

        //salvando a imagem no driver local
        if ($imagens){
            $imagensUploud = [];
            foreach ($imagens as $imagem){

              //dd( $path = $imagem->store('images', 'public'));

             $path = $imagem->store('images', 'public');

             $imagensUploud[] = ['foto'=> $path, 'is_thumb' => false];

            }

            $imovel->foto()->createMany($imagensUploud);

        }

           return response()->json([
               'data' => [
                   'msg' => 'Imovel Atualizado com sucesso'
               ]
           ], 200);

        }catch(\Exception $e){
           return response()->json(['Erro' => $e->getMessage()], 401);

        }

    }

    public function destroy($id){

        try{
           $imovel = $this->imovel->findOrFail($id); #se tiver exceção ja testa
           $imovel->delete();

           return response()->json([
               'data' => [
                   'msg' => 'Imovel excluido com sucesso'
               ]
           ], 200);

        }catch(\Exception $e){
           return response()->json(['Erro' => $e->getMessage()], 401);

        }

    }
}



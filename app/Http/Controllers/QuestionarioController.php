<?php

namespace App\Http\Controllers;

use App\Models\Questionario;
use App\Models\Item;
use Illuminate\Http\Request;
use \Symfony\Component\HttpKernel\Exception\HttpException;

class QuestionarioController extends Controller
{

    public function index()
    {
        try{
            return Questionario::all();
        }catch(\Exception $e){
            $json = [
                'success' => false,
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ],
            ];

            return response()->json($json, 400);
        }

    }

    public function show($id)
    {
        try{
                        
            $questionario = Questionario::where('fkItem', $id)->first();
            $questionario->load('questoes');
            return $questionario;

            //return Questionario::find($id);

        }catch(\Exception $e){
            $json = [
                'success' => false,
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ],
            ];

            return response()->json($json, 400);
        }
    }

    public function store(Request $request)
    {

        try{
            $item = Item::create([
                    'fkMateria'     => $request->fkMateria,
                    'fkTipoDeItem'  => $request->fkTipoDeItem,
                    'ordem'         => $request->ordem
                ]);
            //return json_encode($item->pkItem);
            $questionario = Questionario::create([
                    'pontuacaoPorQuestao'   => $request->pontuacaoPorQuestao,
                    'minimoAprovacao'       => $request->minimoAprovacao,
                    'enunciado'             => $request->enunciado,
                    'fkItem'                => $item->pkItem,
                ]);
                
            return json_encode($questionario);

        }catch(\Exception $e){
            $json = [
                'success' => false,
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ],
            ];

            return response()->json($json, 400);
        }
    }

    public function update(Request $request, $id)
    {

        try{
            $questionario = Questionario::find($id);
            $questionario = $questionario->update($request->all());

            return json_encode($questionario);
        }catch(\Exception $e){
            $json = [
                'success' => false,
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ],
            ];

            return response()->json($json, 400);
        }
    }

    public function destroy($id)
    {
        
        try{
            $questionario = Questionario::findOrFail($id);
            $questionario->delete();    
            return $questionario;
        }catch(\Exception $e){
            $json = [
                'success' => false,
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ],
            ];

            return response()->json($json, 400);
        }
    }
}

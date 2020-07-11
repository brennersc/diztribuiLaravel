<?php

namespace App\Http\Controllers;

use App\Models\Respostas;
use App\Models\Questionario;
use Illuminate\Http\Request;
use \Symfony\Component\HttpKernel\Exception\HttpException;

class RespostasController extends Controller
{
    public function index()
    {
        try{
            return Respostas::all();
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
    public function getByQuestao($id)
    {
        try{
            return Respostas::where('fkQuestoes', $id)->get();
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
            $resposta = Respostas::find($id);
            $resposta->load('questionario');
            return $resposta;

            //return Respostas::find($id);
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
            $respostas = Respostas::create($request->all());
            return json_encode($respostas);
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
            $respostas = Respostas::find($id);
            $respostas = $respostas->update($request->all());

            return json_encode($respostas);
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
            $respostas = Respostas::findOrFail($id);
            $respostas->delete();
            return $respostas;
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

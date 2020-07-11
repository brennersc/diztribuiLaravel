<?php

namespace App\Http\Controllers;

use App\Models\Ferias;
use Illuminate\Http\Request;
use \Symfony\Component\HttpKernel\Exception\HttpException;

class FeriasController extends Controller
{
    public function index()
    {

        try{
            $ferias = Ferias::all();
            $ferias->load('status');
            return $ferias;

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
            $ferias = Ferias::find($id);
            
            return $ferias;

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
            $usuarioLogado = auth()->user();

            $ferias = Ferias::create([
                'fkUsuario'     => $usuarioLogado->pkUsuario,
                'dataInicio'    => $request->dataInicio,
                'dataFinal'     => $request->dataFinal,
                'fkStatus'      => 1,
            ]);

            return json_encode($ferias);
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

            $ferias = Ferias::find($id);

            $usuarioLogado = auth()->user();

            $ferias = $ferias->update($request->all());

            return json_encode($ferias);
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
            $ferias = Ferias::findOrFail($id);
            $ferias->delete();
            return $ferias;
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
    public function getByFerias()
    {

        try {
            $usuarioLogado = auth()->user();

            $ferias = Ferias::where('fkUsuario', $usuarioLogado->pkUsuario)->first();

            if(isset($ferias)){
                return  $ferias = ['ferias' => true];
            }
                return  $ferias = ['ferias' => false];

        } catch (\Exception $e) {
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

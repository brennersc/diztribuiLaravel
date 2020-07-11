<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gestor;
use App\Models\Usuario;
use App\Models\Setor;
use \Symfony\Component\HttpKernel\Exception\HttpException;
use App\Classes\GestorVM;

class GestorController extends Controller
{
    public function index()
    {
        $usuarioLogado = auth()->user();
        $retorno = array();
        try{


            if ($usuarioLogado->administrador) {
                $gestor = Gestor::all();
                $gestor->load('usuario');
                return $gestor;
            } else {
                $gestor = Gestor::where('fkEmpresa', $usuarioLogado->fkEmpresa)->get();
                $gestor->load('usuario');
                return $gestor;

            }
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
            $gestor = Gestor::find($id);
            $gestor->load('usuario');
            return $gestor;
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
            $gestor = Gestor::create($request->all());
            return json_encode($gestor);
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
            $gestor = Gestor::find($id);
            $gestor = $gestor->update($request->all());

            return json_encode($gestor);
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
            $gestor = Gestor::findOrFail($id);
            $gestor->delete();
            return $gestor;
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

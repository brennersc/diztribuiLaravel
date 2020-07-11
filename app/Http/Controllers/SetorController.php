<?php

namespace App\Http\Controllers;

use App\Models\Setor;
use App\Models\Usuario;
use Illuminate\Http\Request;
use \Symfony\Component\HttpKernel\Exception\HttpException;


class SetorController extends Controller
{

    public function index()
    {
        $usuarioLogado = auth()->user();

        try{
            return Setor::where('fkEmpresa',$usuarioLogado->fkEmpresa)->get();
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
    public function byEmpresa($id) {
        try{
            $setores = Setor::where('fkEmpresa',$id);
            return $setores;
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
            return Setor::find($id);
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
        $usuarioLogado = auth()->user();
        try{
            $setor = Setor::create($request->all());
            $setor->fkEmpresa = $usuarioLogado->fkEmpresa;
            $setor->save();
            return json_encode($setor);
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
            $setor = Setor::find($id);
            $setor = $setor->update($request->all());

            return json_encode($setor);
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
            $setor = Setor::findOrFail($id);
            $usuarios = Usuario::where("fkSetor", $setor->pkSetor)->get();
            if(count($usuarios) > 0) {
                $json = [
                    'success' => false,
                    'error' => [
                        'code' => '',
                        'message' => 'Você não pode escluir este setor pois ele esta sendo usado por um usuario',
                    ],
                ];

                return response()->json($json, 400);
            }
            $gestores = Usuario::where("fkSetor", $setor->pkSetor)->get();
            if(count($gestores) > 0) {
                $json = [
                    'success' => false,
                    'error' => [
                        'code' => '',
                        'message' => 'Você não pode escluir este setor pois ele esta sendo usado por um gestor',
                    ],
                ];

                return response()->json($json, 400);
            }


            $setor->delete();

            return 204;
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;
use App\Models\Item;
use \Symfony\Component\HttpKernel\Exception\HttpException;


class MateriaController extends Controller
{
    //
    public function index()
    {

        $usuarioLogado = auth()->user();

        try{
            $materia = Materia::all();
            $materia->load('categoria');
            return $materia;
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
            $materias = Materia::find($id);
            $materias->load('conteudos');
            $materias->load('categoria');
            return $materias;
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
            if($request->fkCategoria==0||$request->fkCategoria=='') {
                $json = [
                    'success' => false,
                    'error' => [
                        'code' =>1,
                        'message' => "O campo categoria é obrigatorio.",
                    ],
                ];

                return response()->json($json, 400);
            }
            return Materia::create($request->all());
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
            $materia = Materia::findOrFail($id);
            $materia->update($request->all());
            return $materia;
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

    public function destroy(Request $request, $id)
    {
        try{
            $itens = Item::where('fkMateria',$id)->get();
            if(count($itens) > 0) {
                $json = [
                    'success' => false,
                    'error' => [
                        'code' =>'',
                        'message' => "Você deve excluir todos os itens da materia antes de continuar.",
                    ],
                ];

                return response()->json($json, 400);
            }
            $materia = Materia::findOrFail($id);
            $materia->delete();

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

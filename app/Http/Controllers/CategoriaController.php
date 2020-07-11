<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Materia;
use \Symfony\Component\HttpKernel\Exception\HttpException;

class CategoriaController extends Controller
{
    public function index()
    {
        $usuarioLogado = auth()->user();
        try{
            return Categoria::where('fkEmpresa',$usuarioLogado->fkEmpresa)->get();
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
            $categoria =Categoria::find($id);
            $categoria->load('materias');
            return $categoria;
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
            $categoria = Categoria::create($request->all());
            $categoria ->fkEmpresa = $usuarioLogado->fkEmpresa;
            $categoria ->save();
            return $categoria;
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
            $categoria = Categoria::findOrFail($id);
            $categoria->update($request->all());
            return $categoria;

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
    public function listaMaterias($id) {
        return Materia::where('fkCategoria', $id)->get();
    }

    public function destroy(Request $request, $id)
    {
        try{
            $categoria = Categoria::findOrFail($id);
            $categoria->delete();
            return $categoria;
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

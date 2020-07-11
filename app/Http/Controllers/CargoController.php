<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;
use \Symfony\Component\HttpKernel\Exception\HttpException;

class CargoController extends Controller
{

    public function index()
    {
        $usuarioLogado = auth()->user();

        try{
            return Cargo::where('fkEmpresa',$usuarioLogado->fkEmpresa)->get();
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
            return Cargo::find($id);
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
            $cargo = Cargo::create($request->all());
            $cargo->fkEmpresa = $usuarioLogado->fkEmpresa;
            $cargo->save();
            return json_encode($cargo);
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
            $cargo = Cargo::find($id);
            $cargo = $cargo->update($request->all());

            return json_encode($cargo);
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
            $cargo = Cargo::findOrFail($id);
            $cargo->delete();
            return $cargo;
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

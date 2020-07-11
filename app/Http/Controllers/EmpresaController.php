<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use \Symfony\Component\HttpKernel\Exception\HttpException;
use Validator;

class EmpresaController extends Controller
{
    public function index()
    {

        $usuarioLogado = auth()->user();

        try{
            if ($usuarioLogado->administrador) {
                return Empresa::all();
            } else {
                return Empresa::where('pkEmpresa', $usuarioLogado->fkEmpresa)->get();
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
            return Empresa::find($id);
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
        $validator = Validator::make(
            $request->all(),
            [
                'cnpj' => 'cnpj'
            ]
        );
        if ($validator->fails()) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => '',
                    'message' => "CNPJ inválido.",
                ],
            ];

            return response()->json($json, 400);
        }

        if(Empresa::where('cnpj', $request->cnpj)->first() != NULL){
            $json = [
                'success' => false,
                'error' => [
                    'code' => '',
                    'message' => "Este CNPJ já esta cadastrado.",
                ],
            ];

            return response()->json($json, 400);
        }else{

        try{
             $empresa = Empresa::create($request->all());
            return json_encode($empresa);

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

    public function update(Request $request, $id)
    {

        try{
            $empresa = Empresa::find($id);
            $empresa = $empresa->update($request->all());

            return json_encode($empresa);
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
            $empresa = Empresa::findOrFail($id);
            $empresa->delete();

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

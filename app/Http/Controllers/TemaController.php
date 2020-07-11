<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tema;
use \Symfony\Component\HttpKernel\Exception\HttpException;

class TemaController extends Controller
{
    public function index()
    {
        try{
            return Tema::all();
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
            return Tema::find($id);
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
            return Tema::create($request->all());
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
            $tema = Tema::findOrFail($id);
            $tema->update($request->all());

            return $tema;
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

    public function delete(Request $request, $id)
    {
        try{
            $tema = Tema::findOrFail($id);
            $tema->delete();

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

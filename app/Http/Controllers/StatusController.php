<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use \Symfony\Component\HttpKernel\Exception\HttpException;

class StatusController extends Controller
{
    public function index()
    {

        try{
            $status = Status::all();
            return $status;

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
            $status = Status::find($id);
            
            return $status;

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

            $status = Status::create($request->all());

            return json_encode($status);
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

            $status = Status::find($id);

            $usuarioLogado = auth()->user();

            $status = $status->update($request->all());

            return json_encode($status);
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
            $status = Status::findOrFail($id);
            $status->delete();
            return $status;
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

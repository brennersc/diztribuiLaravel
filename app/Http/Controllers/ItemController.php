<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Questionario;
use \Symfony\Component\HttpKernel\Exception\HttpException;

class ItemController extends Controller
{
    //
    public function index()
    {
        try {
            return Item::all();
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


    public function createQuestionario(Request $request)
    {

        try {
            $item = Item::create($request->all());

            return $item;
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
    public function getByMateria($id)
    {
        try {
            return Item::where('fkMateria', $id)->get();
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
    public function show($id)
    {
        try {

            $item = Item::find($id);
            $item->load('tipoDeConteudo');
            $item->load('questoes');

            for($i=0;$i<count($item->questoes);$i++) {
                $item->questoes[$i]->load('respostas');
            }
            return $item;

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

    public function store(Request $request)
    {
        try {
            return Item::create($request->all());
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

    public function update(Request $request, $id)
    {
        try {
            $item = Item::findOrFail($id);
            $item->update($request->all());

            return $item;
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

    public function destroy(Request $request, $id)
    {
        try {
            $item = Item::findOrFail($id);
            $item->delete();
            return 204;
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

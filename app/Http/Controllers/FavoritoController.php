<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorito;
use \Symfony\Component\HttpKernel\Exception\HttpException;

class FavoritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarioLogado = auth()->user();
        
        try {
            $favorito = Favorito::select('usuario.pkUsuario','materias.pkMateria','materias.titulo', 'materias.descricao')
            ->join('usuario', 'usuario.pkUsuario', '=', 'favoritos.fkUsuario')
            ->join('materias', 'materias.pkMateria', '=', 'favoritos.fkMateria')
            ->where('usuario.pkUsuario', '=', $usuarioLogado->pkUsuario)              
            ->get();
            
            return $favorito;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $fkUsuario = auth()->user()->pkUsuario;

            $favorito = Favorito::where('fkUsuario', $fkUsuario)->where('fkMateria', $request->fkMateria)->first();

            if(isset($favorito)){
                Favorito::where('fkUsuario', $fkUsuario)->where('fkMateria', $request->fkMateria)->delete();
                return  $favorito = ['favorito' => false] ;
            }else{
                $favorito = Favorito::create([
                    'fkUsuario' => $fkUsuario,
                    'fkMateria' => $request->fkMateria
                ]);
            }
           return $favorito;
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($fkMateria)
    {

        //return 'ID '. $fkMateria;

        $fkUsuario = auth()->user()->pkUsuario;

        try{
            $favorito = Favorito::where('fkUsuario', $fkUsuario)->where('fkMateria', $fkMateria)->first();

            if(isset($favorito)){
                return $favorito = ['favorito' => true] ;
            }
            return  $favorito = ['favorito' => false] ;

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Gestor;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario =  auth()->user();
        $jsonRetorno = array();

        if ($usuario != null) {
            if ($usuario->administrador == 1) {
                $menus = Menu::whereNull('pai')->where('administrador', true)->orderBy('ordem', 'asc')->get();
                foreach ($menus as $pai) {
                    $arrFilhos = array();
                    $filhos = Menu::where('pai', $pai->pkMenu)->where('administrador', true)->orderBy('ordem', 'asc')->get();
                    foreach ($filhos as $filho) {
                        $filhoArr = array('value' => $filho->descricao, 'url' => $filho->url);
                        array_push($arrFilhos, $filhoArr);
                    }
                    $paiArr = array('name' => $pai->descricao, 'id' => $pai->pkMenu, 'url' => $pai->url, 'submenus' => $arrFilhos, 'icon' => $pai->icon);
                    array_push($jsonRetorno, $paiArr);
                }
                return response()->json($jsonRetorno, 200);
            }
            $gestores = Gestor::where('fkUsuario', $usuario->pkUsuario)->get();

            foreach ($gestores as $gestor) {
                if ($gestor->ehmaster) {
                    $menus = Menu::whereNull('pai')->where('master', true)->orderBy('ordem', 'asc')->get();
                    foreach ($menus as $pai) {
                        $arrFilhos = array();
                        $filhos = Menu::where('pai', $pai->pkMenu)->where('master', true)->orderBy('ordem', 'asc')->get();
                        foreach ($filhos as $filho) {
                            $filhoArr = array('value' => $filho->descricao, 'url' => $filho->url);
                            array_push($arrFilhos, $filhoArr);
                        }
                        $paiArr = array('name' => $pai->descricao, 'id' => $pai->pkMenu, 'url' => $pai->url, 'submenus' => $arrFilhos,  'icon' => $pai->icon);
                        array_push($jsonRetorno, $paiArr);
                    }
                    return response()->json($jsonRetorno, 200);
                }
            }
            foreach ($gestores as $gestor) {
                $menus = Menu::whereNull('pai')->where('gestor', true)->orderBy('ordem', 'asc')->get();
                foreach ($menus as $pai) {
                    $arrFilhos = array();
                    $filhos = Menu::where('pai', $pai->pkMenu)->where('gestor', true)->orderBy('ordem', 'asc')->get();
                    foreach ($filhos as $filho) {
                        $filhoArr = array('value' => $filho->descricao, 'url' => $filho->url);
                        array_push($arrFilhos, $filhoArr);
                    }
                    $paiArr = array('name' => $pai->descricao, 'id' => $pai->pkMenu, 'url' => $pai->url, 'submenus' => $arrFilhos, 'icon' => $pai->icon);
                    array_push($jsonRetorno, $paiArr);
                }
                return response()->json($jsonRetorno, 200);
            }
            $menus = Menu::whereNull('pai')->where('usuario', true)->orderBy('ordem', 'asc')->get();
            foreach ($menus as $pai) {
                $arrFilhos = array();
                $filhos = Menu::where('pai', $pai->pkMenu)->where('usuario', true)->orderBy('ordem', 'asc')->get();
                foreach ($filhos as $filho) {
                    $filhoArr = array('value' => $filho->descricao, 'url' => $filho->url);
                    array_push($arrFilhos, $filhoArr);
                }
                $paiArr = array('name' => $pai->descricao, 'id' => $pai->pkMenu, 'url' => $pai->url, 'submenus' => $arrFilhos, 'icon' => $pai->icon);
                array_push($jsonRetorno, $paiArr);
            }
            return response()->json($jsonRetorno, 200);
        } else {
            return array('status' => 'Token is invalid');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

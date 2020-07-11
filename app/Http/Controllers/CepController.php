<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CepController extends Controller
{
    //
    public function index($id)
    {
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "Accept: application/json\r\n"
            ]
        ];
        
        $context = stream_context_create($opts);
        
        $file = file_get_contents('http://cep.la/'.$id, false, $context);
        return $file;
    }
}

<?php

namespace App\Models;

class Alerta extends \App\Models\AbstractModels\AbstractAlerta
{
    protected $fillable = [

        'mensagem',
        'fkSetor',
        'fkUsuario',
        'grupo',
        'fkEmpresa',
        'titulo'
    ];
}

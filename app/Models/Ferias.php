<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ferias extends \App\Models\AbstractModels\AbstractFerias
{
    protected $fillable = ['fkUsuario','dataInicio','dataFinal','fkStatus','resposta' ]; 
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorito extends \App\Models\AbstractModels\AbstractFavorito
{
    protected $fillable = ['fkUsuario','fkMateria' ]; 

}

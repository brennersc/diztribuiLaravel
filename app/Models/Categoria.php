<?php
namespace App\Models;

class Categoria extends \App\Models\AbstractModels\AbstractCategoria
{
    protected $fillable = ['titulo', 'fkEmpresa', 'fkCategoria'];
}

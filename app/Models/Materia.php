<?php
namespace App\Models;

class Materia extends \App\Models\AbstractModels\AbstractMateria
{
    protected $fillable = [ 'titulo', 'descricao', 'fkCategoria' ];
}

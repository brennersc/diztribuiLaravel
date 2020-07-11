<?php
namespace App\Models;

class Gestor extends \App\Models\AbstractModels\AbstractGestor
{
    protected $fillable = [ 'fkSetor','fkEmpresa','fkUsuario','ehmaster' ]; 

}

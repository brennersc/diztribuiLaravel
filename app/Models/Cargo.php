<?php
namespace App\Models;

class Cargo extends \App\Models\AbstractModels\AbstractCargo
{
    protected $fillable = ['nome', 'fkEmpresa'];
}

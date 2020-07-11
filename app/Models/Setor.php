<?php
namespace App\Models;

class Setor extends \App\Models\AbstractModels\AbstractSetor
{
    protected $fillable = ['nome', 'fkEmpresa'];
}

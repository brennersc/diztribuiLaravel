<?php
namespace App\Models;

class Questoes extends \App\Models\AbstractModels\AbstractQuestoes

{
    protected $fillable = [ 'fkItem','enunciado' ];
}

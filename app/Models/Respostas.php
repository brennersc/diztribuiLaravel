<?php
namespace App\Models;

class Respostas extends \App\Models\AbstractModels\AbstractRespostas
{
    protected $fillable = [

        'fkQuestoes',
        'texto' ,
        'correta',
        'pontuacaoPorQuestao' ,
        'fKquestionario'
    ];
}

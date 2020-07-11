<?php
namespace App\Models;

class Item extends \App\Models\AbstractModels\AbstractItem
{
    protected $fillable = [ 'texto', 'videoIncorporado', 'questionario', 'fkTipoDeItem', 'fkMateria','pontuacaoPorQuestao','minimoAprovacao' ];

}

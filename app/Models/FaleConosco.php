<?php

namespace App\Models;

class FaleConosco extends \App\Models\AbstractModels\AbstractFaleConosco
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fale_conosco';

    protected $fillable = [

        'mensagem',
        'fkUsuario',
        'titulo'
    ];
}

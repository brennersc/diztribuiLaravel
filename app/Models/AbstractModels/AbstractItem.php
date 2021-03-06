<?php
/**
 * Model object generated by: Skipper (http://www.skipper18.com)
 * Do not modify this file manually.
 */

namespace App\Models\AbstractModels;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractItem extends Model
{
    /**
     * Primary key name.
     *
     * @var string
     */
    public $primaryKey = 'pkItem';

    /**
     * Primary key type.
     *
     * @var string
     */
    protected $keyType = 'bigInteger';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'pkItem' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'fkMateria' => 'integer',
        'fkTipoDeItem' => 'integer',
        'texto' => 'string',
        'videoIncorporado' => 'string',
        'ordem' => 'integer'
    ];

    public function materia()
    {
        return $this->belongsTo('\App\Models\Materia', 'fkMateria', 'pkMateria');
    }

    public function tipoDeConteudo()
    {
        return $this->belongsTo('\App\Models\TipoDeitem', 'fkTipoDeItem', 'pkTipoDeItem');
    }

    public function questoes()
    {
        return $this->hasMany('\App\Models\Questoes', 'fkItem', 'pkItem');
    }
}

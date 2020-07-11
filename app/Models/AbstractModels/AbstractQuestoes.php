<?php
/**
 * Model object generated by: Skipper (http://www.skipper18.com)
 * Do not modify this file manually.
 */

namespace App\Models\AbstractModels;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractQuestoes extends Model
{
    /**
     * Primary key name.
     *
     * @var string
     */
    public $primaryKey = 'pkQuestoes';

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
        'pkQuestoes' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'enunciado' => 'string',
        'fkItem' => 'integer'
    ];

    public function item()
    {
        return $this->belongsTo('\App\Models\Item', 'fkItem', 'pkItem');
    }

    public function respostas()
    {
        return $this->hasMany('\App\Models\Respostas', 'fkQuestoes', 'pkQuestoes');
    }
}

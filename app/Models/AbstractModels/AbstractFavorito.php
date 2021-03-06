<?php
/**
 * Model object generated by: Skipper (http://www.skipper18.com)
 * Do not modify this file manually.
 */

namespace App\Models\AbstractModels;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractFavorito extends Model
{
    /**
     * Primary key name.
     *
     * @var string
     */
     protected $table = 'favoritos';
    
    //public $primaryKey = 'pkFavoritos';

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
        'pkUsuario' => 'integer',
        'pkMateria' => 'integer',
    ];

    public function usuario()
    {
        return $this->belongsToMany('\App\Models\Usuario', 'Usuario', 'fkUsuario');
    }

    public function materia()
    {
        return $this->belongsToMany('\App\Models\Materia', 'fkMateria', 'pkMateria');
    }
}

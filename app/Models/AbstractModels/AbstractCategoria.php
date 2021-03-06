<?php
/**
 * Model object generated by: Skipper (http://www.skipper18.com)
 * Do not modify this file manually.
 */

namespace App\Models\AbstractModels;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractCategoria extends Model
{
    /**  
     * Primary key name.
     * 
     * @var string
     */
    public $primaryKey = 'pkCategoria';
    
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
        'pkCategoria' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'fkEmpresa' => 'integer',
        'titulo' => 'string'
    ];
    
    public function empresa()
    {
        return $this->belongsTo('\App\Models\Empresa', 'fkEmpresa', 'pkEmpresa');
    }
    
    public function materias()
    {
        return $this->hasMany('\App\Models\Materia', 'fkCategoria', 'pkCategoria');
    }
}

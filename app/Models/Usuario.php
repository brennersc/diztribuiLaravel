<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
class Usuario extends Authenticatable implements JWTSubject
{
    use Notifiable;
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'usuario';
    /**
     * Primary key name.
     *
     * @var string
     */
    public $primaryKey = 'pkUsuario';
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
        'nome' => 'string',
        'email' => 'string',
        'cpf' => 'string',
        'telefone' => 'string',
        'urlImage' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'fkEmpresa' => 'integer',
        'fkSetor' => 'integer',
        'fkCargo' => 'integer',
        'facebook' => 'string',
        'instagram' => 'string',
        'twitter' => 'string',
        'linkedin' => 'string',
        'site' => 'string',
        'senha' => 'string',
        'confirmasenha' => 'string'
    ];
    protected $fillable = [
        'pkUsuario',
        'nome',
        'email',
        'cpf',
        'telefone',
        'urlImage',
        'fkEmpresa',
        'fkSetor',
        'fkCargo',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'site',
        'password',
    ];
    protected $hidden = array('password', 'token');
    public function empresa()
    {
        return $this->belongsTo('\App\Models\Empresa', 'fkEmpresa', 'pkEmpresa');
    }
    public function setor()
    {
        return $this->belongsTo('\App\Models\Setor', 'fkSetor', 'pkSetor');
    }
    public function cargo()
    {
        return $this->belongsTo('\App\Models\Cargo', 'fkCargo', 'pkCargo');
    }
    public function gestors()
    {
        return $this->hasMany('\App\Models\Gestor', 'fkUsuario', 'pkUsuario');
    }
    public function redesSociais()
    {
        return $this->hasMany('\App\Models\RedesSociais', 'fkUsuario', 'pkUsuario');
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function setPasswordAttribute($password)
    {
        if ( $password !== null & $password !== "" ) {
            $this->attributes['password'] = bcrypt($password);
        }
    }
}

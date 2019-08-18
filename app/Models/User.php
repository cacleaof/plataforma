<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Balance;
use App\Models\Historic;
use App\Models\Diario;
use Illuminate\Database\Eloquent\Model;
use App\Role;
use App\Models\Permission;
use Auth;
use DB;


class User extends Authenticatable
{
    use Notifiable;
    //use SoftDeletes { SoftDeletes::restore insteadof EntrustUserWithPermissionsTrait; }
    //use EntrustUserWithPermissionsTrait;
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cpf', 'name', 'email', 'cns', 'nacionalidade', 'data_nascimento', 'sexo', 'telefone_residencial', 'telefone_celular', 'conselho', 'num_conselho', 'razao_social', 'nome_fantasia', 'cnes', 'cnpj', 'cep', 'logradouro', 'uf', 'cidade', 'cbo_codigo', 'especialidade', 'ocupacao', 'nome_cargo', 'ine', 'password'  
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }  

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function balance()
    {
        return $this->hasone(Balance::class);
    }
    public function historics()
    {
        return $this->hasMany(Historic::class);
    }
    public function diarios()
    {
        return $this->hasMany(Diario::class);
    }

    public function consults()
    {
        return $this->hasMany(Consults::class);
    }


    public function getSender($sender)
    {
        return $this->where('name', 'LIKE', "%$sender%")
            ->orWhere('email', $sender)
            ->get()
            ->first();
    }
}

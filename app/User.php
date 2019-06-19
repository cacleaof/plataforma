<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Balance;
use App\Models\Historic;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable
{
    use Notifiable;

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

    public function consults()
    {
        return $this->hasMany(consults::class);
    }


    public function getSender($sender)
    {
        return $this->where('name', 'LIKE', "%$sender%")
            ->orWhere('email', $sender)
            ->get()
            ->first();
    }
}

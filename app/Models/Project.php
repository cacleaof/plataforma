<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\Models\Diario;

class Project extends Model
{
	protected $fillable = ['proj_id', 'projeto', 'proj_detalhe', 'duracao', 'gerente', 'urg', 'imp'];
	
	 public function project()
    {
    	return $this->belongsTo(Project::class);
    }
    public function diarios()
    {
        return $this->hasMany(Diario::class, 'proj_id');
    }
}

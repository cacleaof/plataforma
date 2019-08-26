<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $fillable = ['task', 'detalhe', 'date_ini', 'date_fim', 'prevdias', 'urg', 'imp', 'proj_id'];

    public function task()
    {
    	return $this->belongsTo(Task::class);
    }
}

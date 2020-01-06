<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $fillable = ['task', 'detalhe', 'progress', 'start_date', 'date_fim', 'prevdias', 'urg', 'imp', 'proj_id', 'user_id'];

	protected $appends = ["open"];

	public function getOpenAttribute(){
        return true;
    }

    //public function task()
    //{
    //	return $this->belongsTo(Task::class);
    //}
}

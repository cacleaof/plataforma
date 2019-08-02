<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use app\models\project;

class Project extends Model
{
	 public function project()
    {
    	return $this->belongsTo(Project::class);
    }
}

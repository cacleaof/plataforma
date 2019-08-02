<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Project extends Model
{
	 public function project()
    {
    	return $this->belongsTo(Project::class);
    }
}

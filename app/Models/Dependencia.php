<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dependencia;

class Dependencia extends Model
{
    public function dependencia()
    {
    	return $this->belongsTo(Dependencia::class);
    }
}

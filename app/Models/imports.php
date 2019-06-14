<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class imports extends Model
{

  //protected $fillable = ['reg_id'];

    public function imports()
    {
    	return $this->belongsTo(imports::class);
    }  //
}

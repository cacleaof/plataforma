<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class file extends Model
{
    public function consult()
    {
    	return $this->belongsTo(consult::class);
    }//
}

<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class import extends Model
{
  protected $fillable = ['reg_id'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }  //
}

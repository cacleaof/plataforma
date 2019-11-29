<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\models\user;

class Consult extends Model
{
	protected $fillable = ['reg_id','user_id'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function consult()
    {
    	return $this->belongsTo(consult::class);
    }//
}

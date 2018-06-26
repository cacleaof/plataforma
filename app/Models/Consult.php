<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\user;

class Consult extends Model
{
	protected $fillable = ['reg_id'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\user;

class Consult extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function nova(float $value) : Array
    {
    	DB::beginTransaction();

    	$deposit = $this->save();

    	$consult = auth()->user()->consults()->create([
    		'descriçao' 			=> 'I',
    	//	'date' 			=> date('Ymd'),
    	]);

    	if ($deposit && $historic) {

    		DB::commit();
    	
    		return[
    			'success' => true,
    			'message' => 'Sucesso ao recarregar'
    		];
    	} else {

    		DB::rollback();


    	return [
    		'success' => false,
    		'message' => 'falha ao carregar'
    		];
    	};
    }
}

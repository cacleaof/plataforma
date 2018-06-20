<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Consult;
use App\Models\Perfil;

class ConsultController extends Controller
{
   public function entrada(Consult $consult, Perfil $perfil, User $user)
    {

	$consults = $consult->where('status', 'S')->get();
    
    $sol = $perfil->where('perfil', 'S')->where('user_id', auth()->user()->id)->get();
    //dd($posts);

    	return view('admin.consult.entrada', compact('consults', 'sol'));
    }
    public function saida(Consult $consult)
    {

    $consults = $consult->where('user_id', auth()->user()->id)->get();

        return view('admin.consult.saida', compact('consults'));
    }
    public function finalizada(Consult $consult)
    {
        $consults = $consult->all();
        $status = $consult->status;

        return view('admin.consult.finalizada', compact('consults'));
    }
    public function nova(Request $request)
    {

        return view('admin.consult.nova');
    } 
    public function store(Request $request)
    {
        $dataForm = $request->all();

        return 'criando';
    } 
}

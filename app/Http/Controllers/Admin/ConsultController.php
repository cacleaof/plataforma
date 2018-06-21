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

    $solS = $perfil->where('perfil', 'S')->where('user_id', auth()->user()->id)->get();
    //dd($sol);

    if ($solS) {

	$consults = $consult->where('status', 'S')->get();
    }

    $solR = $perfil->where('perfil', 'R')->where('user_id', auth()->user()->id);
    
    //dd($solR);

    if ($solR) {

        //dd($solR);
    $consults = $consult->where('status', 'R')->get();

    dd($consults);

    }

    //else {$consults=='null';}


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
    public function nova(Consult $consult)
    {
        $consults = $consult->all();

        return view('admin.consult.nova', compact('consults'));
    } 
    public function store(Request $request)
    {
        $dataForm = new Consult;
        //$dataForm = $request->except('_token');

        $dataForm->consulta = $request->consulta;
        $dataForm->serviço = $request->serviço;
        $dataForm->ativo = $request->ativo;
        $dataForm->paciente = $request->paciente;
        $dataForm->idade = $request->idade;
        $dataForm->queixa = $request->queixa;
        $dataForm->instituiçao = $request->instituiçao;
        $dataForm->municipio_sol = $request->municipio_sol;
        $dataForm->area = $request->area;
        $dataForm->status = 'R';
        //dd($dataForm);
        $dataForm->user_id = auth()->user()->id;
        //dd($dataForm);
        
        $dataForm->save();

        return redirect('/admin');
    } 
}

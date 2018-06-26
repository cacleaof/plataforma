<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Consult;
use App\Models\Perfil;
use DB;


class ConsultController extends Controller
{
   public function entrada(Consult $consult, Perfil $perfil, User $user)
    {

    $solS = $perfil->where('perfil', 'S')->where('user_id', auth()->user()->id)->get()->isEmpty();
    //dd($solS);

    if (!$solS) {
    
	$consults = $consult->where('status', 'S')->where('user_id', auth()->user()->id)->get();
    
    }
    else{$consults=null;}
    //dd($consults);

    $solR = $perfil->where('perfil', 'R')->where('user_id', auth()->user()->id)->get()->isEmpty();
    
    //dd($solR);

    if (!$solR) {

        //dd($solR);
    $consreg = $consult->where('status', 'R')->get();
    //dd($consreg);
    }
    else{$consreg=null;}

    $solC = $perfil->where('perfil', 'C')->where('user_id', auth()->user()->id)->get()->isEmpty();
    
    //dd($solR);

    if (!$solC) {

        //dd($solR);
    $conscons = $consult->where('cons_id', auth()->user()->id)->get();
    //dd($consreg);
    }
    else{$conscons=null;}


    	return view('admin.consult.entrada', compact('consults', 'consreg', 'sol', 'conscons'));

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
    public function regular(consult $consult, Request $request, Perfil $perfil, User $user)
    {
        
        
        $consults = $consult->where('id', $request->sid)->get();
        
        $solRs = $perfil->where('perfil', 'C')->get($perfil->user_id);
        
        $sid = $request->sid;
        $users = $user->all();
        
        return view('admin.consult.regular', compact('consults', 'solRs', 'users', 'sid'));
    } 
    public function consultor(Consult $consult, Request $request, User $user)
    {
        
        $cid = $request->cid;
        $sid = $request->sid;
        $nome = $user->where('id', $cid)->get($user->name);
        //dd($nome);
        DB::table('consults')
                    ->where('id', $request->sid)
                    ->update(['cons_id' => $request->cid, 'status' => 'C','reg_id' => auth()->user()->id ,'reg_name' => auth()->user()->name ]);
        //dd($dataForm);
        //return view('admin.consult.entrada');
         return redirect('/admin');           
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Consult;
use App\Models\Perfil;
use App\Models\file;
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



    	return view('admin.consult.entrada', compact('consults', 'consreg', 'solS', 'conscons'));

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
        $arquivos = $request->file('arquivo');
        $dataForm = new Consult;
        $dataForm->consulta = $request->consulta;
        $dataForm->serviço = $request->serviço;
        $dataForm->ativo = $request->ativo;
        $dataForm->paciente = $request->paciente;
        $dataForm->idade = $request->idade;
        $dataForm->queixa = $request->queixa;
        $dataForm->instituiçao = $request->instituiçao;
        $dataForm->municipio_sol = $request->municipio_sol;
        $dataForm->area = $request->area;
        $nome = $request->file;
        $dataForm->status = 'R';
        $dataForm->user_id = auth()->user()->id;
        $dataForm->save();
        $idc = $dataForm->id;
        //dd($arquivos);
        if(!empty($arquivos)):
                $dataForm->anexos = '1';
                $dataForm->update();
            foreach ($arquivos as $arquivo):

                $data = new file;
                $data->consult_id = $idc;
                //dd($dataForm->file);
                //$file_ext = $arquivo->getClientOriginalExtension();
                //$destination_path = public_path('/consulta');

                //$newname = rand(123456,999999).".".$file_ext;
                //$arquivo->move($destination_path, $newname);
                $data->size = $arquivo->getClientSize();
                //$arquivo->filename = $newname;
                //dd($arquivo);
                $nome = $arquivo->getClientOriginalName();
                $nome = $idc.$nome;
                $data->file = $nome;
                $data->save();
                Storage::putfileAs($dataForm->user_id, $arquivo, $nome);
            endforeach;
        endif;

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
        
        $user = User::find($cid);
        DB::table('consults')
                    ->where('id', $request->sid)
                    ->update(['cons_id' => $request->cid, 'cons_name' => $user->name ]);
         return redirect()->back();           
    }
    public function encaminhar(Consult $consult, Request $request, User $user)
    {
        $consults = $consult->where('id', $request->sid)->get();
        //dd($consults);
        if ($consults) {

        DB::table('consults')
                    ->where('id', $request->sid)
                    ->update(['status' => 'C','reg_id' => auth()->user()->id ,'reg_name' => auth()->user()->name ]);
                }
        else {

        }

         return redirect('/admin');           
    }
    public function selecresp(consult $consult, Request $request, Perfil $perfil, User $user, File $file)
    {
        $sid = $request->sid;
        $files = $file->where('consult_id', $sid)->get();
        $consults = $consult->where('id', $request->sid)->get();
        
        $solRs = $perfil->where('perfil', 'C')->get($perfil->user_id);
        
        $users = $user->all();

        $downloads=DB::table('files')->get();
        
        return view('admin.consult.resposta', compact('consults', 'solRs', 'users', 'sid', 'cid', 'files', 'downloads'));
    }

    public function show(File $file, Consult $consult, Request $request, User $user)
    {
        $sid = $request->sid;
        $cid = $request->cid;
        //dd($cid);
        $dl = File::find($sid);
        $dl = $dl->file;
        //$resource = fopen('C:\xampp\htdocs\Plataforma\storage\app\public\3\40download (1).jpg', 'r');
        return Storage::download('/3/', $dl);
        //return Storage::download($dl->pah, $dl->file);
       // return redirect()->back();
    }

    public function resposta(Consult $consult, Request $request, User $user)
    {
        dd($request->sid);

        DB::table('consults')
                    ->where('id', $request->sid)
                    ->update(['status' => 'C','reg_id' => auth()->user()->id ,'reg_name' => auth()->user()->name ]);

         return redirect('/admin');           
    }
    public function devolver(consult $consult, Request $request, Perfil $perfil, User $user)
    {  
        $consults = $consult->where('id', $request->sid)->get();
        
        $solRs = $perfil->where('perfil', 'C')->get($perfil->user_id);
        
        $sid = $request->sid;
        $users = $user->all();
        
        return view('admin.consult.devolver', compact('consults', 'solRs', 'users', 'sid'));
    } 
    public function devstore(Consult $consult, Request $request, User $user)
    {
       
        $cid = $request->cid;
        $sid = $request->sid;

         //dd($sid);
        
        //$consults = Consult::find($sid);
        //dd($dataform);
        DB::table('consults')
                    ->where('id', $request->sid)
                    ->update(['devolutiva' => $request->devolutiva, 'status' => 'D' ]);

        //$dataForm->devolutiva = $request->devolutiva;
        //$dataForm->status = 'D';
        //$dataForm->update();

         return redirect(route('consult.entrada'));   
    }
}

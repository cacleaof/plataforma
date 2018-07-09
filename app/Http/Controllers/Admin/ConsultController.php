<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
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
    
	$consults = $consult->where('status', 'S')
                        ->orwhere('status', 'D')
                        ->where('user_id', auth()->user()->id)->get();
    
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
    public function saida(Consult $consult, Perfil $perfil, User $user)
    {
        
        $solS = $perfil->where('perfil', 'S')->where('user_id', auth()->user()->id)->get()->isEmpty();
 
        if (!$solS) 
        {  
        $consults = $consult->where('user_id', auth()->user()->id)->get();

        //dd($consults);
         
         return view('admin.consult.saida', compact('consults'));

        }
        else 
        {
        $id = auth()->user()->id;
        //dd($consult);
        $consults = Consult::where('cons_id' , $id)
                                    ->where( 'status', '!=', 'C')
                                    ->orWhere('reg_id', $id)
                                    ->get();

        return view('admin.consult.saida', compact('consults'));
        }
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
    if(!empty($request->consulta)) {
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

        return redirect()
                    ->route('consult.entrada')
                    ->with('success', 'TeleConsultoria enviada com sucesso - Prazo Máximo de Retorno 72 horas');
    }
    else {
        return redirect()
                    ->back()
                    ->with('error', 'O campo descreva sua dúvida ou questionamento deve ser preenchido para envio da consultoria');
    }
    }
    public function regular(consult $consult, Request $request, Perfil $perfil, User $user, file $file)
    {
        $sid = $request->sid;
        $files = $file->where('consult_id', $sid)->get();
        $consults = $consult->where('id', $request->sid)->get();
        
        $solRs = $perfil->where('perfil', 'C')->get($perfil->user_id);
        
        $users = $user->all();

        $downloads=DB::table('files')->get();
        
        return view('admin.consult.regular', compact('consults', 'solRs', 'users', 'sid', 'cid', 'files', 'downloads'));
    } 

    public function showS(consult $consult, Request $request, Perfil $perfil, User $user, file $file)
    {
        $sid = $request->sid;
        $files = $file->where('consult_id', $sid)->get();
        $consults = $consult->where('id', $request->sid)->get();
        
        $solRs = $perfil->where('perfil', 'C')->get($perfil->user_id);
        
        $users = $user->all();

        $downloads=DB::table('files')->get();
        
        return view('admin.consult.showS', compact('consults', 'solRs', 'users', 'sid', 'cid', 'files', 'downloads'));
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
        $consult = consult::find($request->sid);
        $cn = $consult->cons_name;
        //dd($cn);
        if (!empty($cn)) {

        DB::table('consults')
                    ->where('id', $request->sid)
                    ->update(['status' => 'C','reg_id' => auth()->user()->id ,'reg_name' => auth()->user()->name ]);

        return redirect(route('consult.entrada'))
                    ->with('success', 'Teleconsultoria regulada com sucesso');  
                }
        else { 
            return redirect()
                    ->back()
                    ->with('error', 'Você tem que escolher um Teleconsultor para atender esta solicitação antes de enviá-la');
        }          
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

    public function download(File $file, Consult $consult, Request $request, User $user)
    {
        $sid = $request->sid;
        $cid = $request->cid;
        //dd($cid);
        $dl = File::find($sid);
        $dl = $dl->file;
        $file= storage_path()."/app/public/".$cid."/".$dl;

        return Response::download($file, $dl);
        
    }
    public function show()
    {
    //PDF file is stored under project/public/download/info.pdf
    //dd(storage_path());

    $file= storage_path()."/app/public/3/"."5filhos.jpg";

    $headers = array(
              'Content-Type: image/jpg',
            );

    return Response::download($file, '5filhos.jpg', $headers);
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

        DB::table('consults')
                    ->where('id', $request->sid)
                    ->update(['devolutiva' => $request->devolutiva, 'status' => 'D' ]);

         return redirect(route('consult.entrada'));   
    }
}

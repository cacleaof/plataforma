<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Consult;
use App\Models\Perfil;
use App\Models\file;
use App\Models\Profissoe;
use App\Models\Especialidade;
use DB;
use App\Library\Curls;
use GuzzleHttp\Client;


class ConsultController extends Controller
{

   public function entrada(Consult $consult, Perfil $perfil, User $user)
    { 
        $solS=null;
        $nomeconsultor=null;

        //dd(date("Y-m-d"));

    if (perfil()['solS']) {
    

	$consults = Consult::where('user_id', auth()->user()->id)
                        ->wherein('status', ['S', 'A', 'D'])
                        ->paginate(12);
    
    }
    else{$consults=null;}

    if (perfil()['solR']) {
  
    $consreg = Consult::where('status', 'R')->paginate(12);
    
    }
    else{$consreg=null;}

    if (perfil()['solC']) {

    $conscons = Consult::where('cons_id', auth()->user()->id)
                        ->wherein('status', ['C', '2'])->paginate(12);

    }
    else{$conscons=null;}



    	return view('admin.consult.entrada', compact('consults', 'consreg', 'solS', 'conscons', 'nomeconsultor'));

    }
    public function saida(Consult $consult, Perfil $perfil, User $user)
    {
 
        if (perfil()['solS']) 
        {  
        $consults = Consult::where('user_id', auth()->user()->id)->paginate(12);

         
         return view('admin.consult.saida', compact('consults'));

        }
        else 
        {
        $id = auth()->user()->id;
        $consults = Consult::where('cons_id' , $id)
                                    ->where( 'status', '!=', 'C')
                                    ->orWhere('reg_id', $id)
                                    ->paginate(12);

        return view('admin.consult.saida', compact('consults'));
        }
    }
    public function finalizada(Consult $consult)
    {
        $consults = Consult::where('status', 'F')->orwhere('status', 'D')->paginate(12);
    
        //$status = $consult->status;

        return view('admin.consult.finalizada', compact('consults'));
    }
    public function nova(Consult $consult, Perfil $perfil)
    {
        //if($perfil->select('perfil')->where( 'user_id' , auth()->user()->id)->first()->perfil == 'S')
        if(perfil()['solS'])
        {
        $consults = $consult->all();

        return view('admin.consult.nova', compact('consults'));
        }
        else
        {
         return redirect()
                    ->route('consult.entrada')
                    ->with('error', 'Você não tem autorização para entrar uma TeleConsultoria');   
        }
    } 
    public function novaecg(Consult $consult, Perfil $perfil)
    {
        //if($perfil->select('perfil')->where( 'user_id' , auth()->user()->id)->first()->perfil == 'S')
        if(perfil()['solS'])
        {
        $consults = $consult->all();

        return view('admin.consult.novaecg', compact('consults'));
        }
        else
        {
         return redirect()
                    ->route('consult.entrada')
                    ->with('error', 'Você não tem autorização para entrar uma TeleConsultoria');   
        }
    } 

    public function WordsSearch() 
    {
        $client = new Client([
            'headers' => ['content-type' => 'application/xml' , 'Accept' => 'application/xml' ]]);
        $response = $client->request('GET', 'http://decs.bvsalud.org/cgi-bin/mx/cgi=@vmx/decs/?words=dengue');
        $data = $response->getBody();
        $data = simplexml_load_string($data);
        dd($data);

    return view('admin.consult.wordssearch', compact('data'));
    //return $content;
    }
    public function get_cep(Request $request)
    {
    $cep = $request->cep;
    $url = 'https://viacep.com.br/ws/'.$cep.'/json/';
    return redirect()
                    ->back();
    }

    public function store(Request $request)
    {
    if(!empty($request->consulta)) {
        $arquivos = $request->file('arquivo');
        $dataForm = new Consult;
        $dataForm->consulta = $request->consulta;
        $dataForm->servico = $request->servico;
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
        if(!empty($arquivos)):
                $dataForm->anexos = '1';
                $dataForm->update();
            foreach ($arquivos as $arquivo):

                $data = new file;
                $data->consult_id = $idc;
                $data->size = $arquivo->getClientSize();
                $nome = $arquivo->getClientOriginalName();
                $nome = $idc.'-'.$nome;
                $data->file = $nome;
                $data->user_id = auth()->user()->id;
                $data->save();
                Storage::putfileAs($dataForm->user_id.'/'.$idc, $arquivo, $nome);
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
    public function storeecg(Request $request)
    {
    if(!empty($request->consulta)) {
        $arquivos = $request->file('arquivo');
        $dataForm = new Consult;
        $dataForm->consulta = $request->consulta;
        $dataForm->servico = 'Tele-ECG';
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
        if(!empty($arquivos)):
                $dataForm->anexos = '1';
                $dataForm->update();
            foreach ($arquivos as $arquivo):

                $data = new file;
                $data->consult_id = $idc;
                $data->size = $arquivo->getClientSize();
                $nome = $arquivo->getClientOriginalName();
                $nome = $idc.'-'.$nome;
                $data->file = $nome;
                $data->user_id = auth()->user()->id;
                $data->save();
                Storage::putfileAs($dataForm->user_id.'/'.$idc, $arquivo, $nome);
            endforeach;
        endif;

        return redirect()
                    ->route('consult.entrada')
                    ->with('success', 'Tele-ECG enviado com sucesso - Prazo Máximo de Retorno 72 horas');
    }
    else {
        return redirect()
                    ->back()
                    ->with('error', 'O campo descreva sua dúvida ou questionamento deve ser preenchido para envio');
    }
    }
    public function regular(consult $consult, Request $request, Perfil $perfil, User $user, file $file, Especialidade $especialidade, Profissoe $profissoe )
    {
        $sid = $request->sid;
        $cid = $request->cid;
        $consult = Consult::find($request->sid);
        $files = $file->where('consult_id', $sid)->get();
        $consults = $consult->where('id', $request->sid)->get();
        
        //$solRs = Perfil::Select('user_id')->where('perfil', 'C')->get($perfil->user_id)->toArray();
        //dd($solRs);

        if(isset($request)&&isset($request->nomeconsultor))
        {
            $consults = $consult->where('id', $request->sid)->get();
            $solRs = Perfil::select('perfils.user_id', 'users.name', 'users.email' , 'users.telefone_celular', 'profissoes.profissao', 'especialidades.especialidade')->join('users', 'users.id', 'perfils.user_id' )->leftJoin('profissoes', 'profissoes.user_id', 'perfils.user_id' )->leftJoin('especialidades', 'especialidades.user_id', 'perfils.user_id' )->where('name', 'LIKE' , "%$request->nomeconsultor%")->where('perfil', 'C' )->paginate(4);  
             //dd($solRs);
        }
            else
        {

        $solRs = Perfil::select('perfils.user_id', 'users.name', 'users.email' , 'users.telefone_celular', 'profissoes.profissao', 'especialidades.especialidade')->join('users', 'users.id', 'perfils.user_id' )->leftJoin('profissoes', 'profissoes.user_id', 'perfils.user_id' )->leftJoin('especialidades', 'especialidades.user_id', 'perfils.user_id' )->where('perfil', 'C')->paginate(4);        
        //dd($solRs);
        }

        if($perfil->select('perfil')->where( 'user_id' , auth()->user()->id)->first()->perfil == 'R')
        {


        $downloads=DB::table('files')->get();
        
        return view('admin.consult.regular', compact('consult','consults', 'solRs',  'sid', 'cid', 'files', 'downloads'));
        }
        else
        {
         return redirect()
                    ->route('consult.entrada')
                    ->with('error', 'Você não tem autorização para ver essa TeleConsultoria');   
        }
    } 

    public function showS(consult $consult, Request $request, Perfil $perfil, User $user, file $file)
    {
        $sid = $request->sid;
        $consult = Consult::find($request->sid);
        if($consult->user_id == auth()->user()->id)
        {
        $files = $file->where('consult_id', $sid)->get();
        $solRs = $perfil->where('perfil', 'C')->get($perfil->user_id);
        
        $users = $user->all();    

        $downloads=DB::table('files')->get();
        
        return view('admin.consult.showS', compact('consult', 'solRs', 'users', 'sid', 'files', 'downloads'));
        }
        else
        {
         return redirect()
                    ->route('consult.entrada')
                    ->with('error', 'Você não tem autorização para ver essa TeleConsultoria');   
        }
    } 
    public function show_store(Request $request)
    {

    if(!empty($request->sid)) {
        $dataForm = Consult::find($request->sid);
        $dataForm->av_duvida = $request->av_duvida;
        $dataForm->avaliaçao = $request->avaliaçao;
        $dataForm->av_comment = $request->av_comment;
        $dataForm->status = 'F';
        $dataForm->update();

        return redirect()
                    ->route('consult.entrada')
                    ->with('success', 'TeleConsultoria Avaliada pelo Solicitante e Finalizada');
    }
    else {
        return redirect()
                    ->back()
                    ->with('error', 'Problemas na avaliaçao');
    }
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
    public function modelo(Consult $consult, Request $request)
    {
        $sid = $request->sid;
        
        $consult = Consult::find($sid);
        
         return view('admin.consult.modelo', compact('consult'));          
    }
    public function encaminhar(Consult $consult, Request $request, User $user)
    {
        $consult = consult::find($request->sid);
        $cn = $consult->cons_name;

        if (!empty($cn)) {

        DB::table('consults')
                    ->where('id', $request->sid)
                    ->update(['status' => 'C','reg_id' => auth()->user()->id ,'reg_name' => auth()->user()->nome ]);

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
        $cid = $request->cid;
        $files = $file->where('consult_id', $sid)->get();
        
        $consult = Consult::find($request->sid);
        
        $solRs = $perfil->where('perfil', 'C')->get($perfil->user_id);
        
        $users = $user->all();

        $downloads=DB::table('files')->get();

        if($consult->cons_id == auth()->user()->id)
        {
        if($consult->servico == 'Tele-ECG')
            {
            return view('admin.consult.respostaecg', compact('consult', 'solRs', 'users', 'sid', 'cid', 'files', 'downloads'));
            }
        else
            {
            return view('admin.consult.resposta', compact('consult', 'solRs', 'users', 'sid', 'cid', 'files', 'downloads'));
            }
        }
        else
        {
         return redirect()
                    ->route('consult.entrada')
                    ->with('error', 'Você não tem autorização para ver essa TeleConsultoria');   
        }
    }

    public function respcons(File $file, Consult $consult, Request $request, Perfil $perfil, User $user)
    {
        //dd($consult->cons_id);
        
        $sid = $request->sid;
        $cid = $request->cid;
        $files = $file->where('consult_id', $sid)->get();
        $consult = Consult::find($request->sid);
        $solRs = $perfil->where('perfil', 'C')->get($perfil->user_id);
        $users = $user->all();
        $downloads=DB::table('files')->get();
        $dl = File::find($sid);
        if($consult->cons_id == auth()->user()->id)
        {

        return view('admin.consult.respcons', compact('consult', 'solRs', 'users', 'sid', 'cid', 'files', 'downloads'));
        }
        else
        {
         return redirect()
                    ->route('consult.entrada')
                    ->with('error', 'Você não tem autorização para ver essa TeleConsultoria');   
        }
        
    }
    public function respecg(File $file, Consult $consult, Request $request, Perfil $perfil, User $user)
    {
        //dd($consult->cons_id);
        
        $sid = $request->sid;
        $cid = $request->cid;
        $files = $file->where('consult_id', $sid)->get();
        $consult = Consult::find($request->sid);
        $solRs = $perfil->where('perfil', 'C')->get($perfil->user_id);
        $users = $user->all();
        $downloads=DB::table('files')->get();
        $dl = File::find($sid);
        if($consult->cons_id == auth()->user()->id)
        {

        return view('admin.consult.respecg', compact('consult', 'solRs', 'users', 'sid', 'cid', 'files', 'downloads'));
        }
        else
        {
         return redirect()
                    ->route('consult.entrada')
                    ->with('error', 'Você não tem autorização para ver esse Tele-ECG');   
        }
        
    }
        public function storecons(Request $request)
        {
        if(!empty($request->resposta)) {
            $arquivos = $request->file('arquivo');
            $sid = $request->sid;
            $dataForm = Consult::find($request->sid);
            $dataForm->resposta = $request->resposta;
            $dataForm->l_recom = $request->l_recom;
            $dataForm->dec1 = $request->dec1;
            $dataForm->dec2 = $request->dec2;
            $dataForm->dec3 = $request->dec3;
            $nome = $request->file;
            $dataForm->status = 'A';
            $dataForm->tempo = tempo($dataForm->created_at);
            $dataForm->update();
            $idc = $dataForm->id;
            if(!empty($arquivos)):
                $dataForm->anexos = '1';
                $dataForm->update();
            foreach ($arquivos as $arquivo):

                $data = new file;
                $data->consult_id = $idc;
                $data->size = $arquivo->getClientSize();
                $nome = $arquivo->getClientOriginalName();
                $nome = $idc.'-'.$nome;
                $data->file = $nome;
                $data->user_id = auth()->user()->id;
                $data->save();
                Storage::putfileAs($dataForm->user_id.'/'.$idc, $arquivo, $nome);
            endforeach;
            endif;

            return redirect()
                        ->route('consult.entrada')
                        ->with('success', 'Resposta da TeleConsultoria enviada com sucesso');
        }
        else {
        return redirect()
                    ->back()
                    ->with('error', 'O campo descreva sua dúvida ou questionamento deve ser preenchido para envio da consultoria');
    }
    }
    public function download(File $file, Consult $consult, Request $request, User $user)
    {
        $sid = $request->sid;
        $cid = $request->cid;
        $dl = File::find($sid);
        $ui = $dl->user_id;
        $ci = $dl->consult_id;
        $dl = $dl->file;

        $file= storage_path()."/app/public/".$ui."/".$ci."/".$dl;

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
                    ->update(['status' => 'C','reg_id' => auth()->user()->id ,'reg_name' => auth()->user()->nome ]);

         return redirect('/admin');           
    }
    public function devolver(consult $consult, Request $request, Perfil $perfil, User $user)
    {  
        if($perfil->select('perfil')->where( 'user_id' , auth()->user()->id)->first()->perfil == 'R')
        {
        $consults = $consult->where('id', $request->sid)->get();
        
        $solRs = $perfil->where('perfil', 'C')->get($perfil->user_id);
        
        $sid = $request->sid;
        $users = $user->all();
        
        return view('admin.consult.devolver', compact('consults', 'solRs', 'users', 'sid'));
        }
        else
        {
         return redirect()
                    ->route('consult.entrada')
                    ->with('error', 'Você não tem perfil para Regular esta TeleConsultoria');   
        }
    } 
    public function dev_cons(consult $consult, Request $request, Perfil $perfil, User $user)
    {  
        $sid = $request->sid;
        $consult = Consult::find($request->sid);

        if($consult->cons_id == auth()->user()->id)
        {
        
        return view('admin.consult.dev_cons', compact('consult', 'sid'));

        }
        else
        {
         return redirect()
                    ->route('consult.entrada')
                    ->with('error', 'Você não tem autorização para ver essa TeleConsultoria');   
        }

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
    public function dev_con_store(Consult $consult, Request $request)
    {
        $sid = $request->sid;
        DB::table('consults')
                    ->where('id', $request->sid)
                    ->update(['devolutiva_cons' => $request->devolutiva, 'status' => 'R' ]);

         return redirect(route('consult.entrada'));   
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileFormRequest;
use App\user;
use App\Models\Perfil;
use DB;

class UserControl extends Controller
{
	public function lista(User $user)
	    { 
    		$users = $user->all();

          	return view('admin.cadastro.lista', compact('users'));
          }
    public function usuario(User $user, Request $request)
	    { 
	    	$cid = $request->cid;
	    	//dd($cid);
	    	$users = User::find($cid);
            $perfils = Perfil::where('user_id', $cid)->get()->first();
            

            if (is_null($perfils)) {
                $perfils = new perfil;
                $perfils->user_id = $cid;
                $perfils->perfil = 'S';
                $perfils->save();
            }
            //dd($perfils->perfil);
          	return view('admin.cadastro.usuario', compact('users', 'cid', 'perfils' ));
          }
    public function store(Request $request, Perfil $perfil)
    {
    		$cid = $request->cid;
    
            $dataForm = user::find($request->cid);
            
            $dataForm->name = $request->nome;
            $dataForm->email = $request->email;
        	$dataForm->update();

            $data = Perfil::where('user_id', $cid)->get()->first();
            //dd($request->userperfil);
            $data->perfil = $request->userperfil;
            $data->update();

              return redirect()
                    ->route('admin.cadastro.lista')
                    ->with('success', 'Cadastro Alterado');
    }
    public function deletar(Request $request)
    {
    		$cid = $request->cid;

    		if ($cid!='1') {
    			# code...
    		
            $user = user::find($cid);

            $user->delete();

              return redirect()
                    ->route('admin.cadastro.lista')
                    ->with('success', 'Usuário Deletado');
            }
            else{
            	return redirect()
                    ->route('admin.cadastro.lista')
                    ->with('error', 'Este Usuário é administrador e não pode ser Deletado');
            }
    }
    public function profile()
    {
    	return view('site.profile.profile');
    }

    public function profileUpdate(UpdateProfileFormRequest $request)
    {
		$user = auth()->user();

    	$data = $request->all();

	if ($data['password'] != null)
		$data['password'] = bcrypt($data['password']);
	else
		unset($data['password']);

	$data['image'] = $user->image;

	if ($request->hasFile('image') && $request->file('image')->isValid()) {
		if ($user->image)
			$name = $user->image;
		else
			$name = $user->id.kebab_case($user->name);

		$extenstion = $request->image->extension();
		$nameFile = "{$name}.{$extenstion}";

		$data['image'] = $nameFile;

		$upload = $request->image->storeAs('users', $nameFile);
		
		if (!$upload)
			return redirect()
						->back()
						->with('error', 'Falha ao fazer o upload da imagem');

	}

	$update = auth()->user()->update($data);

	if($update)
		return redirect()
					->route('profile')
					->with('success', 'Sucesso ao atualizar!');
		return redirect()
					->back()
					->with('error', 'Falha ao atualizar o perfil...');

    }
}

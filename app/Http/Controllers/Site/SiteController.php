<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\post;
use App\Models\Perfil;
use App\User;

class SiteController extends Controller
{
    public function index()
    {
    	return view('site.home.index');
    }
    public function post(Post $post, Perfil $perfil, User $user)
    {

    	//$posts = $post->all();
        //$posts = $post->where('status', 'S')->get();
        //$status = $post->status;
        //$perfid = $perfil->user_id;
        //$sol = $posts->where()

	$posts = $post->where('status', 'S')->get();
    //$sol = $perfil->where('perfil', 'S')->where('user_id', $user->id)->get();
    $sol = $perfil->where('perfil', 'S')->where('user_id', auth()->user()->id)->get();
    //dd($posts);

    	return view('admin.home.post', compact('posts', 'sol'));
    }
    public function saida(Post $post)
    {

    //$posts = $post->all();

    $posts = $post->where('user_id', auth()->user()->id)->get();
    //$posts = $post->where('user_id', 4)->get();

        return view('admin.home.saida', compact('posts'));
    }
    public function fim(Post $post)
    {
        $posts = $post->all();
        $status = $post->status;

    //$posts = $post->where('user_id', 2)->get();

        return view('admin.home.fim', compact('posts'));
    }
}

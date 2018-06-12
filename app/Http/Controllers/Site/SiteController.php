<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\post;

class SiteController extends Controller
{
    public function index()
    {
    	return view('site.home.index');
    }
    public function post(Post $post)
    {

    //	$posts = $post->all();

	$posts = $post->where('user_id', 2)->get();

    	return view('admin.home.post', compact('posts'));
    }
}

<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\post;

class PostController extends Controller
{
    public function post(Post $post)
    {

    	$posts = $post->all();

    	return view('admin.home.post', compact('posts'));
    }
}

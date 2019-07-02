<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\post;
use App\Models\user;

class PostController extends Controller
{
    public function post(Post $post)
    {
    	$balance = auth()->user()->balance;
		$amount = $balance ? $balance->amount : 0;

    	$posts = $post->all();

    	return view('admin.home.post', compact('posts'));
    }
    public function entrada()
    {
    	return 'entrada';
    }
}

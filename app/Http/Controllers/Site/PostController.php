<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\post;
use App\User;

class PostController extends Controller
{
    public function post(Post $post)
    {
    	$balance = auth()->user()->balance;
		$amount = $balance ? $balance->amount : 0;

    	$posts = $post->all();

    	return view('admin.home.post', compact('posts'));
    }
}

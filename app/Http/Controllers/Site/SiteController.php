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
}

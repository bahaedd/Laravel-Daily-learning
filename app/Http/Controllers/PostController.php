<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {

        return view('post.create');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function forum_view()
    {
        return view('forum');
    }

    public function add_view(){
        return view('addPost');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index_admin()
    {
        return view('admin.index');
    }

}

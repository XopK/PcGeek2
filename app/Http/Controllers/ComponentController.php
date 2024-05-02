<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function get_category($categoryId)
    {
        $components = Component::where('id_category', $categoryId)->get();

        return response()->json($components);
    }
}

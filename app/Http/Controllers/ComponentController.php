<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\Tag;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function get_category($categoryId)
    {
        $components = Component::where('id_category', $categoryId)->get();

        return response()->json($components);
    }

    public function getTags(Request $request)
    {
        $term = $request->input('term');
        $tags = Tag::where('title_tag', 'like', '%' . $term . '%')->pluck('title_tag')->toArray();

        return response()->json($tags);
    }
}

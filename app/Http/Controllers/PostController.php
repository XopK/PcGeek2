<?php

namespace App\Http\Controllers;

use App\Models\ComponentPost;
use App\Models\Post;
use App\Models\Tag;
use App\Models\TagPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with('tags')->latest()->get();
        return view('index', ['posts' => $posts]);
    }

    public function forum_view()
    {
        return view('forum');
    }

    public function add_view()
    {
        return view('addPost');
    }

    public function addPost(Request $request)
    {
        $request->validate([
            'text_post' => 'required',
            'tags_post' => 'required',
            'post_title' => 'required',
            'component_id' => 'required',
            'photo_post' => 'required|image',
        ]);

        $id_user = Auth::user()->id;
        $tags = explode(', ', $request->tags_post);

        $hashPhoto = $request->file('photo_post')->hashName();
        $storePhoto = $request->file('photo_post')->store('public/image_posts');

        $post = Post::create([
            'title_post' => $request->post_title,
            'description' => $request->text_post,
            'image_posts' => $hashPhoto,
            'id_user' => $id_user,
        ]);

        ComponentPost::create([
            'id_post' => $post->id,
            'id_component' => $request->component_id,
        ]);

        foreach ($tags as $tag) {
            $exitTags = Tag::where('title_tag', $tag)->first();

            if (!$exitTags) {
                $newTag = Tag::create([
                    'title_tag' => $tag
                ]);

                $tagId = $newTag->id;
                $postId = $post->id;

                TagPost::create([
                    'id_tag' => $tagId,
                    'id_post' => $postId,
                ]);
            } else {
                $tagId = $exitTags->id;
                $postId = $post->id;

                $existingTagPost = TagPost::where('id_tag', $tagId)->where('id_post', $postId)->first();

                if (!$existingTagPost) {
                    TagPost::create([
                        'id_tag' => $tagId,
                        'id_post' => $postId,
                    ]);
                }
            }
        }
        return redirect()->back()->with('success', 'Запись создана!');
    }
}

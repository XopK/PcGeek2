<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\ComponentPost;
use App\Models\DisslikeBranch;
use App\Models\LikeBranch;
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
        $user = Auth::user();

        foreach ($posts as $post) {
            $post->isLiked = $user ? $post->likes()->where('id_user', $user->id)->exists() : false;
            $post->isDissliked = $user ? $post->disslikes()->where('id_user', $user->id)->exists() : false;
        }

        return view('index', ['posts' => $posts]);
    }

    public function forum_view($id)
    {
        $user = Auth::user();

        $data_post = Post::with('components', 'tags', 'comments.users')->where('id', $id)->get()->first();
        $data_post->isLiked = $user ? $data_post->likes()->where('id_user', $user->id)->exists() : false;
        $data_post->isDissliked = $user ? $data_post->disslikes()->where('id_user', $user->id)->exists() : false;

        return view('forum', ['post' => $data_post]);
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
        ], [
            'text_post.required' => 'Поле обязательно для заполенения!',
            'tags_post.required' => 'Поле обязательно для заполенения!',
            'post_title.required' => 'Поле обязательно для заполенения!',
            'component_id.required' => 'Поле обязательно для заполенения!',
            'photo_post.required' => 'Поле обязательно для заполенения!',
            'photo_post.image' => 'Только изображения!',
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

        foreach ($request->component_id as $component) {
            ComponentPost::create([
                'id_post' => $post->id,
                'id_component' => $component,
            ]);
        }

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

    public function LikePost(Request $request)
    {
        $user = Auth::user();
        $like = $request->input('post_id');

        $existingLike = LikeBranch::where('id_user', $user->id)
            ->where('id_post', $like)
            ->first();

        $existingDiss = DisslikeBranch::where('id_user', $user->id)
            ->where('id_post', $like)
            ->first();

        if ($existingLike) {
            $existingLike->delete();
            return response()->json(['status' => 'success', 'message' => 'Лайк удален!']);
        } else {
            if ($existingDiss) {
                $existingDiss->delete();
            }
            LikeBranch::create([
                'id_user' => $user->id,
                'id_post' => $like,
            ]);
            return response()->json(['status' => 'success', 'message' => 'Лайк поставлен!']);
        }
    }

    public function DisslikePost(Request $request)
    {
        $user = Auth::user();
        $disslike = $request->input('post_id');

        $existingDiss = DisslikeBranch::where('id_user', $user->id)
            ->where('id_post', $disslike)
            ->first();

        $existingLike = LikeBranch::where('id_user', $user->id)
            ->where('id_post', $disslike)
            ->first();

        if ($existingDiss) {
            $existingDiss->delete();
            return response()->json(['status' => 'success', 'message' => 'Дизлайк удален!']);
        } else {

            if ($existingLike) {
                $existingLike->delete();
            }

            DisslikeBranch::create([
                'id_user' => $user->id,
                'id_post' => $disslike,
            ]);
            return response()->json(['status' => 'success', 'message' => 'Дизлайк поставлен!']);
        }
    }

    public function postComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required',
        ], [
            'comment.required' => 'Поле обязательно для заполнения!',
        ]);

        $user = Auth::user();
        $comment = Comment::create([
            'comment' => $request->comment,
            'id_post' => $id,
            'id_user' => $user->id,
        ]);

        $newComment = Comment::with('users')->find($comment->id);

        // Возвращаем JSON ответ с новым комментарием
        return response()->json(['success' => true, 'comment' => $newComment]);
    }
}

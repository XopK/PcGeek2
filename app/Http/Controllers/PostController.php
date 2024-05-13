<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\ComponentPost;
use App\Models\DisslikeBranch;
use App\Models\Favorite;
use App\Models\LikeBranch;
use App\Models\Post;
use App\Models\Tag;
use App\Models\TagPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class PostController extends Controller
{

    public function index()
    {
        $currentUrl = URL::current();
        session()->put('last_visited_page', $currentUrl);

        $posts = Post::with('tags')->latest()->get();
        $user = Auth::user();

        foreach ($posts as $post) {
            $post->isLiked = $user ? $post->likes()->where('id_user', $user->id)->exists() : false;
            $post->isDissliked = $user ? $post->disslikes()->where('id_user', $user->id)->exists() : false;
            $post->isFavorited = $user ? $post->favorites()->where('id_user', $user->id)->exists() : false;
        }

        return view('index', ['posts' => $posts]);
    }

    public function forum_view($id)
    {
        $user = Auth::user();
        $data_post = Post::with('components', 'tags', 'comments.users')
            ->where('id', $id)
            ->first();
        $data_post->comments = $data_post->comments->sortByDesc('created_at');
        $data_post->isLiked = $user ? $data_post->likes()->where('id_user', $user->id)->exists() : false;
        $data_post->isDissliked = $user ? $data_post->disslikes()->where('id_user', $user->id)->exists() : false;
        $data_post->isFavorited = $user ? $data_post->favorites()->where('id_user', $user->id)->exists() : false;
        $data_post->comments->each(function ($comment) use ($data_post) {
            $comment->replies = $data_post->comments->where('id_reply', $comment->id)->sortBy('created_at');
        });
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

        $post = Post::find($id);

        $newComment = Comment::with('users')->find($comment->id);
        $newComment->formatted_created_at = $newComment->created_at->diffForHumans();

        return response()->json(['success' => true, 'comment' => $newComment]);
    }

    public function replyComment(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required',
        ], [
            'reply.required' => 'Поле обязательно для заполнения!',
        ]);

        $user = Auth::user();
        $reply = Comment::create([
            'comment' => $request->reply,
            'id_post' => $id,
            'id_user' => $user->id,
            'id_reply' => $request->comment_id,
        ]);

        $newReply = Comment::with('users')->find($reply->id);
        $newReply->formatted_created_at = $newReply->created_at->diffForHumans();

        return response()->json(['success' => true, 'reply' => $newReply]);
    }

    public function addfavorite(Request $request)
    {
        $user = Auth::user();
        $favorite = $request->input('post_id');

        $existingFavorite = Favorite::where('id_user', $user->id)
            ->where('id_post', $favorite)
            ->first();

        if ($existingFavorite) {
            $existingFavorite->delete();
            return response()->json(['status' => 'success', 'message' => 'Пост удален из избранного!']);
        } else {
            Favorite::create([
                'id_user' => $user->id,
                'id_post' => $favorite,
            ]);
            return response()->json(['status' => 'success', 'message' => 'Пост добавлен в избранное!']);
        }
    }
}

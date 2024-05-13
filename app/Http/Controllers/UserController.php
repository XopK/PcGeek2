<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\LikeBranch;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $currentUrl = URL::current();
        session()->put('last_visited_page', $currentUrl);

        $user = Auth::user();

        $filter = $request->input('sort', null);

        if ($filter == null) {
            $posts = Post::with('tags')->where('id_user', $user->id)->get();

            foreach ($posts as $post) {
                $post->isLiked = $user ? $post->likes()->where('id_user', $user->id)->exists() : false;
                $post->isDissliked = $user ? $post->disslikes()->where('id_user', $user->id)->exists() : false;
                $post->isFavorited = $user ? $post->favorites()->where('id_user', $user->id)->exists() : false;
            }
        } else {
            $posts = $this->filterProfile($filter);
        }

        return view('account', ['posts' => $posts]);
    }

    protected function filterProfile($filter)
    {
        $user = Auth::user();
        if ($filter == 'liked') {
            $likedPostIds = LikeBranch::where('id_user', $user->id)->pluck('id_post');
            $posts = Post::with('tags')->whereIn('id', $likedPostIds)->get();
            foreach ($posts as $post) {
                $post->isLiked = $user ? $post->likes()->where('id_user', $user->id)->exists() : false;
                $post->isDissliked = $user ? $post->disslikes()->where('id_user', $user->id)->exists() : false;
                $post->isFavorited = $user ? $post->favorites()->where('id_user', $user->id)->exists() : false;
            }
        } elseif ($filter == 'favorited') {
            $favoritePostIds = Favorite::where('id_user', $user->id)->pluck('id_post');
            $posts = Post::with('tags')->whereIn('id', $favoritePostIds)->get();
            foreach ($posts as $post) {
                $post->isLiked = $user ? $post->likes()->where('id_user', $user->id)->exists() : false;
                $post->isDissliked = $user ? $post->disslikes()->where('id_user', $user->id)->exists() : false;
                $post->isFavorited = $user ? $post->favorites()->where('id_user', $user->id)->exists() : false;
            }
        }
        return $posts;
    }
}

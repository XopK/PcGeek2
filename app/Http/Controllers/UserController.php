<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\ComponentPost;
use App\Models\Favorite;
use App\Models\LikeBranch;
use App\Models\Post;
use App\Models\Report;
use App\Models\Tag;
use App\Models\TagPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
            $posts = Post::with('tags')->where('id_user', $user->id)->paginate(5);

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
            $posts = Post::with('tags')->whereIn('id', $likedPostIds)->paginate(5);
            foreach ($posts as $post) {
                $post->isLiked = $user ? $post->likes()->where('id_user', $user->id)->exists() : false;
                $post->isDissliked = $user ? $post->disslikes()->where('id_user', $user->id)->exists() : false;
                $post->isFavorited = $user ? $post->favorites()->where('id_user', $user->id)->exists() : false;
            }
        } elseif ($filter == 'favorited') {
            $favoritePostIds = Favorite::where('id_user', $user->id)->pluck('id_post');
            $posts = Post::with('tags')->whereIn('id', $favoritePostIds)->paginate(5);
            foreach ($posts as $post) {
                $post->isLiked = $user ? $post->likes()->where('id_user', $user->id)->exists() : false;
                $post->isDissliked = $user ? $post->disslikes()->where('id_user', $user->id)->exists() : false;
                $post->isFavorited = $user ? $post->favorites()->where('id_user', $user->id)->exists() : false;
            }
        }
        return $posts;
    }

    public function CommentsView()
    {
        $user = Auth::user();
        $userComments = Comment::where('id_user', $user->id)->paginate(5);
        return view('comments', ['comments' => $userComments]);
    }

    public function editUser(Request $request)
    {
        $request->validate([
            "login_edit" => "unique:users,login," . Auth::user()->id,
            "email_edit" => "unique:users,email," . Auth::user()->id,
            'phone_edit' => "unique:users,phone," . Auth::user()->id,
            'photo_edit' => "image",
            'confirm_password_edit' => 'nullable',
        ], [
            "login_edit.unique" => "Данный логин занят!",
            "email_edit.unique" => "Данная почта занята!",
            "phone_edit.unique" => "Данный номер занят!",
            "photo_edit" => "image",
        ]);

        $user = User::find(Auth::user()->id);

        if (Hash::check($request->confirm_password_edit, $user->password)) {

            if ($request->file('photo_edit')) {
                if ($user->profile_img != 'profile.svg') {
                    Storage::delete('public/users_profile/' . $user->profile_img);
                }
                $hashPhoto = $request->file('photo_edit')->hashName();
                $storePhoto = $request->file('photo_edit')->store('public/users_profile');
            } else {
                $hashPhoto = $user->profile_img;
            }

            $user->fill([
                'login' => $request->login_edit,
                'email' => $request->email_edit,
                'profile_img' => $hashPhoto,
                'phone' => $request->phone_edit,
            ]);
            $user->save();
            return redirect('/profile')->with('success', 'Данные обновлены!');
        } else {
            return redirect()->back()->with('error_edit', 'Пароли не совпадают!');
        }
    }

    public function editPost($id)
    {
        $post = Post::where('id', $id)->with('tags')->get()->first();
        return view('editPost', ['edit' => $post]);
    }

    public function deleteTag(Request $request, $tagid)
    {
        $deleteTag = TagPost::where('id_post', $request->input('idPost'))->where('id_tag', $tagid)->first();

        if ($deleteTag) {
            $deleteTag->delete();
            return redirect()->back()->with('success', 'Тег удален!');
        } else {
            return redirect()->back()->with('error', 'Ошибка удаления!');
        }
    }

    public function deleteComponent(Request $request, $componentid)
    {
        $deleteComponent = ComponentPost::where('id_post', $request->input('idPost'))->where('id_component', $componentid)->first();

        if ($deleteComponent) {
            $deleteComponent->delete();
            return redirect()->back()->with('success', 'Компонент удален!');
        } else {
            return redirect()->back()->with('error', 'Ошибка удаления!');
        }
    }

    public function editPostStore(Request $request, Post $id)
    {
        $request->validate([
            'text_post' => 'required',
            'post_title' => 'required',
            'photo_post' => 'image',
        ], [
            'text_post.required' => 'Поле обязательно для заполенения!',
            'post_title.required' => 'Поле обязательно для заполенения!',
            'photo_post.image' => 'Только изображения!',
        ]);

        $id_user = Auth::user()->id;
        $current_post = Post::where('id', $id->id)->first();

        if ($request->file('photo_post')) {
            Storage::delete('public/image_posts/' . $current_post->image_posts);
            $hashPhoto = $request->file('photo_post')->hashName();
            $storePhoto = $request->file('photo_post')->store('public/image_posts');
            $id->update([
                'image_posts' => $hashPhoto,
            ]);
        }

        if ($request->tags_post) {
            $tags = explode(', ', $request->tags_post);

            foreach ($tags as $tag) {
                $existingTag = Tag::where('title_tag', $tag)->first();

                if (!$existingTag) {
                    $newTag = Tag::create([
                        'title_tag' => $tag
                    ]);
                    TagPost::create([
                        'id_tag' => $newTag->id,
                        'id_post' => $id->id
                    ]);
                } else {
                    $existingTagPost = TagPost::where('id_tag', $existingTag->id)->where('id_post', $id->id)->first();
                    if (!$existingTagPost) {
                        TagPost::create([
                            'id_tag' => $existingTag->id,
                            'id_post' => $id->id,
                        ]);
                    }
                }
            }
        }

        foreach ($request->component_id as $component) {
            if ($component != null) {
                ComponentPost::firstOrCreate([
                    'id_post' => $id->id,
                    'id_component' => $component,
                ]);
            }
        }

        if ($request->text_post || $request->post_title) {
            $id->update([
                'title_post' => $request->post_title,
                'description' => $request->text_post,
            ]);
        }

        return redirect()->back()->with('success', 'Пост обновлен!');
    }

    public function deletePost(Post $id)
    {
        Storage::delete('public/image_posts/' . $id->image_posts);
        $id->delete();
        return redirect()->back()->with('success', 'Пост удален!');
    }

    public function user_report(Comment $user)
    {
        $user_report = $user->users;
        return view('reportUser', ['user_report' => $user_report]);
    }

    public function post_report(Post $post)
    {
        ;
        return view('reportPost', ['post_report' => $post]);
    }

    public function report(Request $request)
    {
        $request->validate([
            'text_report' => 'required',
        ], [
            'text_report.required' => 'Поле обязательно для заполнения!',
        ]);

        if ($request->id_user) {
            $report = Report::create([
                'text_report' => $request->text_report,
                'id_user' => $request->id_user,
            ]);

            return redirect('/')->with('success', 'Жалоба подана!');
        } elseif ($request->id_post) {
            $report = Report::create([
                'text_report' => $request->text_report,
                'id_post' => $request->id_post,
            ]);

            return redirect('/')->with('success', 'Жалоба подана!');
        }

    }
}

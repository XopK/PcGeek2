<?php

namespace App\Http\Controllers;

use App\Mail\UserBanMail;
use App\Models\Component;
use App\Models\ComponentCategory;
use App\Models\Post;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index_admin()
    {

        $user = User::where('id_role', 2)->paginate(10);
        return view('admin.index', ['users' => $user]);
    }

    public function moderator_view()
    {
        $user = User::where('id_role', 3)->paginate(10);
        return view('admin.moderator', ['users' => $user]);
    }

    public function up_user(User $id)
    {
        $id->update([
            'id_role' => 3,
        ]);

        return redirect()->back()->with('success', 'Пользователь повышен!');
    }

    public function down_user(User $id)
    {
        $id->update([
            'id_role' => 2,
        ]);

        return redirect()->back()->with('success', 'Пользователь понижен!');
    }

    public function componets_view(Request $request)
    {
        $type = $request->input('type', null);
        if ($type !== null) {
            $components = $this->SortComponents($type);
            $category = ComponentCategory::where('id', $type)->first();
            $title = $category->title_category_components;
        } else {
            $components = Component::paginate(15);
            $title = "Все компоненты";
        }

        $components->appends($request->query());

        return view('admin.components', ['components' => $components, 'title' => $title]);
    }

    protected function SortComponents($type)
    {
        $components = Component::where('id_category', $type)->paginate(15);

        return $components;
    }

    public function edit_components(Component $id)
    {
        return view('admin.editcomponents', ['component' => $id]);
    }

    public function update_component(Request $request, Component $id)
    {
        $request->validate([
            'title_component' => 'required',
            'config_component' => 'required',
            'sale' => 'required',
        ], [
            'title_component.required' => 'Поле обязательно для заполнения!',
            'config_component.required' => 'Поле обязательно для заполнения!',
            'sale.required' => 'Поле обязательно для заполнения!',
        ]);

        $id->update([
            'title_component' => $request->title_component,
            'config_component' => $request->config_component,
            'sale' => $request->sale,
        ]);
        return redirect()->back()->with('success', 'Компонент обновлен!');
    }

    public function delete_component(Component $id)
    {
        $id->delete();
        return redirect()->back()->with('success', 'Компонент удален!');
    }

    public function parser_view()
    {
        return view('admin.parser');
    }

    public function moderator_index()
    {
        $posts = Report::where('id_post', null)->where('is_checked', 0)->paginate(10);
        return view('moderator.index', ['posts' => $posts]);
    }

    public function list_reports()
    {
        $posts = Report::where('id_user', null)->where('is_checked', 0)->paginate(10);
        return view('moderator.list_reports', ['posts' => $posts]);
    }

    public function response_report(Report $report)
    {
        return view('moderator.response', ['response' => $report]);
    }

    public function accept_report(Request $request, Report $report)
    {
        $request->validate([
            'response' => 'required',
        ], [
            'response.required' => 'Поле обязательно для заполнения!',
        ]);

        if ($report->id_post == null) {
            $report->update([
                'response' => $request->response,
                'is_checked' => 1,
            ]);

            $user = User::find($report->id_user);
            $user->update([
                'is_blocked' => 1,
            ]);

            $userEmail = $report->user->email;

            $title = "Ваш аккаунт заблокирован";
            $content = "К сожалению, ваш аккаунт был заблокирован за нарушение наших правил и условий. Причина блокировки: " . $request->response;

            Mail::to($userEmail)->send(new UserBanMail($title, $content));

            return redirect('/moderator')->with('success', 'Пользователь заблокирован!');
        } elseif ($report->id_user == null) {
            $report->update([
                'response' => $request->response,
                'is_checked' => 1,
            ]);

            $post = Post::find($report->id_post);
            $post->update([
                'is_blocked' => 1,
            ]);

            $userEmail = $post->user->email;

            $title = "Ваш пост " . $post->title_post . " заблокирован";
            $content = "К сожалению, ваш пост был заблокирован за нарушение наших правил и условий. Причина блокировки: " . $request->response;

            Mail::to($userEmail)->send(new UserBanMail($title, $content));
            return redirect('/moderator')->with('success', 'Пользователь заблокирован!');
        }

    }

    public function denay_report(Report $report)
    {
        $report->update([
            'is_checked' => 1,
        ]);

        return redirect('/moderator')->with('success', 'Заявка отклонена!');
    }

    public function users_ban_view()
    {
        $user = User::where('is_blocked', 1)->paginate(10);
        return view('moderator.usersban', ['users' => $user]);
    }

    public function users_unban(User $user)
    {
        $user->update([
            'is_blocked' => 0
        ]);
        $reports = Report::where('id_user', $user->id)->first();
        $reports->delete();
        return redirect('/moderator/users')->with('success', 'Пользователь разблокирован!');
    }

    public function posts_ban()
    {
        $posts = Post::where('is_blocked', 1)->paginate(10);
        return view('moderator.postsban', ['posts' => $posts]);
    }

    public function posts_unban(Post $post)
    {
        $post->update([
            'is_blocked' => 0
        ]);
        $reports = Report::where('id_post', $post->id)->first();
        $reports->delete();

        return redirect('/moderator/postsBan')->with('success', 'Пост разблокирован!');
    }
}

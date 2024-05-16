<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\User;
use Illuminate\Http\Request;

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
        } else {
            $components = Component::paginate(15);
        }
        
        $components->appends($request->query());

        return view('admin.components', ['components' => $components]);
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
}

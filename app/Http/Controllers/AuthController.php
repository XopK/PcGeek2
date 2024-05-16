<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function signUp(Request $request)
    {
        $request->validate([
            'login' => 'required|unique:users|min:3',
            'email' => 'required|unique:users|email',
            'phone' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password|min:8',
        ], [
            'login.required' => 'Поле обязательно для заполнения!',
            'email.required' => 'Поле обязательно для заполнения!',
            'phone.required' => 'Поле обязательно для заполнения!',
            'password.required' => 'Поле обязательно для заполнения!',
            'confirm_password.required' => 'Поле обязательно для заполнения!',
            'login.unique' => 'Пользователь с таким логин уже зарегистрирован!',
            'email.unique' => 'Пользователь с такой почтой уже зарегистрирован!',
            'password.min' => 'Минимум 8 символов!',
            'confirm_password.same' => 'Пароли не совпадают!',
            'confirm_password.min' => 'Минимум 8 символов!',
            'login.min' => 'Минимум 3 символа!',
            'email.email' => 'Введите действительную почту',
        ]);

        $user = User::create([
            'login' => $request->login,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'id_role' => 2,
        ]);

        if ($user) {
            Auth::login($user);
            return redirect('/')->with('success', 'Регистрация прошла успешно!');
        } else {
            return redirect()->back()->with('error_signUp', 'Ошибка регистрации!');
        }
    }

    public function signIn(Request $request)
    {
        $request->validate([
            'login_signIn' => 'required|min:3',
            'password_signIn' => 'required|min:8',
        ], [
            'login_signIn.required' => 'Поле обязательно для заполнения!',
            'login_signIn.min' => 'Минимум 3 символа!',
            'password_signIn' => 'Поле обязательно для заполнения!',
            'password_signIn.min' => 'Минимум 8 символов!',
        ]);

        if (Auth::attempt([
            'login' => $request->login_signIn,
            'password' => $request->password_signIn,
        ])) {
            if (Auth::user()->id_role == 1) {
                return redirect('/admin')->with('success', 'Здраствуй,' . Auth::user()->login);
            }
            return redirect('/')->with('success', 'Здраствуй,' . Auth::user()->login);
        } else {
            return redirect()->back()->with('error_signIn', 'Ошибка авторизации, проверьте данные!');
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}

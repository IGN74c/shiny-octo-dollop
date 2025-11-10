<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (
            Auth::attempt($request->validate(
                [
                    'login' => 'required|string',
                    // 'email' => 'required|email',
                    'password' => 'required|string',
                ],
                [
                    'required' => 'Поле обязательно'
                ]
            ))
        ) {
            return redirect()->route('home');
        }
        return redirect()->route('home')->withErrors([
            'email' => 'Неверные данные',
        ]);
    }

    public function register(Request $request)
    {
        Auth::login(
            User::create($request->validate(
                [
                    'name' => 'required|regex:/^[А-Яа-яЁё\s]+$/u',
                    'login' => 'required|string',
                    'email' => 'required|email',
                    'phone' => 'required|regex:/^[+78][\d]{10,11}$/',
                    'password' => 'required|string|confirmed',
                ],
                [
                    'required' => 'Поле обязательно',
                    'confirmed' => 'Пароли не совпадают'
                ]
            ))
        );
        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}

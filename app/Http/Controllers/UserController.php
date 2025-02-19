<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        return view('layout')
            ->with("users", User::all())
            ->with("categories", Category::orderBy('name')->get());
    }

    public function login()
    {
        return view('user.login')->with("categories", Category::orderBy('name')->get());
    }

    public function loginPost()
    {
        $data = request()->validate([
            'userEmail' => ['required', 'email'],
            'userPassword' => 'required',
        ], [
            'userEmail.required' => 'El campo email es obligatorio',
            'userEmail.email' => 'El email no tiene un formato correcto',
            'userPassword.required' => 'El campo contraseña es obligatorio',
        ]);


        if (Auth::attempt([
            "email" => $data['userEmail'],
            "password" => $data['userPassword']
        ], request()->has('rememberSession'))) {
            request()->session()->regenerate();
            
            return redirect()->route('home');
        } else {
            return back()->withErrors([
                'password' => 'La contraseña no es correcta',
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }

    public function register()
    {
        return view('user.register')->with("categories", Category::orderBy('name')->get());
    }

    public function registerPost()
    {
        $data = request()->validate([
            'userName' => 'required',
            'userEmail' => ['required', 'email', 'unique:users,email'],
            'userPassword' => 'required',
            'userRepeatPassword' => 'required'
        ], [
            'userName.required' => 'El campo nombre es obligatorio',
            'userEmail.required' => 'El campo email es obligatorio',
            'userEmail.email' => 'El email no tiene un formato correcto',
            'userEmail.unique' => 'El email ya está registrado',
            'userPassword.required' => 'El campo contraseña es obligatorio',
            'userRepeatPassword.required' => 'El campo repetir contraseña no coincide'
        ]);

        if ($data['userPassword'] == $data['userRepeatPassword']) {
            User::create([
                'name' => $data['userName'],
                'email' => $data['userEmail'],
                'password' => bcrypt($data['userPassword'])
            ]);

            return redirect()->route('login');
        } else {
            return back()->withErrors([
                'userRepeatPassword' => 'El campo repetir contraseña no coincide',
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        $remember = request()->has('rememberSession');

        if (Auth::attempt([
            "email" => $data['userEmail'],
            "password" => $data['userPassword']
        ], $remember)) {
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

    public function edit(User $user)
    {
        return view('user.edit')
            ->with('categories', Category::orderBy('name')->get())
            ->with('user', $user);
    }

    public function editNamePut(User $user)
    {
        $data = request()->validate([
            'userName' => 'required',
        ], [
            'userName.required' => 'El campo nombre es obligatorio',
        ]);

        $user->update([
            'name' => $data['userName'],
        ]);

        return redirect()->route('home');
    }

    public function editEmailPut(User $user)
    {
        $data = request()->validate([
            'userEmail' => ['required', 'email', 'unique:users,email'],
        ], [
            'userEmail.required' => 'El campo email es obligatorio',
            'userEmail.email' => 'El email no tiene un formato válido',
            'userEmail.unique' => 'El email ya está registrado',
        ]);

        $user->update([
            'email' => $data['userEmail'],
        ]);

        return redirect()->route('home');
    }

    public function editPasswordPut(User $user)
    {
        $data = request()->validate([
            'userOldPassword' => 'required',
            'userNewPassword' => 'required',
            'userNewPasswordRepeat' => 'required',
        ], [
            'userOldPassword.required' => 'El campo antigua contraseña es obligatorio',
            'userNewPassword.required' => 'El campo nueva contraseña es obligatorio',
            'userNewPasswordRepeat.required' => 'El campo repetir nueva contraseña es obligatorio',
        ]);


        if ($data['userNewPassword'] == $data['userNewPasswordRepeat']) {
            if (Hash::check($data['userOldPassword'], $user->password)) {
                $user->update([
                    'password' => bcrypt($data['userNewPassword']),
                ]);

                return redirect()->route('home');
            } else {
                return back()->withErrors([
                    'userOldPassword' => 'El campo contraseña antigua no coincide con la contraseña actual',
                ]);
            }
        } else {
            return back()->withErrors([
                'userNewPasswordRepeat' => 'El campo repetir contraseña no coincide',
            ]);
        }
    }

    public function editIsAdminPut(User $user)
    {
        $user->update([
            'is_admin' => request()->has('userIsAdmin'),
        ]);

        return redirect()->route('home');
    }
}

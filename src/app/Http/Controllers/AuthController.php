<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('auth.login', ['redirect' => $request->input('redirect')]);
    }

    public function signup()
    {
        return view('auth.signup');
    }


    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $role= User::count() === 0 ? 'admin' : 'user';

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $role,
        ]);

        return redirect()->route('login')->with('success', 'Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.');
    }

    public function signin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            $redirect = $request->input('redirect');
            if ($redirect && str_starts_with($redirect, url('/'))) {
                return redirect($redirect);
            }
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification sont incorrectes.',
        ])->onlyInput('email');
    }
}

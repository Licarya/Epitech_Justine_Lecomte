<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\UserController;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::User();
            if ($user->role == 1 || $user->role == 2) {
                $show = new UserController;
                return $show->show($user->id);
            }
            else
                return redirect('admin/users');
        }

        return redirect('login');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->flush();
        return redirect('/');
    }
}

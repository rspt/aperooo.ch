<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->with('alert', [
            'message' => 'site.errorLogin',
            'type' => 'error',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function register(Request $request)
    {
        return view('auth.register');
    }

    public function createAccount(Request $request)
    {
        try {
            $user = User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);
            // Auth the user
            Auth::login($user, true);
        } catch (QueryException $e) {
            $sqlErrorCode = $e->errorInfo[1];

            switch ($sqlErrorCode) {
                case '1062':
                    back()->with('alert', [
                        'message' => 'site.usernameAlreadyExists',
                        'type' => 'error',
                    ]);
                    break;
            }
        }

        return redirect()->route('home');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {
            if ($user->level == 'admin') {
                return redirect()->intended('editor');
            }elseif ($user->level == 'editor') {
                return redirect()->intended('editor');
            }
        }
        return view('login');
    }
    
    public function proses_login(Request $request)
    {
        request()->validate(
             [
                'username' => 'required',
                'password' => 'required',
             ]);
    
         $kredensil = $request->only('username','password');
    
            if (Auth::attempt($kredensil)) {
                $user = Auth::user();
                if ($user->level == 'admin') {
                    return redirect()->intended('admin');
                } elseif ($user->level == 'editor') {
                    return redirect()->intended('editor');
                }
                return redirect()->intended('/');
            }
    
            return redirect('login') {
                ->withInput()
                ->withErrors(['login_gagal' => 'These credentials do not match our records']);
            }
        }
    }
}

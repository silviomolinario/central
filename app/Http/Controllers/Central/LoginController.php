<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller 
{
    public function authenticate(Request $request)
    {
        $credenciais = [
            'usu_usuario' => $request->input('usu_usuario'),
            'password' => $request->input('usu_senha')
        ];
        
        if (Auth::guard('web')->attempt($credenciais,true)) {
            return redirect()->intended('/central/home');
        }
        return redirect()->intended('/central/login');
    }
    
    public function showLoginForm()
    {
        return view('central.login.index');
    }
    
    public function showRegisterForm()
    {
        return view('central.login.register');
    }
    
    public function logout()
    {
        Auth::guard('web')->logout();
        return Redirect::to('central/login');
    }
}

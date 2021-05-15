<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Models\DetailUser;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Password;

class LoginHandler extends Controller
{
    public function index()
    {
        if(Auth::check())
            return redirect()->route("home");
        else
            return view('login/login');
    }

    public function login(Request $request)
    {
        $rules = [
            'email'                 => 'bail|required|email|string',
            'password'              => 'bail|required|string'
        ];
  
        $messages = [
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'email.dns'             => 'Email tidak valid',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
        
        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        Auth::attempt($data);

        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect()->route('home');
  
        } else {
            return redirect()->route("login")->withErrors(["Email atau password salah, silahkan coba kembali"])->withInput($request->all);
        }
    }
}

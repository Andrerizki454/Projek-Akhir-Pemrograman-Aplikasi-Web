<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutHandler extends Controller
{
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->flush();
        return redirect()->route("login");
    }
}

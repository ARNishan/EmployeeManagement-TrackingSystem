<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function logout()
    {
        //logout the user
        Auth::logout();
        
        return redirect('/user')->with('info','Successfully logged out!');
    }
    public function show(){
        return view('auth.user_show');
    }
}

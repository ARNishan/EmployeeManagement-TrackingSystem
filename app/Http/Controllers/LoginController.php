<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use App\User;
use DB;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

   public function indexAdmin(){
        return view('auth.index');
    }
    public function AdminAuthenticate(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|min:6',
            'password' => 'required|min:7',
        ]);

        //try to login the admin
        if (Auth::guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->has('remember'))) {
            // Authentication passed...
            return redirect()->route('admin.dashboard');
        }else{
            // Authentication failed...
            //redirect the user with the old input
            return redirect('/admin')->withInput()->with('info','Invalid Credentials!');
        }
    }
    public function indexUser(){
        return view('auth.user_index');
    }
    public function UserAuthenticate(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|min:6',
            'password' => 'required|min:7',
        ]);

        //try to login the user
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->has('remember'))) {
            $user_id = Auth::user()->id;
            $date_current = Carbon::now('+6:00');
            $date = $date_current->format('Y-m-d');
            $att_date = DB::table('attendences')
            ->where([
            ['user_id',$user_id],
            ['att_date',$date],
            ])
            ->first();
            if($att_date == NULL){
            $year = $date_current->format('Y');
            $time = $date_current->format('g:i a');
            $attendence = "Present";
            $data = array();
            $data['user_id'] = $user_id;
            $data['att_date'] = $date;
            $data['att_time'] = $time;
            $data['att_year'] = $year;
            $data['attendence'] = $attendence;
            $attendence=DB::table('attendences')->insert($data);

            }
            

            // Authentication passed...
            return redirect()->route('user.dashboard');
        }else{
            // Authentication failed...
            //redirect the user with the old input
            return redirect('/user')->withInput()->with('info','Invalid Credentials!');
        }
    }

}

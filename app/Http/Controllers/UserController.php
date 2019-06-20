<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        
        $users = User::Paginate(4);
        return view('user.index')->with('users',$users);
    }
    public function create()
    {
        $employees = DB::table('employees')->get();
        return view('user.create')->with('employees',$employees);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'Emp_id' => 'required|unique:users',
        'username' => 'required',
        'password' => 'required',
         ]);
        $employees = DB::table('employees')->where('id',$request->Emp_id)->first();
        // echo "<pre>";
        // print_r($employees);
        $data = array();
        $data['user_name'] = $request->username;
        $data['first_name'] = $employees->first_name;
        $data['last_name'] = $employees->last_name;
        $data['picture'] = $employees->picture;
        $data['Emp_id'] = $request->Emp_id;
        $data['email'] = $employees->email;
        if($request->input('password') != NULL){
         $data['password'] = bcrypt($request->input('password'));
        }
        // echo "<pre>";
        // print_r($data);
        $users = DB::table('users')->insert($data);
        if($users){
              return redirect('/users')->with('info','New Users has been created!');
          }else{
             return redirect('/users')->with('info','Opps! Something Wrong!!');
          }
    }
    public function destroy($id)
    {
        /**
         *  Check if the admin is not the
         *  current authenticated user
         */
        
        $users = DB::table('users')->where('id',$id)->delete();
        return redirect('/users')->with('info','Selected user has been deleted!');
    }
   public function search(Request $request){
        $this->validate($request,[
            'search' => 'required',
            'options' => 'required',
        ]);
        $str = $request->input('search');
        $option = $request->input('options');
        $users =  DB::table('users')->where( $option , 'LIKE' , '%'.$str.'%' )
            ->orderBy($option,'asc')
            ->paginate(4);
        return view('user.index')->with([ 'users' => $users ,'search' => true ]);
    }




}

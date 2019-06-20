<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use DB;

class StatesController extends Controller
{
    /**
     *  Only authenticated users can access this controller
     */
    public function __construct(){
        $this->middleware('auth:admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         *  read all the comments from DepartmentsController
         *  they are all the same.
         */
        
        $states = DB::table('states')->Paginate(5);
        return view('sys_mg.states.index')->with('states',$states);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sys_mg.states.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'state_name' => 'required|unique:states|min:3'
        ]);
         $data = array();
        $data['state_name'] = $request->state_name;
        $state = DB::table('states')->insert($data);
        return redirect('/states')->with('info','New State has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state = DB::table('states')->where('id',$id)->first();
        return view('sys_mg.states.edit')->with('state',$state);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'state_name' => 'required|min:3|unique:states'
        ]);
        $data = array();
        $data['state_name'] = $request->state_name;
        $state = DB::table('states')->where('id',$id)->update($data);
        return redirect('/states')->with('info','Selected State has been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = DB::table('states')->where('id',$id)->delete();
        return redirect('/states')->with('info','Selected State has been deleted!');
    }

    /**
     *  Search For Resource(s)
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request){
        $this->validate($request,[
            'search' => 'required'
        ]);
        $str = $request->input('search');
        $states = DB::table('states')->where( 'state_name' , 'LIKE' , '%'.$str.'%' )
            ->orderBy('state_name','asc')
            ->paginate(4);
        return view('sys_mg.states.index')->with([ 'states' => $states ,'search' => true ]);
    }
}

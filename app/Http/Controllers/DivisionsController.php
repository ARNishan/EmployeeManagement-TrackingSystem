<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Division;
use DB;

class DivisionsController extends Controller
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
        $divisions = DB::table('divisions')->orderBy('division_name','asc')->Paginate(5);
        return view('sys_mg.divisions.index')->with('divisions',$divisions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sys_mg.divisions.create');
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
            'division_name' => 'required|min:3|unique:divisions'
        ]);
        $data = array();
        $data['division_name'] = $request->division_name;
        $division = DB::table('divisions')->insert($data);
        return redirect('/divisions')->with('info','New Division has been created!');
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
        $division = DB::table('divisions')->where('id',$id)->first();
        return view('sys_mg.divisions.edit')->with('division',$division);
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
            'division_name' => 'required|min:3|unique:divisions'
        ]);
        $data = array();
        $data['division_name'] = $request->division_name;
        $division = DB::table('divisions')->where('id',$id)->update($data);
        return redirect('/divisions')->with('info','Selected Division has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $division = DB::table('divisions')->where('id',$id)->delete();
        return redirect('/divisions')->with('info','Selected Division has been deleted!');
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
        $divisions = Division::where( 'division_name' , 'LIKE' , '%'.$str.'%' )
            ->orderBy('division_name','asc')
            ->paginate(4);
        return view('sys_mg.divisions.index')->with([ 'divisions' => $divisions ,'search' => true ]);
    }
}

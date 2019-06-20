<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salary;
use DB;

class SalariesController extends Controller
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
        $salaries = DB::table('salaries')->Paginate(5);
        return view('sys_mg.salaries.index')->with('salaries',$salaries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sys_mg.salaries.create');
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
            's_amount' => 'required|min:3'
        ]);

        $data = array();
        $data['s_amount'] = $request->s_amount;
        $salary = DB::table('salaries')->insert($data);
        return redirect('/salaries')->with('info','Salary has been created!');
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
        $salary = DB::table('salaries')->where('id',$id)->first();
        return view('sys_mg.salaries.edit')->with('salary',$salary);
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
            's_amount' => 'required|min:3'
        ]);
        $data = array();
        $data['s_amount'] = $request->s_amount;
        $department = DB::table('salaries')->where('id',$id)->update($data);
        return redirect('/salaries')->with('info','Selected salary has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deluser = DB::table('salaries')->where('id',$id)->delete();
        return redirect('/salaries')->with('info','Selected salary has been deleted!');
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
        $salaries = DB::table('salaries')->where( 's_amount' , 'LIKE' , '%'.$str.'%' )
            ->orderBy('s_amount','asc')
            ->paginate(4);
        return view('sys_mg.salaries.index')->with([ 'salaries' => $salaries ,'search' => true ]);
    }
}

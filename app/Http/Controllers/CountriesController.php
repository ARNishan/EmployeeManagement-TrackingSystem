<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use DB;

class CountriesController extends Controller
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
        
        $countries = DB::table('countries')->Paginate(5);
        return view('sys_mg.countries.index')->with('countries',$countries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sys_mg.countries.create');
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
            'country_name' => 'required|unique:countries|min:3'
        ]);
        $data = array();
        $data['country_name'] = $request->country_name;
        $country = DB::table('countries')->insert($data);
        return redirect('/countries')->with('info','New Country has been created!');
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
        $country = DB::table('countries')->where('id',$id)->first();
        return view('sys_mg.countries.edit')->with('country',$country);
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
            'country_name' => 'required|min:3|unique:countries'
        ]);
        $data = array();
        $data['country_name'] = $request->country_name;
        $country = DB::table('countries')->where('id',$id)->update($data);

        return redirect('/countries')->with('info','Selected Country has been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = DB::table('countries')->where('id',$id)->delete();
        return redirect('/countries')->with('info','Selected Country has been deleted!');
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
        $countries =  DB::table('countries')->where( 'country_name' , 'LIKE' , '%'.$str.'%' )
            ->orderBy('country_name','asc')
            ->paginate(4);
        return view('sys_mg.countries.index')->with([ 'countries' => $countries ,'search' => true ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use DB;

class CitiesController extends Controller
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
        $cities = DB::table('cities')->Paginate(5);
        return view('sys_mg.cities.index')->with('cities',$cities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sys_mg.cities.create');
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
            'city_name' => 'required|min:2',
            'zip_code' => 'required|min:4|unique:cities'
        ]);
        $data = array();
        $data['city_name'] = $request->city_name;
        $data['zip_code'] = $request->zip_code;
        $city = DB::table('cities')->insert($data);

        // $city = new City();
        // $city->city_name = $request->input('city_name');
        // $city->zip_code = $request->input('zip_code');
        // $city->save();
        return redirect('/cities')->with('info','City has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $city = DB::table('cities')->where('id',$id)->first();
        return view('sys_mg.cities.edit')->with('city',$city);
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
            'city_name' => 'required|min:2',
            'zip_code' => 'required|min:4|unique:cities,zip_code,'.$id
        ]);
        $data = array();
        $data['city_name'] = $request->city_name;
        $data['zip_code'] = $request->zip_code;
        $city = DB::table('cities')->where('id',$id)->update($data);
        return redirect('/cities')->with('info','Selected city has been updated!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = DB::table('cities')->where('id',$id)->delete();
        return redirect('/cities')->with('info','Selected city has been deleted!');
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
        $cities = City::where( 'city_name' , 'LIKE' , '%'.$str.'%' )
            ->orderBy('city_name','asc')
            ->paginate(4);
        return view('sys_mg.cities.index')->with([ 'cities' => $cities ,'search' => true ]);
    }
}

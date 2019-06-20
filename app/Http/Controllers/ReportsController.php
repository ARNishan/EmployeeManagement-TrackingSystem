<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use DB;
use Carbon\Carbon;
use PDF;
use App;

class ReportsController extends Controller
{
    /**
     *  Only authenticated users can access this controller
     */
    public function __construct(){
        $this->middleware('auth:admin');
    }

    /**
     * Show the Report view
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = DB::table('employees')
        ->join('genders','employees.gender_id','genders.id')
        ->join('departments','employees.dept_id','departments.id')
        ->join('countries','employees.country_id','countries.id')
        ->join('states','employees.state_id','states.id')
        ->join('cities','employees.city_id','cities.id')
        ->join('divisions','employees.division_id','divisions.id')
        ->join('salaries','employees.salary_id','salaries.id')
        ->select('genders.gender_name','departments.dept_name','countries.country_name','states.state_name','cities.city_name','divisions.division_name','salaries.s_amount','employees.*')
        ->paginate(4);
        return view('reports.index')->with('employees',$employees);
    }

    /**
     *  Generate PDF
     * 
     * @return \Illuminate\Http\Response
     */
    public function makeReport(Request $request){
        $this->validate($request,[
            'date_from' => 'required',
            'date_to'   => 'required'
        ]);
        
        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        /**
         *  employees between two dates
         */
        $employees = DB::table('employees')
        ->join('genders','employees.gender_id','genders.id')
        ->join('departments','employees.dept_id','departments.id')
        ->join('countries','employees.country_id','countries.id')
        ->join('states','employees.state_id','states.id')
        ->join('cities','employees.city_id','cities.id')
        ->join('divisions','employees.division_id','divisions.id')
        ->join('salaries','employees.salary_id','salaries.id')
        ->select('genders.gender_name','departments.dept_name','countries.country_name','states.state_name','cities.city_name','cities.zip_code','divisions.division_name','salaries.s_amount','employees.*')
        ->whereBetween('employees.join_date' ,[new Carbon($date_from),new Carbon($date_to)])->get();
        echo "<pre>";
        print_r($employees);

        //generate pdf
        $pdf = PDF::loadView('reports.report',['employees' => $employees])->setPaper('a4', 'landscape');
        // return base64_encode($pdf->stream('Employee_hired_report_from_'.$date_from.'_to_'.$date_to.'.pdf'));
         return base64_encode($pdf->download('invoice.pdf'));
    }
}

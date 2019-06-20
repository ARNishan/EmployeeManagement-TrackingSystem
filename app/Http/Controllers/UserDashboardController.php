<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Employee;
use App\Department;
use App\Division;
use App\Country;
use App\City;
use App\State;
use App\Salary;
use App\Admin;
use Carbon\Carbon;
use DB;

class UserDashboardController extends Controller
{
   public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        //get Current date and time
        $date_current = Carbon::now('+6:00');
        // $current_month_in_number = $date_current->month;
        // $current_month_in_string = $date_current->format('F');
        // $current_year_in_string = $date_current->format('Y');
        // echo "$date_current";
        // echo"<br>";
        //get date and time of previous month
        /**
         *  subMonths() means it will subtract the month with
         *  the given argument.
         */
        $prev_date1 = $date_current->copy()->subMonth();
        $prev_date2 = $date_current->copy()->subMonths(2);
        $prev_date3 = $date_current->copy()->subMonths(3);
        $prev_date4 = $date_current->copy()->subMonths(4);
        // echo "$prev_date1";
        // echo"<br>";
        // echo "$prev_date2";
        // echo"<br>";
        // echo "$prev_date3";
        // echo"<br>";
        // echo "$prev_date4";

        /**
         *  get count of employee between two given dates.
         */
        $emp_count_1 = DB::table('employees')
                    ->whereBetween('join_date', [$prev_date1, $date_current])->count();
        $emp_count_2 = DB::table('employees')
                    ->whereBetween('join_date', [$prev_date2, $prev_date1])->count();
        $emp_count_3 = DB::table('employees')
                    ->whereBetween('join_date', [$prev_date3, $prev_date2])->count();
        $emp_count_4 = DB::table('employees')
                    ->whereBetween('join_date', [$prev_date4, $prev_date3])->count();                                    
        // $emp_count_1 = Employee::whereBetween('join_date',[$prev_date1,$date_current])->count();
        // $emp_count_2 = Employee::whereBetween('join_date',[$prev_date2,$prev_date1])->count();
        // $emp_count_3 = Employee::whereBetween('join_date',[$prev_date3,$prev_date2])->count();
        // $emp_count_4 = Employee::whereBetween('join_date',[$prev_date4,$prev_date3])->count();

        $t_admins = DB::table('admins')->count();
        $t_employees = DB::table('employees')->count();
        $t_countries = DB::table('countries')->count();
        $t_states = DB::table('states')->count();
        $t_cities = DB::table('cities')->count();
        $t_departments = DB::table('departments')->count();
        $t_divisions = DB::table('divisions')->count();
        $t_salaries = DB::table('salaries')->count();
        // echo "$emp_count_1";
        // echo "<br>";
        // echo "$t_employees";
        // echo "<br>";
        // echo "$t_countries";
        // echo "<br>";
        // echo "$t_cities";
        // echo "<br>";
        // echo "$t_departments";
        // echo "<br>";
        // echo "$t_divisions";
        // echo "<br>";


        return view('dashboard.user_index')
            ->with([
                'emp_count_1'     =>  $emp_count_1,
                'emp_count_2'     =>  $emp_count_2,
                'emp_count_3'     =>  $emp_count_3,
                'emp_count_4'     =>  $emp_count_4,
                't_employees'     =>  $t_employees,
                't_countries'     =>  $t_countries,
                't_cities'        =>  $t_cities,
                't_states'        =>  $t_states,
                't_salaries'      =>  $t_salaries,
                't_divisions'     =>  $t_divisions,
                't_departments'   =>  $t_departments,
                't_admins'        =>  $t_admins
            ]);
    }
}

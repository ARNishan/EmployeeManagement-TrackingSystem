<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use DB;

class AttendeceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

      public function AllAttendence(){
    	$attendence = DB::table('attendences')->select('att_date')->groupBy('att_date')->paginate(6);
    	return view('attendence.index')->with('attendence',$attendence);
    }
     public function EditAttendence($att_date){
     	$date = DB::table('attendences')->where('att_date',$att_date)->first();

    	$attendence = DB::table('attendences')
        ->join('employees','attendences.user_id','employees.id')
        ->select('employees.name','employees.photo','attendences.*')
    	->where('att_date',$att_date)->get();
    	return view('edit_attendence',compact('attendence','date'));
    }

       public function UpdateAttendence(Request $request){
       $check = 0;
   	   foreach ($request->id as $id) {
   		$data=[
   			"attendence" => $request->attendence[$id],
   			"att_date" => $request->att_date,
   			"att_year" => $request->att_year,
   			"edit_date" => date("d_m_y")
   		];
   		$update=DB::table('attendences')->where('id',$id)->update($data);
   		if($update){
   			$check = 1;
   		} 
   	}
   	// return $request->all();
   	 if ($check) {
                $notification=array(
                'messege'=>'Attendence Updated Successfully ! ',
                'alert-type'=>'success'
                 );
               return Redirect()->route('all.attendence')->with($notification);                      
            }else{
            	$notification=array(
                'messege'=>'Attendence Didnot Updated ! ',
                'alert-type'=>'error');
              return Redirect()->route('all.attendence')->with($notification);
            }

     	
      
      
  }

  public function ViewAttendence($att_date){
     	$date = DB::table('attendences')->where('att_date',$att_date)->first();

    	$attendence = DB::table('attendences')
        ->join('users','attendences.user_id','users.id')
        ->select('users.first_name','users.last_name','users.picture','attendences.*')
    	->where('att_date',$att_date)->paginate(6);
    	return view('attendence.view',compact('attendence','date'));
    }
    public function search(Request $request){
        $this->validate($request,[
            'att_date' => 'required',
        ]);
        $timestamp = strtotime($request->att_date);  
        $att_date =  date('Y-m-d', $timestamp);
        $attendence =  DB::table('attendences')->select('att_date')->groupBy('att_date')->where('att_date',$att_date)
            ->paginate(6);
        return view('attendence.index')->with([ 'attendence' => $attendence ,'search' => true ]);
    }
}

<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Appointment;
use Mail;
use Carbon\Carbon;

class HomeController extends Controller
{
    function __construct() {
        $this->validate_session();
    }
    
    public function dashboard()
    {
       $alldoctors=User::where('role','doctor')->get();
       $totaldoctors=count($alldoctors);
       $patients=User::where('role','patient')->get();
       $totalpatients=count($patients);
       $appointments=Appointment::get();
       $totalappointments=count($appointments);
       $openappointments=Appointment::where('status','1')->get();
       $opentotalappointments=count($openappointments);
       $closeappointments=Appointment::where('status','0')->get();
       $closetotalappointments=count($closeappointments);
    return view('admin.dashboard',compact('totaldoctors','totalpatients','totalappointments','opentotalappointments','closetotalappointments'));
    }
    public function changeuserpassword(Request $request)
    {
        //return $request;
        
        if($request->password!=$request->confirm_password){
            return back()->with('error', 'Password Do Not Match! '); 
            
        }else{
           $data= User::find($request->userid);
            $data->password = md5($request->password);
           
            $data->save();
           
            return back()->with('message', 'Password Changed Successfully! ');
        }
    }
   
}

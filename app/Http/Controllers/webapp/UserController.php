<?php

namespace App\Http\Controllers\webapp;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Appointment;
use Mail;
use Stevebauman\Location\Facades\Location;

class UserController extends Controller
{
 
    function __construct() {
        $this->validate_session();
    }
    

    public function saveuser(Request $request,$id)
    {
        //return $request;
        $data= User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
		$data->passowrd = md5($request->passowrd);
        $data->status = '1';
        $data->role = $request->role;
          
        $data->save();
        
        return back()->with('message', ' Patient Registered successfully!');
    }
    public function saveappointment(Request $request)
    {
      if(!isset($_SESSION))
      {
         session_start();
      }
      //return $request;
      if(!empty($request->name) && !empty($request->email) && !empty($request->phone) && !empty($request->service) && !empty($request->date) && !empty($request->time)){
        $data=new Appointment();
        $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->service = $request->service;
            $data->date = $request->date;
            $data->doctor = $request->doctor;
            $data->time = $request->time;
            $data->message = $request->message;
            $data->save();
            return back()->with('message', 'Appointment Booked Successfully!');
      }else{
        return back()->with('error', 'Fill all the fields!');
      }
        
    }

    
}

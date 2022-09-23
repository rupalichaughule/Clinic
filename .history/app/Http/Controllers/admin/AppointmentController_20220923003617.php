<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use DB;
use App\Appointment;
use App\User;
use Mail;

class AppointmentController extends Controller
{
    function __construct() {
        $this->validate_session();
    }
    
 
    public function appointments() //all appointments list
    {
        if(isset($_SESSION['userid']) && $_SESSION['userrole']=='doctor'){
            $appointments= DB::table('appointments')
            ->leftJoin('users', 'users.id', '=', 'appointments.doctor')
          ->select('appointments.*', 'users.id as doctorid', 'users.name as doctorname')
          ->where('appointments.doctor',$_SESSION['userid'])->orWhere('appointments.email',$_SESSION['useremail'])->orderBy('appointments.id','Desc')
          ->get();
        }else{
    	    $appointments= Appointment::orderBy('id','DESC')->get();
            DB::table('appointments')
            ->leftJoin('users', 'users.id', '=', 'appointments.doctor')
          ->select('appointments.*', 'users.id as doctorid', 'users.name as doctorname')
          ->where('appointments.doctor',$_SESSION['userid'])->orWhere('appointments.email',$_SESSION['useremail'])->orderBy('appointments.id','Desc')
          ->get();
        }   
        return view('admin.appointments',compact('appointments'));
    }
    public function addappointment() //new appointment create
    {
        $doctors= User::where('role','doctor')->get();
        return view('admin.addappointment',compact('doctors'));
    }
    public function updateappointment(Request $request,$id) //edit appointment data
    {
        //return $request;
        
        if(!empty($request->name) && !empty($request->email) && !empty($request->phone) && !empty($request->service) && !empty($request->date) && !empty($request->time)){
            $data= Appointment::find($id);
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
    public function editappointment($id) //edit page
    {
        $appointmentdata = Appointment::find($id);
        $doctors= User::where('role','doctor')->get();
        return view('admin.editappointment',compact('appointmentdata','doctors'));
    }
    public function deleteappointment($id){ //delete appointment
        $data= Appointment::find($id);
        $data->delete();
        return back()->with('message', ' appointment Deleted successfully!');
    }

    public function changepassword(Request $request) //change appointment's password
    {
        //return $request;
        
        if($request->password!=$request->confirm_password){
            return back()->with('error', 'Password Do Not Match! '); 
            
        }else{
           $data= Appointment::find($request->appointmentid);
            $data->password = md5($request->password);
           
            $data->save();
           
            return back()->with('message', 'Password Changed Successfully! ');
        }
    }

    public function saveappointment(Request $request) //save appointments data
    {

           $data= new Appointment();
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
    
    public function activeappointmentstatus($id) //activate appointment 
        {
            $data = Appointment::find($id);
            $data->status = '1';
            $data->save();
            return back()->with('message', ' Appointment Activated successfully!');
        }
        public function inactiveappointmentstatus($id) //close appointment
        {
            $data = Appointment::find($id);
            $data->status = '0';
            $data->save();
            return back()->with('message', ' Appointment Closed successfully!');
        }

    
    
}

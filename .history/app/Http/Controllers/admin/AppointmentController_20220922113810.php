<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use DB;
use App\Appointment;
use Mail;

class PatientController extends Controller
{
    function __construct() {
        $this->validate_session();
    }
    
 
    public function patients() //all patients list
    {
    	    $patients= Appointment::orderBy('id','DESC')->get();
           
        return view('admin.patients',compact('patients'));
    }
    public function addpatient() //new patient create
    {
        return view('admin.addpatient');
    }
    public function updatepatient(Request $request,$id) //edit patient data
    {
        //return $request;
        $data= Appointment::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->role = 'patient';
        $data->password = md5($request->password);
        $data->status = $request->status;
        
        $data->save();
        
        return back()->with('message', ' patient Updated successfully!');
    }
    public function editpatient($id) //edit page
    {
        $patientdata = Appointment::find($id);
        return view('admin.editpatient',compact('patientdata'));
    }
    public function deletepatient($id){ //delete patient
        $data= Appointment::find($id);
        $data->delete();
        return back()->with('message', ' patient Deleted successfully!');
    }

    public function changepassword(Request $request) //change patient's password
    {
        //return $request;
        
        if($request->password!=$request->confirm_password){
            return back()->with('error', 'Password Do Not Match! '); 
            
        }else{
           $data= Appointment::find($request->patientid);
            $data->password = md5($request->password);
           
            $data->save();
           
            return back()->with('message', 'Password Changed Successfully! ');
        }
    }

    public function savepatient(Request $request) //save patients data
    {

           $data= new Appointment();
           $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->role = 'patient';
            $data->password = md5($request->password);
            $data->status = $request->status;
            $data->save();
           
            return back()->with('message', ' patient registered successfully.');
        
    }
    
    public function activestatus($id) //activate patient for access
        {
            $data = Appointment::find($id);
            $data->status = '1';
            $data->save();
            return back()->with('message', ' patient Activated successfully!');
        }
        public function inactivestatus($id) //remove patients access
        {
            $data = Appointment::find($id);
            $data->status = '0';
            $data->save();
            return back()->with('message', ' patient deactivated successfully!');
        }

    
    
}

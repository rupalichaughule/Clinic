<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use DB;
use App\User;
use Mail;

class DoctorController extends Controller
{
    function __construct() {
        $this->validate_session();
    }
    
 
    public function doctors() //all doctors list
    {
    	    $doctors= User::where('role','doctor')->orderBy('id','DESC')->get();
           
        return view('admin.doctors',compact('doctors'));
    }
    public function adddoctor() //new doctor create
    {
        return view('admin.adddoctor');
    }
    public function updatedoctor(Request $request,$id) //edit doctor data
    {
        //return $request;
        $data= User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->role = 'doctor';
        $data->password = md5($request->password);
        $data->status = $request->status;
        
        $data->save();
        
        return back()->with('message', ' Doctor Updated successfully!');
    }
    public function editdoctor($id) //edit page
    {
        $doctordata = User::find($id);
        return view('admin.editdoctor',compact('doctordata'));
    }
    public function deletedoctor($id){ //delete doctor
        $data= User::find($id);
        $data->delete();
        return back()->with('message', ' Doctor Deleted successfully!');
    }

    public function changepassword(Request $request) //change doctor's password
    {
        //return $request;
        
        if($request->password!=$request->confirm_password){
            return back()->with('error', 'Password Do Not Match! '); 
            
        }else{
           $data= User::find($request->doctorid);
            $data->password = md5($request->password);
           
            $data->save();
           
            return back()->with('message', 'Password Changed Successfully! ');
        }
    }

    public function savedoctor(Request $request) //save doctors data
    {

           $data= new User();
           $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->role = 'doctor';
            $data->password = md5($request->password);
            $data->status = $request->status;
            $data->save();
           
            return back()->with('message', ' Doctor registered successfully.');
        
    }
    
    public function activestatus($id) //activate doctor for access
        {
            $data = User::find($id);
            $data->status = '1';
            $data->save();
            return back()->with('message', ' Doctor Activated successfully!');
        }
        public function inactivestatus($id) //remove doctors access
        {
            $data = User::find($id);
            $data->status = '0';
            $data->save();
            return back()->with('message', ' Doctor deactivated successfully!');
        }

    
    
}

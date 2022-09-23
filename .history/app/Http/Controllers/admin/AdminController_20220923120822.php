<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Websitecontent;
use App\Contact;
use Mail;

class AdminController extends Controller
{
    function __construct() {
        $this->validate_session();
    }
   
    public function activestatus($id)
        {
            $data = User::find($id);
            $data->status = '1';
            $data->save();
            return back()->with('message', ' User Activated successfully!');
        }
        public function inactivestatus($id)
        {
            $data = User::find($id);
            $data->status = '0';
            $data->save();
            return back()->with('message', ' User deactivated successfully!');
        }

    public function changepassword(Request $request)
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

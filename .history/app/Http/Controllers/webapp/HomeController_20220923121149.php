<?php

namespace App\Http\Controllers\webapp;
use Illuminate\Http\Request;
use DB;
use App\User;
use Mail;
use Stevebauman\Location\Facades\Location;


class HomeController extends Controller
{
    
    public function index(Request $request)
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
        
        
        return view('webapp.index');
    }
    public function register(Request $request)
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
        
        
        return view('webapp.register');
    }
    public function appointment(Request $request)
    {
        $doctors= User::where('role','doctor')->get();
        if(!isset($_SESSION))
        {
            session_start();
        }
        
        return view('webapp.appointment',compact('doctors'));
    }

    

    public function login()
    {
        return view('webapp.login');
    }
   
   
    public function saveuser(Request $request)
    {
        // $checksponserid= User::where('userid',$request->email)->get();
        
           $data= new User();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->status = $request->status;
            $data->password = md5($request->password);
            $data->role = $request->role;
            
           
                $data->save();
                return back()->with('message', 'User Registered Successfully!');
           
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
    
    
    function logout()
    {
        if(!isset($_SESSION)) 
            { 
                session_start(); 
        } 
        session_destroy();
        
        unset($_SESSION['userid']);
        unset($_SESSION['username']);
        unset($_SESSION['userrole']);
        unset($_SESSION['userphone']);
        unset($_SESSION['useremail']);
        unset($_SESSION['userstatus']);
        
     return redirect('/');
    }


}

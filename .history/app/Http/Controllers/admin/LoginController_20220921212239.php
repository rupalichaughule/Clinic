<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use DB;
use App\User;
use Mail;

class LoginController extends Controller
{
  
    public function login()
    {
        return view('admin.login');
    }
    // public function forgotpassword()
    // {
    //     return view('admin.forgot-password');
    // }
    // public function resetpassword()
    // {
    //     return view('admin.reset-password');
    // }
    
   
    function checklogin(Request $request)
    {
        $email= $request->email; // store email value
        $password= md5($request->password); // Encrypting plain password using md5 function

        $admindata =  DB::table('users')->where([['email', $email],['password', $password],['status', '1']])
        // ->orWhere([['username', $email],['password', $password]])->orWhere([['userid', $email],['password', $password]])
        ->get();

       
     if(count($admindata)>0) // check query result
     {
         if(!isset($_SESSION)) //if session is not started
         {
            session_start(); //start session
         }
            $_SESSION['adminid'] = $admindata[0]->id; // store query result in session
            $_SESSION['adminname'] = $admindata[0]->name;
            $_SESSION['adminrole'] = $admindata[0]->role;
            $_SESSION['adminphone'] = $admindata[0]->phone;
            $_SESSION['adminemail'] = $admindata[0]->email;
            $_SESSION['adminstatus'] = $admindata[0]->status;
      
        if(isset($request->remember) && $request->remember == 1) // if remember is checked then set cookie
        {
            setcookie("cemail", $email, time()+(60*60*24));
            setcookie("cpassword", $password, time()+(60*60*24));
        }
      
     }else
     {
      return back()->with('error', 'Invalid Login Credentials!'); //retur with error message
     }
    }

    function logout()
    {
        if(!isset($_SESSION)) //if session is not started
            { 
                session_start(); //start session
        } 
        session_destroy(); // destroy session
        
        unset($_SESSION['adminid']); //unset values
        unset($_SESSION['adminname']);
        unset($_SESSION['adminrole']);
        unset($_SESSION['adminphone']);
        unset($_SESSION['adminemail']);
        unset($_SESSION['adminstatus']);
      
     return redirect('/login');
    }

}

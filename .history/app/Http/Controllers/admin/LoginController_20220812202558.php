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
        $email= $request->email;
        $password= md5($request->password);

        $admindata =  DB::table('users')->where([['email', $email],['password', $password],['role', 'admin'],['status', '1']])
        // ->orWhere([['username', $email],['password', $password]])->orWhere([['userid', $email],['password', $password]])
        ->get();
       
     if(count($admindata)>0)
     {
         if(!isset($_SESSION))
         {
        session_start();
         }
        $_SESSION['adminid'] = $admindata[0]->id; 
        $_SESSION['adminname'] = $admindata[0]->name;
        $_SESSION['adminrole'] = $admindata[0]->role;
        $_SESSION['adminphone'] = $admindata[0]->phone;
        $_SESSION['adminemail'] = $admindata[0]->email;
        $_SESSION['adminphoto'] = $admindata[0]->user_photo;
        $_SESSION['adminstatus'] = $admindata[0]->status;
      
        if(isset($request->remember) && $request->remember == 1)
        {
            setcookie("cemail", $email, time()+(60*60*24));
            setcookie("cpassword", $password, time()+(60*60*24));
        }
        else
        {
        setcookie("Details", "PHP");
        }   
            if($admindata[0]->role=='admin'){
                return redirect('/admin/dashboard'); 
            }else{
               // return redirect('/');
               return redirect('/admin/dashboard');  
            }
      
     }else
     {
      return back()->with('error', 'Invalid Login Credentials!');
     }
    }

    function logout()
    {
        if(!isset($_SESSION)) 
            { 
                session_start(); 
        } 
        session_destroy();
        
        unset($_SESSION['adminid']);
        unset($_SESSION['adminname']);
        unset($_SESSION['adminrole']);
        unset($_SESSION['adminphone']);
        unset($_SESSION['adminemail']);
        unset($_SESSION['adminstatus']);
      
     return redirect('/admin');
    }

}

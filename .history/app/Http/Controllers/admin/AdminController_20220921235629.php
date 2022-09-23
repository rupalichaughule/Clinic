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
    
 
    public function members()
    {
    	    $members= User::where('role','member')->orderBy('id','DESC')->get();
        
        return view('admin.members',compact('members'));
    }
    
    public function contacts()
    {
    	    $contacts= Contact::orderBy('id','DESC')->get();
        
        return view('admin.contacts',compact('contacts'));
    }
   
    public function updatemember(Request $request,$id)
    {
        //return $request;
        $data= User::find($id);
        $data->firstname = $request->firstname;
        $data->lastname = $request->lastname;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->dob = $request->dob;
        $data->gender = $request->gender;
        
        $data->bank_holder_name = $request->bank_holder_name;
        $data->bank_name = $request->bank_name;
        $data->bank_account_no = $request->bank_account_no;
        $data->bank_ifsc_code = $request->bank_ifsc_code;
        $data->bank_branch_name = $request->bank_branch_name;
        $data->upi_id = $request->upi_id;
        
        // $data->password = md5($request->password);
        $data->marital_status = $request->marital_status;
        //$data->sponser_id = $request->sponser_id;
        // if(isset($request->node_placement)){
        //     $data->node_placement = $request->node_placement;
        // }
        if($request->hasfile('photo'))
             {
                $name = $request->firstname;
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension(); // getting logo extension
                $filename =$name.'.'.time().'.'.$extension;
                $filename =  preg_replace('/[^A-Za-z0-9. ]/', '', $filename);
                $path=$file->move('uploads/member-photos/', $filename);
                $data->photo = $filename;
             }
        if(isset($request->bv)){
            $data->bv = $request->bv;
        }
        $data->updated_at =date("Y-m-d h:i:s");
        $data->save();
        
        $data1= User::find($id);
        
        $fullname=$data->firstname.$data->lastname;
        $uname=preg_replace('/[^A-Za-z0-9. ]/ ', '', $fullname);
        $uname=strtolower($uname);
        $uname=str_replace(' ', '', $uname);
        $data1->username = $uname.'0'.$data->id;
        $data1->save();
        
        // $findsponsoruser=User::where('sponser_id',$data->sponser_id)->first();
        //     if(isset($findsponsoruser)){
        //         if($request->node_placement=='Left'){
        //             $findsponsoruser->total_leftnode_placement=$findsponsoruser->total_leftnode_placement+1;
        //             $findsponsoruser->save();
        //         }else{
        //           $findsponsoruser->total_rightnode_placement=$findsponsoruser->total_rightnode_placement+1;
        //             $findsponsoruser->save(); 
        //         }
        //    }
        return back()->with('message', ' Member Updated successfully!');
    }
    public function deletemember($id){
        $data= User::find($id);
        $data->delete();
        return back()->with('message', ' Member Deleted successfully!');
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
        unset($_SESSION['userphoto']);
        
        
     return redirect('/admin');
    }
    
    function loginmember($id)
    {
        
        $userdata =  User::find($id);
       
     if(isset($userdata))
     {
         if(!isset($_SESSION))
         {
        session_start();
         }
        $_SESSION['userid'] = $userdata->id; 
        $_SESSION['username'] = $userdata->firstname.' '.$userdata->lastname;
        $_SESSION['userrole'] = $userdata->role;
        $_SESSION['userphone'] = $userdata->phone;
        $_SESSION['useremail'] = $userdata->email;
        $_SESSION['ruserid'] = $userdata->userid;
        $_SESSION['rusername'] = $userdata->username;
        $_SESSION['usersponserid'] = $userdata->sponser_id;
        $_SESSION['userfranchisetype'] = $userdata->franchise_type;
        $_SESSION['userstatus'] = $userdata->status;
         
      return redirect('/admin/dashboard');  

     }else
     {
      return back()->with('error', 'Something Went Wrong!');
     }
    }
    
    
    public function websitesettings()
    {
        $id='1';
        $data=Websitecontent::find($id);
        return view('admin.websitesettings',compact('data'));
    }
    function updatewebsitesettings (Request $request)
    {
          
         // return $request;
        $id='1';
        $data=Websitecontent::find($id);
        $data->title=$request->title;
        $data->address=$request->address;
        $data->email=$request->email;
        $data->contact_no=$request->contact_no;
        $data->facebook_link=$request->facebook_link;
        $data->twitter_link=$request->twitter_link;
        $data->insta_link=$request->insta_link;
        $data->youtube_link=$request->youtube_link;
        $data->google_link=$request->google_link;
        $data->razor_pay_key=$request->razor_pay_key;
        $data->sms_gateway_key=$request->sms_gateway_key;
        if($request->hasfile('logo'))
             {
                $name = 'logo';
                $file = $request->file('logo');
                $extension = $file->getClientOriginalExtension(); // getting logo extension
                $filename =$name.'.'.time().'.'.$extension;
                $filename =  preg_replace('/[^A-Za-z0-9. ]/', '', $filename);
                $path=$file->move('webapp-assets/', $filename);
                $data->logo = $filename;
             }
             if($request->hasfile('favicon'))
             {
                $name = 'favicon';
                $file = $request->file('favicon');
                $extension = $file->getClientOriginalExtension(); // getting favicon extension
                $filename =$name.'.'.time().'.'.$extension;
                $filename =  preg_replace('/[^A-Za-z0-9. ]/', '', $filename);
                $path=$file->move('webapp-assets/', $filename);
                $data->favicon = $filename;
             }
             
        $data->save();
    
        return back()->with('message', ' Website Settings Updated successfully!');
    }
    public function incomereports()
    {
        if($_SESSION['userrole']=='admin'){
            if(isset($_GET['user']) && isset($_GET['type']) && $_GET['user']!='all' && $_GET['type']!='all'){
                $walletdata = DB::table('wallets')
                ->leftjoin('users', 'users.id','=','wallets.userid')
                ->select('wallets.*', 'users.firstname as firstname', 'users.lastname as lastname', 'users.userid as userid')
                ->where('wallets.userid', 'like', '%' . $_GET['user'] . '%')->where('wallets.type', 'like', '%' . $_GET['type'] . '%')->orderBy('wallets.id','DESC')->get();
                
            }elseif(isset($_GET['user']) && isset($_GET['type']) && $_GET['user']=='all' && $_GET['type']!='all'){
                $walletdata = DB::table('wallets')
                ->leftjoin('users', 'users.id','=','wallets.userid')
                ->select('wallets.*', 'users.firstname as firstname', 'users.lastname as lastname', 'users.userid as userid')
                ->where('wallets.type', 'like', '%' . $_GET['type'] . '%')->orderBy('wallets.id','DESC')->get();
                
            }elseif(isset($_GET['user']) && isset($_GET['type']) && $_GET['user']!='all' && $_GET['type']=='all'){
                $walletdata = DB::table('wallets')
                ->leftjoin('users', 'users.id','=','wallets.userid')
                ->select('wallets.*', 'users.firstname as firstname', 'users.lastname as lastname', 'users.userid as userid')
                ->where('wallets.userid', 'like', '%' . $_GET['user'] . '%')->orderBy('wallets.id','DESC')->get();
                
            }else{
                $walletdata = DB::table('wallets')
                ->leftjoin('users', 'users.id','=','wallets.userid')
                ->select('wallets.*', 'users.firstname as firstname', 'users.lastname as lastname', 'users.userid as userid')
                ->orderBy('wallets.id','DESC')->get();
            }
            
        }else{
                $walletdata = DB::table('wallets')
                ->leftjoin('users', 'users.id','=','wallets.userid')
                ->select('wallets.*', 'users.firstname as firstname', 'users.lastname as lastname', 'users.userid as userid')
                ->where('wallets.userid', $_SESSION['userid'])->orderBy('wallets.id','DESC')->get();
        }
        $userdata = User::where('role','member')->orderBy('id','DESC')->get();
        return view('admin.incomereports',compact('walletdata','userdata'));
    }

    public function bvreports()
    {
        if($_SESSION['userrole']=='admin'){
            if(isset($_GET['user']) && $_GET['user']!='all'){
                $bvdata = DB::table('bvs')
                ->leftjoin('users', 'users.id','=','bvs.user_id')
                ->select('bvs.*', 'users.firstname as firstname', 'users.lastname as lastname', 'users.userid as userid')
                ->where('bvs.user_id', 'like', '%' . $_GET['user'] . '%')->orderBy('bvs.id','DESC')->get();
                
            }else{
                $bvdata = DB::table('bvs')
                ->leftjoin('users', 'users.id','=','bvs.user_id')
                ->select('bvs.*', 'users.firstname as firstname', 'users.lastname as lastname', 'users.userid as userid')
                ->orderBy('bvs.id','DESC')->get();
            }
            
        }else{
                $bvdata = DB::table('bvs')
                ->leftjoin('users', 'users.id','=','bvs.userid')
                ->select('bvs.*', 'users.firstname as firstname', 'users.lastname as lastname', 'users.userid as userid')
                ->where('bvs.user_id', $_SESSION['userid'])->orderBy('bvs.id','DESC')->get();
        }
        $userdata = User::where('role','member')->orderBy('id','DESC')->get();
        return view('admin.bvreports',compact('bvdata','userdata'));
    }

    
  
}

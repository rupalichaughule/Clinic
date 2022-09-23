<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Source;
use App\Websitecontent;
use Mail;

class UserController extends Controller
{
    function __construct() {
        $this->validate_session();
    }
    
 
    public function users()
    {
    	    $users= DB::table('users')
            ->leftjoin('purchases', 'purchases.user_id','=','users.id')
            ->leftjoin('packages', 'packages.id','=','purchases.package_id')
            ->select('users.*', 'packages.plan_name as plan_name')
            ->orderBy('users.id','DESC')->get();
            // User::where('role','user')->orderBy('id','DESC')->get();
           
        return view('admin.users',compact('users'));
    }
    public function adduser()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.countrystatecity.in/v1/countries/IN/cities',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'X-CSCAPI-KEY: c09UTVlnZmxncXF6TkVwelZITHhvcndwUVlnb1QzNWJkbU1hVE9jMQ=='
        ),
        ));

        $sources = curl_exec($curl);

        curl_close($curl);
        $sources=json_decode($sources);
        return view('admin.adduser',compact('sources'));
    }
    public function updateuser(Request $request,$id)
    {
        //return $request;
        $data= User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        // $cities= Source::where('source_name',$request->city)->get();
        // if(count($cities)>0){
        //     $getcity=Source::where('source_name',$request->city)->first();
        //     $data->city = $getcity->id;
        // }else{
        //     $addcity= new Source();
        //     $addcity->source_name = $request->city;
        //     $addcity->save();
        //     $data->city = $addcity->id;
        // }

        $data->city = $request->city;
        $data->state = $request->state;
        $data->country = $request->country;
        $data->address = $request->address;
        $data->aadhar_card_no = $request->aadhar_card_no;
        $data->driving_licence_no = $request->driving_licence_no;
        $data->pan_card_no = $request->pan_card_no;
        $data->updated_at =date("Y-m-d h:i:s");
        if($request->hasfile('user_photo'))
             {
                $name = $request->name;
                $file = $request->file('user_photo');
                $extension = $file->getClientOriginalExtension(); // getting logo extension
                $filename =$name.'.'.time().'.'.$extension;
                $filename =  preg_replace('/[^A-Za-z0-9. ]/', '', $filename);
                $path=$file->move('webapp-assets/images/user-images/', $filename);
                $data->user_photo = $filename;
             }
             if($request->hasfile('aadhar_card_photo'))
             {
                $name = $request->name;
                $file = $request->file('aadhar_card_photo');
                $extension = $file->getClientOriginalExtension(); // getting logo extension
                $filename =$name.'.'.time().'.'.$extension;
                $filename =  preg_replace('/[^A-Za-z0-9. ]/', '', $filename);
                $path=$file->move('webapp-assets/images/user-aadharcard/', $filename);
                $data->aadhar_card_photo = $filename;
             }
             if($request->hasfile('driving_licence_photo'))
             {
                $name = $request->name;
                $file = $request->file('driving_licence_photo');
                $extension = $file->getClientOriginalExtension(); // getting logo extension
                $filename =$name.'.'.time().'.'.$extension;
                $filename =  preg_replace('/[^A-Za-z0-9. ]/', '', $filename);
                $path=$file->move('webapp-assets/images/user-licence/', $filename);
                $data->driving_licence_photo = $filename;
             }
             if($request->hasfile('pan_card_photo'))
             {
                $name = $request->name;
                $file = $request->file('pan_card_photo');
                $extension = $file->getClientOriginalExtension(); // getting logo extension
                $filename =$name.'.'.time().'.'.$extension;
                $filename =  preg_replace('/[^A-Za-z0-9. ]/', '', $filename);
                $path=$file->move('webapp-assets/images/user-pancard/', $filename);
                $data->pan_card_photo = $filename;
             }
        $data->save();
        
        return back()->with('message', ' user Updated successfully!');
    }
    public function edituser($id)
    {
        $userdata = User::find($id);
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.countrystatecity.in/v1/countries/IN/cities',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'X-CSCAPI-KEY: c09UTVlnZmxncXF6TkVwelZITHhvcndwUVlnb1QzNWJkbU1hVE9jMQ=='
        ),
        ));

        $sources = curl_exec($curl);

        curl_close($curl);
        $sources=json_decode($sources);
        return view('admin.edituser',compact('userdata','sources'));
    }
    public function deleteuser($id){
        $data= User::find($id);
        $data->delete();
        return back()->with('message', ' user Deleted successfully!');
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

    public function saveuser(Request $request)
    {

           $data= new User();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            // $cities= Source::where('source_name',$request->city)->get();
            // if(count($cities)>0){
            //     $getcity=Source::where('source_name',$request->city)->first();
            //     $data->city = $getcity->id;
            // }else{
            //     $addcity= new Source();
            //     $addcity->source_name = $request->city;
            //     $addcity->save();
            //     $data->city = $addcity->id;
            // }
            $data->city = $request->city;
            $data->state = $request->state;
            $data->country = $request->country;
            $data->address = $request->address;
            $data->status = $request->status;
            $data->aadhar_card_no = $request->aadhar_card_no;
            $data->driving_licence_no = $request->driving_licence_no;
            $data->pan_card_no = $request->pan_card_no;
            $data->password = md5($request->password);
            $data->role = 'user';
            $data->otp_verified= 'yes';
            $data->status = '1';
            if($request->hasfile('user_photo'))
             {
                $name = $request->name;
                $file = $request->file('user_photo');
                $extension = $file->getClientOriginalExtension(); // getting logo extension
                $filename =$name.'.'.time().'.'.$extension;
                $filename =  preg_replace('/[^A-Za-z0-9. ]/', '', $filename);
                $path=$file->move('webapp-assets/images/user-images/', $filename);
                $data->user_photo = $filename;
             }
             if($request->hasfile('aadhar_card_photo'))
             {
                $name = $request->name;
                $file = $request->file('aadhar_card_photo');
                $extension = $file->getClientOriginalExtension(); // getting logo extension
                $filename =$name.'.'.time().'.'.$extension;
                $filename =  preg_replace('/[^A-Za-z0-9. ]/', '', $filename);
                $path=$file->move('webapp-assets/images/user-aadharcard/', $filename);
                $data->aadhar_card_photo = $filename;
             }
             if($request->hasfile('driving_licence_photo'))
             {
                $name = $request->name;
                $file = $request->file('driving_licence_photo');
                $extension = $file->getClientOriginalExtension(); // getting logo extension
                $filename =$name.'.'.time().'.'.$extension;
                $filename =  preg_replace('/[^A-Za-z0-9. ]/', '', $filename);
                $path=$file->move('webapp-assets/images/user-licence/', $filename);
                $data->driving_licence_photo = $filename;
             }
             if($request->hasfile('pan_card_photo'))
             {
                $name = $request->name;
                $file = $request->file('pan_card_photo');
                $extension = $file->getClientOriginalExtension(); // getting logo extension
                $filename =$name.'.'.time().'.'.$extension;
                $filename =  preg_replace('/[^A-Za-z0-9. ]/', '', $filename);
                $path=$file->move('webapp-assets/images/user-pancard/', $filename);
                $data->pan_card_photo = $filename;
             }
            $data->save();
           
            return back()->with('message', ' User registered successfully.');
        
    }
    
    public function activestatus($id)
        {
            $data = User::find($id);
            $data->status = '1';
            $data->save();
            return back()->with('message', ' user Activated successfully!');
        }
        public function inactivestatus($id)
        {
            $data = User::find($id);
            $data->status = '0';
            $data->save();
            return back()->with('message', ' user deactivated successfully!');
        }

    
    public function savemoney(Request $request)
    {
        //return $request;
        $data= new Wallet;
        $data->userid = $request->userid;
        $data->rupees = $request->rupees;
        $data->type = $request->type;
        $data->updated_at =date("Y-m-d h:i:s");
        $data->save();
        
        return back()->with('message', ' Money Added successfully!');
    }
    
    public function allincomes()
    {
        $walletdata = DB::table('wallets')
        ->leftjoin('users', 'users.id','=','wallets.userid')
        ->select('wallets.*', 'users.firstname as firstname', 'users.lastname as lastname', 'users.userid as userid')
        ->orderBy('wallets.id','DESC')->get();
        return view('admin.all-incomes',compact('walletdata'));
    }
    
  
    function updatewebsitesettings (Request $request)
    {
          
         // return $request;
        $id='1';
        $data=Websitecontent::find($id);
        $data->title=$request->title;
        $data->about_us=$request->about_us;
        $data->mission=$request->mission;
        $data->vision=$request->vision;
        $data->address=$request->address;
        $data->email=$request->email;
        $data->contact_no=$request->contact_no;
        $data->footer_heading=$request->footer_heading;
        $data->footer_para=$request->footer_para;
        $data->link1_text=$request->link1_text;
        $data->link1_url=$request->link1_url;
        $data->link2_text=$request->link2_text;
        $data->link2_url=$request->link2_url;
        $data->link3_text=$request->link3_text;
        $data->link4_text=$request->link4_text;
        $data->link4_url=$request->link4_url;
        $data->link5_text=$request->link5_text;
        $data->link5_url=$request->link5_url;
        $data->footer_address=$request->footer_address;
        $data->footer_phone=$request->footer_phone;
        $data->footer_email=$request->footer_email;
        $data->copyright=$request->copyright;
        if($request->hasfile('logo'))
             {
                $name = 'logo';
                $file = $request->file('logo');
                $extension = $file->getClientOriginalExtension(); // getting logo extension
                $filename =$name.'.'.time().'.'.$extension;
                $filename =  preg_replace('/[^A-Za-z0-9. ]/', '', $filename);
                $path=$file->move('webapp/assets/img/', $filename);
                $data->logo = $filename;
             }
             if($request->hasfile('favicon'))
             {
                $name = 'favicon';
                $file = $request->file('favicon');
                $extension = $file->getClientOriginalExtension(); // getting favicon extension
                $filename =$name.'.'.time().'.'.$extension;
                $filename =  preg_replace('/[^A-Za-z0-9. ]/', '', $filename);
                $path=$file->move('webapp/assets/img/', $filename);
                $data->favicon = $filename;
             }
             if($request->hasfile('link3_url'))
             {
                $name = 'businessplan';
                $file = $request->file('link3_url');
                $extension = $file->getClientOriginalExtension(); // getting link3_url extension
                $filename =$name.'.'.time().'.'.$extension;
                $filename =  preg_replace('/[^A-Za-z0-9. ]/', '', $filename);
                $path=$file->move('webapp/assets/img/', $filename);
                $data->link3_url = $filename;
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
        $userdata = User::where('role','user')->orderBy('id','DESC')->get();
        return view('admin.incomereports',compact('walletdata','userdata'));
    }

    
    public function purchases()
    {
    	    $purchases= DB::table('purchases')
            ->leftjoin('packages', 'packages.id','=','purchases.package_id')
            ->leftjoin('users', 'users.id','=','purchases.user_id')
            ->select('purchases.*', 'packages.plan_name as plan_name', 'users.name as username')
            ->orderBy('purchases.id','DESC')->get();

        return view('admin.purchases',compact('purchases'));
    }

}

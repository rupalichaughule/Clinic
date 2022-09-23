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


    public function filluserdetails($id)
    {
        $user=User::find($id);
        // $sources=Source::orderBy('id')->get();
        $ip=\Request::ip();
        $location = Location::get($ip);
        // return $location;
        $data=User::find($id);
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
        return view('webapp.fill-details',compact('data','location','sources'));
    }
    public function registerform(Request $request)
    {
            $id=$request->user_id;
            // $cities= Source::where('source_name',$request->city)->get();
            // if(count($cities)>0){
            //     $getcity=Source::where('source_name',$request->city)->first();
                $data= User::find($id);
                $data->name = $request->name;
                $data->email = $request->email;
                $data->phone = $request->phone;
                $data->status = $request->status;
                //$data->password = md5($request->password);
                $data->role = 'user';
                $data->city = $request->city;
                $data->zipcode = $request->zipcode;
                $data->state = $request->state;
                $data->country = $request->country;
		        $data->district = $request->district;
            
                $data->save();
                $_SESSION['userid'] = $data->id; 
                $_SESSION['username'] = $data->name;
                $_SESSION['userrole'] = $data->role;
                $_SESSION['userphone'] = $data->phone;
                $_SESSION['useremail'] = $data->email;
                $_SESSION['userphoto'] = $data->user_photo;
                $_SESSION['userstatus'] = $data->status;
                $_SESSION['userotpstatus'] = $data->otp_verified;
      
               
            // }else{
            //     $addcity= new Source();
            //     $addcity->source_name = $request->city;
            //     $addcity->save();

            //     $data= User::find($id);
            //     $data->name = $request->name;
            //     $data->email = $request->email;
            //     $data->phone = $request->phone;
            //     $data->status = $request->status;
            //     $data->password = md5($request->password);
            //     $data->role = 'user';
            //     $data->city = $addcity->id;
            //     $data->zipcode = $request->zipcode;
            //     $data->state = $request->state;
            //     $data->country = $request->country;
                
                // $data->save();
                // $_SESSION['userid'] = $data->id; 
                // $_SESSION['username'] = $data->name;
                // $_SESSION['userrole'] = $data->role;
                // $_SESSION['userphone'] = $data->phone;
                // $_SESSION['useremail'] = $data->email;
                // $_SESSION['userphoto'] = $data->user_photo;
                // $_SESSION['userstatus'] = $data->status;
                // $_SESSION['userotpstatus'] = $data->otp_verified;

            // }
            //return redirect('/verify-mobile/'.$data->id);
            return redirect('/dashboard');
        
    }
    public function getuservehicledata(Request $request)
    {
            $userid=$request->user_id;
            $vehicleid=$request->id;
            $listings= DB::table('listings')
                    ->leftjoin('sources', 'sources.id','=','listings.source')
                    ->leftjoin('destinations', 'destinations.id','=','listings.destination')
                    ->select('listings.*', 'sources.source_name as source_name', 'destinations.destination_name as destination_name')
                    ->where('listings.vehicle_type',$vehicleid)->where('listings.status','1')->where('listings.user_id',$userid)->orderBy('listings.id','DESC')->get();
                    // Listing::where('vehicle_type',$vehicleid)->where('user_id',$userid)->orderBy('id','DESC')->get();
            return $listings;
    }



}

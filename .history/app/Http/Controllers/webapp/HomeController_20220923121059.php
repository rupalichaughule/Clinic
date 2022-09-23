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


    public function sendotp(Request $request)
    {
        //$userdata =  DB::table('users')->Where('phone','=',$request->phone)->where('role','=','user')->get(); 
            
            $rndno=rand(100000, 999999);
            $_SESSION['vaahakuserotp']=$rndno;

            // Maveric SMS API Start
            // $api_key = '561A9D46DA59DD';
            // $contacts = $request->phone;
            // $from = 'Vaahak24';
            // $sms_text = urlencode("Your Verification Code for Vaahak24 is: ".$rndno);

            // $api_url = "http://sms.mavericinfotech.in/app/smsapi/index.php?key=".$api_key."&campaign=1&routeid=14&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text;

            // $response = file_get_contents( $api_url);
            // return $response;
            // Maveric SMS API End

            $settings=Websitecontent::find('1');

            // 2Factor SMS API Start
             $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => "http://2factor.in/API/V1/".$settings->sms_gateway_key."/SMS/".$request->phone."/".$rndno,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "",
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded"
                ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);
                // 2Factor SMS API End

        return redirect('/verify-mobile?n='.$request->phone)->with('message','OTP is sent to your Mobile Number!');
    }
    public function verifymobile()
    {
        return view('webapp.verify-mobile');
    }
    public function verifyuserotp(Request $request)
    {
        
        if($request->otp==$request->uotp){
            $userdata =  DB::table('users')->Where('phone','=',$request->phone)->where('role','=','user')->get(); 
            if(count($userdata)>0){

                if($userdata[0]->status=='1' && $userdata[0]->otp_verified=='yes'){
                    $_SESSION['userid'] = $userdata[0]->id; 
                $_SESSION['username'] = $userdata[0]->name;
                $_SESSION['userrole'] = $userdata[0]->role;
                $_SESSION['userphone'] = $userdata[0]->phone;
                $_SESSION['useremail'] = $userdata[0]->email;
                $_SESSION['userphoto'] = $userdata[0]->user_photo;
                $_SESSION['userstatus'] = $userdata[0]->status;
                $_SESSION['userotpstatus'] = $userdata[0]->otp_verified;
                    return redirect('/');
                }else{
                    return redirect('/fill-details/'.$userdata[0]->id);
                }
            }else{
                $data= new User();
                $data->phone = $request->phone;
                $data->role = 'user';
                $data->otp_verified = 'yes';
                $data->save();
                
                return redirect('/fill-details/'.$data->id);
                //return redirect('/thank-you');

            }
            
        }else{
            return back()->with('error', 'Invalid OTP!');
        }
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

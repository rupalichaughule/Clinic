<?php

namespace App\Http\Controllers\webapp;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Appointment;
use App\Listing;
use App\Vehicletype;
use App\Source;
use App\Destination;
use App\Purchase;
use App\Package;
use Mail;
use Stevebauman\Location\Facades\Location;

class UserController extends Controller
{
 
    function __construct() {
        $this->validate_session();
    }
    
    public function myprofile($id)
    {
        // $data=User::find($id);
        $data=DB::table('users')
        ->leftjoin('sources', 'sources.id','=','users.city')
        ->select('users.*')
        ->where('users.id',$id)->first();
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.countrystatecity.in/v1/countries/IN/cities',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'X-CSCAPI-KEY: c09UTVlnZmxncXF6TkVwelZITHhvcndwUVlnb1QzNWJkbU1hVE9jMQ=='
        ),
        ));

        $cities = curl_exec($curl);

        curl_close($curl);
        $cities=json_decode($cities);

        $ip=\Request::ip();
        $location = Location::get($ip);

        return view('webapp.my-profile',compact('data','cities','location'));
    }
    public function saveuser(Request $request,$id)
    {
        //return $request;
        $data= User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
		$data->passowrd = md5($request->passowrd);
        $data->status = '1';
        $data->role = $request->role;
          
        $data->save();
        
        return back()->with('message', ' Patient Registered successfully!');
    }
    public function saveappointment(Request $request)
    {
      if(!isset($_SESSION))
      {
         session_start();
      }
      //return $request;
      if(!empty($request->name) && !empty($request->email) && !empty($request->phone) && !empty($request->service) && !empty($request->date) && !empty($request->time)){
        $data=new Appointment();
        $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->service = $request->service;
            $data->date = $request->date;
            $data->doctor = $request->doctor;
            $data->time = $request->time;
            $data->message = $request->message;
            $data->save();
            return back()->with('message', 'Appointment Booked Successfully!');
      }else{
        return back()->with('error', 'Fill all the fields!');
      }
        
    }

    
}

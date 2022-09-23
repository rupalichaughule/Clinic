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
    public function dashboard()
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
        $data=User::find($_SESSION['userid']);
        $listings=DB::table('listings')
        ->leftjoin('vehicletypes', 'vehicletypes.id','=','listings.vehicle_type')
            
            ->select('listings.*', 'vehicletypes.vehicle_name as vehicletype')
        ->where('listings.user_id',$_SESSION['userid'])->where('listings.status','1')->orderBy('listings.id','DESC')->limit(5)->get();
        $activepackages=DB::table('purchases')
            ->leftjoin('packages', 'packages.id','=','purchases.package_id')
            ->leftjoin('users', 'users.id','=','purchases.user_id')
            ->select('purchases.*', 'packages.plan_name as plan_name')
            ->where('purchases.user_id',$_SESSION['userid'])->where('purchases.status','1')->orderBy('purchases.id','DESC')->get();
        $expiredpackages=DB::table('purchases')
            ->leftjoin('packages', 'packages.id','=','purchases.package_id')
            ->leftjoin('users', 'users.id','=','purchases.user_id')
            ->select('purchases.*', 'packages.plan_name as plan_name')
            ->where('purchases.user_id',$_SESSION['userid'])->where('purchases.status','!=','1')->orderBy('purchases.id','DESC')->get();
        return view('webapp.dashboard',compact('data','listings','activepackages','expiredpackages'));
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
    public function updateprofile(Request $request,$id)
    {
        //return $request;
        $data= User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
		$data->district = $request->district;
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
        $data->zipcode = $request->zipcode;
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
             if($request->hasfile('vehicle_img'))
             {
                $name = $request->name;
                $file = $request->file('vehicle_img');
                $extension = $file->getClientOriginalExtension(); // getting logo extension
                $filename =$name.'.'.time().'.'.$extension;
                $filename =  preg_replace('/[^A-Za-z0-9. ]/', '', $filename);
                $path=$file->move('webapp-assets/images/vehicles/', $filename);
                $data->vehicle_img = $filename;
             }
        $data->save();
        
        return back()->with('message', ' Profile Updated successfully!');
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
}

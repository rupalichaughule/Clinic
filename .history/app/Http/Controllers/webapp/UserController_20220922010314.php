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

      }
        $data=new Appointment();
        $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->service = $request->service;
            $data->date = $request->date;
            $data->time = $request->time;
            $data->message = $request->message;
            $data->save();
            return back()->with('message', 'Appointment Booked Successfully!');
    }

    public function savelisting(Request $request)
    {
        // $checksponserid= User::where('userid',$request->email)->get();
        
           $data= new Listing();
            $data->user_id = $request->user_id;
            $data->vehicle_type = $request->vehicle_type;
            $data->vehicle_name = $request->vehicle_name;
            $data->source = $request->source;
            $data->destination = $request->destination;
            // $cities= Source::where('source_name',$request->source)->get();
            // if(count($cities)>0){
            //     $getcity=Source::where('source_name',$request->source)->first();
            //     $data->source = $getcity->id;
            // }else{
            //     $addcity= new Source();
            //     $addcity->source_name = $request->source;
            //     $addcity->save();
            //     $data->source = $addcity->id;
            // }

            // $alldestinations= Destination::where('destination_name',$request->destination)->get();
            // if(count($alldestinations)>0){
            //     $getcity=Destination::where('destination_name',$request->destination)->first();
            //     $data->destination = $getcity->id;
            // }else{
            //     $addcity= new Destination();
            //     $addcity->destination_name = $request->destination;
            //     $addcity->save();
            //     $data->destination = $addcity->id;
            // }
            $data->listing_expiry = $request->listing_expiry;
            $data->contact = $request->contact;
            $data->available_seats = $request->available_seats;
            $data->date_time = $request->date_time;
		    $data->duration = $request->duration;
            $data->fare = $request->fare;
            $data->distance = $request->distance;
            $data->status = '1';
            $data->save();

            $checkpackage=Purchase::where('user_id',$request->user_id)->where('status','1')->orderBy('id','DESC')->first();
            if(isset($checkpackage)){
                $checkpackage->pending_listings=$checkpackage->pending_listings-1;
                $checkpackage->save();
            }
            return back()->with('message', 'Listing Added Successfully!');
        
    }

    public function mylistings()
    {
      if(!isset($_SESSION))
      {
         session_start();
      }
        $listings=DB::table('listings')
        ->leftjoin('vehicletypes', 'vehicletypes.id','=','listings.vehicle_type')
        ->select('listings.*', 'vehicletypes.vehicle_name as vehicletype')
        ->where('listings.user_id',$_SESSION['userid'])->where('listings.status','1')->orderBy('listings.id','DESC')->get();
        $data=User::find($_SESSION['userid']);
        return view('webapp.my-listings',compact('listings','data'));
    }
    public function deletelisting($id){
      $data= Listing::find($id);
      $data->delete();
      return back()->with('message', ' Listing Deleted successfully!');
  }
  public function listingactivestatus($id)
        {
            $data = Listing::find($id);
            $data->status = '1';
            $data->save();
            return back()->with('message', ' Listing Opened successfully!');
        }
   public function listinginactivestatus($id)
        {
            $data = Listing::find($id);
            $data->status = '0';
            $data->save();
            return back()->with('message', ' Listing Closed successfully!');
        }


        public function paymentsucess($userid,$packageid)
        {
            //return $request;

                $current_date=date("Y-m-d");
                $data= new Purchase();
                $data->user_id= $userid;
                $data->package_id= $packageid;
                $data->purchase_date= $current_date;
                $data->payment_status= 'success';

                // $package= Package::find($packageid);
                $days_limit=$package->per_limit;
                $data->total_listings= $pakcage->listing_limit;
                $data->pending_listings= $package->listing_limit;
                $data->amount= $package->new_price;
                $data->expiry_date= date('Y-m-d', strtotime($current_date. ' + . $days_limit. days'));
                $data->status= '1';
                $data->save();
                //return $data;
            
            return view('webapp.thank-you');
        }
        public function paymentfailed($userid,$packageid)
        {
            $current_date=date("Y-m-d");
            $data= new Purchase();
            $data->user_id= $userid;
            $data->package_id= $packageid;
            $data->purchase_date= $current_date;
            $data->payment_status= 'failed';

            $package= Package::find($packageid);
            $days_limit=$package->per_limit;
            $data->total_listings= $pakcage->listing_limit;
            $data->pending_listings= $package->listing_limit;
            $data->amount= $package->new_price;
            $data->expiry_date= date('Y-m-d', strtotime($current_date. ' + . $days_limit. days'));
            $data->status= '0';
            $data->save();
            
            return view('webapp.failed');
        }

        public function thankyou()
        {
            return view('webapp.thank-you');
        }
        public function failed()
        {
            return view('webapp.failed');
        }
        public function packages()
        {
            $data=User::find($_SESSION['userid']);
            $packages=Package::get();
            return view('webapp.packages',compact('packages','data'));
        }
        public function mypackages()
        {
        if(!isset($_SESSION))
        {
            session_start();
        }
            $packages=DB::table('purchases')
            ->leftjoin('packages', 'packages.id','=','purchases.package_id')
            ->leftjoin('users', 'users.id','=','purchases.user_id')
            ->select('purchases.*', 'packages.plan_name as plan_name')
            ->where('purchases.user_id',$_SESSION['userid'])->orderBy('purchases.id','DESC')->get();
            $data=User::find($_SESSION['userid']);
            return view('webapp.my-packages',compact('packages','data'));
        }
	
		public function editlisting($id)
        {
            if(!isset($_SESSION))
            {
                session_start();
            }
            $vehicletypes=Vehicletype::orderBy('id')->get();
            $listing=DB::table('listings')
            ->leftjoin('users', 'users.id','=','listings.user_id')
            ->leftjoin('categories', 'categories.id','=','listings.vehicle_type')
            ->select('listings.*', 'categories.name as vehicletype', 'users.name as username', 'users.user_photo as userphoto', 'users.email as useremail')
            ->where('listings.id',$id)->first();
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

            $data=User::find($_SESSION['userid']);
            return view('webapp.edit-listing',compact('listing','vehicletypes','sources','data'));
        }
        public function updatelisting(Request $request,$id)
        {
                $data= Listing::find($id);
                $data->user_id = $request->user_id;
                $data->vehicle_type = $request->vehicle_type;
                $data->vehicle_name = $request->vehicle_name;
                $data->source = $request->source;
                $data->destination = $request->destination;
                $data->listing_expiry = $request->listing_expiry;
                $data->contact = $request->contact;
                $data->available_seats = $request->available_seats;
                $data->date_time = $request->date_time;
			    $data->duration = $request->duration;
                $data->fare = $request->fare;
                $data->distance = $request->distance;
                $data->save();
                return back()->with('message', 'Listing Updated Successfully!');
            
        }
}

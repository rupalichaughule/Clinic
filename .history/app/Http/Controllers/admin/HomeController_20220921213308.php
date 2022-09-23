<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Appointment;
use Mail;
use Carbon\Carbon;

class HomeController extends Controller
{
    function __construct() {
        $this->validate_session();
    }
    
    public function dashboard()
    {
       $doctors=User::where('role','doctor')->get();
       $totaldoctors=count($alldoctors);
       $listings=Listing::get();
       $totallistings=count($listings);
       $openlistings=Listing::where('status','1')->get();
       $opentotallistings=count($openlistings);
       $closelistings=Listing::where('status','!=','1')->get();
       $closetotallistings=count($closelistings);
    return view('admin.dashboard',compact('totalusers','totallistings','opentotallistings','closetotallistings'));
    }
   
}

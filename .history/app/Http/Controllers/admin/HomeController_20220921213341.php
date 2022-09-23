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
       $patients=User::where('role','patient')->get();
       $totalpatients=count($patients);
       $openlistings=Listing::where('status','1')->get();
       $opentotallistings=count($openlistings);
       $closelistings=Listing::where('status','!=','1')->get();
       $closetotallistings=count($closelistings);
    return view('admin.dashboard',compact('totaldoctors','totalpatients','opentotallistings','closetotallistings'));
    }
   
}

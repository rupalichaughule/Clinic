<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Source;
use App\Websitecontent;
use Mail;

class DoctorController extends Controller
{
    function __construct() {
        $this->validate_session();
    }
    
 
    public function doctors()
    {
    	    $doctors= DB::table('doctors')
            ->leftjoin('purchases', 'purchases.doctor_id','=','doctors.id')
            ->leftjoin('packages', 'packages.id','=','purchases.package_id')
            ->select('doctors.*', 'packages.plan_name as plan_name')
            ->orderBy('doctors.id','DESC')->get();
            // doctor::where('role','doctor')->orderBy('id','DESC')->get();
           
        return view('admin.doctors',compact('doctors'));
    }
    public function adddoctor()
    {
        return view('admin.adddoctor');
    }
    public function updatedoctor(Request $request,$id)
    {
        //return $request;
        $data= doctor::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->role = 'doctor';
        $data->password = md5($request->password);
        $data->status = $request->status;
        
        $data->save();
        
        return back()->with('message', ' doctor Updated successfully!');
    }
    public function editdoctor($id)
    {
        $doctordata = doctor::find($id);
        return view('admin.editdoctor',compact('doctordata'));
    }
    public function deletedoctor($id){
        $data= doctor::find($id);
        $data->delete();
        return back()->with('message', ' doctor Deleted successfully!');
    }

    public function changepassword(Request $request)
    {
        //return $request;
        
        if($request->password!=$request->confirm_password){
            return back()->with('error', 'Password Do Not Match! '); 
            
        }else{
           $data= doctor::find($request->doctorid);
            $data->password = md5($request->password);
           
            $data->save();
           
            return back()->with('message', 'Password Changed Successfully! ');
        }
    }

    public function savedoctor(Request $request)
    {

           $data= new doctor();
           $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->role = $request->city;
            $data->password = md5($request->password);
            $data->status = $request->status;
            $data->save();
           
            return back()->with('message', ' doctor registered successfully.');
        
    }
    
    public function activestatus($id)
        {
            $data = doctor::find($id);
            $data->status = '1';
            $data->save();
            return back()->with('message', ' doctor Activated successfully!');
        }
        public function inactivestatus($id)
        {
            $data = doctor::find($id);
            $data->status = '0';
            $data->save();
            return back()->with('message', ' doctor deactivated successfully!');
        }

    
    public function savemoney(Request $request)
    {
        //return $request;
        $data= new Wallet;
        $data->doctorid = $request->doctorid;
        $data->rupees = $request->rupees;
        $data->type = $request->type;
        $data->updated_at =date("Y-m-d h:i:s");
        $data->save();
        
        return back()->with('message', ' Money Added successfully!');
    }
    
    public function allincomes()
    {
        $walletdata = DB::table('wallets')
        ->leftjoin('doctors', 'doctors.id','=','wallets.doctorid')
        ->select('wallets.*', 'doctors.firstname as firstname', 'doctors.lastname as lastname', 'doctors.doctorid as doctorid')
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
        if($_SESSION['doctorrole']=='admin'){
            if(isset($_GET['doctor']) && isset($_GET['type']) && $_GET['doctor']!='all' && $_GET['type']!='all'){
                $walletdata = DB::table('wallets')
                ->leftjoin('doctors', 'doctors.id','=','wallets.doctorid')
                ->select('wallets.*', 'doctors.firstname as firstname', 'doctors.lastname as lastname', 'doctors.doctorid as doctorid')
                ->where('wallets.doctorid', 'like', '%' . $_GET['doctor'] . '%')->where('wallets.type', 'like', '%' . $_GET['type'] . '%')->orderBy('wallets.id','DESC')->get();
                
            }elseif(isset($_GET['doctor']) && isset($_GET['type']) && $_GET['doctor']=='all' && $_GET['type']!='all'){
                $walletdata = DB::table('wallets')
                ->leftjoin('doctors', 'doctors.id','=','wallets.doctorid')
                ->select('wallets.*', 'doctors.firstname as firstname', 'doctors.lastname as lastname', 'doctors.doctorid as doctorid')
                ->where('wallets.type', 'like', '%' . $_GET['type'] . '%')->orderBy('wallets.id','DESC')->get();
                
            }elseif(isset($_GET['doctor']) && isset($_GET['type']) && $_GET['doctor']!='all' && $_GET['type']=='all'){
                $walletdata = DB::table('wallets')
                ->leftjoin('doctors', 'doctors.id','=','wallets.doctorid')
                ->select('wallets.*', 'doctors.firstname as firstname', 'doctors.lastname as lastname', 'doctors.doctorid as doctorid')
                ->where('wallets.doctorid', 'like', '%' . $_GET['doctor'] . '%')->orderBy('wallets.id','DESC')->get();
                
            }else{
                $walletdata = DB::table('wallets')
                ->leftjoin('doctors', 'doctors.id','=','wallets.doctorid')
                ->select('wallets.*', 'doctors.firstname as firstname', 'doctors.lastname as lastname', 'doctors.doctorid as doctorid')
                ->orderBy('wallets.id','DESC')->get();
            }
            
        }else{
                $walletdata = DB::table('wallets')
                ->leftjoin('doctors', 'doctors.id','=','wallets.doctorid')
                ->select('wallets.*', 'doctors.firstname as firstname', 'doctors.lastname as lastname', 'doctors.doctorid as doctorid')
                ->where('wallets.doctorid', $_SESSION['doctorid'])->orderBy('wallets.id','DESC')->get();
        }
        $doctordata = doctor::where('role','doctor')->orderBy('id','DESC')->get();
        return view('admin.incomereports',compact('walletdata','doctordata'));
    }

    
    public function purchases()
    {
    	    $purchases= DB::table('purchases')
            ->leftjoin('packages', 'packages.id','=','purchases.package_id')
            ->leftjoin('doctors', 'doctors.id','=','purchases.doctor_id')
            ->select('purchases.*', 'packages.plan_name as plan_name', 'doctors.name as doctorname')
            ->orderBy('purchases.id','DESC')->get();

        return view('admin.purchases',compact('purchases'));
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Config;


use App\Models\Core\Setting;
use App\Models\Admin\Admin;
use App\Models\Core\Order;
use App\Models\Core\Customers;
use App\Models\Core\Drivers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Exception;
use App\Models\Core\Images;
use Validator;
use Hash;
use Auth;
use ZipArchive;
use File;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CustomerController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /******   Manage Users  Start ******/

    public function manageCustomers(){
       $usertype = auth()->user()->user_types_id;

       if($usertype == 2){

        $manageunassigned = DB::table('customer')->where('center_id', '=',auth()->user()->center_id)->where('cust_status', '=','unassigned')->orderBy('id','Asc')->get();

        $manageassigned = DB::table('customer')->where('center_id', '=',auth()->user()->center_id)->where('cust_status', '=','assigned')->orderBy('id','Asc')->get();

      }elseif($usertype == 3){
        $manageCustomers = DB::table('customer')
        ->select('customer.*','users.*','customer.id as custID')->Join('users', 'users.id', '=', 'customer.staff_id')->where('customer.staff_id', '=',auth()->user()->id)->orderBy('customer.id','Asc')->get();
        $manageunassigned = DB::table('customer')->where('staff_id', '=',auth()->user()->id)->orderBy('id','Asc')->get();

       $manageassigned = DB::table('customer')->where('staff_id', '!=',auth()->user()->id)->orderBy('id','Asc')->get(); 
       

      
      }else{

       $manageunassigned = DB::table('customer')->where('center_id', '=',auth()->user()->center_id)->where('admin_status', '=','unassigned')->orderBy('id','Asc')->get();

       $manageassigned = DB::table('customer')->where('center_id', '!=',auth()->user()->center_id)->orderBy('id','Asc')->get(); 

       $managecompleted = DB::table('customer')->where('cust_status', '=','completed')->orderBy('id','Asc')->get();
   }

   $manageadmincustomer = DB::table('users')
   ->where('users.user_types_id', '=','2')
   ->orderBy('users.id','Asc')->get();


   $managestaffcustomer = DB::table('users')
   ->where('users.user_types_id', '=','3')->where('center_id', '=',auth()->user()->center_id)
   ->orderBy('users.id','Asc')->get();

   if($usertype == 1){

    return view("customer.index")->with('manageadmincustomer', $manageadmincustomer)->with('managestaffcustomer', $managestaffcustomer)->with('manageunassigned', $manageunassigned)->with('manageassigned', $manageassigned)->with('managecompleted', $managecompleted);

}elseif($usertype == 2){
    return view('customer.index')->with('manageadmincustomer', $manageadmincustomer)->with('managestaffcustomer', $managestaffcustomer)->with('manageassigned', $manageassigned)->with('manageunassigned', $manageunassigned);

}elseif($usertype == 3){
    return view("customer.index")->with('managecustomers', $manageCustomers)->with('manageadmincustomer', $manageadmincustomer)->with('managestaffcustomer', $managestaffcustomer);
}
}

public function Assignadmin(Request $request){

    $assignadmin = DB::table('customer')->where('id',$request->id)->update([

       'center_id'          =>   $request->center_id, 
       'comments'           =>   $request->comments,
       'admin_status'        =>   "assigned", 

   ]);
    return redirect('customer')->with('success', 'Customer Assigned Successfully');

}

public function Assignstaff(Request $request){

    $assignadmin = DB::table('customer')->where('id',$request->id)->update([

       'staff_id'           =>   $request->staff_id,
       'comments'           =>   $request->comments,
       'cust_status'        =>   "assigned", 

   ]);
    return redirect('customer')->with('success', 'Customer Created Successfully');

}

public function Progress(Request $request){

    $progress = DB::table('customer')->where('id',$request->id)->update([

       'percentage'           =>   $request->percentage,
       'percentage_comments'  =>   $request->percentage_comments,
       'percentage_completed'  =>  date('Y-m-d'),

   ]);

     $progress_in = DB::table('customer_progress')->insert([
        'percentage'                  =>   $request->percentage,
        'percentage_comments'         =>   $request->percentage_comments,
        'customer_id'                 =>   $request->id,
        'users_id'                    =>   $request->users_id,
        'users_name'                  =>   $request->users_name,
        'update_time'                 =>   date('Y-m-d H:i:s'),
        'log_id'                      =>   auth()->user()->id,
        ]);
    return redirect('customer')->with('success', 'Progress Updated Successfully');

}

public function addCustomer(Request $request){

    $adduser = DB::table('customer')->insertGetId([
        'customer_name'           =>   $request->customer_name,
        'date_of_birth'           =>   $request->date_of_birth,
        'gender'                  =>   $request->gender,
        'name_of_college'         =>   $request->name_of_college,
        'name_of_department'      =>   $request->name_of_department,
        'name_of_instiute'        =>   $request->name_of_instiute,
        'name_of_board_univercity'=>   $request->name_of_board_univercity,
        'percentage_of_marks'     =>   $request->percentage_of_marks,
        'year_of_passing'         =>   $request->year_of_passing,
        'mobile_number'           =>   $request->mobile_number,
        'email'                   =>   $request->email,
        'remarks'                 =>   $request->remarks,
        'name_of_degree'          =>   $request->name_of_degree,
        'status'                  =>   $request->status,
        'admin_status'            =>   "unassigned",
        'cust_status'            =>   "unassigned",
        'created_at'              =>   date('Y-m-d H:i:s'),
        'center_id'              =>    auth()->user()->center_id,
    ]);

    return redirect('/customer')->with('success', 'Customer Added Successfully'); 
}

public function editPatient(Request $request){
    $editpatient->doctor_id = json_encode(doctor_id);
    $editpatient = DB::table('patients')->where('id',$request->id)->update([

        'profile_status'     =>   $request->profile_status,
        'full_name'          =>   $request->full_name,
        'year'               =>   $request->year,
        'month'              =>   $request->month,
        'days'               =>   $request->days,
        'gender'             =>   $request->gender,
        'age'                =>   $request->age,
        'relation_name'      =>   $request->relation_name,
        'relationship'       =>   $request->relationship,
        'street'             =>   $request->street,
        'locality'           =>   $request->locality,
        'village_name'       =>   $request->village_name,
        'aadhaar_no'         =>   $request->aadhaar_no,
        'mobile_number'      =>   $request->mobile_number,
        'phone_number'       =>   $request->phone_number,
        'email'              =>   $request->email,
        'blood_group'        =>   $request->blood_group,
        'company'            =>   $request->company,
        'employe_id'         =>   $request->employe_id,
        'other_details'      =>   $request->other_details,
        'status'             =>   $request->status,
        'updated_at'         =>   date('Y-m-d H:i:s'),
    ]);

    return redirect('/patients')->with('success', 'Patient Updated Successfully'); 
}

/******   Edit Users End ******/


public function appointments($id){
    return view("patients.appointments");
}

/**    Add Event  Start **/

public function calandarData(){
   print_r("ok"); die();

   $event = DB::table('reminder_event')->where('status',1)->orderBy('id','DESC')->get();
   $currentDate = date('Y-m-d');
   $domainExpired = DB::table('tb_user')->where('status', '1')->orderBy('id','DESC')->get();

   foreach($event as $eve){
    if($eve->event_name != ''){
        $data[] = array(
            'title'   => $eve->event_name,
            'start'   => $eve->event_date,
            'end'     => $eve->event_time,
            'url'     => "edit_event/".$eve->id,
            'backgroundColor'=> '#00bc8c',
            'borderColor'=> '#00bc8c',
        );
    }
}

foreach($domainExpired as $domExp){
    if($domExp->shop_name != ''){
        $data[] = array(
            'title'   => $domExp->first_name,
            'start'   => date('Y-m-d',strtotime($domExp->end_date)),
            'end'     => date('H:i:s',strtotime($domExp->end_date)),
            'url'     => "shoplistdashboard/". $domExp->id,
            'backgroundColor'=> '#e74c3c',
            'borderColor'=> '#e74c3c',
        );
    }
}

echo json_encode($data);

}

/**   Add Event  End **/

/**    Add Event  Start **/

public function addEvent(Request $request){

    $mangeRolesUpdate = DB::table('reminder_event')->insert([

        'event_name'    =>   $request->event_name,
        'event_date'	=>   $request->event_date,
        'event_time'	=>   $request->event_time,
        'status'		=>   1,
        'created_at'	=>	 date('Y-m-d H:i:s'),
    ]);

    return redirect()->back(); 

}

/**   Add Event  End **/


/**    Edit Event  Start **/

public function editEvent(Request $request,$id){

    $editevent = DB::table('reminder_event')->where('id','=',$id)->first();
    return view("patients.appointments")->with('editevent',$editevent);

}

/**   Edit Event  End **/


/**    Update Event  Start **/

public function updateEvent(Request $request){

    $updateEvent = DB::table('reminder_event')->where('id',$request->id)->update([

        'event_name'    =>   $request->event_name,
        'event_date'	=>   $request->event_date,
        'event_time'	=>   $request->event_time,
        'status'		=>   1,
        'created_at'	=>	 date('Y-m-d H:i:s'),
    ]);

    return redirect()->back()->with('success','Event Updated Successfully ... !'); 

}

/**   Update Event  End **/


/**    Delete Event  Start **/

public function deleteEvent(Request $request){

    $delEvent = DB::table('reminder_event')->where('id',$request->delid)->delete();

    return view("patients.appointments");

}

/**   Delete Event  End **/
/******    Delete Users  Start ******/

public function deleteUser(Request $request){

    $deluser = DB::table('patients')->where('id',$request->id)->delete();
    return redirect()->back(); 

}

/******   Delete Users  End ******/


/******    Sorting Users  Start ******/

public function planSorting(Request $request)
{
    $array  = $request->arrayorder;
            //Print_r($array);die();
    if($request->update == "update")
    {
        $count = 1;

        foreach ($array as $idval)
        {
                    //$data=array('sort_order'=> $count);
            $sortPlan = DB::table('manage_plan')->where('id',$idval)->update(['sort_order' =>   $count]);
            $count ++;
        }
    }
    echo 'Manage Plan Order Change Successfully....!';
}

/******    Sorting Users  End ******/


}

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
use Carbon\Carbon;
use DateTime;
use Carbon\CarbonPeriod;
use PDF;
use DateInterval;


class DashboardController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /******   dashboard Start ******/

    public function dashboard(){

        $usertype = auth()->user()->user_types_id;
        $user_id = auth()->user()->id;
        $cen_id = auth()->user()->center_id;

        if($usertype == 1){

            $sql = " select count(*) as total from users where user_types_id=2";
            $result = DB::select(DB::raw($sql));
            if(count($result) > 0){
              $total = $result[0]->total;
          }

          $sql = " select count(*) as new from customer where admin_status='unassigned'";
          $result = DB::select(DB::raw($sql));
          if(count($result) > 0){
              $new = $result[0]->new;
          }

          $sql = " select count(*) as assigned from customer where admin_status='assigned'";
          $result = DB::select(DB::raw($sql));
          if(count($result) > 0){
              $assigned = $result[0]->assigned;
          }

          $sql = " select count(*) as completed from customer where admin_status='completed'";
          $result = DB::select(DB::raw($sql));
          if(count($result) > 0){
              $completed = $result[0]->completed;
          }

        }elseif($usertype == 2){

           $sql = " select count(*) as staff from users where user_types_id=3 and center_id='$user_id'";
            $result = DB::select(DB::raw($sql));
            if(count($result) > 0){
              $staff = $result[0]->staff;
          }
         $sql ="select count(*) as admin_unassign from customer where cust_status='unassigned' and center_id='$cen_id'";
          $result = DB::select(DB::raw($sql));
          if(count($result) > 0){
              $admin_unassign = $result[0]->admin_unassign;
          }

      
         $sql = " select count(*) as admin_assign from customer where cust_status='assigned' and center_id='$cen_id'";
          $result = DB::select(DB::raw($sql));
          if(count($result) > 0){
              $admin_assign = $result[0]->admin_assign;
          }

       $sql = " select count(*) as admin_comp from customer where admin_status='completed' and center_id='$cen_id'";
          $result = DB::select(DB::raw($sql));
          if(count($result) > 0){
              $admin_comp = $result[0]->admin_comp;
        }


        }else{

            $sql ="select count(*) as staff_comp from customer where staff_id = '$user_id' and cust_status='completed' and admin_status='completed'";
          $result = DB::select(DB::raw($sql));
          if(count($result) > 0){
              $staff_comp = $result[0]->staff_comp;
          }

      
         $sql = " select count(*) as staff_assign from customer where staff_id = '$user_id'";
          $result = DB::select(DB::raw($sql));
          if(count($result) > 0){
              $staff_assign = $result[0]->staff_assign;
          }
        }   

        if($usertype == 1){
            return view("dashboard", compact('total','new','assigned','completed'));
        }elseif($usertype == 2){
            return view("dashboard", compact('staff','admin_unassign','admin_assign','admin_comp'));
        }else{
            return view("dashboard", compact('staff_comp','staff_assign'));
        }

}

/******   dashboard end ******/





}

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
use Illuminate\Support\Facades\Input;
use Exception;
use App\Models\Core\Images;
use Validator;
use Hash;
use Auth;
use ZipArchive;
use File;
use Carbon\Carbon;



class UsersController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /****** View  Roles Start ******/

    public function manageUsers(){
        $usertype = auth()->user()->user_types_id;
        if($usertype == 1){
         $manageusers = DB::table('users')->select('users.*','user_types.*','users.id as userID')
         ->Join('user_types', 'user_types.id', '=', 'users.user_types_id')
         ->where( 'users.user_types_id','!=',1)
         ->orderBy('users.id','Asc')->get();
     }elseif($usertype == 2){
        $manageusers = DB::table('users')->select('users.*','user_types.*','users.id as userID')
        ->Join('user_types', 'user_types.user_types_id', '=', 'users.user_types_id')
        ->where( 'users.center_id', '=',auth()->user()->center_id)->where( 'users.user_types_id','!=',2)
        ->orderBy('users.id','Asc')->get();
    }else{
        $manageusers = DB::table('users')->select('users.*','user_types.*','users.id as userID')
        ->Join('user_types', 'user_types.user_types_id', '=', 'users.user_types_id')
        ->where( 'users.id', '=',auth()->user()->id)->where( 'users.user_types_id','!=',3)
        ->orderBy('users.id','Asc')->get();
    }
    $manageadmins = DB::table('users')->select('users.*','user_types.*','users.id as userID')
         ->Join('user_types', 'user_types.user_types_id', '=', 'users.user_types_id')
         ->where( 'users.user_types_id', '=','2')
         ->orderBy('users.id','Asc')->get();

         $managestaffs = DB::table('users')->select('users.*','user_types.*','users.id as userID')
         ->Join('user_types', 'user_types.user_types_id', '=', 'users.user_types_id')
         ->where( 'users.user_types_id', '=','3')->where( 'users.center_id', '=',auth()->user()->center_id)
         ->orderBy('users.id','Asc')->get();

    $userrole = DB::table('user_types')->where('status',1)->where('user_types_id','!=',1)->get();

    return view("users.index")->with('manageusers',$manageusers)->with('userrole', $userrole)->with('manageadmins', $manageadmins)->with('managestaffs', $managestaffs);


}

/******   View Roles  end ******/

public function usersAttendance($id){
    $attendance = DB::table('attendances')->select('attendances.*','users.*','attendances.id as userID')
    ->Join('users', 'users.id', '=', 'attendances.user_id')
    ->orderBy('attendances.id','Asc')->get();
    return view("users.attendance")->with('attendance', $attendance);
}

/****** Add  Roles Action Start ******/

public function addUser(Request $request){
    $usertype = auth()->user()->user_types_id;
    $user_types_id = $request->get('user_types_id');
    if($usertype == 1 && $user_types_id == 2){
       $customers_id = DB::table('users')->insertGetId([

        'full_name'                 =>   $request->first_name.' '.$request->last_name,
        'first_name'                =>   $request->first_name,
        'last_name'                 =>   $request->last_name,
        'mobile_number'             =>   $request->mobile_number,
        'email'                     =>   $request->email,

        'password'                  =>   Hash::make($request->password),
        'check_password'            =>   $request->password,
        'gender'                    =>   $request->gender,
        'address'                   =>   $request->address,
        'created_at'                =>   date('Y-m-d H:i:s'),
        'user_types_id'             =>   $request->user_types_id,

    ]);
       $gender = $request->get('gender');
       if($gender == "Male"){
        $profile_photo ="man.png";
    }else{
        $profile_photo ="girl.png";
    }

    $last_insert_id = DB::getPdo()->lastInsertId();
    $customers_id = DB::table('users')->where('id',$last_insert_id)->update([
        'center_id'                =>   $last_insert_id,
        'profile_photo'             =>   $profile_photo,
    ]);

    $addUserRoles = DB::table('user_permission')->insert([
        'user_types_id'   =>   $request->user_types_id,
        'user_id'         =>   $customers_id,
    ]);

}elseif($usertype == 1 && $user_types_id == 3){
    $gender = $request->get('gender');
    if($gender == "Male"){
        $profile_photo ="man.png";
    }else{
        $profile_photo ="girl.png";
    }
    $customers_id = DB::table('users')->insertGetId([

        'full_name'                 =>   $request->first_name.' '.$request->last_name,
        'first_name'                =>   $request->first_name,
        'last_name'                 =>   $request->last_name,
        'mobile_number'             =>   $request->mobile_number,
        'email'                     =>   $request->email,

        'password'                  =>   Hash::make($request->password),
        'check_password'            =>   $request->password,
        'gender'                    =>   $request->gender,
        'address'                   =>   $request->address,
        'created_at'                =>   date('Y-m-d H:i:s'),
        'user_types_id'             =>   $request->user_types_id,
        'center_id'                 =>   auth()->user()->center_id,
        'profile_photo'             =>   $profile_photo,
    ]);

    $addUserRoles = DB::table('user_permission')->insert([
        'user_types_id'   =>   $request->user_types_id,
        'user_id'         =>   $customers_id,
    ]);

}elseif($usertype == 2 && $user_types_id == 3){
  $gender = $request->get('gender');
  if($gender == "Male"){
    $profile_photo ="man.png";
}else{
    $profile_photo ="girl.png";
}

$customers_id = DB::table('users')->insertGetId([

    'full_name'                 =>   $request->first_name.' '.$request->last_name,
    'first_name'                =>   $request->first_name,
    'last_name'                 =>   $request->last_name,
    'mobile_number'             =>   $request->mobile_number,
    'email'                     =>   $request->email,

    'password'                  =>   Hash::make($request->password),
    'check_password'            =>   $request->password,
    'gender'                    =>   $request->gender,
    'address'                   =>   $request->address,
    'created_at'                =>   date('Y-m-d H:i:s'),
    'user_types_id'             =>   $request->user_types_id,
    'center_id'             =>   auth()->user()->center_id,
    'profile_photo'             =>   $profile_photo,
]);

$addUserRoles = DB::table('user_permission')->insert([
    'user_types_id'   =>   $request->user_types_id,
    'user_id'         =>   $customers_id,
]);
}


return redirect('/users')->with('success', 'Users Created Successfully');
}

/****** Edit  Roles Start ******/

public function editUser(Request $request){

    $edituser = DB::table('users')->where('id',$request->id)->update([
        'full_name'                 =>   $request->first_name.' '.$request->last_name,
        'first_name'                =>   $request->first_name,
        'last_name'                 =>   $request->last_name,
        'mobile_number'             =>   $request->mobile_number,
        'email'                     =>   $request->email,
        'gender'                    =>   $request->gender,
        'address'                   =>   $request->address,
        'status'                    =>   $request->status,
        'created_at'                =>   date('Y-m-d H:i:s'),
        'user_types_id'             =>   $request->user_types_id
    ]);
                            //Print_r($edituser);die();

    return redirect('/users')->with('success', 'Users Updated Successfully'); 
}
/******   Edit Users End ******/

public function checkemail(Request $request){
    $email = trim($request->get('email'));
    $id = trim($request->get('id'));
    if($id == 0){
        $sql = "SELECT * FROM users where email='$email'";
    }else{
        $sql = "SELECT * FROM users where email='$email' and id <> $id";
    }
    $emailcheck = DB::select(DB::raw($sql));
    if(count($emailcheck) > 0){
        return response()->json(array("exists" => true));
    }else{
        return response()->json(array("exists" => false));   
    }
}

}

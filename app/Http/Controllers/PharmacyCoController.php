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


class PharmacyCoController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
/******   Manage Products Start ******/
	
        public function manageCategory(){
          $manageCategory = DB::table('category')->orderBy('id','Asc')->get();
      return view("pharmacy/products.category")->with('manageCategory', $manageCategory);
        }
		

        public function manageGenerics(){
          $manageGenerics = DB::table('generics')->orderBy('id','Asc')->get();
      return view("pharmacy/products.generics")->with('manageGenerics', $manageGenerics);
        }
		
		public function managePackings(){
          $managePackings = DB::table('packings')->orderBy('id','Asc')->get();
      return view("pharmacy/products.packings")->with('managePackings', $managePackings);
        }
		
		public function manageMedicines(){
          $manageMedicines = DB::table('medicines')->orderBy('id','Asc')->get();
    return view("pharmacy/products.medicines")->with('manageMedicines', $manageMedicines);
        }
		
		public function manageCompany(){
          $manageCompany = DB::table('company')->orderBy('id','Asc')->get();
          return view("pharmacy/products.company")->with('manageCompany', $manageCompany);
        }
		
	    public function manageSupplierlist(){
          $manageSupplierlist = DB::table('supplierlist')->orderBy('id','Asc')->get();
          return view("pharmacy/products.supplierlist")->with('manageSupplierlist', $manageSupplierlist);
        }
		
		public function manageLocations(){
          $manageLocations = DB::table('locations')->orderBy('id','Asc')->get();
          return view("pharmacy/products.location")->with('manageLocations', $manageLocations);
        }
		
/******   Add category Start ******/

        public function addCategory(Request $request){

            $addCategory = DB::table('category')->insert([
                'category_name'	    =>   $request->category_name,
                'status'	        =>   $request->status,
               
                ]);
				//Print_r($addproduct);die();

            return redirect()->back(); 
        }
		
/******   Add generics Start ******/

        public function addGenerics(Request $request){

            $addGenerics = DB::table('generics')->insert([
                'generic_name'	    =>   $request->generic_name,
                'status'	        =>   $request->status,
               
                ]);
				//Print_r($addproduct);die();

            return redirect()->back(); 
        }
/******   Add packings Start ******/

        public function addPackings(Request $request){

            $addPackings = DB::table('packings')->insert([
                'packing_name'	    =>   $request->packing_name,
                'status'	        =>   $request->status,
               
                ]);
				//Print_r($addproduct);die();

            return redirect()->back(); 
        }
		
/******   Add medicines Start ******/
		
		public function addMedicines(Request $request){

            $addMedicines = DB::table('medicines')->insert([
                'medicine_name'	    =>   $request->medicine_name,
                'status'	        =>   $request->status,
               
                ]);
				//Print_r($addproduct);die();

            return redirect()->back(); 
        }
		
/******   Add company Start ******/

        public function addCompany(Request $request){

            $addCompany = DB::table('company')->insert([
                'company_name'	    =>   $request->company_name,
                'status'	        =>   $request->status,
               
                ]);
				//Print_r($addproduct);die();

            return redirect()->back(); 
        }
/******   Add supplier Start ******/
        public function addSupplierlist(Request $request){

            $addSupplierlist = DB::table('supplierlist')->insert([
                'supplier_name'	    =>   $request->supplier_name,
				'adress'	        =>   $request->adress,
				'contact'	        =>   $request->contact,
                'status'	        =>   $request->status,
               
                ]);
				//Print_r($addproduct);die();

            return redirect()->back(); 
        }
/******   Add location Start ******/

		public function addLocations(Request $request){

            $addLocations = DB::table('locations')->insert([
                'rack_name'	        =>   $request->rack_name,
                'status'	        =>   $request->status,
               
                ]);
				//Print_r($addproduct);die();

            return redirect()->back(); 
        }
		
		
/******   Edit Pharmacy Start ******/

       /*public function editLocations(Request $request){

            $editLocations = DB::table('locations')->where('id',$request->id)->update([
                'rack_name'	            =>   $request->rack_name,
                'status'       	        =>   $request->status,
                ]);
            return redirect()->back(); 
        }*/

/******   Edit Product End ******/

/******    Delete Users  Start ******/

        public function deleteUser(Request $request){

            $deluser = DB::table('users')->where('id',$request->id)->delete();
            return redirect()->back(); 

        }

/******   Delete Users  End ******/

/******   Delete Patients  Start ******/
       public function managePatients(){
			$managepatients = DB::table('users')
                ->Join('patient_disease', 'patient_disease.id', '=', 'users.disease_id')
                ->where('users.role_id', '=','2')->get();
            return view("patients.index")->with('managepatients', $managepatients);

        }
/******   Delete Patients  End ******/
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

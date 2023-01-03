@extends('layout')
@section('content')
@if(auth()->user()->user_types_id == 1)
<div class="content-wrapper">
   <section class="content">
      <div class="card card-primary card-outline card-outline-tabs">
         <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-four-admin-new" data-toggle="pill" href="#custom-tabs-four-new" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="true">New</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-assigned-tab" data-toggle="pill" href="#custom-tabs-four-assigned" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Assigned</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-completed-tab" data-toggle="pill" href="#custom-tabs-four-completed" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Completed</a>
               </li>
               <div class="col-sm-4">
                  <center>
                     <div class="nav-link">Users List</div>
                  </center>
               </div>
               <div class="col-sm-3">
                  <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Customer Full Name">
               </div>
               <div class="col-sm-1">
                  <td>
                     <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add_customer"><i class="fa fa-plus"> </i> Add</button>
                  </td>
               </div>
            </ul>
         </div>

         <div class="card-body">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissable">
               <a href="#" style="color:white !important" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               <strong> {{ session('success') }} </strong>
            </div>
            @endif

            <div class="tab-content" id="custom-tabs-four-tabContent">
               <div class="tab-pane fade show active" id="custom-tabs-four-new" role="tabpanel" aria-labelledby="custom-tabs-four-new-tab">
                  <table id="example3" class="table table-bordered table-hover">
                     <thead>
                        <tr>
                           <th>Id</th>
                           <th>Customer Name</th>
                           <th>College Name</th>
                           <th>DepartMent</th>
                           <th>Degree</th>
                           <th>Pass Out</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($manageunassigned as $key=>$manageunassign)
                        <tr id="arrayorder_<?php echo $manageunassign->id?>">
                           <td>{{ $key + 1 }}</td>
                           <td>{{ $manageunassign->customer_name }}</td>
                           <td>{{ $manageunassign->name_of_college }}</td>
                           <td>{{ $manageunassign->name_of_department }}</td>
                           <td>{{ $manageunassign->name_of_degree }}</td>
                           <td>{{ $manageunassign->year_of_passing }}</td>
                           @if($manageunassign->status == 1)
                           <td>Active</td>
                           @else
                           <td>Inactive</td>
                           @endif 
                           <td>
                              <div class="margin">
                               <div class="btn-group">
                                 <button type="button" class="btn btn-default">More</button>
                                 <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                   <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                   <a href="" class="dropdown-item"  data-toggle="modal" data-target="#edit{{ $manageunassign->id }}">Edit</a>
                                   <a href="" class="dropdown-item"  data-toggle="modal" data-target="#assign{{ $manageunassign->id }}">Assign</a>
                                </div>
                             </td>

                          </tr>
                          <div class="modal fade" id="edit{{ $manageunassign->id }}">
                           <form action="{{url('/edit_user')}}" method="post">
                              {{ csrf_field() }}
                              <div class="modal-dialog">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h4 class="modal-title">Edit</h4>
                                       <button type="button" class="close" data-dismiss="modal" 
                                       aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <input type="hidden" class="form-control" name="id" 
                                    value="{{ $manageunassign->id }}"/>
                                    <input type="text" class="form-control mb-3" name="customer_name" 
                                    value="{{ $manageunassign->customer_name }}" placeholder="Name"/>
                                    <input type="text" class="form-control mb-3" name="name_of_college" 
                                    value="{{ $manageunassign->name_of_college }}" placeholder="College Name"/>
                                    <input type="text" class="form-control mb-3" name="email"
                                    value="{{ $manageunassign->email }}" placeholder="Enter email"/>
                                    <input type="text" class="form-control mb-3" name="phone"
                                    value="{{ $manageunassign->mobile_number }}" placeholder="Enter phone"/>
                                    <select name="gender" class="form-control">
                                       <option value="">Select status</option>
                                       <option value="Mail" <?php if($manageunassign->gender == 1){ echo "selected"; }?>>Mail</option>
                                       <option value="Femail" <?php if($manageunassign->gender == 0){ echo "selected"; }?>>Femail</option>
                                    </select>
                                 </br>
                              </br>
                              <select name="status" class="form-control">
                                 <option value="">Select status</option>
                                 <option value="1" <?php if($manageunassign->status == 1){ echo "selected"; }?>>Active</option>
                                 <option value="0" <?php if($manageunassign->status == 0){ echo "selected"; }?>>Inactive</option>
                              </select>
                           </div>
                           <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-default" 
                              data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Submit</button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
               @endforeach
            </tbody>
         </table>
      </div>

      <div class="tab-pane fade" id="custom-tabs-four-assigned" role="tabpanel" aria-labelledby="custom-tabs-four-assigned-tab">
         <table id="example4" class="table table-bordered table-hover">
            <thead>
               <tr>
                  <th>Id</th>
                  <th>Customer Name</th>
                  <th>College Name</th>
                  <th>DepartMent</th>
                  <th>Degree</th>
                  <th>Percentage</th>
                  <th>Percentage Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @foreach($manageassigned as $key=>$manageassign)
               <tr id="arrayorder_<?php echo $manageassign->id?>">
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $manageassign->customer_name }}</td>
                  <td>{{ $manageassign->name_of_college }}</td>
                  <td>{{ $manageassign->name_of_department }}</td>
                  <td>{{ $manageassign->name_of_degree }}</td>
                  @if($manageassign->percentage == "")
                  <td>--</td>
                  @else
                  <td>{{ $manageassign->percentage }}</td>
                  @endif
                  <td class="text-center">
                   @if($manageassign->percentage == "")
                   <button class="btn btn-primary disabled" ><i class="fa fa-eye"></i></button>
                   @else
                   <a href="" class="btn btn-primary"  data-toggle="modal" data-target="#progresscheck{{ $manageassign->id }}"><i class="fa fa-eye"></i></a>
                   @endif
                   <div class="modal fade" id="progresscheck{{ $manageassign->id }}">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h4 class="modal-title">Progress</h4>
                              <button type="button" class="close" data-dismiss="modal" 
                              aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                        <div class="modal-body">
                           <table id="example4" class="table table-bordered table-hover">
                              <tr>
                                 <th>Percentage</th>
                                 <th>Comments</th>
                                 <th>Completed Date</th>
                              </tr>
                              @php
                              $sql = "select * from customer_progress where customer_id='$manageassign->id'";
                              $result = DB::select(DB::raw($sql));
                              foreach($result as $res){
                                $percentage = $res->percentage;
                                $percentage_comments = $res->percentage_comments;
                                $date = $res->update_time;
                                echo"<tr>
                                 <td>$percentage</td>
                                 <td>$percentage_comments</td>
                                 <td>$date</td>
                              </tr>";
                           }
                           @endphp 
                        </table>
                     </div>

                     <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" 
                        data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                     </div>
                  </div>
               </div>
            </div>
         </td>
         <td>
            <div class="margin">
             <div class="btn-group">
               <button type="button" class="btn btn-default">More</button>
               <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                 <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu" role="menu">
                 <a href="" class="dropdown-item"  data-toggle="modal" data-target="#edit{{ $manageassign->id }}">Edit</a>
                 <a href="" class="dropdown-item"  data-toggle="modal" data-target="#assign{{ $manageassign->id }}">Assign</a>
              </div>
           </td>

        </tr>
        <div class="modal fade" id="edit{{ $manageassign->id }}">
         <form action="{{url('/edit_user')}}" method="post">
            {{ csrf_field() }}
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h4 class="modal-title">Edit</h4>
                     <button type="button" class="close" data-dismiss="modal" 
                     aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <input type="hidden" class="form-control" name="id" 
                  value="{{ $manageassign->id }}"/>
                  <input type="text" class="form-control mb-3" name="customer_name" 
                  value="{{ $manageassign->customer_name }}" placeholder="Name"/>
                  <input type="text" class="form-control mb-3" name="name_of_college" 
                  value="{{ $manageassign->name_of_college }}" placeholder="College Name"/>
                  <input type="text" class="form-control mb-3" name="email"
                  value="{{ $manageassign->email }}" placeholder="Enter email"/>
                  <input type="text" class="form-control mb-3" name="phone"
                  value="{{ $manageassign->mobile_number }}" placeholder="Enter phone"/>
                  <select name="gender" class="form-control">
                     <option value="">Select status</option>
                     <option value="Mail" <?php if($manageassign->gender == 1){ echo "selected"; }?>>Mail</option>
                     <option value="Femail" <?php if($manageassign->gender == 0){ echo "selected"; }?>>Femail</option>
                  </select>
               </br>
            </br>
            <select name="status" class="form-control">
               <option value="">Select status</option>
               <option value="1" <?php if($manageassign->status == 1){ echo "selected"; }?>>Active</option>
               <option value="0" <?php if($manageassign->status == 0){ echo "selected"; }?>>Inactive</option>
            </select>
         </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" 
            data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
         </div>
      </div>
   </div>
</form>
</div>
@endforeach
</tbody>
</table>
</div>
<div class="tab-pane fade" id="custom-tabs-four-completed" role="tabpanel" aria-labelledby="custom-tabs-four-completed-tab">
   <table id="example5" class="table table-bordered table-hover">
      <thead>
         <tr>
          <th>Id</th>
          <th>Customer Name</th>
          <th>College Name</th>
          <th>DepartMent</th>
          <th>Degree</th>
          <th>Pass Out</th>
          <th>Status</th>
          <th>Action</th>
       </tr>
    </thead>
    <tbody>
      @foreach($managecompleted as $key=>$managecomplet)
      <tr id="arrayorder_<?php echo $managecomplet->id?>">
         <td>{{ $key + 1 }}</td>
         <td>{{ $managecomplet->customer_name }}</td>
         <td>{{ $managecomplet->name_of_college }}</td>
         <td>{{ $managecomplet->name_of_department }}</td>
         <td>{{ $managecomplet->name_of_degree }}</td>
         <td>{{ $managecomplet->year_of_passing }}</td>
         @if($managecomplet->status == 1)
         <td>Active</td>
         @else
         <td>Inactive</td>
         @endif 
         <td>
            <div class="margin">
             <div class="btn-group">
               <button type="button" class="btn btn-default">More</button>
               <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                 <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu" role="menu">
                 <a href="" class="dropdown-item"  data-toggle="modal" data-target="#edit{{ $managecomplet->id }}">Edit</a>
                 <a href="" class="dropdown-item"  data-toggle="modal" data-target="#assign{{ $managecomplet->id }}">Assign</a>
              </div>
           </td>

        </tr>
        <div class="modal fade" id="edit{{ $managecomplet->id }}">
         <form action="{{url('/edit_user')}}" method="post">
            {{ csrf_field() }}
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h4 class="modal-title">Edit</h4>
                     <button type="button" class="close" data-dismiss="modal" 
                     aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <input type="hidden" class="form-control" name="id" 
                  value="{{ $managecomplet->id }}"/>
                  <input type="text" class="form-control mb-3" name="customer_name" 
                  value="{{ $managecomplet->customer_name }}" placeholder="Name"/>
                  <input type="text" class="form-control mb-3" name="name_of_college" 
                  value="{{ $managecomplet->name_of_college }}" placeholder="College Name"/>
                  <input type="text" class="form-control mb-3" name="email"
                  value="{{ $managecomplet->email }}" placeholder="Enter email"/>
                  <input type="text" class="form-control mb-3" name="phone"
                  value="{{ $managecomplet->mobile_number }}" placeholder="Enter phone"/>
                  <select name="gender" class="form-control">
                     <option value="">Select status</option>
                     <option value="Mail" <?php if($managecomplet->gender == 1){ echo "selected"; }?>>Mail</option>
                     <option value="Femail" <?php if($managecomplet->gender == 0){ echo "selected"; }?>>Femail</option>
                  </select>
               </br>
            </br>
            <select name="status" class="form-control">
               <option value="">Select status</option>
               <option value="1" <?php if($managecomplet->status == 1){ echo "selected"; }?>>Active</option>
               <option value="0" <?php if($managecomplet->status == 0){ echo "selected"; }?>>Inactive</option>
            </select>
         </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" 
            data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
         </div>
      </div>
   </div>
</form>
</div>
@endforeach
</tbody>
</table>
</div>
</div>

</div>

<!-- /.card -->
@if(auth()->user()->user_types_id == 1)

@foreach($manageunassigned as $key=>$managecustomerslist)
<div class="modal fade" id="assign{{ $managecustomerslist->id }}">
   <form action="{{url('/assignadmin')}}" method="post">
      {{ csrf_field() }}
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Edit</h4>
               <button type="button" class="close" data-dismiss="modal" 
               aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <input type="hidden" class="form-control" name="id" 
            value="{{ $managecustomerslist->id }}"/>
            <select name="center_id" class="form-control">
               <option value="">select</option>
               @foreach($manageadmincustomer as $key=>$manageadmin)

               <option value="{{ $manageadmin->center_id }}" >{{ $manageadmin->full_name }}</option>
               @endforeach
            </select>
         </br>

         <textarea name='comments' class="form-control" rows="3" placeholder="Comments..." ></textarea>


      </div>
      <div class="modal-footer justify-content-between">
         <button type="button" class="btn btn-default" 
         data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary">Submit</button>
      </div>
   </div>
</div>
</form>
</div>
@endforeach
@endif
<div class="modal fade" id="add_customer">
   <form action="{{url('/add_customer')}}" method="post">
      {{ csrf_field() }}
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Add Customer</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-6">
                     <input type="text" class="form-control mb-3" name="customer_name" placeholder="Customer Name"/>
                     <input type="email" class="form-control mb-3" name="email" placeholder="Email"/>
                     <select class="form-control mb-3" name="gender">
                        <option>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                     </select>
                     <input type="text" class="form-control mb-3" name="date_of_birth" placeholder="DOB"/>
                     <input type="text" class="form-control mb-3" name="name_of_instiute" placeholder="Instiute Name"/>
                     <input type="text" class="form-control mb-3" name="name_of_board_univercity" placeholder="Name Of Univercity"/>
                     <input type="text" class="form-control mb-3" name="name_of_college" placeholder="College Name "/>  
                     <input type="text" class="form-control mb-3" name="name_of_department" placeholder="Department Name"/>
                  </div>
                  <div class="col-md-6"> 

                     <input type="text" class="form-control mb-3" name="name_of_degree" placeholder="Name Of Degree"/>
                     <input type="text" class="form-control mb-3" name="year_of_passing" placeholder="Year Of Passing"/>				  
                     <input type="text" class="form-control mb-3" name="mobile_number" placeholder="Enter Mobile Number"/>
                     <input type="text" class="form-control mb-3" name="percentage_of_marks" placeholder="Percentage"/>
                     <input type="text" class="form-control mb-3" name="remarks" placeholder="Remarks"/>
                     <textarea name='address' class="form-control" rows="3" placeholder="Address..." ></textarea>
                  </div>
               </div>
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Submit</button>
            </div>
         </div>
      </div>
   </form>
</div>
<!-- /.card -->
</div>
</div>
</section>
<!-- /.content -->
</div>
@elseif(auth()->user()->user_types_id == 2)
<div class="content-wrapper">
   <section class="content">
      <div class="card card-primary card-outline card-outline-tabs">
         <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">

               <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-four-admin-new" data-toggle="pill" href="#custom-tabs-four-new" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="true">New</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-assigned-tab" data-toggle="pill" href="#custom-tabs-four-assigned" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Assigned</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-completed-tab" data-toggle="pill" href="#custom-tabs-four-completed" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Completed</a>
               </li>
               <div class="col-sm-4">
                  <center>
                     <div class="nav-link">Users List</div>
                  </center>
               </div>
               <div class="col-sm-3">
                  <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Customer Full Name">
               </div>
               <div class="col-sm-1">
                  <td>
                     <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add_customer"><i class="fa fa-plus"> </i> Add</button>
                  </td>
               </div>
            </ul>
         </div>

         <div class="card-body">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissable">
               <a href="#" style="color:white !important" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               <strong> {{ session('success') }} </strong>
            </div>
            @endif

            <div class="tab-content" id="custom-tabs-four-tabContent">

               <div class="tab-pane fade show active" id="custom-tabs-four-new" role="tabpanel" aria-labelledby="custom-tabs-four-new-tab">
                  <table id="example3" class="table table-bordered table-hover">
                     <thead>
                        <tr>
                           <th>Id</th>
                           <th>Customer Name</th>
                           <th>College Name</th>
                           <th>DepartMent</th>
                           <th>Degree</th>
                           <th>Pass Out</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                       @foreach($manageunassigned as $key=>$manageunassign)
                       <tr id="arrayorder_<?php echo $manageunassign->id?>">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $manageunassign->customer_name }}</td>
                        <td>{{ $manageunassign->name_of_college }}</td>
                        <td>{{ $manageunassign->name_of_department }}</td>
                        <td>{{ $manageunassign->name_of_degree }}</td>
                        <td>{{ $manageunassign->year_of_passing }}</td>
                        @if($manageunassign->status == 1)
                        <td>Active</td>
                        @else
                        <td>Inactive</td>
                        @endif 
                        <td>
                           <div class="margin">
                            <div class="btn-group">
                              <button type="button" class="btn btn-default">More</button>
                              <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                             </button>
                             <div class="dropdown-menu" role="menu">
                                <a href="" class="dropdown-item"  data-toggle="modal" data-target="#edit{{ $manageunassign->id }}">Edit</a>
                                <a href="" class="dropdown-item"  data-toggle="modal" data-target="#assign{{ $manageunassign->id }}">Assign</a>
                             </div>
                          </td>

                       </tr>
                       <div class="modal fade" id="edit{{ $manageunassign->id }}">
                        <form action="{{url('/edit_user')}}" method="post">
                           {{ csrf_field() }}
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h4 class="modal-title">Edit</h4>
                                    <button type="button" class="close" data-dismiss="modal" 
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <input type="hidden" class="form-control" name="id" 
                                 value="{{ $manageunassign->id }}"/>
                                 <input type="text" class="form-control mb-3" name="customer_name" 
                                 value="{{ $manageunassign->customer_name }}" placeholder="Name"/>
                                 <input type="text" class="form-control mb-3" name="name_of_college" 
                                 value="{{ $manageunassign->name_of_college }}" placeholder="College Name"/>
                                 <input type="text" class="form-control mb-3" name="email"
                                 value="{{ $manageunassign->email }}" placeholder="Enter email"/>
                                 <input type="text" class="form-control mb-3" name="phone"
                                 value="{{ $manageunassign->mobile_number }}" placeholder="Enter phone"/>
                                 <select name="gender" class="form-control">
                                    <option value="">Select status</option>
                                    <option value="Mail" <?php if($manageunassign->gender == 1){ echo "selected"; }?>>Mail</option>
                                    <option value="Femail" <?php if($manageunassign->gender == 0){ echo "selected"; }?>>Femail</option>
                                 </select>
                              </br>
                           </br>
                           <select name="status" class="form-control">
                              <option value="">Select status</option>
                              <option value="1" <?php if($manageunassign->status == 1){ echo "selected"; }?>>Active</option>
                              <option value="0" <?php if($manageunassign->status == 0){ echo "selected"; }?>>Inactive</option>
                           </select>
                        </div>
                        <div class="modal-footer justify-content-between">
                           <button type="button" class="btn btn-default" 
                           data-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
            @endforeach

         </tbody>
      </table>
   </div>

   <div class="tab-pane fade" id="custom-tabs-four-assigned" role="tabpanel" aria-labelledby="custom-tabs-four-assigned-tab">
      <table id="example4" class="table table-bordered table-hover">
         <thead>
            <tr>
               <th>Id</th>
               <th>Customer Name</th>
               <th>College Name</th>
               <th>DepartMent</th>
               <th>Degree</th>
               <th>Percentage</th>
               <th>Percentage Status</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
           @foreach($manageassigned as $key=>$manageassign)
           <tr id="arrayorder_<?php echo $manageassign->id?>">
            <td>{{ $key + 1 }}</td>
            <td>{{ $manageassign->customer_name }}</td>
            <td>{{ $manageassign->name_of_college }}</td>
            <td>{{ $manageassign->name_of_department }}</td>
            <td>{{ $manageassign->name_of_degree }}</td>
            @if($manageassign->percentage == "")
            <td>---</td>
            @else
            <td>{{ $manageassign->percentage }}%</td>
            @endif
            <td class="text-center">
             @if($manageassign->percentage == "")
             <button class="btn btn-primary disabled" ><i class="fa fa-eye"></i></button>
             @else
             <a href="" class="btn btn-primary"  data-toggle="modal" data-target="#progresscheck{{ $manageassign->id }}"><i class="fa fa-eye"></i></a>
             @endif
             <div class="modal fade" id="progresscheck{{ $manageassign->id }}">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title">Progress</h4>
                        <button type="button" class="close" data-dismiss="modal" 
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <table id="example4" class="table table-bordered table-hover">
                        <tr>
                           <th>Percentage</th>
                           <th >Comments</th>
                           <th>Completed Date</th>
                        </tr>
                        @php
                        $sql = "select * from customer_progress where customer_id='$manageassign->id'";
                        $result = DB::select(DB::raw($sql));
                        foreach($result as $res){
                          $percentage = $res->percentage;
                          $percentage_comments = $res->percentage_comments;
                          $date = $res->update_time;
                          echo"<tr>
                           <td>$percentage</td>
                           <td style='width: 100%;white-space:pre;'>$percentage_comments</td>
                           <td style='width: 100%;white-space: nowrap;'>$date</td>
                        </tr>";
                     }
                     @endphp 
                  </table>
               </div>

               <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" 
                  data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
               </div>
            </div>
         </div>
      </div>
   </td>
   <td>
      <div class="margin">
       <div class="btn-group">
         <button type="button" class="btn btn-default">More</button>
         <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
           <span class="sr-only"></span>
        </button>
        <div class="dropdown-menu" role="menu">
           <a href="" class="dropdown-item"  data-toggle="modal" data-target="#edit{{ $manageassign->id }}">Edit</a>
           <a href="" class="dropdown-item"  data-toggle="modal" data-target="#unassign{{ $manageassign->id }}">Assign</a>
        </div>

     </td>

  </tr>

  <div class="modal fade" id="unassign{{ $manageassign->id }}">
   <form action="{{url('/assignstaff')}}" method="post">
      {{ csrf_field() }}
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Edit</h4>
               <button type="button" class="close" data-dismiss="modal" 
               aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <input type="hidden" class="form-control" name="id" 
            value="{{ $manageassign->id }}"/>


            <select name="staff_id" class="form-control">
               <option value="">select</option>
               @foreach($managestaffcustomer as $key=>$managestaff)

               <option value="{{ $managestaff->id }}">{{ $managestaff->full_name }}</option>
               @endforeach
            </select>
         </br>

         <textarea name="comments" class="form-control" rows="3" placeholder="Comments..." ></textarea>


      </div>
      <div class="modal-footer justify-content-between">
         <button type="button" class="btn btn-default" 
         data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary">Submit</button>
      </div>
   </div>
</div>
</form>
</div>
<div class="modal fade" id="edit{{ $manageassign->id }}">
   <form action="{{url('/edit_user')}}" method="post">
      {{ csrf_field() }}
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Edit</h4>
               <button type="button" class="close" data-dismiss="modal" 
               aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <input type="hidden" class="form-control" name="id" 
            value="{{ $manageassign->id }}"/>
            <input type="text" class="form-control mb-3" name="customer_name" 
            value="{{ $manageassign->customer_name }}" placeholder="Name"/>
            <input type="text" class="form-control mb-3" name="name_of_college" 
            value="{{ $manageassign->name_of_college }}" placeholder="College Name"/>
            <input type="text" class="form-control mb-3" name="email"
            value="{{ $manageassign->email }}" placeholder="Enter email"/>
            <input type="text" class="form-control mb-3" name="phone"
            value="{{ $manageassign->mobile_number }}" placeholder="Enter phone"/>
            <select name="gender" class="form-control">
               <option value="">Select status</option>
               <option value="Mail" <?php if($manageassign->gender == 1){ echo "selected"; }?>>Mail</option>
               <option value="Femail" <?php if($manageassign->gender == 0){ echo "selected"; }?>>Femail</option>
            </select>
         </br>
      </br>
      <select name="status" class="form-control">
         <option value="">Select status</option>
         <option value="1" <?php if($manageassign->status == 1){ echo "selected"; }?>>Active</option>
         <option value="0" <?php if($manageassign->status == 0){ echo "selected"; }?>>Inactive</option>
      </select>
   </div>
   <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-default" 
      data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Submit</button>
   </div>
</div>
</div>
</form>
</div>
@endforeach
</tbody>
</table>
</div>
<div class="tab-pane fade" id="custom-tabs-four-completed" role="tabpanel" aria-labelledby="custom-tabs-four-completed-tab">
   <table id="example5" class="table table-bordered table-hover">
      <thead>
         <tr>
          <th>Id</th>
          <th>Customer Name</th>
          <th>College Name</th>
          <th>DepartMent</th>
          <th>Degree</th>
          <th>Pass Out</th>
          <th>Status</th>
          <th>Action</th>
       </tr>
    </thead>
    <tbody>

    </tbody>
 </table>
</div>
</div>

</div>

<!-- /.card -->

@if(auth()->user()->user_types_id == 2)
@foreach($manageunassigned as $key=>$managecustomerslist)
<div class="modal fade" id="assign{{ $managecustomerslist->id }}">
   <form action="{{url('/assignstaff')}}" method="post">
      {{ csrf_field() }}
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Edit</h4>
               <button type="button" class="close" data-dismiss="modal" 
               aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <input type="hidden" class="form-control" name="id" 
            value="{{ $managecustomerslist->id }}"/>


            <select name="staff_id" class="form-control">
               <option value="">select</option>
               @foreach($managestaffcustomer as $key=>$managestaff)

               <option value="{{ $managestaff->id }}">{{ $managestaff->full_name }}</option>
               @endforeach
            </select>
         </br>

         <textarea name="comments" class="form-control" rows="3" placeholder="Comments..." ></textarea>


      </div>
      <div class="modal-footer justify-content-between">
         <button type="button" class="btn btn-default" 
         data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary">Submit</button>
      </div>
   </div>
</div>
</form>
</div>
@endforeach

@endif

<div class="modal fade" id="add_customer">
   <form action="{{url('/add_customer')}}" method="post">
      {{ csrf_field() }}
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Add Customer</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-6">
                     <input type="text" class="form-control mb-3" name="customer_name" placeholder="Customer Name"/>
                     <input type="email" class="form-control mb-3" name="email" placeholder="Email"/>
                     <select class="form-control mb-3" name="gender">
                        <option>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                     </select>
                     <input type="text" class="form-control mb-3" name="date_of_birth" placeholder="DOB"/>
                     <input type="text" class="form-control mb-3" name="name_of_instiute" placeholder="Instiute Name"/>
                     <input type="text" class="form-control mb-3" name="name_of_board_univercity" placeholder="Name Of Univercity"/>
                     <input type="text" class="form-control mb-3" name="name_of_college" placeholder="College Name "/>  
                     <input type="text" class="form-control mb-3" name="name_of_department" placeholder="Department Name"/>
                  </div>
                  <div class="col-md-6"> 

                     <input type="text" class="form-control mb-3" name="name_of_degree" placeholder="Name Of Degree"/>
                     <input type="text" class="form-control mb-3" name="year_of_passing" placeholder="Year Of Passing"/>              
                     <input type="text" class="form-control mb-3" name="mobile_number" placeholder="Enter Mobile Number"/>
                     <input type="text" class="form-control mb-3" name="percentage_of_marks" placeholder="Percentage"/>
                     <input type="text" class="form-control mb-3" name="remarks" placeholder="Remarks"/>
                     <textarea name='address' class="form-control" rows="3" placeholder="Address..." ></textarea>
                  </div>
               </div>
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Submit</button>
            </div>
         </div>
      </div>
   </form>
</div>
<!-- /.card -->
</div>
</div>
</section>
<!-- /.content -->
</div>
@else(auth()->user()->user_types_id == 3)
<div class="content-wrapper">
   <section class="content">
      <div class="card card-primary card-outline card-outline-tabs">
         <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Assigned</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-completed-tab" data-toggle="pill" href="#custom-tabs-four-completed" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Completed</a>
               </li>
               <div class="col-sm-4">
                  <center>
                     <div class="nav-link">Users List</div>
                  </center>
               </div>
               <div class="col-sm-3">
                  <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Customer Full Name">
               </div>
               <div class="col-sm-1">
                  <td>
                     <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add_customer"><i class="fa fa-plus"> </i> Add</button> -->
                  </td>
               </div>
            </ul>
         </div>

         <div class="card-body">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissable">
               <a href="#" style="color:white !important" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               <strong> {{ session('success') }} </strong>
            </div>
            @endif

            <div class="tab-content" id="custom-tabs-four-tabContent">
               <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                 <table id="example2" class="table table-bordered table-hover">
                  <thead>
                     <tr>
                        <th>Id</th>
                        <th>Customer Name</th>
                        <th>College Name</th>
                        <th>DepartMent</th>
                        <th>Degree</th>
                        <th>Pass Out</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($managecustomers as $key=>$managecustomerslist)
                     <tr id="arrayorder_<?php echo $managecustomerslist->custID?>">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $managecustomerslist->customer_name }}</td>
                        <td>{{ $managecustomerslist->name_of_college }}</td>
                        <td>{{ $managecustomerslist->name_of_department }}</td>
                        <td>{{ $managecustomerslist->name_of_degree }}</td>
                        <td>{{ $managecustomerslist->year_of_passing }}</td>
                        @if($managecustomerslist->status == 1)
                        <td>Active</td>
                        @else
                        <td>Inactive</td>
                        @endif 
                        <td>
                           <div class="margin">
                            <div class="btn-group">
                              <button type="button" class="btn btn-default">More</button>
                              <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                             </button>
                             <div class="dropdown-menu" role="menu">
                                <a href="" class="dropdown-item"  data-toggle="modal" data-target="#progress{{ $managecustomerslist->id }}">Edit</a>
                             </div>
                          </td>

                       </tr>
                       <div class="modal fade" id="progress{{ $managecustomerslist->id }}">
                        <form action="{{url('/progress')}}" method="post">
                           {{ csrf_field() }}
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h4 class="modal-title">Progress</h4>
                                    <button type="button" class="close" data-dismiss="modal" 
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <input type="hidden" class="form-control" name="id" 
                                 value="{{ $managecustomerslist->custID }}"/> 
                                 <input type="hidden" class="form-control" name="users_id" 
                                 value="{{ $managecustomerslist->id }}"/> 
                                 <input type="hidden" class="form-control" name="users_name" 
                                 value="{{ $managecustomerslist->full_name}}"/> 

                                 <select name="percentage" class="form-control">
                                    <option value="">Select completed percentage</option>
                                    @if($managecustomerslist->percentage == "")
                                    <option value="25">25%</option>
                                    <option value="50">50%</option>
                                    <option value="75">75%</option>
                                    <option value="100">100%</option>
                                    @elseif($managecustomerslist->percentage == "25")
                                    <option value="50">50%</option>
                                    <option value="75">75%</option>
                                    <option value="100">100%</option>
                                    @elseif($managecustomerslist->percentage == "50")
                                    <option value="75">75%</option>
                                    <option value="100">100%</option>
                                    @elseif($managecustomerslist->percentage == "75")
                                    <option value="100">100%</option>
                                    @endif
                                 </select>
                                 <br>

                                 <textarea  name='percentage_comments' class="form-control" rows="3" placeholder="Comments..." ></textarea>
                              </div>
                              <div class="modal-footer justify-content-between">
                                 <button type="button" class="btn btn-default" 
                                 data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Submit</button>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
                  @endforeach
               </tbody>
            </table>
         </div>

         <div class="tab-pane fade" id="custom-tabs-four-completed" role="tabpanel" aria-labelledby="custom-tabs-four-completed-tab">
            <table id="example5" class="table table-bordered table-hover">
               <thead>
                  <tr>
                   <th>Id</th>
                   <th>Customer Name</th>
                   <th>College Name</th>
                   <th>DepartMent</th>
                   <th>Degree</th>
                   <th>Pass Out</th>
                   <th>Status</th>
                   <th>Action</th>
                </tr>
             </thead>
             <tbody>

             </tbody>
          </table>
       </div>
    </div>

 </div>

 <!-- /.card -->


 <!-- /.card -->
</div>
</div>
</section>
<!-- /.content -->
</div>
@endif
@endsection
@extends('layout')
@section('content')
<div class="content-wrapper">
<section class="content">
<div class="card card-primary card-outline card-outline-tabs">
<div class="card-header p-0 border-bottom-0">
<ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
    @if(auth()->user()->user_types_id == 2)
<li class="nav-item">
<a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Staff</a>
</li>
@endif
 @if(auth()->user()->user_types_id == 1)
 <li class="nav-item">
<a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">All Users</a>
</li>
<li class="nav-item">
<a class="nav-link" id="custom-tabs-four-admin-tab" data-toggle="pill" href="#custom-tabs-four-admin" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Admin</a>
</li>
<li class="nav-item">
<a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Staff</a>
</li>
@endif

<div class="col-sm-5">
<center>
   <div class="nav-link">Users List</div>
</center>
</div>
<div class="col-sm-3">
<input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Customer Full Name">
</div>
<div class="col-sm-1">
<td>
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#adduser"><i class="fa fa-plus"> </i> Add</button>
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
                <th>#ID</th>
                <th>User Type</th>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($manageusers as $key=>$manageuserslist)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $manageuserslist->user_types_name }}</td>
                <td>{{ $manageuserslist->full_name }}</a></td>
                <td>{{ $manageuserslist->gender }}</td>
                <td>{{ $manageuserslist->email }}</td>
                <td>{{ $manageuserslist->mobile_number }}</td>
                @if($manageuserslist->status == 1)
                <td>Active</td>
                @else
                <td>Inactive</td>
                @endif
                <td>
                  @if($manageuserslist->user_types_id != 1)
                  <div class="margin">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default">More</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a href="" class="dropdown-item"  data-toggle="modal" data-target="#edit{{ $manageuserslist->userID }}">Edit</a>
                            <a href="{{url('/users/attendance/'.$manageuserslist->userID)}}" class="dropdown-item" > Attendance</a>
                        </div>
                        @endif
                    </td>
                    <div class="modal fade" id="edit{{ $manageuserslist->userID }}">
                        <form action="{{url('/edit_user')}}" method="post">
                            {{ csrf_field() }}
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit User</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    
                                    <div class="modal-body">
                                      <div class="row">
                                       <div class="col-md-6">   
                                          <input type="hidden" class="form-control" name="id" value="{{ $manageuserslist->userID }}"/>

                                          <input value="{{ $manageuserslist->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                          <input value="{{ $manageuserslist->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($manageuserslist->gender == 'Male'){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($manageuserslist->gender == 'Female'){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2" <?php if($manageuserslist->user_types_id == 2){ echo "selected"; }?>>Admin</option>
                                 <option value="3" <?php if($manageuserslist->user_types_id == 3){ echo "selected"; }?>>Staff</option>
                                 @else
                                 <option value="3" <?php if($manageuserslist->user_types_id == 3){ echo "selected"; }?>>Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $manageuserslist->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $manageuserslist->mobile_number }}" type="text" class="form-control mb-3" name="mobile_number" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($manageuserslist->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($manageuserslist->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $manageuserslist->address }}</textarea>
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
</tr>


@endforeach

</tbody>
</table>
                              </div>
                              <div class="tab-pane fade" id="custom-tabs-four-admin" role="tabpanel" aria-labelledby="custom-tabs-four-admin-tab">
                              
                                 <table id="example2" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#ID</th>
                <th>User Type</th>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($manageadmins as $key=>$manageadmin)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $manageadmin->user_types_name }}</td>
                <td>{{ $manageadmin->full_name }}</a></td>
                <td>{{ $manageadmin->gender }}</td>
                <td>{{ $manageadmin->email }}</td>
                <td>{{ $manageadmin->mobile_number }}</td>
                @if($manageadmin->status == 1)
                <td>Active</td>
                @else
                <td>Inactive</td>
                @endif
                <td>
                  @if($manageadmin->user_types_id != 1)
                  <div class="margin">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default">More</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a href="" class="dropdown-item"  data-toggle="modal" data-target="#edits{{ $manageadmin->userID }}">Edit</a>
                            <a href="{{url('/users/attendance/'.$manageadmin->userID)}}" class="dropdown-item" > Attendance</a>
                        </div>
                        @endif
                    </td>
                    <div class="modal fade" id="edits{{ $manageadmin->userID }}">
                        <form action="{{url('/edit_user')}}" method="post">
                            {{ csrf_field() }}
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit User</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    
                                    <div class="modal-body">
                                      <div class="row">
                                       <div class="col-md-6">   
                                          <input type="hidden" class="form-control" name="id" value="{{ $manageadmin->userID }}"/>

                                          <input value="{{ $manageadmin->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                          <input value="{{ $manageadmin->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($manageadmin->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($manageadmin->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2" <?php if($manageadmin->user_types_id == 1){ echo "selected"; }?>>Admin</option>
                                 <option value="3" <?php if($manageadmin->user_types_id == 2){ echo "selected"; }?>>Staff</option>
                                 @else
                                 <option value="3" <?php if($manageadmin->user_types_id == 3){ echo "selected"; }?>>Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $manageadmin->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $manageadmin->mobile_number }}" type="text" class="form-control mb-3" name="mobile_number" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($manageadmin->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($manageadmin->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $manageadmin->address }}</textarea>
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
    </div>
    </div>
</tr>


@endforeach

</tbody>
</table>
                              </div>
                         
						 <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                 <table id="example2" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#ID</th>
                <th>User Type</th>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($managestaffs as $key=>$managestaff)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $managestaff->user_types_name }}</td>
                <td>{{ $managestaff->full_name }}</a></td>
                <td>{{ $managestaff->gender }}</td>
                <td>{{ $managestaff->email }}</td>
                <td>{{ $managestaff->mobile_number }}</td>
                @if($managestaff->status == 1)
                <td>Active</td>
                @else
                <td>Inactive</td>
                @endif
                <td>
                  @if($managestaff->user_types_id != 1)
                  <div class="margin">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default">More</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a href="" class="dropdown-item"  data-toggle="modal" data-target="#edit{{ $managestaff->userID }}">Edit</a>
                            <a href="{{url('/users/attendance/'.$managestaff->userID)}}" class="dropdown-item" > Attendance</a>
                        </div>
                        @endif
                    </td>
                    <div class="modal fade" id="edit{{ $managestaff->userID }}">
                        <form action="{{url('/edit_user')}}" method="post">
                            {{ csrf_field() }}
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit User</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    
                                    <div class="modal-body">
                                      <div class="row">
                                       <div class="col-md-6">   
                                          <input type="hidden" class="form-control" name="id" value="{{ $managestaff->userID }}"/>

                                          <input value="{{ $managestaff->first_name }}" type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                                          <input value="{{ $managestaff->email }}"type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                                          <div class="form-group">
                                              <select name="gender" class="form-control">
                                                <option value="Male" <?php if($managestaff->gender == 1){ echo "selected"; }?>>Male</option>
                                                <option value="Female" <?php if($managestaff->gender == 0){ echo "selected"; }?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                         <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>
                                   </div>
                               </div>
                               <div class="col-md-6">   
                                  <input value="{{ $managestaff->last_name }}" type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                                  <input value="{{ $managestaff->mobile_number }}" type="text" class="form-control mb-3" name="mobile_number" placeholder="Enter Mobile Number"/>
                                  <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if($managestaff->status == 1){ echo "selected"; }?>>Active</option>
                                        <option value="0" <?php if($managestaff->status == 0){ echo "selected"; }?>>Inactive</option>
                                    </select>
                                </div>
                                <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." >{{ $managestaff->address }}</textarea>
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
</tr>


@endforeach

</tbody>
</table>
                              </div>
                           </div>
                        </div>
                        <!-- /.card -->
                     </div>
                  </div>
               </section>
               </div>
<div class="modal fade" id="adduser">
    <form action="{{url('/add_user')}}" method="post">
        {{ csrf_field() }}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">   
                          <input type="text" class="form-control mb-3" name="first_name" placeholder="Enter First Name"/>

                          <input onkeyup="duplicateEmail(0)" id="email" type="email" class="form-control mb-3" name="email" placeholder="Enter Email"/>
                          <span id="dupemail" style="color:red;font-size: 12px;"></span>

                          <input type="password" class="form-control mb-3" name="password" placeholder="Enter Password"/>

                          <div class="form-group">
                              <select name="user_types_id" class="form-control">
                                 <option>Select User type</option>
                                 @if(auth()->user()->user_types_id == 1)
                                 <option value="2">Admin</option>
                                 <option value="3">Staff</option>
                                 @else
                                 <option value="3">Staff</option>
                                 @endif
                             </select>

                         </div>
                         <select class="form-control mb-3" name="gender">
                            <option>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-6">   
                      <input type="text" class="form-control mb-3" name="last_name" placeholder="Enter Last Name"/>

                      <input type="text" class="form-control mb-3" name="mobile_number" placeholder="Enter Mobile Number"/>

                      <input type="text" class="form-control mb-3" name="check_password" placeholder="Enter Conform Password"/>
                      <textarea name='address' class="form-control" rows="3" placeholder="Enter Address..." ></textarea>
                  </div>      
              </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button id="save" type="submit" class="btn btn-primary">Submit</button>
        </div>
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
   @endsection

@extends('layout')
@section('content')
<style>
.row-padded {
        padding: 1px;
        margin: 4px;
        border: 1px solid #DDD;
        height: 25px;
    }

    .row-color {
        background-color: greenyellow;
        padding: 1px;
        margin: 4px;
        border: 1px solid #DDD;
        height: 25px;
    }
</style>

<div class="content-wrapper">
   <section class="content">
    <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
				
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">All Users</a>
                  </li>
				  
					<div class="col-sm-6">
                   <center> <div class="nav-link">User Permission List</div></center>
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Customer Full Name">
					</div>
					<div class="col-sm-1">
						<td>
          <button type="button" class="btn btn-block btn-outline-danger btn-xs" data-toggle="modal" data-target="#userrole"><i class="fa fa-plus"> </i> Add</button>

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
					<th>UserId</th>
					<th>User Type</th>
					<th>Full Name</th>
					<th>Gender</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Status</th>
					<th>Actions</th>
</tr>
</thead>
<tbody>
 @foreach($manageusers as $key=>$manageuserslist)
                      <tr id="arrayorder_<?php echo $manageuserslist->id?>">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $manageuserslist->user_types_name }}</td>
                         <td><a href="" data-toggle="modal" data-target="#edit{{ $manageuserslist->userID }}" >{{ $manageuserslist->full_name }}</a></td>
                        <td>{{ $manageuserslist->gender }}</td>
                        <td>{{ $manageuserslist->email }}</td>
                        <td>{{ $manageuserslist->mobile_number}}</td>
                        @if($manageuserslist->status == 1)
                            <td>Active</td>
                        @else
                            <td>Inactive</td>
                        @endif     
						 <td>
						 	                           <div class="btn-group dropdown">
						 	                 <button type="button" class="btn btn-default btn-outline-danger btn-xs fa fa-eye" data-toggle="modal" data-target="#permissions{{ $manageuserslist->user_id }}">
</button>    	
                                <button type="button" class="btn btn-default btn-outline-danger btn-xs" data-toggle="modal" data-target="#permissions{{ $manageuserslist->user_id }}">Permission</button>

</div>
                           
                        </td>
<div class="modal fade" id="permissions{{ $manageuserslist->user_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
   <form action="{{url('/addroles')}}" method="post">
      {{ csrf_field() }}
	  
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Add Permission</h5>
		
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span></button>
            </div>
			   <div class="modal-body">
   <input type="hidden" class="form-control" name="user_id" value="{{ $manageuserslist->user_id }}"/>

         <div class="card card-success ">
            <div class="card-body ">

             <div class="row row-color">
            		<label class="col-sm-4">Dashboard</label>
            	</div>

            	<div class="row row-padded">
            		<label for="dashboard" class="col-sm-2">1</label>
            		<label for="dashboard" class="col-sm-8">Dashboard</label>
            		<div class="icheck-success d-inline">
            			@if($manageuserslist->dashboard == 1)
            			<label class="col-sm-1"><input value="1" type="checkbox" name="dashboard" id="dashboard" checked></label>
            			@else
            			<label class="col-sm-1"><input value="1" type="checkbox" name="dashboard" id="dashboard"></label>
            			@endif
            		</div> 
            	</div>
               
               <div class="row row-color">
            		<label class="col-sm-4">Roles</label>
            	</div>

            	<div class="row row-padded">
            		<label for="roles" class="col-sm-2">2</label>
            		<label for="roles" class="col-sm-8">Roles</label>
            		<div class="icheck-success d-inline">
            			@if($manageuserslist->roles == 1)
            			<label class="col-sm-1"><input value="1" type="checkbox" name="roles" id="roles" checked></label>
            			@else
            			<label class="col-sm-1"><input value="1" type="checkbox" name="roles" id="roles"></label>
            			@endif
            		</div> 
            	</div>
            </div>
         </div>
      </div>
	<div class="modal-footer justify-content-between">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary">Submit</button>
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
         </div>
     </section>
</div>
@endsection
<div class="modal fade" id="userrole">
<form action="{{url('/roles')}}" method="post">
{{ csrf_field() }}
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Add User Role</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
            <div class="modal-body">
        	    <div class="row">
			    <div class="col-md-6">   
                  <input type="text" class="form-control mb-3" name="user_types_name" placeholder="User Role Name"/>
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
<script src="{!! asset('plugins/jquery/jquery.min.js') !!}"></script>
<script src="{!! asset('dist/js/pages/dashboard2.js') !!}"></script>
<script>
$(".scroll-modal-top").click(function() {
    $("#modalId").scrollTop(0);
});

$(".scroll-page-top").click(function() {
    $("html,body").scrollTop($("#modalId").offset().top);
});
</script>
<script>
function myFunction() {
  const input = document.getElementById("myInput");
  const inputStr = input.value.toUpperCase();
  document.querySelectorAll('#example2 tr:not(.header)').forEach((tr) => {
    const anyMatch = [...tr.children]
      .some(td => td.textContent.toUpperCase().includes(inputStr));
    if (anyMatch) tr.style.removeProperty('display');
    else tr.style.display = 'none';
  });
}
</script>

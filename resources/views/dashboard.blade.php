@extends('layout')
@section('content')
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   @if(auth()->user()->user_types_id == 1  ||  auth()->user()->user_types_id == 2)
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-3 col-6">
               <div class="small-box bg-info">
                  <div class="inner">

                     @if(auth()->user()->user_types_id == 1)
                     <h3>{{ $new }}</h3>
                     @elseif(auth()->user()->user_types_id == 2)
                     <h3>{{ $admin_unassign }}</h3>
                     @endif

                     @if(auth()->user()->user_types_id == 1)
                     <p>New Customer</p>
                     @elseif(auth()->user()->user_types_id == 2)
                     <p>New Customer</p>
                     @endif

                  </div>
                  <div class="icon">
                     <i class="ion ion-bag"></i>
                  </div>
                  <a href="{{ url('/customer') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <div class="col-lg-3 col-6">
               <div class="small-box bg-success">
                  <div class="inner">

                     @if(auth()->user()->user_types_id == 1)
                     <h3>{{ $assigned }}</h3>
                     @elseif(auth()->user()->user_types_id == 2)
                     <h3>{{ $admin_assign }}</h3>
                     @endif

                     @if(auth()->user()->user_types_id == 1)
                     <p>Assigned Customer</p>
                     @elseif(auth()->user()->user_types_id == 2)
                     <p>Assigned Customer</p>
                     @endif
                     
                  </div>
                  <div class="icon">
                     <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="{{ url('/customer') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <div class="col-lg-3 col-6">
               <div class="small-box bg-warning">
                  <div class="inner">

                     @if(auth()->user()->user_types_id == 1)
                     <h3>{{ $completed }}</h3>
                     @elseif(auth()->user()->user_types_id == 2)
                     <h3>{{ $admin_comp }}</h3>
                     @endif

                     @if(auth()->user()->user_types_id == 1)
                     <p>Completed Customer</p>
                     @elseif(auth()->user()->user_types_id == 2)
                     <p>Completed Customer</p>
                     @endif

                  </div>
                  <div class="icon">
                     <i class="ion ion-person-add"></i>
                  </div>
                  <a href="{{ url('/customer') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <div class="col-lg-3 col-6">
               <div class="small-box bg-danger">
                  <div class="inner">

                     @if(auth()->user()->user_types_id == 1)
                     <h3>{{ $total }}</h3>
                     @elseif(auth()->user()->user_types_id == 2)
                     <h3>{{ $staff }}</h3>
                     @endif

                     @if(auth()->user()->user_types_id == 1)
                     <p>Admin</p>
                     @elseif(auth()->user()->user_types_id == 2)
                     <p>Staff</p>
                     @endif

                  </div>
                  <div class="icon">
                     <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="{{ url('/users') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
         </div>
      </div>
   </section>

@elseif(auth()->user()->user_types_id == 3)

 <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-6 col-6">
               <div class="small-box bg-info">
                  <div class="inner">
                     <h3>{{ $staff_assign }}</h3>
                     <p>Assigned Customer</p>
                  </div>
                  <div class="icon">
                     <i class="ion ion-bag"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <div class="col-lg-6 col-6">
               <div class="small-box bg-success">
                  <div class="inner">
                     <h3>{{ $staff_comp }}</h3>
                     <p>Completed Customer</p>
                  </div>
                  <div class="icon">
                     <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
         </div>
      </div>
   </section>

@endif


</div>
@endsection
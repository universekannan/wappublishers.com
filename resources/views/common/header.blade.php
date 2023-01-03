<?php
   $permission = DB::table('user_permission')->where('user_id',auth()->user()->id)->first();
   ?>
<ul class="navbar-nav">
   <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
   </li>
   <li class="nav-item d-none d-sm-inline-block">
      <a href="http://wappublishers.com/" class="nav-link">Home</a>
   </li>
   <li class="nav-item d-none d-sm-inline-block">
      <a href="tel:+919445511401" class="nav-link">Support :  +91 9445511401 {24/7}</a>
   </li>
</ul>
<ul class="navbar-nav ml-auto">
   <li class="nav-item">
      <div class="navbar-search-block">
         <form class="form-inline">
            <div class="input-group input-group-sm">
               <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
               <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                  </button>
               </div>
            </div>
         </form>
      </div>
   </li>
   <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-bell"></i>
      <span class="badge badge-warning navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         <span class="dropdown-item dropdown-header">15 Notifications</span>
         <div class="dropdown-divider"></div>
         <a href="#" class="dropdown-item">
         <i class="fas fa-envelope mr-2"></i> 4 new messages
         <span class="float-right text-muted text-sm">3 mins</span>
         </a>
         <div class="dropdown-divider"></div>
         <a href="#" class="dropdown-item">
         <i class="fas fa-users mr-2"></i> 8 friend requests
         <span class="float-right text-muted text-sm">12 hours</span>
         </a>
         <div class="dropdown-divider"></div>
         <a href="#" class="dropdown-item">
         <i class="fas fa-file mr-2"></i> 3 new reports
         <span class="float-right text-muted text-sm">2 days</span>
         </a>
         <div class="dropdown-divider"></div>
         <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
   </li>
   <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-user"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <span class="dropdown-item dropdown-header">
      <img src="{!! asset('upload/users')!!}/{{auth()->user()->profile_photo}}" class="img-circle elevation-2 " style="width: 25%; height: auto;">
      </span>
      <span class="dropdown-item dropdown-header">{{auth()->user()->full_name}}</span>
      <div class="dropdown-divider"></div>
      <div class="dropdown-item">
         <a class="btn btn-default  text-muted text-sm" href="users/profile">Profile</a>
         <a class="btn btn-default float-right text-muted text-sm" href="{{url('/logout')}}">Logout</a>
         <div class="dropdown-divider"></div>
         <a href="#" class="dropdown-item dropdown-footer">
		 @if(auth()->user()->user_types_id == 1)
		    SuperAdmin
	     @elseif(auth()->user()->user_types_id == 2)
            Admin
	     @elseif(auth()->user()->user_types_id == 3)
		    Staff
	     @endif

	 </a>
      </div>
   </li>
   <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
      <i class="fas fa-expand-arrows-alt"></i>
      </a>
   </li>
</ul>
</nav>

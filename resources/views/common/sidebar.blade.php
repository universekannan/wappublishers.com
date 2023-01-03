<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <a href="" class="brand-link">
   <img src="{!! asset('dist/img/logo.png') !!}" alt="WAP Publishers Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
   <span class="brand-text font-weight-light">WAP Publishers</span>
   </a>
   <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <div class="image">
            <img src="{!! asset('upload/users')!!}/{{auth()->user()->profile_photo}}" class="img-circle elevation-2" alt="User Image">
         </div>
         <div class="info">
            <a href="#" class="d-block">{{auth()->user()->full_name}}</a>
         </div>
      </div>
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
            <a href="{{url('/dashboard')}}" class="nav-link {{ Request::is('users') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
               </a>
            </li>
            <li class="nav-item menu-open">
            <a href="{{url('/customer')}}" class="nav-link {{ Request::is('customer') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-project-diagram"></i>
                  <p>
                     Customers
                  </p>
               </a>
            </li>
            <li class="nav-item menu-open">
            <a href="{{url('/users')}}" class="nav-link {{ Request::is('users') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                     Users
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>
                     Setting
                     <i class="right fas fa-angle-left"></i>
                  </p>
               </a>
               <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                           User Tlpe
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="#" class="nav-link">
                              <i class="far fa-dot-circle nav-icon"></i>
                              <p>Add User Type</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#" class="nav-link">
                              <i class="far fa-dot-circle nav-icon"></i>
                              <p>View User Type</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#" class="nav-link">
                              <i class="far fa-dot-circle nav-icon"></i>
                              <p>Level 3</p>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item">
            <a href="{{url('/users/permissions')}}" class="nav-link {{ Request::is('users') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ppermissions</p>
                     </a>
                  </li>
               </ul>
            </li>
         </ul>
      </nav>
   </div>
</aside>
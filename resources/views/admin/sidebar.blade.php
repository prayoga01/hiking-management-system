 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/home">
         {{-- <div class="sidebar-brand-icon rotate-n-15">
     <i class="fas fa-laugh-wink"></i>
   </div> --}}
         <div class="sidebar-brand-text mx-3">HIKING <sup>MANAGEMENT SYSTEM</sup></div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0" />

     <!-- Nav Item - Dashboard -->
     <li class="nav-item active">
         <a class="nav-link" href="/admin/home">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Dashboard</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider" />

     <!-- Heading -->
     <div class="sidebar-heading">Mountains</div>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
             aria-expanded="true" aria-controls="collapseTwo">
             <i class="fas fa-mountain fa-2x text-gray-300"></i>
             <span>Mountains Manage</span>
         </a>
         <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Mountain Manage :</h6>
                 <a class="collapse-item" href="/addmountains">Mountain List</a>
                 <a class="collapse-item" href="/mountainables">Mountain List Able</a>
             </div>
         </div>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="/climbers">
             <i class="fas fa-hiking"></i>
             <span>Climbers</span></a>
     </li>

     <!-- Nav Item - Utilities Collapse Menu -->
     @if (auth()->user()->is_admin == 1)
         <li class="nav-item">
             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                 aria-expanded="true" aria-controls="collapseUtilities">
                 <i class="fa-solid fa-users"></i>
                 <span>Manage User</span>
             </a>
             <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                     <a class="collapse-item" href="/users">User</a>
                     <a class="collapse-item" href="utilities-border.html">Officer</a>
                 </div>
             </div>
         </li>
     @endif


     <!-- Divider -->
     <hr class="sidebar-divider" />

     <!-- Heading -->
     <div class="sidebar-heading">Addons</div>

     <!-- Nav Item - Pages Collapse Menu -->
     {{-- <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
             aria-expanded="true" aria-controls="collapsePages">
             <i class="fas fa-fw fa-folder"></i>
             <span>Pages</span>
         </a>
         <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Login Screens:</h6>
                 <a class="collapse-item" href="login.html">Login</a>
                 <a class="collapse-item" href="register.html">Register</a>
                 <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                 <div class="collapse-divider"></div>
                 <h6 class="collapse-header">Other Pages:</h6>
                 <a class="collapse-item" href="404.html">404 Page</a>
                 <a class="collapse-item" href="blank.html">Blank Page</a>
             </div>
         </div>
     </li> --}}

     <!-- Nav Item - Charts -->

     <li class="nav-item">
         <a class="nav-link" href="/regulations">
             <i class="fas fa-newspaper"></i>
             <span>News & Regulation</span></a>
     </li>

     <!-- Nav Item - Tables -->
     <li class="nav-item">
         <a class="nav-link" href="/payments">

             <i class="fas fa-file-invoice-dollar"></i>
             <span>Table Payment</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block" />

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

     <!-- Sidebar Message -->

 </ul>
 <!-- End of Sidebar -->

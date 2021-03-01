   <!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

       <!-- Sidebar - Brand -->
       <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
           <div class="sidebar-brand-icon rotate-n-15">
               <i class="fas fa-laugh-wink"></i>
           </div>
           <div class="sidebar-brand-text mx-3">DEEPBLUE</div>
       </a>

       <!-- Divider -->
       <hr class="sidebar-divider my-0">

       <!-- Nav Item - Dashboard -->
       <li class="nav-item active">
           <a class="nav-link" href="user_index.php">
               <i class="fas fa-fw fa-tachometer-alt"></i>
               <span>My Dashboard</span></a>
       </li>

       <!-- Divider -->
       <hr class="sidebar-divider">

       <!-- Heading -->
       <div class="sidebar-heading">
           PERSONAL MANAGEMENT
       </div>

       <!-- Nav Item -  Collapse Menu -->
       <li class="nav-item">
           <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
               <i class="fas fa-fw fa-folder"></i>
               <span>Registration</span>
           </a>
           <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
               <div class="bg-white py-2 collapse-inner rounded">

                   <a class="collapse-item" href="visitor_register.php">Visitor</a>

                   <div class="collapse-divider"></div>

               </div>
           </div>
       </li>

       <!-- Divider -->
       <hr class="sidebar-divider">

       <!-- Heading -->
       <div class="sidebar-heading">
           Information
       </div>


       -->




       <li class="nav-item">
           <a class="nav-link" href="visitor_user.php">
               <i class="fas fa-fw fa-chart-area"></i>
               <span>My Profile</span> <input type="hidden"></a>
       </li>
       <li class="nav-item">
           <a class="nav-link" href="visitor_profile.php">
               <i class="fas fa-fw fa-chart-area"></i>
               <span>Visitor Profile</span> <input type="hidden"></a>
       </li>




       -->









       <!-- Divider -->
       <hr class="sidebar-divider d-none d-md-block">

       <!-- Sidebar Toggler (Sidebar) -->
       <div class="text-center d-none d-md-inline">
           <button class="rounded-circle border-0" id="sidebarToggle"></button>
       </div>

   </ul>
   <!-- End of Sidebar -->

   <!-- Content Wrapper -->
   <div id="content-wrapper" class="d-flex flex-column">

       <!-- Main Content -->
       <div id="content">

           <!-- Topbar -->
           <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

               <!-- Sidebar Toggle (Topbar) -->
               <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                   <i class="fa fa-bars"></i>
               </button>

               <!-- Topbar Search -->



               <!-- Topbar Navbar -->
               <ul class="navbar-nav ml-auto">

                   <!-- Nav Item - Search Dropdown (Visible Only XS) -->


                   <!-- Nav Item - Alerts -->


                   <!-- Nav Item - Messages -->


                   <div class="topbar-divider d-none d-sm-block"></div>

                   <!-- Nav Item - User Information -->
                   <li class="nav-item dropdown no-arrow">
                       <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <span class="mr-2 d-none d-lg-inline text-gray-600 small">

                               <?php echo $_SESSION['username']; ?>

                           </span>
                           <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                       </a>
                       <!-- Dropdown - User Information -->
                       <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                           <a class="dropdown-item" href="visitor_user.php">
                               <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                               Profile
                           </a>

                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                               <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                               Logout
                           </a>
                       </div>
                   </li>

               </ul>

           </nav>
           <!-- End of Topbar -->


           <!-- Scroll to Top Button-->
           <a class="scroll-to-top rounded" href="#page-top">
               <i class="fas fa-angle-up"></i>
           </a>


           <!-- Logout Modal-->
           <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                           <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">×</span>
                           </button>
                       </div>
                       <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                       <div class="modal-footer">
                           <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                           <form action="logout_action.php" method="POST">

                               <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>

                           </form>


                       </div>
                   </div>
               </div>
           </div>
   <?php
    $query = "SELECT * FROM dailyvisit WHERE row_id=(SELECT max(row_id) FROM dailyvisit)";
    $query_run = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($query_run);
    // echo $row['id'];

    $sql =
        "SELECT * from `dailyvisit` where `status` = 'unread' order by `date` DESC";
    $result1 = $connection->query($sql);


    // $result1->num_rows;
    ?>

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
       <!-- <hr class="sidebar-divider my-0"> -->

       <!-- Nav Item - Dashboard -->
       <li class="nav-item active">
           <a class="nav-link" href="security_page.php">
               <i class="fas fa-fw fa-tachometer-alt"></i>
               <span>Security Dashboard</span></a>
       </li>

       <!-- Divider -->
       <hr class="sidebar-divider">

       <!-- Heading -->
       <div class="sidebar-heading">
           PERSONAL MANAGEMENT
       </div>



       <!-- Divider -->
       <!-- <hr class="sidebar-divider"> -->


       <li class="nav-item">
           <a class="nav-link" href="security_profile.php">
               <i class="fas fa-fw fa-chart-area"></i>
               <span>My Profile</span> <input type="hidden"></a>
       </li>
       <li class="nav-item">
           <a class="nav-link" href="visitor_auth.php">
               <i class="fas fa-fw fa-chart-area"></i>
               <span>Visitor Entry Report</span> <input type="hidden"></a>
       </li>















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




               <!-- Topbar Navbar -->
               <ul class="navbar-nav ml-auto">


                   <li class="nav-item dropdown no-arrow d-sm-none">
                       <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fas fa-search fa-fw"></i>
                       </a>

                   </li>

                   <!-- Nav Item - Alerts -->
                   <li class="nav-item dropdown no-arrow mx-1">
                       <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fas fa-bell fa-fw" aria-hidden="true"></i>
                           <!-- Counter - Alerts -->
                           <span class="badge badge-danger badge-counter" id="noti_number"></span>
                       </a>

                       <script type="text/javascript">
                           // function myRemove() {
                           //   var element = document.getElementById("noti_number").innerHTML;
                           //   //console.log(this.responseText);
                           //   // element.classList.remove("container");
                           // }
                           // let number = 0;

                           function loadDoc() {


                               setInterval(function() {

                                   var xhttp = new XMLHttpRequest();
                                   xhttp.onload = function() {
                                       if (this.readyState == 4 && this.status == 200) {
                                           document.getElementById("noti_number").innerHTML = this.responseText;
                                           console.log(this.responseText);
                                           if(this.responseText==0){
                                                document.getElementById("myDiv").style.display = "none";

                                          }
                                          if(this.responseText==1){
                                                document.getElementById("myDiv").style.display = "block";

                                          }

                                           
                                           // console.log(noti_number);

                                       }
                                   };
                                   xhttp.open("GET", "view.php", false);
                                   xhttp.send();

                               }, 1000);


                           }
                           loadDoc();
                       </script>
                       <script>
                           function myFunction() {


                               var xhttp = new XMLHttpRequest();
                               xhttp.onload = function() {
                                   if (this.readyState == 4 && this.status == 200) {
                                       document.getElementById("noti_number").innerHTML = this.responseText;
                                    //    console.log(this.responseText);
                                    //    if(this.responseText==0){
                                    //             document.getElementById("myDiv").style.display = "none";

                                    //        }
                                           



                                   }
                               };
                               xhttp.open("POST", "view.php", false);
                               xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                               xhttp.send("fname=false");
                               xhttp.prop()

                           }
                           loadDoc();
                       </script>

                       <!-- Dropdown - Alerts -->
                       <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                           <h6 class="dropdown-header">
                               Alerts Center
                           </h6>
                           <a class="dropdown-item d-flex align-items-center" href="#">
                               <div class="mr-3">
                                   <div class="icon-circle bg-primary">
                                       <i class="fas fa-file-alt text-white"></i>
                                   </div>
                               </div>
                               <div>
                                   <div class="small text-gray-500" id="dropdown-date">

                                       <?php
                                        date_default_timezone_set("Asia/calcutta");
                                        // date_default_timezone_set('Europe/London');
                                        echo  date("d-m-Y");
                                        ?>

                                   </div>




                                   <span class="font-weight-bold" id="dropdown-data">


                                   </span>
                                   <script type="text/javascript">
                                       function loadData() {


                                           setInterval(function() {

                                               var xhttp = new XMLHttpRequest();
                                               xhttp.onload = function() {
                                                   if (this.readyState == 4 && this.status == 200) {
                                                       document.getElementById("dropdown-data").innerHTML = this.responseText;
                                                       console.log(this.responseText);
                                                        if(this.responseText == "No New Visitor yet"){
                                                                    document.getElementById("myDiv").style.display = "none";

                                                            }
                                                            
                                           
                                                   }
                                               };
                                               xhttp.open("GET", "info.php", false);
                                               xhttp.send();


                                           }, 1000);

                                       }
                                       loadData();
                                   </script>

                               </div>
                           </a>



                           <div id="myDiv" class="container" >



                               <div class="row">



                                   <form action="record.php" method="POST">
                                       <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                                       <button type="submit" name="edit_data_btn" onclick="myFunction();" class=" btn btn-success col-lg ">Accept</button>
                                   </form>


                                   <form action="visitor_record.php" method="POST">
                                       <input type="hidden" name="decline_id" value="<?php echo $row['id'] ?>">
                                       <button type="submit" onclick="myConfirm('Are you sure that you want to delete this comment?');myFunction();" name="decline_btn" class="btn btn-danger col-lg " role="button" aria-pressed="true">Decline</button>
                                   </form>

                               </div>

                           </div>
                       </div>
                   </li>

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
                           <a class="dropdown-item" href="security_profile.php">
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


           <script>

           function hiding(){
            document.getElementById("myDiv").style.display = "none";

           } 
           


           </script>
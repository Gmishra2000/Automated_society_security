<!--  -->
<?php
$query = "SELECT * FROM dailyvisit WHERE row_id=(SELECT max(row_id) FROM dailyvisit)";
$query_run = mysqli_query($connection, $query);
$row1 = mysqli_fetch_assoc($query_run);
setcookie('lid',$row1['id']);

// "SELECT dailyvisit.id,Name,temp from visitor,dailyvisit where dailyvisit.id=visitor.id and status = 'unread'";

// $query1 = "SELECT dailyvisit.id,Name,temp from dailyvisit,visitor where status = 'unread' and dailyvisit.id=visitor.id";
// $query1_run = mysqli_query($connection, $query1);
// $row = mysqli_fetch_assoc($query1_run);
// // echo var_dump($row);

// $s="";
// $v="";
// if ($row == NULL){
//   $s="no new data";
//   $v="no new data";
// }
// else{
//   // $row['Name']= (int)$row['Name'];
//   $row['Name']=$row['Name'];
//   $row['temp']=(int)$row['temp'];
//   // echo var_dump($row);
//   if ($row['id'] == 111 && $row['temp'] >= 98) {
//    $s="Visitor is not Registered ";
//     $v= "Temperature is high ";
//   } elseif ($row['id'] == 111 && $row['temp'] < 98) {
//     $s= "Visitor is not Registered ";
  
//     $v= "Temperature is normal";
//   } elseif ($row['temp'] >= 98) {
//     $s= "Registered Visitor " . $row['Name'] . " Arrived <br/>";
//     $v= "Visitor with High temperature";
//   } elseif ($row['temp'] < 98) {
//     $s= "Registered Visitor " . $row['Name'] . " Arrived <br/>";
//     $v= "Visitor with Normal temperature";
//   }
// }


// setcookie('vis',$s,);
// setcookie('temp',$v);
// // echo var_dump($row);






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
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
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
        <a class="collapse-item" href="register.php">Admin</a>
        <a class="collapse-item" href="user.php">User</a>
        <!-- <a class="collapse-item" href="user.php">Visitor</a> -->
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

  <!-- Nav Item - Pages Collapse Menu -->
  <!--<li class="nav-item">
       <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
         <i class="fas fa-fw fa-cog"></i>
         <span>Components</span>
       </a>
       <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
         <div class="bg-white py-2 collapse-inner rounded">
           <h6 class="collapse-header">Custom Components:</h6>
           <a class="collapse-item" href="buttons.html">Buttons</a>
           <a class="collapse-item" href="cards.html">Cards</a>
         </div>
       </div>
     </li>
  -->




  <li class="nav-item">
    <a class="nav-link" href="admin_Profile.php">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Admin Profile</span> <input type="hidden"></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="admin_user-profile.php">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>User Profile</span> <input type="hidden"></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="admin_visitor.php">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Visitor Profile</span> <input type="hidden"></a>
  </li>



  <!-- Nav Item - Utilities Collapse Menu 
     <li class="nav-item">
       <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
         <i class="fas fa-fw fa-wrench"></i>
         <span>Utilities</span>
       </a>
       <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
         <div class="bg-white py-2 collapse-inner rounded">
           <h6 class="collapse-header">Custom Utilities:</h6>
           <a class="collapse-item" href="utilities-color.html">Colors</a>
           <a class="collapse-item" href="utilities-border.html">Borders</a>
           <a class="collapse-item" href="utilities-animation.html">Animations</a>
           <a class="collapse-item" href="utilities-other.html">Other</a>
         </div>
       </div>
     </li>
  -->







  <!-- Nav Item - Charts 
     <li class="nav-item">
       <a class="nav-link" href="charts.html">
         <i class="fas fa-fw fa-chart-area"></i>
         <span>Charts</span></a>
     </li>

     <!-- Nav Item - Tables-->
  <li class="nav-item">
    <a class="nav-link" href="tables.php">
      <i class="fas fa-fw fa-table"></i>
      <span>Daily Report</span></a>
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

      <!-- Topbar Search -->
      <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search fa-sm"></i>
            </button>
          </div>
        </div>
      </form>


      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
          <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
          </a>
          <!-- Dropdown - Messages -->
          <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw" aria-hidden="true"></i>
            <!-- Counter - Alerts -->
            <span class="badge badge-danger badge-counter" id="noti_number"></span>
          </a>
          <script type="text/javascript">
        //   function getCookie(cname) {
        //   var name = cname + "=";
        //   var decodedCookie = decodeURIComponent(document.cookie);
        //   var ca = decodedCookie.split(';');
        //   for(var i = 0; i <ca.length; i++) {
        //     var c = ca[i];
        //     while (c.charAt(0) == ' ') {
        //       c = c.substring(1);
        //     }
        //     if (c.indexOf(name) == 0) {
        //       return c.substring(name.length, c.length);
        //     }
        //   }
        //   return "";
        // }


            function loadDoc() {

              var isswal=true;
           
              
              setInterval(function() {


                $.ajax({
                type: "POST",
                url: "https://f16b3e56b087.ngrok.io" + url,
                data: JSON.stringify(patient), // serializes the form's elements.
                dataType: 'json',
                contentType: 'application/json'
            }).done(function (data, status, xhr) {
                console.log("done in");
                console.log(data);
                // console.log(status);
                $("#alert-popup-success").fadeTo(3000, 500).slideUp(600, function () {
                    $("#alert-popup-success").slideUp(500);
                });

            }).fail(function (xhr, status, error) {
                // console.log("done fail");
                $("#alert-popup-fail").fadeTo(2000, 500).slideUp(600, function () {
                    $("#alert-popup-fail").slideUp(500);
                });
            });


                

                var xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                  if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("noti_number").innerHTML = this.responseText;
                    //console.log(typeof(this.responseText));
                  if(Number(this.responseText)>=1 && isswal){
                    // var x = document.cookie 
                    // console.log(getCookie('lid'));
                    Swal.fire({
                      timer: 5000,
                      timerProgressBar:true,
                      title: 
                      // getCookie('vis') + '\n'+ getCookie('temp'),
                      
                      showDenyButton: true,
                      // showCancelButton: true,
                      confirmButtonText: `Accept`,
                      denyButtonText: `Decline`,
                    }).then((result) => {
                      /* Read more about isConfirmed, isDenied below */
                      if (result.isConfirmed) {
                        myFunction();
                        Swal.fire('Accepted!', '', 'success')
                      } else if (result.isDenied) {
                        myFunction();
                        Swal.fire('Visitor Declined!!', '', 'info')
                      }

                      
                    })


                  }
                  }
                };
                xhttp.open("GET", "view.php", false);
                xhttp.send();

              }, 5000);


            }
            loadDoc();
          </script>
          <script>
            
            function myFunction() {
              var xhttp = new XMLHttpRequest();
              xhttp.onload = function() {
                if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("noti_number").innerHTML = this.responseText;

                }
              };
              xhttp.open("POST", "view.php", false);
              xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xhttp.send("fname=false");

            }
            // loadDoc();
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
                <!-- <script type="text/javascript">
                  function loadDate() {



                    setInterval(function() {
                      var xhttp = new XMLHttpRequest();
                      xhttp.onload = function() {
                        if (this.readyState == 4 && this.status == 200) {
                          document.getElementById("dropdown-date").innerHTML = this.responseText;
                        }
                      };
                      xhttp.open("GET", "date.php", false);
                      xhttp.send();


                    }, 1000);

                  }
                  loadDate();
                </script> -->



                <span class="font-weight-bold" id="dropdown-data">


                </span>
                <script type="text/javascript">
                  function loadData() {


                    setInterval(function() {

                      var xhttp = new XMLHttpRequest();
                      xhttp.onload = function() {
                        if (this.readyState == 4 && this.status == 200) {
                          document.getElementById("dropdown-data").innerHTML = this.responseText;
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
            <!-- <a class="dropdown-item d-flex align-items-center" href="#">
                 <div class="mr-3">
                   <div class="icon-circle bg-success">
                     <i class="fas fa-donate text-white"></i>
                   </div>
                 </div>
                 <div>
                   <div class="small text-gray-500">December 7, 2019</div>
                   $290.29 has been deposited into your account!
                 </div>
               </a> -->
            <!-- <a class="dropdown-item d-flex align-items-center" href="#">
                 <div class="mr-3">
                   <div class="icon-circle bg-warning">
                     <i class="fas fa-exclamation-triangle text-white"></i>
                   </div>
                 </div>
                 <div>
                   <div class="small text-gray-500">December 2, 2019</div>
                   Spending Alert: We've noticed unusually high spending for your account.
                 </div>
               </a> -->
            <!-- <form action="register_edit.php" method="POST">

              <button type="submit" name="edit_data_btn" class="btn btn-primary btn-sm auth1-button">Accept</button>
            </form> -->
            <!-- <div class="container">



              <div class="row">



                <form action="record.php" method="POST">
                  <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                  <button type="submit" name="edit_data_btn" class=" btn btn-success col-lg ">Accept</button>
                </form>


                <form action=" record.php" method="POST">
                  <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                  <button type="submit" name="edit_data_btn" class="btn btn-danger col-lg " role="button" aria-pressed="true">Decline</button>
                </form>

              </div>

            </div> -->
          </div>
        </li>

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
            <a class="dropdown-item" href="#">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Profile
            </a>
            <a class="dropdown-item" href="#">
              <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
              Settings
            </a>
            <a class="dropdown-item" href="#">
              <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
              Activity Log
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



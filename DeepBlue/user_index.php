<?php
include('security.php');
include('includes/header.php');
include('includes/user_navbar.php');
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $query = "SELECT houseNo FROM user ORDER BY houseNo";
                                $query_run = mysqli_query($connection, $query);

                                $row = mysqli_num_rows($query_run);
                                echo '<h1> ' . $row . '</h1>';
                                ?>
                                <!--<h4>Total Admin: *</h4>-->

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total No of Visitors</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                <?php
                                $query = "SELECT id FROM visitor ORDER BY id";
                                $query_run = mysqli_query($connection, $query);

                                $row = mysqli_num_rows($query_run);
                                echo '<h1> ' . $row . '</h1>';
                                ?>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->


        <!-- Pending Requests Card Example -->

    </div>

    <!-- Content Row -->








    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>
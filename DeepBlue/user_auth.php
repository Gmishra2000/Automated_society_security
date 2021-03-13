<?php
include('security.php');
include('validation/user_val.php');
include('includes/header.php');
include('includes/user_navbar.php');
?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Visitors Data</h1>
        <form method="post" action="export.php">
            <input type="submit" name="export" class="d-none d-md-inline-block btn btn-md btn-primary shadow-sm " value="Generate Report" />
        </form>
    </div>
    <!-- Page Heading -->



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php
                // $query1 = "SELECT * FROM user where email ='$email_data'";
                // $query1_run = mysqli_query($connection, $query1);
                // $row1 = mysqli_fetch_assoc($query1_run);
                // // echo $row1['houseNo'];
                // $data1 = $row1['houseNo'];
                $name = $_SESSION['username'];
                $querytest = "SELECT * from user where email = '$name'";
                $query_runtest = mysqli_query($connection, $querytest);
                $all_arr = mysqli_fetch_array($query_runtest);
                $house_no = $all_arr['houseNo'];

                $query = "SELECT * from dailyrecord where houseNo LIKE '%$house_no%'";
                $query_run = mysqli_query($connection, $query);

                if (mysqli_num_rows($query_run) > 0) {

                ?>
                    <table class="ui celled table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Id</th>
                                <th>Name</th>
                                <!-- <th>House No</th> -->
                                <th>Phone No</th>
                                <th>Aadhar No</th>
                                <th>Designation</th>
                                <th>Temperature</th>
                                <th>Time</th>
                                <th>Permission</th>
                                <th>Security Person</th>
                            </tr>
                        </thead>
                        <!-- <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>House No</th>
                                <th>Phone No</th>
                                <th>Designation</th>
                                <th>Temperature</th>
                                <th>Time</th>
                            </tr>
                        </tfoot> -->
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($query_run)) {
                            ?>
                                <tr>
                                    <td><?php echo $row['Sr.No'] ?></td>
                                    <td><?php echo $row['id'] ?></td>
                                    <td><?php echo $row['Name'] ?></td>
                                    <!-- <td><?php echo $row['houseNo'] ?></td> -->
                                    <td><?php echo $row['phoneNumber'] ?></td>
                                    <td><?php echo $row['aadharNo'] ?></td>
                                    <td><?php echo $row['designation'] ?></td>
                                    <td><?php echo $row['temp'] ?></td>
                                    <td><?php echo $row['time'] ?></td>
                                    <td><?php echo $row['Permission'] ?></td>
                                    <td><?php echo $row['securityPerson'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo "No record Found";
                }
                ?>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
<?php
include('security.php');
include('validation/security_val.php');
include('includes/header.php');
include('includes/security_navbar.php');

?>



<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-@ font-weight-bold text-primary">My Profile

            </h4>
        </div>
        <div class="card-body">


            <div class="table-responsive">
                <?php
                $query = "SELECT * FROM  register where email ='$email_data'";
                $query_run = mysqli_query($connection, $query);

                if (mysqli_num_rows($query_run) > 0) {

                ?>




                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>USERNAME</th>
                                <th>EMAIL</th>
                                <th>HOUSE NUMBER</th>
                                <th>PHONE NUMBER</th>
                                <th>USER TYPE</th>
                                <th>PASSWORD</th>
                                <th>IMAGE</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($query_run)) {
                            ?>
                                <tr>
                                    <td><?php echo $row['id'] ?></td>
                                    <td><?php echo $row['username'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td><?php echo $row['houseNo'] ?></td>
                                    <td><?php echo $row['phoneNo'] ?></td>
                                    <td><?php echo $row['usertype'] ?></td>
                                    <td><?php echo $row['password'] ?></td>
                                    <td><?php echo '<img src="upload/admin/' . $row['images'] . '" width="100px;" height="100px" alt="Image">' ?> </td>

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

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
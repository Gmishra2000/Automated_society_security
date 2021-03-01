<?php
include('security.php');
include('includes/header.php');
include('includes/user_navbar.php');

?>

<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="user_action.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">

                    <div class="form-group">
                        <label> Username </label>
                        <input type="text" name="username" class="form-control" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control checking_email" placeholder="Enter Email">
                        <small class="error_email" style="color: red;"></small>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter Password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                        <label>Upload Image</label>
                        <input type="file" name="person_image" id="person_image" class="form-control" required>
                    </div>
                </div>
                <input type="hidden" name="usertype" value="User">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

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

                $query = "SELECT * FROM  user where email='$email_data'";
                $query_run = mysqli_query($connection, $query);

                if (mysqli_num_rows($query_run) > 0) {

                ?>




                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <!-- <th>ID</th> -->
                                <th>USERNAME</th>
                                <th>EMAIL</th>
                                <th>House No</th>
                                <th>PASSWORD</th>
                                <!-- <th>UserType</th> -->
                                <th>IMAGE</th>
                                <th>EDIT</th>
                                <th>DELETE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($query_run)) {
                            ?>
                                <tr>
                                    <!-- <td><?php echo $row['id'] ?></td> -->
                                    <td><?php echo $row['username'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td><?php echo $row['houseNo'] ?></td>
                                    <td><?php echo $row['password'] ?></td>
                                    <!-- <td><?php echo $row['usertype'] ?></td> -->
                                    <td><?php echo '<img src="upload/user/' . $row['images'] . '" width="100px;" height="100px" alt="Image">' ?> </td>
                                    <td>
                                        <form action="user_edit.php" method="POST">
                                            <input type="hidden" name="edit_id" value="<?php echo $row['houseNo'] ?>">
                                            <button type="submit" name="edit_data_btn" class="btn btn-success">EDIT</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="user_action.php" method="POST">
                                            <input type="hidden" name="delete_id" value="<?php echo $row['houseNo'] ?>">
                                            <button type="submit" name="admin_delete_btn" class="btn btn-danger">DELETE</button>
                                        </form>
                                    </td>
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
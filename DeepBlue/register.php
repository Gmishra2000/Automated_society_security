<?php
include('security.php');
include('validation/admin_val.php');
include('includes/header.php');
include('includes/navbar.php');

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
            <form action="code.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">

                    <div class="form-group">
                        <label> Username </label>
                        <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control checking_email" title="If no email-id with security person then use admin email-id" placeholder="Enter Email" required>
                        <small class="error_email" style="color: red;"></small>
                    </div>
                    <div class="form-group">
                        <label>House Number</label>
                        <input type="text" name="houseNo" class="form-control checking_email" placeholder="Enter House Number" required>
                        <small class="error_email" style="color: red;"></small>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" name="phoneNo" class="form-control checking_email" placeholder="Enter Phone Number" required>
                        <small class="error_email" style="color: red;"></small>
                    </div>
                    <div class="form-group">
                        <label>User Type</label>
                        <select name="usertype" onchange="change(this);" id="type" required>
                            <option value="admin">Admin</option>
                            <option value="security">Security</option>

                        </select>
                        <!-- <input type="number" name="edit_hNo" value="" class="form-control"> -->
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Enter Password" required>
                    </div>
                    <!-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" -->
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirmpassword" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group">
                        <label>Upload Image</label>
                        <input type="file" name="person_image" id="person_image" class="form-control" required>
                    </div>
                </div>
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

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                Add Admin Profile
            </button>

        </div>
        <div class="card-body">


            <div class="table-responsive">
                <?php
                $query = "SELECT * FROM  register";
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
                                <th>EDIT</th>
                                <th>DELETE</th>
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
                                    <td>
                                        <form action="register_edit.php" method="POST">
                                            <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                                            <button type="submit" name="edit_data_btn" class="btn btn-success">EDIT</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="code.php" method="POST">
                                            <input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>">
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
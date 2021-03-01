<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');

?>

<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Visitor Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="admin_visitor_action.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="Name" class="form-control" placeholder="Enter Name" required>
                    </div>

                    <div class="form-group">
                        <label>Aadhar Number</label>
                        <input type="number" name="aadharNo" class="form-control" placeholder="Enter Aadhar Number">
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="phonenumber" name="phoneNumber" class="form-control" placeholder="Enter Phone Number">
                    </div>
                    <div class="form-group">
                        <label>Designation</label>
                        <input type="text" name="designation" class="form-control" placeholder="Enter Designation" required>
                    </div>
                    <div class="form-group">
                        <label>Upload Image</label>
                        <input type="file" name="person_image" id="person_image" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="admin_registerbtn" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile" ">
                    Add visitor Profile
                </button>
            
        </div>
        <div class=" card-body">


                <div class="table-responsive">
                    <?php
                    $query = "SELECT * FROM  admin_visitor";
                    $query_run = mysqli_query($connection, $query);

                    if (mysqli_num_rows($query_run) > 0) {

                    ?>




                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>


                                    <th>AADHAR NUMBER</th>
                                    <th>PHONE NUMBER</th>
                                    <th>DESIGNATION</th>
                                    <th>IMAGES</th>
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
                                        <td><?php echo $row['Name'] ?></td>

                                        <td><?php echo $row['aadharNo'] ?></td>
                                        <td><?php echo $row['phoneNumber'] ?></td>
                                        <td><?php echo $row['designation'] ?></td>
                                        <td><?php echo '<img src="upload/visitor/' . $row['images'] . '" width="100px;" height="100px" alt="Image">' ?> </td>
                                        <td>
                                            <form action="admin_visitor_edit.php" method="POST">
                                                <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                                                <button type="submit" name="edit_data_btn" class="btn btn-success">EDIT</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="admin_visitor_action.php" method="POST">
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
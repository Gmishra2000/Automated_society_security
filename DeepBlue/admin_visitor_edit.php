<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');


?>

<div class="container-fluid">
    <div class=".card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Regstration Edit</h6>
        </div>
    </div>
    <div class="card-body">


        <?php
        if (isset($_POST['edit_data_btn'])) {
            $id = $_POST['edit_id'];

            $query = "SELECT * FROM admin_visitor where id='$id'";
            $query_run = mysqli_query($connection, $query);

            foreach ($query_run as $row) {
        ?>
                <form action="admin_visitor_action.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="edit_name" value="<?php echo $row['Name'] ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Aadhar Number</label>
                        <input type="number" name="edit_ano" value="<?php echo $row['aadharNo'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" name="edit_phno" value="<?php echo $row['phoneNumber'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Designation</label>
                        <input type="text" name="edit_desgn" value="<?php echo $row['designation'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Upload Image</label>
                        <input type="file" name="person_image" id="person_image" value="<?php echo $row['images'] ?>" class="form-control">
                    </div>


                    <a href="admin_visitor_profile.php" class="btn btn-danger">CANCEL</a>
                    <button type="submit" name="register_update_btn" class="btn btn-primary">Update</button>
                </form>
        <?php
            }
        }
        ?>

    </div>
</div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
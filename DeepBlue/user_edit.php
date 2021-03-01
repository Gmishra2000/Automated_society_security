<?php
include('security.php');
include('includes/header.php');

include('includes/user_navbar.php');


?>

<div class="container-fluid">
    <div class=".card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">My Profile Edit</h6>
        </div>
    </div>
    <div class="card-body">


        <?php
        if (isset($_POST['edit_data_btn'])) {
            $id = $_POST['edit_id'];

            $query = "SELECT * FROM user where houseNo='$id'";
            $query_run = mysqli_query($connection, $query);

            foreach ($query_run as $row) {
        ?>
                <form action="user_action.php" method="POST" enctype="multipart/form-data">
                    <!-- <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>"> -->
                    <div class="form-group">
                        <label>UserName</label>
                        <input type="text" name="edit_name" value="<?php echo $row['username'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="edit_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php echo $row['email'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>House Number</label>
                        <input type="text" name="edit_hNo" value="<?php echo $row['houseNo'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" name="edit_PhNo" value="<?php echo $row['phoneNo'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Enter Password" name="edit_password" value="<?php echo $row['password'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Upload Image</label>
                        <input type="file" name="person_image" id="person_image" value="<?php echo $row['images'] ?>" class="form-control">
                    </div>


                    <a href="visitor_user.php" class="btn btn-danger">CANCEL</a>
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
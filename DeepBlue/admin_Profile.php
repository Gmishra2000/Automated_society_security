<?php
include('security.php');
include('validation/admin_val.php');
include('includes/header.php');
include('includes/navbar.php');

?>



<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-@ font-weight-bold text-primary">Admin Profile

            </h4>
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
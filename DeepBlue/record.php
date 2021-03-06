<?php
include('security.php');
include('includes/header.php');
include('includes/security_navbar.php');
?>


<div class="container-fluid">
    <div class=".card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Entered Visitor Detail</h6>
        </div>
    </div>
    <div class="card-body">
        <?php
        function House_No($connection, $id)
        {
            $output = '';
            $sql = "SELECT visitor_id ,user_hNo FROM association_map where  visitor_id = $id ";
            $result = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $output .= '<option value="' . $row["user_hNo"] . '">' . $row["user_hNo"] . '</option>';
            }
            return $output;
        }


        ?>

        <?php


        if (isset($_POST['edit_data_btn'])) {
            $id = $_POST['edit_id'];




            $query = "SELECT   visitor.id,Name,houseNo,aadharNo,phoneNumber,designation,temp,time from visitor,dailyvisit  WHERE row_id = (SELECT max(row_id) FROM dailyvisit) and visitor.id = dailyvisit.id";
            $query_run = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($query_run);

        ?>
            <form action="visitor_record.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="edit_name" value="<?php echo $row['Name'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>House Number</label>
                    <select name="user_hNo" id="brand">
                        <option>Show All Houses</option>
                        value="<?php echo House_No($connection, $id); ?>"
                    </select>
                    <!-- <input type="number" name="edit_hNo" value="" class="form-control"> -->
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="edit_phNo" value="<?php echo $row['phoneNumber'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Aaadhar Number</label>
                    <input type="number" name="edit_aadharNo" value="<?php echo $row['aadharNo'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Designatiom</label>
                    <input type="text" name="edit_dgNo" value="<?php echo $row['designation'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Temperature</label>
                    <input type="number" name="edit_temp" value="<?php echo $row['temp'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label>Time</label>
                    <input type="datetime" name="edit_time" value="<?php echo $row['time'] ?>" class="form-control">
                </div>


                <!-- <a href="register.php" class="btn btn-danger">CANCEL</a> -->
                <button type="submit" name="visitor_update_btn" class="btn btn-primary">Submit</button>
            </form>
        <?php

        }
        ?>

    </div>
</div>















<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
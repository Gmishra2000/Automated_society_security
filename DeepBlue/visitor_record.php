<?php
include("security.php");

if (isset($_POST['visitor_update_btn'])) {
    $edit_id    = $_POST['edit_id'];
    $edit_name = $_POST['edit_name'];
    $edit_hNo = $_POST['user_hNo'];
    $edit_phNo = $_POST['edit_phNo'];
    $edit_aadharNo = $_POST['edit_aadharNo'];
    $edit_dgNo = $_POST['edit_dgNo'];
    $edit_temp = $_POST['edit_temp'];
    $edit_time = $_POST['edit_time'];

    $query = "INSERT INTO dailyrecord (id,Name,houseNo,phoneNumber,aadharNo,designation,temp,time) VALUES ('$edit_id','$edit_name','$edit_hNo','$edit_phNo','$edit_aadharNo','$edit_dgNo','$edit_temp','$edit_time')";
    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        echo "true";
    } else {
        echo "False";
    }
}

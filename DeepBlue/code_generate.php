<?php

include("security.php");

if (isset($_POST['generate-id'])) {
    $admin_id = $_SESSION['username'];
    $security_code = $_POST['security_code'];
    // echo $security_code;
    $query = "INSERT INTO generate_id (admin_id,unique_id) VALUES ('$admin_id','$security_code')";
    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        $_SESSION['status'] = "Security Code addded";
        $_SESSION['status_code'] = "success";
        header('Location: index.php');
    } else {
        $_SESSION['status'] = "one admin one code allowed";
        $_SESSION['status_code'] = "warning";
        header('Location: index.php');
    }
}

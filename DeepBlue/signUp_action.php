<?php

include("security.php");



/**********CODE FOR REGISTRING uSER INTO DATABASE******************/

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $houseNo = $_POST['houseNo'];
    $unique_id = $_POST['Unique_Id'];
    $phoneNo = $_POST['phoneNo'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $images = $_FILES['person_image']['name'];

    $email_query = "SELECT * FROM user WHERE email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);

    $unique_id = " SELECT * FROM generate_id where  unique_id='$unique_id'";
    $unique_id_run = mysqli_query($connection, $unique_id);
    // if (mysqli_fetch_array($unique_id_run) === TRUE) {
    //     echo "True";
    // } else {
    //     echo "False: ";
    // }
    if (mysqli_num_rows($email_query_run) > 0) {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');
    } else if (mysqli_fetch_array($unique_id_run) && ($password === $cpassword)) {
        $query = "INSERT INTO user (username,email,houseNo,phoneNo,password,images) VALUES ('$username','$email','$houseNo','$phoneNo','$password','$images')";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            move_uploaded_file($_FILES["person_image"]["tmp_name"], "upload/user/" . $_FILES["person_image"]["name"]);
            $_SESSION['status'] = "User Added";
            $_SESSION['status_code'] = "success";
            header('Location: login.php');
        } else {
            $_SESSION['status'] = "User not added";
            $_SESSION['status_code'] = "Error";
            header('Location: society.php');
        }
    } else {
        $_SESSION['status'] = "Check Security Code or Password";
        $_SESSION['status_code'] = "warning";
        header('Location: society.php');
    }
}

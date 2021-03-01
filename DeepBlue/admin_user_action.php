<?php
include('security.php');

if (isset($_POST['registerbtn'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $houseNo = $_POST['houseNo'];
    $phoneNo = $_POST['phoneNo'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];

    $images = $_FILES['person_image']['name'];



    $email_query = "SELECT * FROM user WHERE email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);

    if (file_exists("upload/user/" . $_FILES["person_image"]["name"])) {
        $store  = $_FILES["person_image"]["name"];
        $_SESSION['status'] = "Image already exists. '.$store.'";
        $_SESSION['status_code'] = "Error";
        header('Location: user.php');
    } elseif (mysqli_num_rows($email_query_run) > 0) {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: user.php');
    } else {
        if ($password === $cpassword) {
            $query = "INSERT INTO user (username,email,houseNo,phoneNo,password,images) VALUES ('$username','$email','$houseNo','$phoneNo','$password','$images')";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                move_uploaded_file($_FILES["person_image"]["tmp_name"], "upload/user/" . $_FILES["person_image"]["name"]);
                $_SESSION['status'] = "User Added";
                $_SESSION['status_code'] = "success";
                header('Location: admin_user-profile.php');
            } else {
                $_SESSION['status'] = "User not added";
                $_SESSION['status_code'] = "Error";
                header('Location: user.php');
            }
        } else {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            header('Location: user.php');
        }
    }
}


/* ---------------------------------START OF EDIT AND UPDATE IN USER------------------------- */


if (isset($_POST['admin_user_register_update_btn'])) {
    $edit_id = $_POST['edit_id'];
    $edit_name = $_POST['edit_name'];
    $edit_email = $_POST['edit_email'];
    $edit_hNo = $_POST['edit_hNo'];
    $edit_PhNo = $_POST['edit_PhNo'];
    $edit_password = $_POST['edit_password'];
    $person_image = $_FILES['person_image']['name'];

    $admin_query = "SELECT * FROM user where houseNo='$edit_hNo' ";
    $admin_query_run = mysqli_query($connection, $admin_query);
    foreach ($admin_query_run as $ad_row) {
        // echo $ad_row['images'];
        if ($person_image == NULL) {
            // Update with existing image
            $image_data = $ad_row['images'];
        } else {
            // update with new image and delete old image
            if ($img_path = "upload/user/" . $ad_row['images']) {
                unlink($img_path);
                $image_data = $person_image;
                $_SESSION['status'] = "User Updated with new image";
                $_SESSION['status_code'] = "success";
                header('Location: admin_user-profile.php');
            }
        }
    }


    $query = "UPDATE user SET username='$edit_name', email='$edit_email',houseNo='$edit_hNo',phoneNo='$edit_PhNo' ,password='$edit_password', images='$image_data' WHERE houseNo='$edit_hNo' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        if ($person_image == NULL) {
            // Update with existing image
            $_SESSION['status'] = "User Updated with existing image";
            $_SESSION['status_code'] = "success";

            header('Location: admin_user-profile.php');
        } else {
            // update with new image and delete old image
            move_uploaded_file($_FILES["person_image"]["tmp_name"], "upload/user/" . $_FILES["person_image"]["name"]);
            $_SESSION['success'] = "User Updated";
            $_SESSION['status_code'] = "success";
            header('Location: admin_user-profile.php');
        }
    } else {
        $_SESSION['success'] = "User not Updated";
        $_SESSION['status_code'] = "error";
        header('Location: admin_user-profile.php');
    }
}

/* --------------------------------END OF EDIT AND UPDATE IN USER--------------------------------- */

/* ---------------------------------------- START OF DELETE OPERATION IN USER -------------------- */
if (isset($_POST['admin_user_delete_btn'])) {

    $id = $_POST['admin_user_delete_id'];

    $delete_image_query = "SELECT * FROM user where houseNo='$id' ";
    $delete_image_query_run = mysqli_query($connection, $delete_image_query);
    $row = mysqli_fetch_assoc($delete_image_query_run);
    //while ($row = mysqli_fetch_assoc($delete_image_query_run)) {
    //  $img = $row["'upload/.' images"];
    //}
    //echo "<pre>";
    //print_r($row);
    //echo "</pre>";
    unlink("upload/user/" . $row['images']);

    $query = "DELETE   FROM user WHERE houseNo='$id' ";
    //var_dump($query);
    $query_run = mysqli_query($connection, $query);


    /*if (($delete_query_run) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $delete_query_run . "<br>" . $connection->error;
    }*/
    if ($query_run) {
        $_SESSION['status'] = "User Data is Deleted";
        $_SESSION['status_code'] = "success";
        header("Location: admin_user-profile.php");
    } else {
        $_SESSION['status'] = "User Data is Not Deleted";
        $_SESSION['status_code'] = "error";
        header("Location: admin_user-profile.php");
    }
}

/* ----------------------------------END OF DELETE OPERATION IN PHP ---------------------------------- */
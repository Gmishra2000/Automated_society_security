<?php
include('security.php');

//$connection = mysqli_connect("localhost", "root", "", "adminpanel");

/*CODE FOR DELEING THE DATA */
if (isset($_POST['admin_delete_btn'])) {

    $id = $_POST['delete_id'];

    $delete_image_query = "SELECT * FROM register where id='$id' ";
    $delete_image_query_run = mysqli_query($connection, $delete_image_query);
    $row = mysqli_fetch_assoc($delete_image_query_run);
    //while ($row = mysqli_fetch_assoc($delete_image_query_run)) {
    //  $img = $row["'upload/.' images"];
    //}
    //echo "<pre>";
    //print_r($row);
    //echo "</pre>";
    unlink("upload/admin/" . $row['images']);

    $query = "DELETE   FROM register WHERE id='$id' ";
    //var_dump($query);
    $query_run = mysqli_query($connection, $query);


    /*if (($delete_query_run) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $delete_query_run . "<br>" . $connection->error;
    }*/
    if ($query_run) {
        $_SESSION['status'] = "Admin Data is Deleted";
        $_SESSION['status_code'] = "success";
        header("Location: register.php");
    } else {
        $_SESSION['status'] = "Admin Data is Not Deleted";
        $_SESSION['status_code'] = "error";
        header("Location: register.php");
    }
}


/*  ----------------------------------------------- */

if (isset($_POST['registerbtn'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $houseNo = $_POST['houseNo'];
    $phoneNo = $_POST['phoneNo'];
    $usertype = $_POST['usertype'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $images = $_FILES['person_image']['name'];

    $email_query = "SELECT * FROM register WHERE email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);

    if (file_exists("upload/admin" . $_FILES["person_image"]["name"])) {
        $store  = $_FILES["person_image"]["name"];
        $_SESSION['status'] = "Image already exists. '.$store.'";
        $_SESSION['status_code'] = "Error";
        header('Location: register.php');
    } elseif (mysqli_num_rows($email_query_run) > 0) {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');
    } else {
        if ($password === $cpassword) {
            $query = "INSERT INTO register (username,email,houseNo,phoneNo,usertype,password,images) VALUES ('$username','$email','$houseNo','$phoneNo','$usertype','$password','$images')";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                move_uploaded_file($_FILES["person_image"]["tmp_name"], "upload/admin/" . $_FILES["person_image"]["name"]);
                $_SESSION['status'] = "Admin Added";
                $_SESSION['status_code'] = "success";
                header('Location: register.php');
            } else {
                $_SESSION['status'] = "Admin not added";
                $_SESSION['status_code'] = "Error";
                header('Location: register.php');
            }
        } else {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            header('Location: register.php');
        }
    }
}

/* CODE FOR UPDATING DATA AFTER EDITING IN REGISTRATION */

if (isset($_POST['register_update_btn'])) {
    $edit_id = $_POST['edit_id'];
    $edit_name = $_POST['edit_name'];
    $edit_email = $_POST['edit_email'];
    $edit_houseNo = $_POST['edit_houseNo'];
    $edit_usertype = $_POST['edit_usertype'];
    $edit_phoneNo = $_POST['edit_phoneNo'];
    $edit_password = $_POST['edit_password'];
    $person_image = $_FILES['person_image']['name'];

    $admin_query = "SELECT * FROM register where id='$edit_id' ";
    $admin_query_run = mysqli_query($connection, $admin_query);
    foreach ($admin_query_run as $ad_row) {
        // echo $ad_row['images'];
        if ($person_image == NULL) {
            // Update with existing image
            $image_data = $ad_row['images'];
        } else {
            // update with new image and delete old image
            if ($img_path = "upload/admin/" . $ad_row['images']) {
                unlink($img_path);
                $image_data = $person_image;
            }
        }
    }


    $query = "UPDATE register SET username='$edit_name', email='$edit_email', houseNo= '$edit_houseNo', phoneNo='$edit_phoneNo',usertype='$edit_usertype',password='$edit_password', images='$image_data' WHERE id='$edit_id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        if ($person_image == NULL) {
            // Update with existing image
            $_SESSION['username'] = $edit_email;
            $_SESSION['status'] = "Admin Updated with existing image";
            $_SESSION['status_code'] = "success";
            header('Location: register.php');
        } else {
            // update with new image and delete old image
            move_uploaded_file($_FILES["person_image"]["tmp_name"], "upload/admin/" . $_FILES["person_image"]["name"]);
            $_SESSION['success'] = "Admin Updated";
            $_SESSION['status_code'] = "error";
            header('Location: register.php');
        }
    } else {
        $_SESSION['success'] = "Admin not Updated";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');
    }
}

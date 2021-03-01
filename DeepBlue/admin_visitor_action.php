<?php
include('security.php');

if (isset($_POST['admin_registerbtn'])) {
    $Name = $_POST['Name'];
    // $houseNo = $_POST['houseNo'];
    $aadharNo = $_POST['aadharNo'];
    $phoneNumber = $_POST['phoneNumber'];
    $designation = $_POST['designation'];
    $images = $_FILES['person_image']['name'];



    //id	Name	houseNo	aadharNo	phoneNumber	designation	images

    $aadhar_query = "SELECT * FROM visitor WHERE aadharNo='$aadharNo'or phoneNumber='$phoneNumber' ";
    $aadhar_query_run = mysqli_query($connection, $aadhar_query);
    $row = mysqli_fetch_assoc($aadhar_query_run);
    $id = $row['id'];

    // if (($query_run) === TRUE) {
    //     echo "New record created successfully";
    // } else {
    //     echo "Error: " . $query_run . "<br>" . $connection->error;
    // }

    if (file_exists("upload/visitor/" . $_FILES["person_image"]["name"])) {
        $store  = $_FILES["person_image"]["name"];
        $_SESSION['status'] = "Image already exists. '.$store.'";
        $_SESSION['status_code'] = "Error";
        header('Location: admin_visitor_register.php');
    } elseif (mysqli_num_rows($aadhar_query_run) > 0) {
        $query_map = "INSERT INTO association_map(user_hNo,visitor_id) VALUES('$houseNo','$id') ";
        $query_map_run = mysqli_query($connection, $query_map);

        $_SESSION['status'] = "Visitor is Already Registered.";
        $_SESSION['status_code'] = "success";
        header('Location: admin_visitor_register.php');
    } else {



        $query = "INSERT INTO admin_visitor (Name,aadharNo,phoneNumber,designation,images) VALUES ('$Name','$aadharNo','$phoneNumber','$designation','$images')";
        $query_run = mysqli_query($connection, $query);

        // $last_id = mysqli_insert_id($connection);
        // $query_map = "INSERT INTO association_map(user_hNo,visitor_id) VALUES('$houseNo','$last_id') ";
        // $query_map_run = mysqli_query($connection, $query_map);

        // if (($query_run) === TRUE) {
        //     echo "New record created successfully";
        // } else {
        //     echo "Error: " . $query_run . "<br>" . $connection->error;
        // }

        if ($query_run) {
            move_uploaded_file($_FILES["person_image"]["tmp_name"], "upload/visitor/" . $_FILES["person_image"]["name"]);
            $_SESSION['status'] = "Visitor Added";
            $_SESSION['status_code'] = "success";
            //     #calling the register api for embedding
            //     // $curl = curl_init();

            //     // curl_setopt_array($curl, array(
            //     //     CURLOPT_URL => 'localhost:5005/register',
            //     //     CURLOPT_RETURNTRANSFER => true,
            //     //     CURLOPT_ENCODING => '',
            //     //     CURLOPT_MAXREDIRS => 10,
            //     //     CURLOPT_TIMEOUT => 0,
            //     //     CURLOPT_FOLLOWLOCATION => true,
            //     //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //     //     CURLOPT_CUSTOMREQUEST => 'POST',
            //     //     CURLOPT_POSTFIELDS => array('id' => $last_id, 'img_name' => $_FILES["person_image"]["name"]),
            //     // ));

            //     // $response = curl_exec($curl);

            //     // curl_close($curl);
            //     // echo $response;
            header('Location: admin_visitor_profile.php');
        } else {
            $_SESSION['status'] = "Visitor not added";
            $_SESSION['status_code'] = "Error";
            header('Location: admin_visitor_register.php');
        }
    }
}


/* ---------------------------------START OF EDIT AND UPDATE IN USER------------------------- */


if (isset($_POST['register_update_btn'])) {
    $edit_id = $_POST['edit_id'];
    $edit_name = $_POST['edit_name'];

    $edit_ano = $_POST['edit_ano'];
    $edit_phno = $_POST['edit_phno'];
    $edit_desgn = $_POST['edit_desgn'];
    $person_image = $_FILES['person_image']['name'];

    $admin_query = "SELECT * FROM admin_visitor where id='$edit_id' ";
    $admin_query_run = mysqli_query($connection, $admin_query);
    foreach ($admin_query_run as $ad_row) {
        // echo $ad_row['images'];
        if ($person_image == NULL) {
            // Update with existing image
            $image_data = $ad_row['images'];
        } else {
            // update with new image and delete old image
            if ($img_path = "upload/visitor/" . $ad_row['images']) {
                unlink($img_path);
                $image_data = $person_image;
                $_SESSION['status'] = "Visitor Updated with new image";
                $_SESSION['status_code'] = "success";
                header('Location: admin_visitor_profile.php');
            }
        }
    }


    $query = "UPDATE admin_visitor SET Name='$edit_name' ,aadharNo='$edit_ano',phoneNumber='$edit_phno',designation='$edit_desgn',images='$image_data' WHERE id='$edit_id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        if ($person_image == NULL) {
            // Update with existing image
            $_SESSION['status'] = "Visitor Updated with existing image";
            $_SESSION['status_code'] = "success";
            header('Location: admin_visitor_profile.php');
        } else {
            // update with new image and delete old image
            move_uploaded_file($_FILES["person_image"]["tmp_name"], "upload/visitor/" . $_FILES["person_image"]["name"]);
            $_SESSION['success'] = "Visitor Updated";
            $_SESSION['status_code'] = "success";
            header('Location: admin_visitor_profile.php');
        }
    } else {
        $_SESSION['success'] = "Visitor not Updated";
        $_SESSION['status_code'] = "error";
        header('Location: admin_visitor_profile.php');
    }
}

/* --------------------------------END OF EDIT AND UPDATE IN USER--------------------------------- */

/* ---------------------------------------- START OF DELETE OPERATION IN USER -------------------- */
if (isset($_POST['admin_delete_btn'])) {

    $id = $_POST['delete_id'];

    $delete_image_query = "SELECT * FROM admin_visitor where id='$id' ";
    $delete_image_query_run = mysqli_query($connection, $delete_image_query);
    $row = mysqli_fetch_assoc($delete_image_query_run);
    //while ($row = mysqli_fetch_assoc($delete_image_query_run)) {
    //  $img = $row["'upload/.' images"];
    //}
    //echo "<pre>";
    //print_r($row);
    //echo "</pre>";
    unlink("upload/visitor/" . $row['images']);

    $query = "DELETE   FROM admin_visitor WHERE id='$id' ";
    //var_dump($query);
    $query_run = mysqli_query($connection, $query);


    /*if (($delete_query_run) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $delete_query_run . "<br>" . $connection->error;
    }*/
    if ($query_run) {
        $_SESSION['status'] = "visitor Data is Deleted";
        $_SESSION['status_code'] = "success";

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'localhost:5005/delete',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'POST',
        //     CURLOPT_POSTFIELDS => array('id' => $id),
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);
        // echo $response;
        header("Location: admin_visitor_profile.php");
    } else {
        $_SESSION['status'] = "visitor Data is Not Deleted";
        $_SESSION['status_code'] = "error";
        header("Location: admin_visitor_profile.php");
    }
}

/* ----------------------------------END OF DELETE OPERATION IN PHP ---------------------------------- */
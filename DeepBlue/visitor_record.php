<?php
include("security.php");


/******************************ACCEPT BUTTON FUNCTIONALITIES *******************************************/

if (isset($_POST['visitor_update_btn'])) {
    $edit_id    = $_POST['edit_id'];
    $edit_name = $_POST['edit_name'];
    $edit_hNo = $_POST['user_hNo'];
    $edit_phNo = $_POST['edit_phNo'];
    $edit_aadharNo = $_POST['edit_aadharNo'];
    $edit_dgNo = $_POST['edit_dgNo'];
    $edit_temp = $_POST['edit_temp'];
    $edit_time = $_POST['edit_time'];
    $date = $_POST['edit_date'];
    
    $name = $_SESSION['username'];
    if (isset($_POST["user_hNo"])) {
        $framework = '';
        

        foreach ($_POST["user_hNo"] as $row) {         
            
            $val = (string)$row;
            $framework .= $val . ', ';

        }
        if (str_contains($framework, 'all')) { 
            $framework=str_replace("all,","",$framework);
            
        }
    }

    $query = "INSERT INTO dailyrecord (id,Name,houseNo,phoneNumber,aadharNo,designation,temp,time,date,Permission,securityPerson) VALUES ('$edit_id','$edit_name','" . $framework . "','$edit_phNo','$edit_aadharNo','$edit_dgNo','$edit_temp','$edit_time','$date','Accepted','$name')";
    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        $_SESSION['status'] = "Detail Added";
        $_SESSION['status_code'] = "success";
        header('Location: security_page.php');
    } else {
        $_SESSION['status'] = "Details Not added";
        $_SESSION['status_code'] = "error";
        header('Location: security_page.php');
    }
}

/****************************************************************************************************************** */
// echo "hello";

/*****************************DECLINE BUTTON FUNCTIONALITIES ********************************************************/
if (isset($_POST['decline_id'])) {
    $decline_id = $_POST['decline_id'];
    $decline_name = $_SESSION['username'];

    // echo "hello";
    $query3 = "SELECT * FROM dailyvisit WHERE row_id=(SELECT max(row_id) FROM dailyvisit)";
    $query3_run = mysqli_query($connection, $query3);
    $row3 = mysqli_fetch_assoc($query3_run);


    $decline_temp = $row3['temp'];
    $decline_time = $row3['time'];

    $decline_query = "SELECT * FROM visitor where id = '$decline_id'";
    $decline_query_run = mysqli_query($connection, $decline_query);
    $row = mysqli_fetch_assoc($decline_query_run);
    $id = $row['id'];
    $edit_name = $row['Name'];
    $edit_hNo = $row['houseNo'];
    $edit_phNo = $row['phoneNumber'];
    $edit_aadharNo = $row['aadharNo'];
    $edit_dgNo = $row['designation'];


    if ($decline_id = $id) {

        $query2 = "INSERT INTO dailyrecord (id,Name,houseNo,phoneNumber,aadharNo,designation,temp,time,Permission,securityPerson) VALUES ('$decline_id','$edit_name','$edit_hNo','$edit_phNo','$edit_aadharNo','$edit_dgNo','$decline_temp','$decline_time','Decline','$decline_name')";
        $query2_run = mysqli_query($connection, $query2);
        if ($query2_run) {
            $_SESSION['status'] = "Detail Of Declined visitor Added";
            $_SESSION['status_code'] = "success";
            header('Location: security_page.php');
        } else {
            $_SESSION['status'] = "Details Not added";
            $_SESSION['status_code'] = "Error";
            header('Location: security_page.php');
        }
    } else {
        $query4 = "INSERT INTO dailyrecord(id,temp,time,Permission,securityPerson) VALUES ('$decline_id','$decline_temp','$decline_time','Declined','$decline_name')";
        $query4_run = mysqli_query($connection, $query4);
        if ($query4_run) {
            $_SESSION['status'] = "Detail Of Declined unregisterd visitor Added";
            $_SESSION['status_code'] = "success";
            header('Location: security_page.php');
        } else {
            $_SESSION['status'] = "Details of unregisterd Not added";
            $_SESSION['status_code'] = "Error";
            header('Location: security_page.php');
        }
    }
}

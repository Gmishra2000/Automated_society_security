<?php
session_start();
include('security.php');

if (isset($_POST['login_btn'])) {
    $email_login = $_POST['email'];
    $password_login = $_POST['password'];



    $query = "SELECT * FROM register where email='$email_login' AND password='$password_login'  ";
    $query_run = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($query_run);
    $_SESSION['sess_userrole'] = $row['usertype'];
   
    
    $user_query = "SELECT * FROM user where email='$email_login' AND password='$password_login' ";
    $user_query_run = mysqli_query($connection, $user_query);
    // $row1 = mysqli_fetch_assoc($user_query_run);
    // $_SESSION['sess_role']= $row1['usertype'];
    







    // $_SESSION['status'] = "Login is Successfull";
    //$_SESSION['status_code'] = "success";

    if ($_SESSION['sess_userrole'] == "admin") {
        $_SESSION['username'] = $email_login;
        header('Location: index.php');
    } else if ($_SESSION['sess_userrole'] == "security") {
        $_SESSION['username'] = $email_login;
        header('Location: security_page.php');
    } else if (mysqli_fetch_array($user_query_run)) {
        $_SESSION['sess_userrole']="user";

        $_SESSION['username'] = $email_login;
        header('Location:user_index.php');
    } else {
        $_SESSION['status'] = 'Email id/Password is Invalid';
        $_SESSION['status_code'] = "error";
        header('Location: login.php');
    }
}

// if (isset($_POST['user_login_btn'])) {
//     $email_login = $_POST['email'];
//     $password_login = $_POST['password'];

//     $query = "SELECT * FROM user where email='$email_login' AND password='$password_login'";
//     $query_run = mysqli_query($connection, $query);

//     if (mysqli_fetch_array($query_run)) {

//         $_SESSION['username'] = $email_login;
//         // $_SESSION['status'] = "Login is Successfull";
//         //$_SESSION['status_code'] = "success";

//         header('Location:user_index.php');
//     } else {
//         $_SESSION['status'] = 'Email id/Password is Invalid';
//         $_SESSION['status_code'] = "error";
//         header('Location: login.php');
//     }
// }

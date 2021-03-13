<?php
session_start();
include('database/dbconfig.php');

// echo $_SESSION['username'];
// echo $_SESSION['sess_userrole'];

$email_data = $_SESSION['username'];


if ($connection) {
    //echo "Database Connected";
} else {
    header("Location: database/dbconfig.php");
}



if (!$_SESSION['username']) {
    header('Location: ../index.html');
}
// elseif($_SESSION['sess_userrole'] != "security"){
//     header('Location: security_page.php');


// }
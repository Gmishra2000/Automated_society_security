<?php

// session_start();
include('database/dbconfig.php');


if($_SESSION['sess_userrole'] == "security"){
    echo '<script>alert("Not Authorized")</script>';
    header('Location: security_page.php');

}
elseif($_SESSION['sess_userrole'] == "admin"){
    echo '<script>alert("Not Authorized")</script>';
    header('Location: index.php');


}
?>
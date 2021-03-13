<?php

// session_start();
include('database/dbconfig.php');


if($_SESSION['sess_userrole'] == "admin"){
    echo '<script>alert("Not Authorized")</script>';
    header('Location: index.php');

}
elseif($_SESSION['sess_userrole'] == "user"){
    echo '<script>alert("Not Authorized")</script>';
    header('Location: user_index.php');


}
?>
<?php
session_start();
include('database/dbconfig.php');

$email_data = $_SESSION['username'];

if ($connection) {
    //echo "Database Connected";
} else {
    header("Location: database/dbconfig.php");
}

if (!$_SESSION['username']) {
    header('Location: ./index.html');
}

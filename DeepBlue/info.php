


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminpanel";


// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$s = "";
$v = "";
$query1 = "SELECT * from `dailyvisit` where `status` = 'unread' order by `date` DESC";
$query1_run = mysqli_query($connection, $query1);
$row = mysqli_fetch_assoc($query1_run);


if ($query1_run->num_rows >= 1) {
    $id = $row['id'];
    $query2 = "SELECT Name from visitor where id = '$id'";
    $query2_run = mysqli_query($connection, $query2);
    $row1 = mysqli_fetch_assoc($query2_run);
}

if ($row == NUll) {
    $s = "No New Visitor yet";
} elseif ($row['id'] == "111" && $row['temp'] >= "98") {
    $s = "Visitor is not Registered ";
    $v = "Temperature is high ";
} elseif ($row['id'] == "111" && $row['temp'] < "98") {
    $s = "Visitor is not Registered ";

    $v = "Temperature is normal";
} elseif ($row['temp'] >= "98") {
    $s =  "Registered Visitor " . $row1['Name'] . " Arrived <br/>";
    $v = "Visitor with High temperature";
} elseif ($row['temp'] < "98") {
    $s = "Registered Visitor " . $row1['Name'] . " Arrived <br/>";
    $v = "Visitor with Normal temperature";
}

echo $s;
echo $v;

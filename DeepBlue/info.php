


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


$query1 = "SELECT * from `dailyvisit` where `status` = 'unread' order by `date` DESC";
$query1_run = mysqli_query($connection, $query1);
$row = mysqli_fetch_assoc($query1_run);
if ($row == NUll) {
    echo "No New Visitor yet";
} elseif ($row['id'] == "111" && $row['temp'] > "98") {
    echo "Visitor is not Registered ";
    echo "Temperature is high ";
} elseif ($row['id'] == "111" && $row['temp'] < "98") {
    echo "Visitor is not Registered ";

    echo "Temperature is normal";
} elseif ($row['temp'] > "98") {
    echo "Registered Visitor id " . $row['id'] . " Arrived <br/>";
    echo "Visitor with High temperature";
} elseif ($row['temp'] < "98") {
    echo "Registered Visitor id " . $row['id'] . " Arrived <br/>";
    echo "Visitor with Normal temperature";
}

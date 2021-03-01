


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminpanel";

include("security.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if (isset($_POST['fname']) && $_POST['fname'] == "false") {
    $query = "UPDATE dailyvisit SET status = 'read' WHERE status= 'unread' ";
    $query_run = mysqli_query($conn, $query);
} else {
    $sql =
        "SELECT * from `dailyvisit` where `status` = 'unread' order by `date` DESC";
    $result = $conn->query($sql);

    echo $result->num_rows;
}






/*
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Notification: " . $row["description"];
    }
} else {
    echo "0 results";
}
*/
$conn->close();

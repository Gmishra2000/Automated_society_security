<?php
//export.php  
include("security.php");
$output = '';
if (isset($_POST["export"])) {
    $query =
        "SELECT id,Name,houseNo,phoneNumber,aadharNo,designation,temp,time from dailyrecord where date=CURDATE() ";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        $output .= '
   <table class="table" bordered="1">  
                    <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>House No</th>
                                <th>Phone No</th>
                                <th>Aadhar Number</th>
                                <th>Designation</th>
                                <th>Temperature</th>
                                <th>Time</th>
                            </tr>
                        </thead>
  ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
    <tr>  
                         <td>' . $row['id'] . '</td>  
                         <td>' . $row['Name'] . '</td>  
                         <td>' . $row['houseNo'] . '</td>  
                         <td>' . $row['phoneNumber'] . '</td>
                         <td>' . $row['aadharNo'] . '</td>  
                         <td>' . $row['designation'] . '</td>
                         <td>' . $row['temp'] . '</td>
                         <td>' . $row['time'] . '</td>
                    </tr>
   ';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=Report.xls');
        echo $output;
    }
}

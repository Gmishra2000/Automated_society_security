<?php

include("security.php");

$query = "SELECT id,date from dailyvisit where date=CURRENT_DATE()";
$query_run = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($query_run);
date_default_timezone_set("Asia/calcutta");
// date_default_timezone_set('Europe/London');
echo  date("Y/m/d");
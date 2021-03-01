<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(!empty($data->id)  &&  !empty($data->name) && !empty($data->temp) )
{
  
    // set product property values
    $id = $data->id;
    $name = $data->name;

    $temp = $data->temp;
    
    // create the product
    // echo $id;
    // echo $temp;
    


//   $s="";
//   $v="";
  $id=(int)$id;
  $temp=(int)$temp;
//   $row['temp']=(int)$row['temp'];
  // echo var_dump($row);
  if ($id == 111 && $temp >= 98) {
   $s="Visitor is not Registered ";
    $v= "Temperature is high ";
  } elseif ($id == 111 && $temp < 98) {
    $s= "Visitor is not Registered ";
  
    $v= "Temperature is normal";
  } elseif ($temp >= 98) {
    $s= "Registered Visitor " . $name . " Arrived";
    $v= "Visitor with High temperature";
  } elseif ($temp < 98) {
    $s= "Registered Visitor " . $name . " Arrived";
    $v= "Visitor with Normal temperature";
  }
  echo $s;
  echo $v;







        // set response code - 201 created
    http_response_code(201);

    // tell the user
    echo json_encode(array("message" => "done"));
    
  
    // if unable to create the product, tell the user

}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(201);
  
    // tell the user
    echo json_encode(array("message" => "not done"));
}
?>
<?php

include('connect.php');
global $mysqli;
global $stanowiska;
$result = mysqli_query($mysqli,$stanowiska);
$json_array = array();
while($row = mysqli_fetch_assoc($result)){
    $json_array[] = $row;
}
$json_array = array('data'=>$json_array);
echo json_encode($json_array);
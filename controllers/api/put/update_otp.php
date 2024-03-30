<?php
include_once '../../../config/header.php';
include_once '../../../models/put.php';


$data = json_decode(file_get_contents('php://input')); 
$obj = new Put();
$result = $obj->update_otp($data);
echo json_encode($result);
?>
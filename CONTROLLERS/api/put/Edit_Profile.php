<?php
include_once '../../../config/header.php';
include_once '../../../models/put.php';


$data = json_decode(file_get_contents('php://input'));
$obj = new Put();
$result = $obj->Edit_Profile($data->id,$data->name,$data->contactNumber,$data->city,$data->gender);
echo json_encode($result);
?>
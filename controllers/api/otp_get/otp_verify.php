<?php
include_once '../../../config/header.php';
include_once '../../../models/get.php';

$data = json_decode(file_get_contents('php://input'));
if ($data->otp != '') { 
    $obj = new Get();
    $result = $obj->otp_verify($data->otp);
    echo json_encode($result);
} else{
    echo json_encode('empty');
}

?>

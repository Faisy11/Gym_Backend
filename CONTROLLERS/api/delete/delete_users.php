<?php
include_once '../../../config/header.php';
include_once '../../../models/delete.php';

$data = json_decode(file_get_contents('php://input')); 

if (isset($data->ids) && is_array($data->ids)) {
    $obj = new Delete();
    
    $result = $obj->delete_users($data->ids);
    echo json_encode($result);
} else {
    echo json_encode("Error: IDs must be provided in an array.");
}
?>

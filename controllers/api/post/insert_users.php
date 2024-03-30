<?php
include_once '../../../config/header.php';
include_once '../../../models/post.php';

$data = json_decode(file_get_contents('php://input'));
$obj = new Post();

if (isset($data->profile) && !empty($data->profile)) {
    $base64Image = str_replace('data:image/png;base64,', '', $data->profile);
    $base64Image = str_replace(' ', '+', $base64Image);

    $filename = uniqid() . '.png'; 
    $filepath = '../../../Image/' . $filename; 

    $decodedImage = base64_decode($base64Image);
    file_put_contents($filepath, $decodedImage);

    $data->profile = $filename;
}

$result = $obj->insert_users(
    $data->name,
    $data->age,
    $data->gender,
    $data->joinDate,
    $data->city,
    $data->contactNumber,
    $data->duration,  
    $data->trainer,
    $data->paymentMode,
    $data->profile,
    $data->Amount,
    $data->exDate,
);

echo json_encode($result);
?>

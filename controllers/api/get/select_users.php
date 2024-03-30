<?php
// echo "ddf";
// $headersPath = '../../../config/header.php';

// echo $headersPath;
// if (!file_exists($headersPath)) {
//     // Handle the case where one or both files are missing
//     http_response_code(500);
//     echo json_encode(['error' => 'Required files are missing']);
//     exit();
// }

// require_once $headersPath;
$headersPath = '../../../config/header.php';
$modelPath = '../../../models/get.php';
// include_once '../../../config/header.php';
// include_once '../../../models/get.php';
 if (!file_exists($headersPath) || !file_exists($modelPath) ) {
    // Handle the case where one or both files are missing
    http_response_code(500);
    echo json_encode(['error' => 'Required files are missing']);
    exit();
}
echo "test1";

require_once $headersPath;
require_once $modelPath;
echo $modelPath;
$data = json_decode(file_get_contents('php://input'));
$obj = new Get();

$result = $obj->select_users();
echo json_encode($result);
?>
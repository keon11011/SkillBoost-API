<?php

// Headers
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include necessary files
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php'; // Adjust path as per your file structure

// Get the raw POST data
$input_data = file_get_contents("php://input");

// Check if any data was received
if (empty($input_data)) {
    echo json_encode(array('message' => 'No data received.'));
    exit;
}

// Decode the JSON data
$input_data = json_decode($input_data);

// Check if email and password are set in the decoded JSON data
if (!isset($input_data->email, $input_data->password)) {
    echo json_encode(array('message' => 'Missing email or password.'));
    exit;
}

// Get email and password from the decoded JSON data
$email = $input_data->email;
$password = $input_data->password;

// Instantiate TaiKhoan object
$taiKhoan = new TaiKhoan($db);

// Validate user
$validation_result = $taiKhoan->validate($email, $password);

// Prepare response data
$response_data = array('valid' => $validation_result['valid']);
if ($validation_result['valid']) {
    // Include MaNV, HoTenNV, and ChucVu in the response if the user is valid
    $response_data['MaNV'] = $validation_result['MaNV'];
    $response_data['HoTenNV'] = $validation_result['HoTenNV'];
    $response_data['ChucVu'] = $validation_result['ChucVu'];
}

// Send JSON response
echo json_encode($response_data);

?> 

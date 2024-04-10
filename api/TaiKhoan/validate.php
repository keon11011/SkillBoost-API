<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include necessary files
include_once 'C:/xampp/htdocs/SkillBoost-API/core/initialize.php'; // Adjust path as per your file structure

// Instantiate TaiKhoan
$taiKhoan= new TaiKhoan($db); // Assuming $db is the database connection

// Get the raw POST data
$input_data = file_get_contents("php://input");

// Check if any data was received
if(empty($input_data)) {
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
if ($taiKhoan->validate($email, $password)) {
    echo json_encode(array('valid' => true));
} else {
    echo json_encode(array('valid' => false));
}
?>

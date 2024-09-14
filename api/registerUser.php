<?php
header("Content-Type: application/json");

// Retrieve raw POST data
$input = file_get_contents("php://input");

// Decode JSON data to PHP associative array
$data = json_decode($input, true);

include_once "../config/class.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($data['name']);
    $email = trim($data['email']);
    $password = trim($data['password']);

    // Validate input
    if (empty($name) || empty($email) || empty($password)) {
        echo json_encode([
            'message' => 'All fields are required.',
            'status' => 400,
            'success' => false
        ]);
    } else {
        $web = new Websystem();
        $web->registerUser($name, $email, $password);
    }
}

?>
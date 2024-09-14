<?php 

    session_start();
    session_destroy();

    echo json_encode([
        'message' => 'User Logged out successfully.',
        'status' => 200,
        'success' => true
    ]);

?>
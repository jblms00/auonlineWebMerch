<?php
session_start();
include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $query = "SELECT * FROM users_accounts WHERE user_type = 'user'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $data['status'] = "success";
        $data['users'] = $users;
    } else {
        $data['status'] = "error";
        $data['message'] = "Error fetching users.";
    }
} else {
    $data['status'] = "error";
    $data['message'] = "Invalid request method.";
}

echo json_encode($data);

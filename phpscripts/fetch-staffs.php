<?php
session_start();
include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $query = "SELECT * FROM users_accounts WHERE user_type = 'staff'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $staffs = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $data['status'] = "success";
        $data['staffs'] = $staffs;
    } else {
        $data['status'] = "error";
        $data['message'] = "Error fetching staffs.";
    }
} else {
    $data['status'] = "error";
    $data['message'] = "Invalid request method.";
}

echo json_encode($data);

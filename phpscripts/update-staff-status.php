<?php
session_start();
include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $new_status = mysqli_real_escape_string($con, $_POST['new_status']);

    if (empty($user_id) || empty($new_status)) {
        $data['status'] = "error";
        $data['message'] = "User ID and status are required.";
    } else {
        $update_query = "UPDATE users_accounts SET account_status = '$new_status' WHERE user_id = '$user_id'";
        $result = mysqli_query($con, $update_query);

        if ($result) {
            $data['status'] = "success";
            $data['message'] = "Staff status updated successfully.";
        } else {
            $data['status'] = "error";
            $data['message'] = "Failed to update staff status.";
        }
    }
} else {
    $data['status'] = "error";
    $data['message'] = "Invalid request method.";
}

echo json_encode($data);

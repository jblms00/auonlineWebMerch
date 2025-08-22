<?php
session_start();

include ("database-connection.php");
include ("check-login.php");

$user_data = check_login($con);
$logged_in_user = $user_data['user_id'];
$current_password = base64_decode($user_data['user_password']);

$data = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    if (empty($old_password) && empty($new_password) && empty($confirm_new_password)) {
        $data['status'] = "error";
        $data['message'] = "All fields are required";
    } else if ($old_password !== $current_password) {
        $data['status'] = "error";
        $data['message'] = "Old password is wrong";
    } else if ($new_password !== $confirm_new_password) {
        $data['status'] = "error";
        $data['message'] = "New password does not match";
    } else {
        $hashed_password = base64_encode($new_password);

        $update_password_query = "UPDATE users_accounts SET user_password = '$hashed_password' WHERE user_id = '$logged_in_user'";
        $update_password_result = mysqli_query($con, $update_password_query);

        if ($update_password_result) {
            $data['status'] = "success";
            $data['message'] = "Password updated successfully";
        } else {
            $data['status'] = "error";
            $data['message'] = "Failed to update password";
        }
    }
} else {
    $data['status'] = "error";
    $data['message'] = "Invalid request method";
}

echo json_encode($data);

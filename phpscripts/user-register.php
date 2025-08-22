<?php
session_start();

include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fullName = mysqli_real_escape_string($con, $_POST['fullName']);
    $email = mysqli_real_escape_string($con, $_POST['regEmail']);
    $password = $_POST['regPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $encodedPassword = base64_encode($password);
    $encodedConfirmPassword = base64_encode($confirmPassword);

    if (empty($fullName) || empty($email) || empty($password) || empty($confirmPassword)) {
        $data['status'] = "error";
        $data['message'] = "All fields are required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $data['status'] = "error";
        $data['message'] = "Invalid email format";
    } else if ($encodedPassword !== $encodedConfirmPassword) {
        $data['status'] = "error";
        $data['message'] = "Passwords do not match";
    } else {
        $check_email_query = "SELECT user_email FROM users_accounts WHERE user_email = '$email'";
        $check_email_result = mysqli_query($con, $check_email_query);

        if (mysqli_num_rows($check_email_result) > 0) {
            $data['status'] = "error";
            $data['message'] = "Email already used";
        } else {
            $create_acc_query = "INSERT INTO users_accounts (user_id, user_name, user_email, user_password, user_type, account_status, datetime_created) VALUES (NULL, '$fullName', '$email', '$encodedPassword', 'user', 'active', NOW())";
            $create_acc_result = mysqli_query($con, $create_acc_query);

            if ($create_acc_result) {
                $data['message'] = "Account created successfully.";
                $data['status'] = "success";
            } else {
                $data['status'] = "error";
                $data['message'] = "Failed to create account. Please try again later.";
            }
        }
    }
}

echo json_encode($data);

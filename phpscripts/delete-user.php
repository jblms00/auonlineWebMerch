<?php
session_start();
include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = isset($_POST['user_id']) ? mysqli_real_escape_string($con, $_POST['user_id']) : '';

    $data['user_id'] = $user_id;
    if (empty($user_id)) {
        $data['status'] = "error";
        $data['message'] = "User ID is required.";
    } else {
        $query = "DELETE FROM users_accounts WHERE user_id = '$user_id'";
        $result = mysqli_query($con, $query);

        if ($result) {
            $data['status'] = "success";
            $data['message'] = "User deleted successfully.";
        } else {
            $data['status'] = "error";
            $data['message'] = "Error deleting user.";
        }
    }
} else {
    $data['status'] = "error";
    $data['message'] = "Invalid request method.";
}

echo json_encode($data);
?>
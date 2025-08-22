<?php
session_start();
include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId'];

    $fetch_user_query = "SELECT * FROM users_accounts WHERE user_id = '$userId'";
    $fetch_user_result = mysqli_query($con, $fetch_user_query);

    if ($fetch_user_result && mysqli_num_rows($fetch_user_result) > 0) {
        $data['user'] = [];
        while ($row = mysqli_fetch_assoc($fetch_user_result)) {
            $data['user'][] = $row;
        }
        $data['status'] = 'success';
    } else {
        $data['status'] = "error";
        $data['message'] = "No user found";
    }
}

echo json_encode($data);
?>
<?php
session_start();

include("database-connection.php");
include("check-login.php");

$user_data = check_login($con);
$logged_in_user = $user_data['user_id'];

$data = [];
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $query = "
        SELECT uo.*, p.product_name, p.product_image 
        FROM users_order uo
        LEFT JOIN products p ON uo.product_id = p.product_id
        WHERE uo.user_id = '$logged_in_user'
        ORDER BY uo.order_at DESC
    ";
    $result = mysqli_query($con, $query);

    if ($result) {
        $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $data['status'] = "success";
        $data['user_orders'] = $orders;
    } else {
        $data['status'] = "error";
        $data['message'] = "Error fetching orders.";
    }
} else {
    $data['status'] = "error";
    $data['message'] = "Invalid request method.";
}

echo json_encode($data);

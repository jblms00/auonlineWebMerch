<?php
session_start();
include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $query = "
        SELECT o.order_id, o.product_id, o.user_id, o.total_price, o.quantity, o.order_status, o.order_at, p.product_name, p.product_image, u.user_name
        FROM users_order o
        LEFT JOIN products p ON o.product_id = p.product_id
        LEFT JOIN users_accounts u ON o.user_id = u.user_id
        ORDER BY o.order_id ASC
    ";
    $result = mysqli_query($con, $query);

    if ($result) {
        $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $data['status'] = "success";
        $data['orders'] = $orders;
    } else {
        $data['status'] = "error";
        $data['message'] = "Error fetching orders.";
    }
} else {
    $data['status'] = "error";
    $data['message'] = "Invalid request method.";
}

echo json_encode($data);
?>
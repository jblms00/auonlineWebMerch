<?php
session_start();
include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $orderId = isset($_GET['order_id']) ? mysqli_real_escape_string($con, $_GET['order_id']) : '';

    if ($orderId) {
        $query = "
        SELECT o.*, p.product_name, p.product_image, u.user_name, u.user_email
        FROM users_order o
        LEFT JOIN products p ON o.product_id = p.product_id
        LEFT JOIN users_accounts u ON o.user_id = u.user_id
        WHERE order_id = '$orderId'
    ";
        $result = mysqli_query($con, $query);

        if ($result) {
            $order = mysqli_fetch_assoc($result);
            if ($order) {
                $data['status'] = "success";
                $data['order'] = $order;
            } else {
                $data['status'] = "error";
                $data['message'] = "Order not found.";
            }
        } else {
            $data['status'] = "error";
            $data['message'] = "Error fetching order details.";
        }
    } else {
        $data['status'] = "error";
        $data['message'] = "Invalid order ID.";
    }
} else {
    $data['status'] = "error";
    $data['message'] = "Invalid request method.";
}

echo json_encode($data);
?>
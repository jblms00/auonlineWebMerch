<?php
session_start();
include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $orderId = isset($_POST['order_id']) ? mysqli_real_escape_string($con, $_POST['order_id']) : '';
    $orderStatus = isset($_POST['order_status']) ? mysqli_real_escape_string($con, $_POST['order_status']) : '';

    if ($orderId && $orderStatus) {
        $query = "UPDATE users_order SET order_status = '$orderStatus' WHERE order_id = '$orderId'";

        if (mysqli_query($con, $query)) {
            $data['status'] = "success";
            $data['message'] = "Order status has been updated successfully.";
        } else {
            $data['status'] = "error";
            $data['message'] = "Error updating order status.";
        }
    } else {
        $data['status'] = "error";
        $data['message'] = "Invalid input.";
    }
} else {
    $data['status'] = "error";
    $data['message'] = "Invalid request method.";
}

echo json_encode($data);
?>
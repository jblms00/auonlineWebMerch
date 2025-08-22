<?php
include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Query to get total profit
    $profit_query = "SELECT SUM(total_price) AS totalProfit FROM users_order WHERE order_status = 'completed'";
    $profit_result = mysqli_query($con, $profit_query);
    $profit_row = mysqli_fetch_assoc($profit_result);
    $data['totalProfit'] = $profit_row['totalProfit'] ?? 0;

    // Query to get total sales (can be different from profit)
    $sales_query = "SELECT SUM(total_price) AS totalSales FROM users_order WHERE order_status = 'completed'";
    $sales_result = mysqli_query($con, $sales_query);
    $sales_row = mysqli_fetch_assoc($sales_result);
    $data['totalSales'] = $sales_row['totalSales'] ?? 0;

    // Query to get total orders
    $orders_query = "SELECT COUNT(*) AS totalOrders FROM users_order";
    $orders_result = mysqli_query($con, $orders_query);
    $orders_row = mysqli_fetch_assoc($orders_result);
    $data['totalOrders'] = $orders_row['totalOrders'] ?? 0;

    $users_query = "SELECT COUNT(DISTINCT user_id) AS totalUsers FROM users_accounts WHERE user_type = 'user'";
    $users_result = mysqli_query($con, $users_query);
    $users_row = mysqli_fetch_assoc($users_result);
    $data['totalUsers'] = $users_row['totalUsers'] ?? 0;

    $data['status'] = 'success';
} else {
    $data['status'] = 'error';
    $data['message'] = 'Invalid request method.';
}

echo json_encode($data);
?>
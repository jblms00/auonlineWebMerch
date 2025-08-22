<?php
session_start();
include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $year = date("Y");

    // Query to get monthly orders
    $ordersQuery = "
        SELECT MONTHNAME(order_at) AS month, COUNT(*) AS users_order
        FROM users_order
        WHERE YEAR(order_at) = '$year'
        GROUP BY MONTH(order_at)
        ORDER BY MONTH(order_at)";

    // Query to get monthly revenue
    $revenueQuery = "
        SELECT MONTHNAME(order_at) AS month, SUM(total_price) AS revenue
        FROM users_order
        WHERE YEAR(order_at) = '$year'
        GROUP BY MONTH(order_at)
        ORDER BY MONTH(order_at)";

    $ordersResult = mysqli_query($con, $ordersQuery);
    $revenueResult = mysqli_query($con, $revenueQuery);

    if ($ordersResult && $revenueResult) {
        $months = [];
        $ordersData = [];
        $revenueData = [];

        while ($row = mysqli_fetch_assoc($ordersResult)) {
            $months[] = $row['month'];
            $ordersData[] = (int) $row['users_order'];
        }

        while ($row = mysqli_fetch_assoc($revenueResult)) {
            $revenueData[] = (float) $row['revenue'];
        }

        $data['status'] = "success";
        $data['months'] = $months;
        $data['ordersData'] = $ordersData;
        $data['revenueData'] = $revenueData;
    } else {
        $data['status'] = "error";
        $data['message'] = "Failed to fetch data";
    }
} else {
    $data['status'] = "error";
    $data['message'] = "Invalid request method";
}

echo json_encode($data);
?>
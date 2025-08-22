<?php
session_start();
include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $query = "SELECT * FROM products ORDER BY product_id ASC";
    $result = mysqli_query($con, $query);

    if ($result) {
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
        shuffle($products);

        $data['status'] = "success";
        $data['products'] = $products;
    } else {
        $data['status'] = "error";
        $data['message'] = "Error fetching products.";
    }
} else {
    $data['status'] = "error";
    $data['message'] = "Invalid request method.";
}

echo json_encode($data);

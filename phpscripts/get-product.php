<?php
session_start();
include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['productId'];

    $fetch_product_query = "SELECT * FROM products WHERE product_id = '$productId'";
    $fetch_product_result = mysqli_query($con, $fetch_product_query);

    if ($fetch_product_result && mysqli_num_rows($fetch_product_result) > 0) {
        $data['product'] = [];
        while ($row = mysqli_fetch_assoc($fetch_product_result)) {
            $data['product'][] = $row;
        }
        $data['status'] = 'success';
    } else {
        $data['status'] = "error";
        $data['message'] = "No product found";
    }
}

echo json_encode($data);
?>
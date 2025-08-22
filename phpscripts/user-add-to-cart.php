<?php
session_start();
include("database-connection.php");
include("check-login.php");

$user_data = check_login($con);
$loggedInUser = $user_data['user_id'];
$data = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = isset($_POST['productId']) ? intval($_POST['productId']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

    if ($quantity <= 0) {
        $data['status'] = 'error';
        $data['message'] = 'Quantity cannot be zero or negative.';
    } elseif ($quantity > 5) {
        $data['status'] = 'error';
        $data['message'] = 'Quantity cannot be more than 5.';
    } else {
        if ($productId > 0) {
            $cartId = sprintf('%06d', rand(0, 999999));

            $insert_query = "INSERT INTO users_cart (cart_id, product_id, user_id, quantity, date_added) VALUES ('$cartId', '$productId', '$loggedInUser', '$quantity', NOW())";

            if (mysqli_query($con, $insert_query)) {
                $data['status'] = 'success';
                $data['message'] = 'Product added to cart.';
            } else {
                $data['status'] = 'error';
                $data['message'] = 'Failed to add product to cart.';
            }
        } else {
            $data['status'] = 'error';
            $data['message'] = 'Invalid product ID.';
        }
    }
} else {
    $data['status'] = 'error';
    $data['message'] = 'Invalid request method.';
}

echo json_encode($data);
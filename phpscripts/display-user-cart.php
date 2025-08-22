<?php
session_start();

include("database-connection.php");
include("check-login.php");

$user_data = check_login($con);
$logged_in_user = $user_data['user_id'];

$data = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $get_cart_query = " SELECT uc.*, sc.*
                        FROM users_cart uc
                        JOIN products sc ON uc.product_id = sc.product_id
                        WHERE uc.user_id = '$logged_in_user'
    ";

    $get_cart_result = mysqli_query($con, $get_cart_query);

    if ($get_cart_result && mysqli_num_rows($get_cart_result) > 0) {
        $data['user_cart'] = [];
        while ($row = mysqli_fetch_assoc($get_cart_result)) {
            $data['user_cart'][] = $row;
        }
        $data['status'] = 'success';
    } else {
        $data['status'] = "error";
        $data['message'] = "No products in the cart.";
    }
}

echo json_encode($data);
?>
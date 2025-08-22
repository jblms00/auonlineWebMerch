<?php
session_start();
include("database-connection.php");
include("check-login.php");

$user_data = check_login($con);
$logged_in_user = $user_data['user_id'];
$data = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userName = mysqli_real_escape_string($con, $_POST['userName']);
    $userEmail = mysqli_real_escape_string($con, $_POST['userEmail']);
    $phoneNumber = mysqli_real_escape_string($con, $_POST['phoneNumber']);
    $paymentType = mysqli_real_escape_string($con, $_POST['paymentType']);
    $gcashReferenceNumber = mysqli_real_escape_string($con, $_POST['gcashReferenceNumber']);
    $totalPrice = mysqli_real_escape_string($con, $_POST['totalPrice']);
    $products = json_decode($_POST['products'], true);

    $receiptFileName = "";
    if ($paymentType === "gcash") {
        if (empty($gcashReferenceNumber) || !isset($_FILES['gcashReceipt']) || $_FILES['gcashReceipt']['error'] !== UPLOAD_ERR_OK) {
            $data['status'] = 'error';
            $data['message'] = 'Reference number and receipt are required for GCash payments.';
            echo json_encode($data);
            exit();
        } else {
            $receiptFileName = uploadReceipt($_FILES['gcashReceipt']);
            if (empty($receiptFileName)) {
                $data['status'] = 'error';
                $data['message'] = 'Failed to upload receipt image for GCash payments.';
                echo json_encode($data);
                exit();
            }
        }
    }

    if (empty($userName) || empty($userEmail) || empty($phoneNumber) || empty($paymentType) || empty($totalPrice)) {
        $data['status'] = 'error';
        $data['message'] = 'All fields are required.';
    } else if ($paymentType == "null" || $paymentType == "Please select payment type") {
        $data['status'] = 'error';
        $data['message'] = 'Please select payment type.';
    } else if (!ctype_digit($phoneNumber)) {
        $data['status'] = 'error';
        $data['message'] = 'Phone number must contain only digits.';
    } else {
        foreach ($products as $product) {
            $cartId = mysqli_real_escape_string($con, $product['cartId']);

            $get_product_query = "SELECT uc.product_id, uc.quantity, pt.product_type 
                                  FROM users_cart uc 
                                  LEFT JOIN products pt ON pt.product_id = uc.product_id 
                                  WHERE cart_id = '$cartId'";
            $get_product_result = mysqli_query($con, $get_product_query);

            if ($get_product_result && mysqli_num_rows($get_product_result) > 0) {
                $fetch_product = mysqli_fetch_assoc($get_product_result);
                $productId = $fetch_product['product_id'];
                $quantity = $fetch_product['quantity'];

                $insert_order_query = "INSERT INTO users_order 
                                       (order_id, product_id, user_id, total_price, quantity, user_phone_number, payment_type, gcash_image_receipt, gcash_reference_number, order_status, order_at) 
                                       VALUES (NULL, '$productId', '$logged_in_user', '$totalPrice', '$quantity', '$phoneNumber', '$paymentType', '$receiptFileName', '$gcashReferenceNumber', 'pending', NOW())";
                $insert_order_result = mysqli_query($con, $insert_order_query);

                $clear_cart_query = "DELETE FROM users_cart WHERE cart_id = '$cartId' AND user_id = '$logged_in_user'";
                $clear_cart_result = mysqli_query($con, $clear_cart_query);

                if (!$insert_order_result || !$clear_cart_result) {
                    $data['status'] = 'error';
                    $data['message'] = 'Failed to insert order items: ' . mysqli_error($con);
                    echo json_encode($data);
                    exit();
                }
            } else {
                $data['status'] = 'error';
                $data['message'] = 'Product details not found in the cart.';
                echo json_encode($data);
                exit();
            }
        }
        $data['status'] = 'success';
        $data['message'] = 'Purchase successful. Thank you for buying!';
    }
} else {
    $data['status'] = 'error';
    $data['message'] = 'Invalid request method.';
}

echo json_encode($data);

function uploadReceipt($file)
{
    $targetDir = "../assets/media/gcashPayments/";
    $fileName = basename($file["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $allowTypes = array('jpg', 'jpeg', 'png');
    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
            return $fileName;
        } else {
            return "";
        }
    } else {
        return "";
    }
}

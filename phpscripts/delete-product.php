<?php
session_start();
include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);

    $query = "DELETE FROM products WHERE product_id = '$product_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $data['status'] = "success";
        $data['message'] = "Product deleted successfully.";
    } else {
        $data['status'] = "error";
        $data['message'] = "Error deleting product.";
    }
} else {
    $data['status'] = "error";
    $data['message'] = "Invalid request method.";
}

echo json_encode($data);
mysqli_close($con);
?>
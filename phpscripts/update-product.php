<?php
session_start();
include("database-connection.php");
header('Content-Type: application/json');

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
    $product_name = mysqli_real_escape_string($con, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($con, $_POST['product_price']);
    $product_description = mysqli_real_escape_string($con, $_POST['product_description']);
    $product_status = mysqli_real_escape_string($con, $_POST['product_status']);

    // Validate input fields
    if (empty($product_id) || empty($product_name) || empty($product_price) || empty($product_description) || empty($product_status)) {
        $data['status'] = "error";
        $data['message'] = "All fields are required.";
    } else {
        $updateQuery = "UPDATE products SET product_name = '$product_name', product_price = '$product_price', product_description = '$product_description', product_status = '$product_status' WHERE product_id = '$product_id'";

        if (!empty($_FILES['product_image']['name'])) {
            $fetchQuery = "SELECT product_image FROM products WHERE product_id = '$product_id'";
            $fetchResult = mysqli_query($con, $fetchQuery);

            if ($fetchResult && mysqli_num_rows($fetchResult) > 0) {
                $product = mysqli_fetch_assoc($fetchResult);
                $oldImage = $product['product_image'];
                $oldImagePath = "../assets/media/products/" . $oldImage;

                // Delete old image if it exists
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image_name = $_FILES['product_image']['name'];
            $image_tmp_name = $_FILES['product_image']['tmp_name'];
            $image_folder = "../../assets/media/products/" . $image_name;

            if (move_uploaded_file($image_tmp_name, $image_folder)) {
                $updateQuery = "UPDATE products SET product_name = '$product_name', product_price = '$product_price', product_description = '$product_description', product_image = '$image_name', product_status = '$product_status' WHERE product_id = '$product_id'";
            } else {
                $data['status'] = "error";
                $data['message'] = "Failed to upload new image.";
                echo json_encode($data);
                exit();
            }
        }

        $result = mysqli_query($con, $updateQuery);

        if ($result) {
            $data['status'] = "success";
            $data['message'] = "Product updated successfully.";
        } else {
            $data['status'] = "error";
            $data['message'] = "Error updating product.";
        }
    }
} else {
    $data['status'] = "error";
    $data['message'] = "Invalid request method.";
}

echo json_encode($data);
?>
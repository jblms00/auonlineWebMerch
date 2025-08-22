<?php
session_start();
include("database-connection.php");

header('Content-Type: application/json');

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $product_name = mysqli_real_escape_string($con, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($con, $_POST['product_price']);
    $product_description = mysqli_real_escape_string($con, $_POST['product_description']);

    // Validate input fields
    if (empty($product_name) || empty($product_price) || empty($product_description)) {
        $data['status'] = "error";
        $data['message'] = "All fields are required.";
    } elseif (!is_numeric($product_price) || $product_price <= 0) {
        $data['status'] = "error";
        $data['message'] = "Invalid product price.";
    } else {
        // Prepare base query
        $insertQuery = "INSERT INTO products (product_name, product_price, product_description";

        // Add image column to query if image is present
        if (!empty($_FILES['product_image']['name'])) {
            $image_name = mysqli_real_escape_string($con, $_FILES['product_image']['name']);
            $image_tmp_name = $_FILES['product_image']['tmp_name'];
            $image_folder = "../assets/media/products/" . $image_name;

            // Validate image file
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($_FILES['product_image']['type'], $allowed_types)) {
                $data['status'] = "error";
                $data['message'] = "Invalid image type. Only JPEG, PNG, and GIF are allowed.";
                echo json_encode($data);
                exit();
            }

            if (move_uploaded_file($image_tmp_name, $image_folder)) {
                $insertQuery .= ", product_image) VALUES ('$product_name', '$product_price', '$product_description', '$image_name')";
            } else {
                $data['status'] = "error";
                $data['message'] = "Failed to upload image.";
                echo json_encode($data);
                exit();
            }
        } else {
            $insertQuery .= ") VALUES ('$product_name', '$product_price', '$product_description')";
        }

        if (mysqli_query($con, $insertQuery)) {
            $data['status'] = "success";
            $data['message'] = "Product added successfully.";
        } else {
            $data['status'] = "error";
            $data['message'] = "Error adding product.";
        }
    }
} else {
    $data['status'] = "error";
    $data['message'] = "Invalid request method.";
}

echo json_encode($data);
?>
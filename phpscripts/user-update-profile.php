<?php
session_start();
include("database-connection.php");
include("check-login.php");

$user_data = check_login($con);
$logged_in_user = $user_data['user_id'];
$user_name = $user_data['user_name'];

$data = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_email = $_POST['user_email'];
    $user_number = $_POST['user_number'];

    if (empty($user_email) || empty($user_number)) {
        $data['status'] = "error";
        $data['message'] = "All fields are required";
    } else if (!ctype_digit($user_number)) {
        $data['status'] = "error";
        $data['message'] = "Phone number must contain only digits";
    } else {
        $user_email = mysqli_real_escape_string($con, $user_email);
        $user_number = mysqli_real_escape_string($con, $user_number);

        $update_profile_query = "
            UPDATE users_accounts SET 
            user_email = '$user_email',
            user_phone_number = '$user_number'
        ";

        if (isset($_FILES['user_photo']) && $_FILES['user_photo']['error'] == 0) {
            $allowed_exts = array("jpg", "jpeg", "png", "gif");
            $file_ext = strtolower(pathinfo($_FILES['user_photo']['name'], PATHINFO_EXTENSION));

            if (in_array($file_ext, $allowed_exts)) {
                $name_parts = explode(" ", strtoupper($user_name));
                $date = date("dmY-His");

                $file_name = implode("-", $name_parts) . "-$date.$file_ext";
                $file_path = "../assets/media/userProfile/" . $file_name;

                if (move_uploaded_file($_FILES['user_photo']['tmp_name'], $file_path)) {
                    $update_profile_query .= ", user_photo = '$file_name'";
                } else {
                    $data['status'] = "error";
                    $data['message'] = "Failed to upload photo";
                    echo json_encode($data);
                    exit;
                }
            } else {
                $data['status'] = "error";
                $data['message'] = "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed";
                echo json_encode($data);
                exit;
            }
        }

        $update_profile_query .= " WHERE user_id = '$logged_in_user'";
        $update_profile_result = mysqli_query($con, $update_profile_query);

        if ($update_profile_result) {
            $data['status'] = "success";
            $data['message'] = "Profile updated successfully";
        } else {
            $data['status'] = "error";
            $data['message'] = "Failed to update profile. Please try again later.";
        }
    }
} else {
    $data['status'] = "error";
    $data['message'] = "Invalid request method. Please try again later.";
}

echo json_encode($data);
?>
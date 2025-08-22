<?php
session_start();

include("../../phpscripts/database-connection.php");
include("../../phpscripts/check-login.php");
$user_data = check_login($con);
?>
<!doctype html>
<html lang="en">

<head>
    <?php include("../../includes/header.php"); ?>
</head>

<body class="user-index products-page">
    <?php include("../../includes/components/navbar.php"); ?>
    <section class="h-100 products-container" style="padding: 8rem 0;">
        <div class="container position-relative d-flex align-items-center">
            <div class="cards-container gap-5 animation-upwards"></div>
        </div>
    </section>
    <!-- Quantity Modal -->
    <div class="modal fade" id="quantityModal" tabindex="-1" aria-labelledby="quantityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="quantityModalLabel">Enter Quantity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="number" id="quantityInput" class="form-control" value="1" min="1" max="5">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary py-0" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary py-0" id="confirmAddToCart">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
    <?php include("../../includes/components/userComponents.php"); ?>
    <?php include("../../includes/scripts.php"); ?>
    <script src="../../assets/js/components/navbar.js"></script>
    <script src="../../assets/js/displayProducts.js"></script>
    <script src="../../assets/js/manageUserCart.js"></script>
    <script src="../../assets/js/updateUserProfile.js"></script>
</body>

</html>
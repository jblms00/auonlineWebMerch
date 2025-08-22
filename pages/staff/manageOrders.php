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

<body>
    <?php include("../../includes/components/navbar.php"); ?>
    <section class="admin-container" style="padding: 7.5rem 1rem;">
        <div class="container table-container">
            <div class="row">
                <div class="col">
                    <div class="animation-left">
                        <table class="display table table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg-primary-subtle">Product Order</th>
                                    <th class="bg-primary-subtle">Customer Name</th>
                                    <th class="bg-primary-subtle">Quantity</th>
                                    <th class="bg-primary-subtle">Total Price</th>
                                    <th class="bg-primary-subtle">Order Status</th>
                                    <th class="bg-primary-subtle">Date and Time Order</th>
                                    <th class="bg-primary-subtle">Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Toast -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast text-white bg-light" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body text-center">
                <p class="mb-0 fw-normal"></p>
            </div>
        </div>
    </div>
    <!-- Order Details Modal -->
    <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="orderDetailsContent">
                        <!-- Order details will be injected here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("../../includes/scripts.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../../assets/js/components/navbar.js"></script>
    <script defer src="../../assets/js/manageOrders.js"></script>
</body>

</html>
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
        <div class="container-fluid">
            <div class="row gap-3 mb-5">
                <div class="col-sm-6 col-xl animation-left">
                    <div class="bg-secondary-subtle rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa-solid fa-chart-pie fa-3x text-primary"></i>
                        <div class="ms-3 text-end">
                            <p class="mb-2 fw-semibold custom-color">Profit</p>
                            <h6 class="mb-0 fw-bold" id="profitCounts">₱0.00</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl animation-left">
                    <div class="bg-secondary-subtle rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa-solid fa-wallet fa-3x text-primary"></i>
                        <div class="ms-3 text-end">
                            <p class="mb-2 fw-semibold custom-color">Sales</p>
                            <h6 class="mb-0 fw-bold" id="todaySalesAmount">₱0.00</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl animation-right">
                    <div class="bg-secondary-subtle rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa-solid fa-paste fa-3x text-primary"></i>
                        <div class="ms-3 text-end">
                            <p class="mb-2 fw-semibold custom-color">Total Orders</p>
                            <h6 class="mb-0 fw-bold" id="totalOrders">0</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl animation-right">
                    <div class="bg-secondary-subtle rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa-solid fa-user fa-3x text-primary"></i>
                        <div class="ms-3 text-end">
                            <p class="mb-2 fw-semibold custom-color">Total Users</p>
                            <h6 class="mb-0 fw-bold" id="totalUsers">0</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card animation-left">
                        <div class="card-title p-2 m-0">
                            <h6 class="fw-bold mb-0">Orders</h6>
                        </div>
                        <hr class="divider m-0">
                        <div class="card-body pb-3">
                            <div id="ordersChart"></div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card animation-right">
                        <div class="card-title p-2 m-0">
                            <h6 class="fw-bold mb-0">Total Revenue</h6>
                        </div>
                        <hr class="divider m-0">
                        <div class="card-body pb-3">
                            <div id="revenueChart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include("../../includes/scripts.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../../assets/js/components/navbar.js"></script>
    <script src="../../assets/js/staffDashboard.js"></script>
</body>

</html>
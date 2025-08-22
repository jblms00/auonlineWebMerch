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

<body class="user-index">
    <?php include("../../includes/components/navbar.php"); ?>
    <section class="py-11 bg-light-gradient border-bottom border-white border-5">
        <div class="bg-holder overlay overlay-light"
            style="background-image:url(../../assets/media/header-bg.png);background-size:cover;"></div>
        <!--/.bg-holder-->
        <div class="container position-relative z-99">
            <div class="row flex-center">
                <div class="col-12 mb-10">
                    <div class="d-flex align-items-center flex-column">
                        <h1 class="fw-normal animation-left" style="font-size: 2.8rem;"> Just dropped &amp; never seen
                            before</h1>
                        <h2 class="fw-bold animation-right" style="font-size: 5rem;">Designed specially for you</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-0" id="header" style="margin-top: -23rem !important;">
        <div class="container">
            <div class="row g-0">
                <div class="col-md-6" data-aos="fade-up-right">
                    <div class="card card-span h-100 text-white animation-left" style="background: #414141;">
                        <img class="img-fluid" src="../../assets/media/products/AU-MERCH-PRODUCT-7-20240907195113.png"
                            width="790" alt="...">
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-up-left">
                    <div class="card card-span h-100 text-white animation-right">
                        <img class="img-fluid" src="../../assets/media/products/AU-MERCH-PRODUCT-8-20240907195113.png"
                            width="790" alt="...">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="p-5 position-relative flash-sale-container">
        <div class="container">
            <div class="row h-100 mb-2">
                <div class="col-lg-7 mx-auto text-center my-5" data-aos="zoom-out-up">
                    <h1 class="fw-bold lh-sm animation-left">Flash Sales</h1>
                </div>
            </div>
            <div
                class="cards-container d-flex flex-wrap justify-content-center align-item-center gap-4 animation-right">
            </div>
        </div>
    </section>
    <?php include("../../includes/components/userComponents.php"); ?>
    <?php include("../../includes/scripts.php"); ?>
    <script src="../../assets/js/components/navbar.js"></script>
    <script src="../../assets/js/components/flash-sale-cards.js"></script>
    <script src="../../assets/js/displayProducts.js"></script>
    <script src="../../assets/js/manageUserCart.js"></script>
    <script src="../../assets/js/updateUserProfile.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
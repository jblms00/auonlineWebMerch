<?php
if (
    strpos($_SERVER['REQUEST_URI'], '/admin/') !== false ||
    strpos($_SERVER['REQUEST_URI'], '/staff/') !== false
) {
    $cssClass = "-fluid";
} else {
    $cssClass = "";
}
?>

<nav id="navbar" class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block animation-downwards">
    <div class="container<?php echo $cssClass; ?>">
        <img src="../../assets/media/logo.png" class="mx-3" width="50" height="50" alt="img">
        <a class="navbar-brand" href="homepage">AU Merchandise Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php if (strpos($_SERVER['REQUEST_URI'], '/user/') !== false) { ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-3">
                        <a href="homepage" class="text-dark">
                            <i class="fa-solid fa-house-chimney"></i>
                        </a>
                    </li>
                    <li class="nav-item mx-3">
                        <a href="products" class="text-dark">
                            <i class="fa-solid fa-store"></i>
                        </a>
                    </li>
                    <li class="nav-item mx-3">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#myCart" class="text-dark my-cart">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                    </li>
                    <li class="nav-item mx-3">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalProfile" class="text-dark">
                            <i class="fa-regular fa-circle-user"></i>
                        </a>
                    </li>
                    <li class="nav-item mx-3">
                        <a href="../../phpscripts/user-logout.php" class="text-dark">
                            <i class="fa-solid fa-power-off"></i>
                        </a>
                    </li>
                </ul>
            <?php } else if (strpos($_SERVER['REQUEST_URI'], '/admin/') !== false) { ?>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-4">
                            <a href="manageUsers" class="text-dark text-decoration-none fs-6">
                                Manage Users
                            </a>
                        </li>
                        <li class="nav-item mx-4">
                            <a href="manageStaffs" class="text-dark text-decoration-none fs-6">
                                Manage Staffs
                            </a>
                        </li>
                        <li class="nav-item mx-4">
                            <a href="../../phpscripts/user-logout.php" class="text-dark text-decoration-none fs-6">
                                Logout
                            </a>
                        </li>
                    </ul>
            <?php } else if (strpos($_SERVER['REQUEST_URI'], '/staff/') !== false) { ?>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item mx-4">
                                <a href="dashboard" class="text-dark text-decoration-none fs-6">
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item mx-4">
                                <a href="manageOrders" class="text-dark text-decoration-none fs-6">
                                    Manage Orders
                                </a>
                            </li>
                            <li class="nav-item mx-4">
                                <a href="manageProducts" class="text-dark text-decoration-none fs-6">
                                    Manage Products
                                </a>
                            </li>
                            <li class="nav-item mx-4">
                                <a href="../../phpscripts/user-logout.php" class="text-dark text-decoration-none fs-6">
                                    Logout
                                </a>
                            </li>
                        </ul>
            <?php } ?>
        </div>
    </div>
</nav>
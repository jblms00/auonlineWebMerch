<?php
session_start();

include("phpscripts/database-connection.php");
include("phpscripts/check-login.php");
?>
<!doctype html>
<html lang="en">

<head>
    <?php include("includes/header.php"); ?>
</head>


<body>
    <svg class="bg-design animation-fade-in" preserveAspectRatio="xMidYMid slice" viewBox="10 10 80 80">
        <path fill="#0082cd" class="out-top"
            d="M37-5C25.1-14.7,5.7-19.1-9.2-10-28.5,1.8-32.7,31.1-19.8,49c15.5,21.5,52.6,22,67.2,2.3C59.4,35,53.7,8.5,37-5Z" />
        <path fill="#002866" class="in-top"
            d="M20.6,4.1C11.6,1.5-1.9,2.5-8,11.2-16.3,23.1-8.2,45.6,7.4,50S42.1,38.9,41,24.5C40.2,14.1,29.4,6.6,20.6,4.1Z" />
        <path fill="#004487" class="out-bottom"
            d="M105.9,48.6c-12.4-8.2-29.3-4.8-39.4.8-23.4,12.8-37.7,51.9-19.1,74.1s63.9,15.3,76-5.6c7.6-13.3,1.8-31.1-2.3-43.8C117.6,63.3,114.7,54.3,105.9,48.6Z" />
        <path fill="#2ea3f2" class="in-bottom"
            d="M102,67.1c-9.6-6.1-22-3.1-29.5,2-15.4,10.7-19.6,37.5-7.6,47.8s35.9,3.9,44.5-12.5C115.5,92.6,113.9,74.6,102,67.1Z" />
    </svg>
    <div class="main-container">
        <div class="registration-box animation-downwards">
            <div class="bg-image" style="padding: 0 10px;">
                <img src="assets/media/logo.png" alt="logo" width="200" height="200">
                <h2>Welcome to AU Merchandise Store</h2>
            </div>
            <div class="form-inner">
                <!-- Login Form -->
                <form class="registration-form needs-validation" id="formLogin" novalidate>
                    <h2 class="mb-5">Sign In</h2>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="userEmail" placeholder="name@example.com" required>
                        <label for="userEmail">Email address</label>
                        <div class="invalid-feedback">
                            Please provide a valid email.
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="userPassword" placeholder="Password" required>
                        <label for="userPassword">Password</label>
                        <div class="invalid-feedback">
                            Please enter your password.
                        </div>
                    </div>
                    <div class="form-check me-auto mb-3">
                        <input class="form-check-input" type="checkbox" value="" id="showPassword">
                        <label class="form-check-label" for="showPassword">Show Password</label>
                    </div>
                    <button type="submit" class="btn btn-warning mb-3">Login</button>
                    <div>
                        <p>Don't have an account? <span>
                                <a href="#" id="registerForm"
                                    class="text-decoration-none fw-semibold text-success">Register here.</a>
                            </span></p>
                    </div>
                </form>
                <!-- Registration Form Template (hidden) -->
                <form class="registration-form needs-validation d-none" id="formRegister" novalidate>
                    <h2 class="mb-5">Create Account</h2>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="fullName" placeholder="Full Name" required>
                        <label for="fullName">Full Name</label>
                        <div class="invalid-feedback">
                            Please provide your full name.
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="regEmail" placeholder="name@example.com" required>
                        <label for="regEmail">Email address</label>
                        <div class="invalid-feedback">
                            Please provide a valid email.
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="regPassword" placeholder="Password" required>
                        <label for="regPassword">Password</label>
                        <div class="invalid-feedback">
                            Please enter a password.
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password"
                            required>
                        <label for="confirmPassword">Confirm Password</label>
                        <div class="invalid-feedback">
                            Please confirm your password.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning mb-3">Register</button>
                    <div>
                        <p>Already have an account? <span>
                                <a href="#" id="loginForm" class="text-decoration-none fw-semibold text-success">Login
                                    here.</a>
                            </span></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include("includes/components/toast.php"); ?>
    <?php include("includes/scripts.php"); ?>
    <script src="assets/js/login.js"></script>
</body>

</html>
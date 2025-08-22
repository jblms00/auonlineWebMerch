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
                                    <th class="bg-primary-subtle">ID</th>
                                    <th class="bg-primary-subtle">Name</th>
                                    <th class="bg-primary-subtle">Email</th>
                                    <th class="bg-primary-subtle">Phone Number</th>
                                    <th class="bg-primary-subtle">Status</th>
                                    <th class="bg-primary-subtle">Date and Time Created</th>
                                    <th class="bg-primary-subtle">Action</th>
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
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary py-0" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger py-0" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <?php include("../../includes/scripts.php"); ?>
    <script src="../../assets/js/components/navbar.js"></script>
    <script defer src="../../assets/js/manageUsers.js"></script>
</body>

</html>
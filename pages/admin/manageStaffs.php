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
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProductForm">
                        <input type="hidden" id="editUserId">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="editUserName" placeholder="Name" readonly>
                            <label for="editUserName" class="form-label">Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="editUserEmail" placeholder="Email" readonly>
                            <label for="editUserEmail" class="form-label">Price</label>
                        </div>
                        <div class="form-floating">
                            <select class="form-select" id="editUserStatus" aria-label="User status">
                                <option selected disabled>Open this to select staff status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <label for="editUserStatus">Status</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary py-0" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary py-0" id="saveChangesBtn">Save changes</button>
                </div>
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
    <script defer src="../../assets/js/manageStaffs.js"></script>
</body>

</html>
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
            <div class="row mb-4 align-items-center">
                <div class="col animation-left">
                    <button type="button" class="btn btn-primary btn-add py-0">Add New</button>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="animation-left">
                        <table class="display table table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg-primary-subtle">Product</th>
                                    <th class="bg-primary-subtle">Product Name</th>
                                    <th class="bg-primary-subtle">Product Price</th>
                                    <th class="bg-primary-subtle">Date and Time Added</th>
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
    <!-- Add New Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProductForm" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="newProductName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="newProductName" required>
                        </div>
                        <div class="mb-3">
                            <label for="newProductPrice" class="form-label">Product Price</label>
                            <input type="number" class="form-control" id="newProductPrice" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="newProductDescription" class="form-label">Product Description</label>
                            <textarea class="form-control" id="newProductDescription" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="newProductImage" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="newProductImage" accept="image/*">
                            <img id="imagePreview" src="#" alt="Image Preview"
                                style="display: none; width: 100%; margin-top: 10px;">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveNewProductBtn">Save Product</button>
                </div>
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
                        <input type="hidden" id="editProductId">
                        <div class="form-floating mb-3 text-center p-2">
                            <img id="productImagePreview" class="object-fit-contain" src="" alt="Product Image"
                                height="200" width="200" style="background: #dadbdd;">
                        </div>
                        <div class="form-floating mb-3">
                            <input type="file" class="form-control" id="editProductImage">
                            <label for="editProductImage" class="form-label">Product Image</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="editProductName" placeholder="Product Name">
                            <label for="editProductName" class="form-label">Product Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="editProductPrice"
                                placeholder="Product Pricce">
                            <label for="editProductPrice" class="form-label">Price</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Leave a description here"
                                id="editProductDescription" style="height: 150px;"></textarea>
                            <label for="editProductDescription" class="form-label">Product Description</label>
                        </div>
                        <select class="form-select" id="editProductStatus" aria-label="Default select example">
                            <option selected>Select product Status</option>
                            <option value="Available">Available</option>
                            <option value="Sold Out">Sold Out</option>
                            <option value="Limited Stock">Limited Stock</option>
                        </select>
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
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../../assets/js/components/navbar.js"></script>
    <script defer src="../../assets/js/manageProducts.js"></script>
</body>

</html>
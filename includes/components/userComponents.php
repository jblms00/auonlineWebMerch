<!-- Toast -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast text-white bg-light" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-center">
            <p class="mb-0 fw-normal"></p>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myCart" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="cartTab" data-bs-toggle="tab" data-bs-target="#cart"
                            type="button" role="tab" aria-controls="cart" aria-selected="true">My Cart</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="ordersTab" data-bs-toggle="tab" data-bs-target="#orders"
                            type="button" role="tab" aria-controls="orders" aria-selected="false">My Orders</button>
                    </li>
                </ul>
                <div class="tab-content pt-3" id="myTabContent">
                    <!-- Cart Tab -->
                    <div class="tab-pane fade show active" id="cart" role="tabpanel" aria-labelledby="cart-tab">
                        <div class="table-container text-center">
                            <h4 class="mb-4">My Cart</h4>
                            <table class="table table-responsive table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <div class="alert alert-success w-25 m-auto mb-2 py-1" role="alert">
                                Sub Total: <span id="subTotal" class="fw-bold">₱0.00</span>
                            </div>
                            <button type="button" role="button"
                                class="btn btn-success checkout my-2 py-0 w-25 d-none">Checkout</button>
                        </div>
                    </div>
                    <!-- Orders Tab -->
                    <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                        <div class="order-container text-center">
                            <h4 class="mb-4">My Orders</h4>
                            <table id="orderList" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Product Name & Quantity</th>
                                        <th>Total Price</th>
                                        <th>Order Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCheckout" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <div id="productOrder"></div>
                <div class="alert alert-success w-25 m-auto mb-3 py-1 text-center w-50" role="alert">
                    Total: <span id="totalPrice" class="fw-bold">₱0.00</span>
                </div>
                <div class="customer-details my-4">
                    <!-- Billing details -->
                    <div class="row mb-2">
                        <div class="col">
                            <h4 class="fw-bold mb-0">Billing details</h4>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <p class="fw-semibold mb-0">Full Name <span class="text-danger">*</span></p>
                            <input type="text" id="userName" name="userName"
                                value="<?php echo $user_data['user_name']; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <p class="fw-semibold mb-0">Email <span class="text-danger">*</span></p>
                            <input type="text" id="userEmail" name="userEmail"
                                value="<?php echo $user_data['user_email']; ?>">
                        </div>
                        <div class="col">
                            <p class="fw-semibold mb-0">Phone Number <span class="text-danger">*</span></p>
                            <input type="text" id="phoneNumber" name="phoneNumber"
                                value="<?php echo $user_data['user_phone_number'] === '0' ? '' : htmlspecialchars($user_data['user_phone_number']); ?>">
                        </div>
                    </div>
                    <!-- GCash QR Code -->
                    <div class="row" id="gcashStore" style="display: none;">
                        <div class="col text-center">
                            <img src="../../assets/media/gcash-qrcode.jpg" alt="img" width="350" height="100%">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <p class="fw-semibold mb-0">Payment Method <span class="text-danger">*</span></p>
                            <select class="form-select" id="paymentType" name="paymentType"
                                aria-label="Default select example">
                                <option selected disabled>Please select payment type</option>
                                <option value="gcash">GCash</option>
                                <option value="cash on pickup">Cash On Pickup</option>
                            </select>
                        </div>
                    </div>
                    <!-- Reference Number and GCash Receipt -->
                    <div class="row mb-3" id="gcashFields" style="display: none;">
                        <div class="col">
                            <p class="fw-semibold mb-0">Reference Number <span class="text-danger">*</span></p>
                            <input type="text" id="userReferenceNumber" name="userReferenceNumber">
                        </div>
                    </div>
                    <div class="row mb-3" id="receiptField" style="display: none;">
                        <div class="col">
                            <p class="fw-semibold mb-0">Screenshot of Receipt <span class="text-danger">*</span></p>
                            <input type="file" id="gcashReceipt" name="gcashReceipt">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" role="button" class="btn btn-success place-order w-50 m-auto my-2 py-0">Place
                Order</button>
        </div>
    </div>
</div>
<div class="modal fade" id="modalProfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-profile">
            <div class="modal-header border-0">
                <h5 class="modal-title mb-0">My Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <div class="row mb-4 align-items-center">
                    <div class="col-4">
                        <img src="../../assets/media/userProfile/<?php echo $user_data['user_photo']; ?>"
                            id="profileImg" height="150px" width="150px" class="rounded object-fit-cover rounded-circle"
                            alt="img">
                    </div>
                    <div class="col">
                        <h6>Upload Image</h6>
                        <input type="file" class="form-control" id="editUserPhoto"
                            value="<?php echo $user_data['user_photo']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <h6>Name</h6>
                        <input type="text" class="form-control" id="editUserName"
                            value="<?php echo $user_data['user_name']; ?>">
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col">
                        <h6>Email Address</h6>
                        <input type="email" class="form-control" id="editUserEmail"
                            value="<?php echo $user_data['user_email']; ?>" disabled>
                    </div>
                    <div class="col">
                        <h6>Phone Number</h6>
                        <input type="tel" class="form-control" id="editUserPhoneNumber"
                            value="<?php echo $user_data['user_phone_number'] === '0' ? '' : htmlspecialchars($user_data['user_phone_number']); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <button type="button" role="button" class="btn btn-warning text-light w-100"
                            data-bs-toggle="modal" data-bs-target="#modalChangePassword">Change Password</button>
                    </div>
                    <div class="col text-center">
                        <button type="button" role="button"
                            class="btn btn-primary text-light update-profile w-100">Update Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalChangePassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-changepass">
            <div class="modal-header p-3 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="font-size: 13px;"></button>
            </div>
            <div class="modal-body edit-info">
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="userOldPassword" placeholder="password">
                            <label for="userOldPassword">Old Password</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="userNewPassword" placeholder="password">
                            <label for="userNewPassword">New Password</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="userConfirmPassword" placeholder="password">
                            <label for="userConfirmPassword">Confirm New Password</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <button type="button" role="button" class="btn btn-success w-50 change-password">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
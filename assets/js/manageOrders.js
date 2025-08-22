$(document).ready(function () {
    var table = $(".table-container table").DataTable({
        autoWidth: false,
        columnDefs: [
            { width: "10%", targets: 0 },
            { width: "15%", targets: 1 },
            { width: "10%", targets: 2 },
            { width: "10%", targets: 3 },
            { width: "10%", targets: 4 },
            { width: "20%", targets: 5 },
            { width: "20%", targets: 6 },
        ],
        destroy: true,
    });

    displayOrders(table);
    fetchOrderDetails();

    // Handle status change
    $(".table-container").on("change", ".form-select", function () {
        var orderId = $(this).data("order-id");
        var newStatus = $(this).val();

        console.log(newStatus);
        console.log(orderId);

        $.ajax({
            url: "../../phpscripts/update-order-status.php",
            method: "POST",
            data: {
                order_id: orderId,
                order_status: newStatus,
            },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    displayOrders(table);
                    $("#liveToast .toast-body p")
                        .text(response.message)
                        .addClass("text-success")
                        .removeClass("text-danger");
                    $("#liveToast").toast("show");
                } else {
                    $("#liveToast .toast-body p")
                        .text(response.message)
                        .addClass("text-danger")
                        .removeClass("text-success");
                    $("#liveToast").toast("show");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error:", textStatus, errorThrown);
            },
        });
    });
});

function displayOrders(table) {
    $.ajax({
        url: "../../phpscripts/fetch-orders.php",
        method: "GET",
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                var tableData = response.orders.map(function (order) {
                    var formattedPrice = parseFloat(order.total_price).toFixed(
                        2
                    );
                    var formattedDate = formatDateTime(order.order_at);

                    var statusClass;
                    switch (order.order_status) {
                        case "pending":
                            statusClass =
                                "badge bg-warning text-dark text-uppercase";
                            break;
                        case "accepted":
                            statusClass =
                                "badge bg-warning text-dark text-uppercase";
                            break;
                        case "processing":
                            statusClass = "badge bg-info text-uppercase";
                            break;
                        case "completed":
                            statusClass = "badge bg-success text-uppercase";
                            break;
                        case "cancelled":
                            statusClass = "badge bg-danger text-uppercase";
                            break;
                        default:
                            statusClass = "badge bg-primary text-uppercase";
                    }

                    return [
                        `<img src='../../assets/media/products/${order.product_image}' style="background: #dadbdd;" height="150" width="150">`,
                        order.user_name,
                        order.quantity,
                        "₱" + formattedPrice,
                        `<span class="badge ${statusClass}">${order.order_status}</span>`,
                        formattedDate,
                        `<div class="d-flex gap-3 align-items-center flex-column">
                            <select class="form-select" data-order-id="${order.order_id}" aria-label="Default select example">
                                <option selected disabled>Please update order status</option>
                                <option value="pending">Pending</option>
                                <option value="accepted">Accepted</option>
                                <option value="processing">Processing</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                            <button type="button" class="btn btn-primary view-details py-0 w-50" data-order-id="${order.order_id}">View Details</buton>
                        </div>`,
                    ];
                });

                table.clear().rows.add(tableData).draw();
            } else {
                console.error("Error fetching orders:", response.message);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("AJAX Error:", textStatus, errorThrown);
        },
    });
}

function fetchOrderDetails() {
    $(".table-container").on("click", ".view-details", function () {
        var orderId = $(this).data("order-id");

        $.ajax({
            url: "../../phpscripts/fetch-order-details.php",
            method: "GET",
            data: { order_id: orderId },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    var order = response.order;
                    var formattedPrice = parseFloat(order.total_price).toFixed(
                        2
                    );
                    var formattedDate = formatDateTime(order.order_at);

                    var gcashClass =
                        order.payment_type !== "gcash" ? "d-none" : "";

                    var content = `
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" value="${
                                        order.order_id
                                    }" disabled>
                                    <label>Order ID</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" value="${formattedDate}" disabled>
                                    <label>Order At</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" value="${
                                        order.quantity
                                    }" disabled>
                                    <label>Order Quantity</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" value="${formattedPrice}" disabled>
                                    <label>Total Price</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" value="${
                                        order.user_name
                                    }" disabled>
                                    <label>Customer Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" value="${
                                        order.user_email
                                    }" disabled>
                                    <label>Customer Email</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" value="${
                                        order.user_phone_number
                                    }" disabled>
                                    <label>Customer Phone Number</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" value="${capitalizeFirstLetter(
                                        order.order_status
                                    )}" disabled>
                                    <label>Order Status</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" value="${capitalizeFirstLetterOfEachWord(
                                        order.payment_type
                                    )}" disabled>
                                    <label>Payment Type</label>
                                </div>
                            </div>
                            <div class="col ${gcashClass}">
                                <div class="form-floating">
                                    <input type="text" class="form-control" value="${
                                        order.gcash_reference_number
                                    }" disabled>
                                    <label>GCASH Reference Number</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col text-center">
                                <div>Product Order</div>
                                <img src='../../assets/media/products/${
                                    order.product_image
                                }' class="object-fit-contain" style="background: #dadbdd;" height="200" width="200">
                            </div>
                            <div class="col text-center ${gcashClass}">
                                <div>GCASH Receipt</div>
                                <img src='../../assets/media/gcashPayments/${
                                    order.gcash_image_receipt
                                }' class="object-fit-contain" height="200" width="200">
                            </div>
                        </div>
                    `;
                    $("#orderDetailsContent").html(content);
                    $("#orderDetailsModal").modal("show");
                } else {
                    console.error(
                        "Error fetching order details:",
                        response.message
                    );
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error:", textStatus, errorThrown);
            },
        });
    });
}

function formatDateTime(datetimeString) {
    var date = new Date(datetimeString);
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? "PM" : "AM";
    hours = hours % 12;
    hours = hours ? hours : 12;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    var timeStr = hours + ":" + minutes + " " + ampm;
    var day = date.getDate();
    var month = date.toLocaleString("default", { month: "long" });
    var year = date.getFullYear();
    return timeStr + " - " + month + " " + day + ", " + year;
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function capitalizeFirstLetterOfEachWord(str) {
    return str.replace(/\b\w/g, function (char) {
        return char.toUpperCase();
    });
}

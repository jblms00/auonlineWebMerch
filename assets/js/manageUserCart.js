$(document).ready(function () {
	displayUserCart();
	displayUserOrders();
	checkoutCart();

	$("#myCart").on("hidden.bs.modal", function () {
		var tab = new bootstrap.Tab($("#cartTab")[0]);
		tab.show();

		$("#myCart .modal-body").find("tbody").empty();
		$("#myCart .modal-body").find(".alert").addClass("d-none");
		$("#myCart .modal-body").find(".checkout").addClass("d-none");
	});

	$("#modalCheckout").on("hidden.bs.modal", function () {
		$("#productOrder").empty();
	});

	$("#paymentType").change(function () {
		var paymentType = $(this).val();
		if (paymentType === "gcash") {
			$("#gcashFields, #receiptField, #gcashStore").show();
		} else {
			$("#gcashFields, #receiptField, #gcashStore").hide();
		}
	});

	$("#gcashReceipt").change(function (e) {
		var file = e.target.files[0];
		var reader = new FileReader();

		reader.onload = function (event) {
			$("#proofReceipt")
				.attr("src", event.target.result)
				.removeClass("d-none");
		};

		reader.readAsDataURL(file);
	});

	$("#cartTab").on("click", function () {
		displayUserCart();
	});

	$("#ordersTab").on("click", function () {
		displayUserOrders();
	});
});

function displayUserCart() {
	$(document).on("click", ".my-cart", function () {
		var tableBody = $("#myCart").find("tbody");

		$.ajax({
			method: "GET",
			url: "../../phpscripts/display-user-cart.php",
			dataType: "json",
			success: function (response) {
				tableBody.empty();

				if (
					response.status === "success" &&
					response.user_cart.length > 0
				) {
					response.user_cart.forEach(function (cart) {
						$("#subTotal").closest(".alert").removeClass("d-none");
						$("#myCart").find("button.checkout").removeClass("d-none");

						var totalPrice =
							parseFloat(cart.product_price) * parseInt(cart.quantity);

						switch (cart.product_status) {
							case "Available":
								badgeClass = "text-bg-success";
								break;
							case "Sold Out":
								badgeClass = "text-bg-danger";
								break;
							case "Limited Stock":
								badgeClass = "text-bg-warning";
								break;
							default:
								badgeClass = "text-bg-secondary";
								break;
						}

						var row = `
                        <tr>
                            <td>
                                <input type="checkbox" class="selectProduct" data-product-id="${
												cart.product_id
											}" data-cart-id="${cart.cart_id}">
                            </td>
                            <td class="image"><img src="../../assets/media/products/${
											cart.product_image
										}" alt="img" width="100" height="100"></td>
                            <td class="name">${cart.product_name}</td>
                            <td class="qty">${cart.quantity}</td>
                            <td class="price">₱${formattedPrice(
											totalPrice
										)}</td>
                            <td class="status"><span class="badge ${badgeClass}" style="font-size: 13px;">${
							cart.product_status
						}</span></td>
                        </tr>`;

						console.log(cart.product_status);

						tableBody.append(row);
					});

					$(".selectProduct").change(function () {
						calculateSubtotal();
					});
				} else {
					tableBody.html(
						`<tr><td colspan="7">Your cart is currently empty.</td></tr>`
					);
					$("#subTotal").closest(".alert").addClass("d-none");
				}
			},
			error: function (xhr, status, error) {
				console.log(error);
			},
		});
	});
}

function displayUserOrders() {
	$.ajax({
		method: "GET",
		url: "../../phpscripts/display-user-orders.php",
		dataType: "json",
		success: function (response) {
			var orderList = $("#orderList tbody");
			orderList.empty();

			if (response.status === "success" && response.user_orders.length > 0) {
				response.user_orders.forEach(function (order) {
					$("#subTotal").closest(".alert").removeClass("d-none");
					$("#myCart").find("button.checkout").removeClass("d-none");

					var statusClass;
					switch (order.order_status) {
						case "pending":
							statusClass = "badge bg-warning text-dark";
							break;
						case "accepted":
							statusClass = "badge bg-warning text-dark";
							break;
						case "processing":
							statusClass = "badge bg-info";
							break;
						case "completed":
							statusClass = "badge bg-success";
							break;
						case "cancelled":
							statusClass = "badge bg-danger";
							break;
						default:
							statusClass = "badge bg-primary";
					}

					var row = `
                        <tr>
                            <td class="image"><img src="../../assets/media/products/${
											order.product_image
										}" alt="img" width="100" height="100"></td>
                            <td class="name">${
											order.product_name
										}<span class="mx-3"><i class="fa-solid fa-xmark"></i></span>${
						order.quantity
					}</td>
                            <td class="price">₱${formattedPrice(
											order.total_price
										)}</td>
                            <td class="qty">${formatDateTime(
											order.order_at
										)}</td>
                            <td class="status">
                                <span class="badge ${statusClass}">${capitalizeFirstLetter(
						order.order_status
					)}</span>
                            </td>
                        </tr>
                    `;
					orderList.append(row);
				});
			} else {
				orderList.html(
					`<tr><td colspan="7">You haven’t placed any orders yet.</td></tr>`
				);
			}
		},
		error: function (xhr, status, error) {
			console.log(error);
		},
	});
}

function checkoutCart() {
	$(document).on("click", ".checkout", function () {
		var selectedProducts = [];
		var totalPrice = 0;
		var soldOutItems = [];

		$(".selectProduct:checked").each(function () {
			var productId = $(this).data("product-id");
			var cartId = $(this).data("cart-id");
			var name = $(this).closest("tr").find(".name").text();
			var quantity = parseInt($(this).closest("tr").find(".qty").text());
			var priceString = $(this).closest("tr").find(".price").text();
			var price = parseFloat(priceString.replace("₱", "").replace(",", ""));
			var option = $(this).closest("tr").find(".option").text();
			var image = $(this).closest("tr").find(".image").html();
			var productStatus = $(this)
				.closest("tr")
				.find(".status .badge")
				.text();

			if (productStatus === "Sold Out") {
				soldOutItems.push(name);
			}

			selectedProducts.push({
				productId: productId,
				cartId: cartId,
				name: name,
				quantity: quantity,
				price: price,
				option: option,
				image: image,
			});

			totalPrice += price;
		});

		if (soldOutItems.length > 0) {
			var soldOutMessage = `The following items are sold out and cannot be checked out: ${soldOutItems.join(
				", "
			)}.`;
			$("#liveToast .toast-body p")
				.text(soldOutMessage)
				.addClass("text-danger");
			var toast = new bootstrap.Toast(document.getElementById("liveToast"));
			toast.show();
			return;
		}

		if (selectedProducts.length === 0) {
			$("#liveToast .toast-body p")
				.text("Please select at least one product to checkout.")
				.addClass("text-danger");
			var toast = new bootstrap.Toast(document.getElementById("liveToast"));
			toast.show();
			return;
		}

		var orderHtml = `
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
        `;

		selectedProducts.forEach(function (product) {
			orderHtml += `
                <tr data-cart-id="${product.cartId}">
                    <td>${product.image}</td>
                    <td>${product.name}</td>
                    <td>${product.quantity}</td>
                    <td>₱${formattedPrice(product.price)}</td>
                </tr>
            `;
		});
		orderHtml += `
                    </tbody>
                </table>
            </div>
        `;

		$("#productOrder").html(orderHtml);
		$("#totalPrice").text("₱" + formattedPrice(totalPrice));
		$("#modalCheckout").modal("show");
		$("#myCart").modal("hide");
	});

	$(document).on("click", ".place-order", function () {
		var userName = $("#userName").val();
		var userEmail = $("#userEmail").val();
		var phoneNumber = $("#phoneNumber").val();
		var paymentType = $("#paymentType").val();
		var gcashReferenceNumber = $("#userReferenceNumber").val();
		var totalPrice = parseFloat(
			$("#totalPrice").text().replace("₱", "").replace(",", "")
		);

		var gcashReceipt = $("#gcashReceipt")[0].files[0];

		var selectedProducts = [];
		$("#modalCheckout tbody tr").each(function () {
			var productId = $(this).find(".selectProduct").data("product-id");
			var cartId = $(this).data("cart-id");

			selectedProducts.push({
				productId: productId,
				cartId: cartId,
			});
		});

		var formData = new FormData();
		formData.append("userName", userName);
		formData.append("userEmail", userEmail);
		formData.append("phoneNumber", phoneNumber);
		formData.append("paymentType", paymentType);
		formData.append("gcashReferenceNumber", gcashReferenceNumber);
		formData.append("totalPrice", totalPrice);
		formData.append("gcashReceipt", gcashReceipt);
		formData.append("products", JSON.stringify(selectedProducts));

		$.ajax({
			method: "POST",
			url: "../../phpscripts/user-placeorder.php",
			data: formData,
			processData: false,
			contentType: false,
			success: function (response) {
				try {
					response = JSON.parse(response);
				} catch (e) {
					console.error("Error parsing JSON response:", e);
					return;
				}

				if (response.status === "success") {
					$("#modalCheckout").modal("hide");

					$("#liveToast .toast-body p")
						.text(response.message)
						.addClass("text-success")
						.removeClass("text-danger");
					var toast = new bootstrap.Toast(
						document.getElementById("liveToast")
					);
					toast.show();

					setTimeout(function () {
						location.reload();
					}, 3000);
				} else {
					$("#liveToast .toast-body p")
						.text(response.message)
						.addClass("text-danger")
						.removeClass("text-success");
					var toast = new bootstrap.Toast(
						document.getElementById("liveToast")
					);
					toast.show();
				}
			},
			error: function (xhr, status, error) {
				console.error("AJAX error:", status, error);
			},
		});
	});
}

function calculateSubtotal() {
	var subtotal = 0;

	$(".selectProduct:checked").each(function () {
		var priceString = $(this).closest("tr").find(".price").text();
		var price = parseFloat(priceString.replace("₱", "").replace(",", ""));

		subtotal += price;
	});

	$("#subTotal").text("₱" + formattedPrice(subtotal));
}

function formattedPrice(price) {
	return Number(price).toLocaleString("en-PH", {
		minimumFractionDigits: 2,
		maximumFractionDigits: 2,
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

var table = $(".table-container table");

$(document).ready(function () {
	table.DataTable({
		autoWidth: false,
		columnDefs: [
			{ width: "20%", targets: 0 },
			{ width: "20%", targets: 1 },
			{ width: "20%", targets: 2 },
			{ width: "20%", targets: 3 },
			{ width: "10%", targets: 4 },
		],
		destroy: true,
	});

	displayProducts();

	$("#saveChangesBtn").on("click", function () {
		saveProductChanges();
	});

	$("#confirmDeleteBtn").on("click", function () {
		confirmProductDeletion();
	});

	$(".btn-add").on("click", function () {
		$("#addProductModal").modal("show");
	});

	$("#saveNewProductBtn").on("click", function () {
		addNewProduct();
	});

	$("#newProductImage").on("change", function () {
		var file = this.files[0];
		if (file) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$("#imagePreview").attr("src", e.target.result).show();
			};
			reader.readAsDataURL(file);
		} else {
			$("#imagePreview").hide();
		}
	});

	// Reset modals when they are hidden
	$("#addProductModal").on("hidden.bs.modal", function () {
		resetAddProductModal();
	});

	$("#editModal").on("hidden.bs.modal", function () {
		resetEditModal();
	});

	$("#deleteModal").on("hidden.bs.modal", function () {
		resetDeleteModal();
	});
});

function displayProducts() {
	$.ajax({
		url: "../../phpscripts/fetch-product.php",
		type: "GET",
		dataType: "json",
		success: function (response) {
			var table = $(".table-container table").DataTable(); // Get DataTable instance
			table.clear(); // Clear existing data

			if (response.status === "success") {
				if (response.products.length === 0) {
					table.row
						.add([
							'<td colspan="5" class="text-center text-danger">No data found</td>',
						])
						.draw();
				} else {
					response.products.forEach(function (product) {
						var formattedPrice = parseFloat(
							product.product_price
						).toFixed(2);
						var formattedDate = formatDateTime(product.datetime_added);

						table.row
							.add([
								`<img src="../../assets/media/products/${product.product_image}" style="background: #dadbdd;" height="150" width="150">`,
								product.product_name,
								`₱${formattedPrice}`,
								formattedDate,
								`<button type="button" class="btn btn-warning py-0" data-product-id="${product.product_id}">
                                <i class="fa-regular fa-pen-to-square"></i>
                             </button>
                             <button type="button" class="btn btn-danger py-0" data-product-id="${product.product_id}">
                                <i class="fa-solid fa-trash-can"></i>
                             </button>`,
							])
							.draw();
					});

					$(".btn-warning").on("click", function () {
						var productId = $(this).data("product-id");
						openEditModal(productId);
					});

					$(".btn-danger").on("click", function () {
						var productId = $(this).data("product-id");
						openDeleteModal(productId);
					});
				}
			} else {
				console.error(response.message);
			}
		},
		error: function (xhr, status, error) {
			console.error("An error occurred: " + error);
		},
	});
}

function openEditModal(productId) {
	$.ajax({
		url: "../../phpscripts/get-product.php",
		type: "POST",
		data: { productId: productId },
		dataType: "json",
		success: function (response) {
			if (response.status === "success") {
				var product = response.product[0];
				$("#editProductId").val(product.product_id);
				$("#editProductName").val(product.product_name);
				$("#editProductPrice").val(product.product_price);
				$("#editProductDescription").val(product.product_description);
				$("#editProductStatus").val(product.product_status);

				var imagePath =
					"../../assets/media/products/" + product.product_image;
				$("#productImagePreview").attr("src", imagePath);

				$("#editModal").modal("show");

				$("#editProductImage").on("change", function () {
					var reader = new FileReader();
					reader.onload = function (e) {
						$("#productImagePreview").attr("src", e.target.result);
					};
					reader.readAsDataURL(this.files[0]);
				});
			} else {
				console.error(response.message);
			}
		},
		error: function (xhr, status, error) {
			console.error(error);
		},
	});
}

function openDeleteModal(productId) {
	$("#confirmDeleteBtn").data("product-id", productId);
	$("#deleteModal").modal("show");
}

function addNewProduct() {
	var productName = $("#newProductName").val();
	var productPrice = $("#newProductPrice").val();
	var productDescription = $("#newProductDescription").val();
	var productImage = $("#newProductImage")[0].files[0];

	var formData = new FormData();
	formData.append("product_name", productName);
	formData.append("product_price", productPrice);
	formData.append("product_description", productDescription);
	if (productImage) {
		formData.append("product_image", productImage);
	}

	$.ajax({
		url: "../../phpscripts/add-product.php",
		type: "POST",
		data: formData,
		processData: false,
		contentType: false,
		success: function (response) {
			if (response.status === "success") {
				$("#addProductModal").modal("hide");
				displayProducts();
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
		error: function (xhr, status, error) {
			console.error(error);
		},
	});
}

function saveProductChanges() {
	var productId = $("#editProductId").val();
	var productName = $("#editProductName").val();
	var productPrice = $("#editProductPrice").val();
	var productDescription = $("#editProductDescription").val();
	var productStatus = $("#editProductStatus").val();
	var productImage = $("#editProductImage")[0].files[0];

	var formData = new FormData();
	formData.append("product_id", productId);
	formData.append("product_name", productName);
	formData.append("product_price", productPrice);
	formData.append("product_description", productDescription);
	formData.append("product_status", productStatus);
	if (productImage) {
		formData.append("product_image", productImage);
	}

	$.ajax({
		url: "../../phpscripts/update-product.php",
		type: "POST",
		data: formData,
		processData: false,
		contentType: false,
		success: function (response) {
			if (response.status === "success") {
				$("#editModal").modal("hide");
				displayProducts();
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
		error: function (xhr, status, error) {
			console.error(error);
		},
	});
}

function confirmProductDeletion() {
	var productId = $("#confirmDeleteBtn").data("product-id");

	$.ajax({
		url: "../../phpscripts/delete-product.php",
		type: "POST",
		data: { product_id: productId },
		dataType: "json",
		success: function (response) {
			if (response.status === "success") {
				$("#deleteModal").modal("hide");
				displayProducts();
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
		error: function (xhr, status, error) {
			console.error(error);
		},
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

function resetAddProductModal() {
	$("#newProductName").val("");
	$("#newProductPrice").val("");
	$("#newProductDescription").val("");
	$("#newProductImage").val("");
	$("#imagePreview").hide();
}

function resetEditModal() {
	$("#editProductId").val("");
	$("#editProductName").val("");
	$("#editProductPrice").val("");
	$("#editProductDescription").val("");
	$("#editProductImage").val("");
	$("#productImagePreview").attr("src", "");
}

function resetDeleteModal() {
	$("#confirmDeleteBtn").removeData("product-id");
}

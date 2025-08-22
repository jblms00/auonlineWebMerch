var table = $(".table-container table");

$(document).ready(function () {
	table.DataTable({
		autoWidth: false,
		columnDefs: [
			{ width: "2%", targets: 0 },
			{ width: "20%", targets: 1 },
			{ width: "20%", targets: 2 },
			{ width: "20%", targets: 3 },
			{ width: "20%", targets: 4 },
			{ width: "20%", targets: 5 },
			{ width: "10%", targets: 6 },
		],
		destroy: true,
		language: {
			emptyTable: "No data available in the table",
		},
	});

	displayUsers();
	deleteAccount();
});

function displayUsers() {
	$.ajax({
		url: "../../phpscripts/fetch-users.php",
		type: "GET",
		dataType: "json",
		success: function (response) {
			var table = $(".table-container table").DataTable(); // Get DataTable instance
			table.clear(); // Clear existing data

			if (response.status === "success") {
				if (response.users.length === 0) {
					table.row
						.add([
							'<td colspan="5" class="text-center text-danger">No data found</td>',
						])
						.draw();
				} else {
					response.users.forEach(function (user) {
						var formattedDate = formatDateTime(user.datetime_created);

						table.row
							.add([
								user.user_id,
								user.user_name,
								user.user_email,
								user.user_phone_number,
								capitalizeFirstLetter(user.account_status),
								formattedDate,
								`<button type="button" class="btn btn-danger py-0" data-user-id="${user.user_id}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>`,
							])
							.draw();
					});

					$(".btn-danger").on("click", function () {
						var userId = $(this).data("user-id");
						openDeleteModal(userId);
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

function openDeleteModal(userId) {
	$("#confirmDeleteBtn").data("user-id", userId);
	$("#deleteModal").modal("show");
}

function deleteAccount() {
	$(document).on("click", "#confirmDeleteBtn", function () {
		var user_id = $(this).data("user-id");

		$.ajax({
			url: "../../phpscripts/delete-user.php",
			type: "POST",
			data: { user_id: user_id },
			dataType: "json",
			success: function (response) {
				if (response.status === "success") {
					$("#liveToast .toast-body p")
						.text(response.message)
						.addClass("text-success")
						.removeClass("text-danger");
					$("#liveToast").toast("show");

					$("#deleteModal").modal("hide");
					displayUsers();
				} else {
					$("#liveToast .toast-body p")
						.text(response.message)
						.addClass("text-danger")
						.removeClass("text-success");
					$("#liveToast").toast("show");
				}
			},
			error: function (xhr, status, error) {
				console.error("An error occurred: " + error);
			},
		});
	});
}

function capitalizeFirstLetter([first = "", ...rest]) {
	return [first.toUpperCase(), ...rest].join("");
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

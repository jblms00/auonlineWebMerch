$(document).ready(function () {
	userLogin();
	userRegister();

	$("#showPassword").on("click", function () {
		var passwordInput = $("#userPassword");
		var type =
			passwordInput.attr("type") === "password" ? "text" : "password";
		passwordInput.attr("type", type);
	});

	$("#registerForm").on("click", function (event) {
		event.preventDefault();
		$("#formLogin").addClass("d-none");
		$("#formRegister").removeClass("d-none");
		$("#formLogin").removeClass("was-validated");
		$("#formLogin .invalid-feedback").remove();
		$(".registration-box").css("height", "65vh");
	});

	$("#loginForm").on("click", function (event) {
		event.preventDefault();
		$("#formRegister").addClass("d-none");
		$("#formLogin").removeClass("d-none");
		$("#formRegister").removeClass("was-validated");
		$("#formRegister .invalid-feedback").remove();
		$(".registration-box").css("height", "50vh");
	});
});

function userLogin() {
	$(document).on("submit", "#formLogin", function (event) {
		event.preventDefault();
		var form = $(this);

		if (!form[0].checkValidity()) {
			event.stopPropagation();
			form.addClass("was-validated");
			return;
		}

		var userEmail = form.find("#userEmail").val();
		var userPassword = form.find("#userPassword").val();

		$.ajax({
			method: "POST",
			url: "phpscripts/user-login.php",
			data: { userEmail, userPassword },
			dataType: "json",
			success: function (response) {
				if (response.status === "success") {
					$("#liveToast .toast-body p")
						.text(response.message)
						.addClass("text-success")
						.removeClass("text-danger");
					$("#liveToast").toast("show");

					$("button, input").prop("disabled", true);
					$("a")
						.addClass("disabled")
						.on("click", function (e) {
							e.preventDefault();
						});

					var fadeOutDuration = 3000;

					setTimeout(function () {
						if (response.user_type === "user") {
							window.location.href = "pages/user/homepage";
						} else if (response.user_type === "admin") {
							window.location.href = "pages/admin/manageUsers";
						} else if (response.user_type === "staff") {
							window.location.href = "pages/staff/dashboard";
						} else {
							$("#liveToast .toast-body p")
								.text(response.message)
								.addClass("text-danger")
								.removeClass("text-success");
							$("#liveToast").toast("show");
						}
					}, fadeOutDuration);
				} else {
					$("#liveToast .toast-body p")
						.text(response.message)
						.addClass("text-danger")
						.removeClass("text-success");
					$("#liveToast").toast("show");
				}
			},
			error: function (xhr, status, error) {
				$("#liveToast .toast-body p")
					.text(error)
					.addClass("text-danger")
					.removeClass("text-success");
				$("#liveToast").toast("show");
			},
		});
	});
}

function userRegister() {
	$(document).on("submit", "#formRegister", function (event) {
		event.preventDefault();
		var form = $(this);

		if (!form[0].checkValidity()) {
			event.stopPropagation();
			form.addClass("was-validated");
			return;
		}

		var fullName = form.find("#fullName").val();
		var regEmail = form.find("#regEmail").val();
		var regPassword = form.find("#regPassword").val();
		var confirmPassword = form.find("#confirmPassword").val();

		$.ajax({
			method: "POST",
			url: "phpscripts/user-register.php",
			data: { fullName, regEmail, regPassword, confirmPassword },
			dataType: "json",
			success: function (response) {
				if (response.status === "success") {
					$("#liveToast .toast-body p")
						.text(response.message)
						.addClass("text-success")
						.removeClass("text-danger");
					$("#liveToast").toast("show");

					$("#formRegister").addClass("d-none");
					$("#formLogin").removeClass("d-none");
				} else {
					$("#liveToast .toast-body p")
						.text(response.message)
						.addClass("text-danger")
						.removeClass("text-success");
					$("#liveToast").toast("show");
				}
			},
			error: function (xhr, status, error) {
				$("#liveToast .toast-body p")
					.text(error)
					.addClass("text-danger")
					.removeClass("text-success");
				$("#liveToast").toast("show");
			},
		});
	});
}

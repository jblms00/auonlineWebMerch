$(document).ready(function () {
    changePassword();
    updateProfile();

    $("#modalChangePassword").on("hidden.bs.modal", function () {
        $("#userOldPassword").val("");
        $("#userNewPassword").val("");
        $("#userConfirmPassword").val("");
    });

    $("#modalProfile").on("hidden.bs.modal", function () {
        $("#userEmail").val("");
        $("#userPhoneNumber").val("");
        $("#editUserPhoto").val("");
        var originalSrc = $(".profile-photo").attr("src");

        $("#profileImg").attr("src", originalSrc);
    });

    $("#editUserPhoto").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#profileImg").attr("src", e.target.result);
            };

            reader.readAsDataURL(this.files[0]);
        }
    });
});

function updateProfile() {
    $(document).on("click", ".update-profile", function () {
        var formData = new FormData();
        formData.append("user_email", $("#editUserEmail").val());
        formData.append("user_number", $("#editUserPhoneNumber").val());

        var userPhoto = $("#editUserPhoto")[0].files[0];
        if (userPhoto) {
            formData.append("user_photo", userPhoto);
        }

        $.ajax({
            method: "POST",
            url: "../../phpscripts/user-update-profile.php",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    $("input, button, textarea").prop("disabled", true);

                    $("a")
                        .addClass("disabled")
                        .on("click", function (e) {
                            e.preventDefault();
                        });

                    $("#liveToast .toast-body p")
                        .text(response.message)
                        .addClass("text-success")
                        .removeClass("text-danger");
                    $("#liveToast").toast("show");

                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                } else {
                    $("#liveToast .toast-body p")
                        .text(response.message)
                        .addClass("text-danger")
                        .removeClass("text-success");
                    $("#liveToast").toast("show");
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:", error);
            },
        });
    });
}

function changePassword() {
    $(document).on("click", ".change-password", function () {
        var old_password = $("#userOldPassword").val();
        var new_password = $("#userNewPassword").val();
        var confirm_new_password = $("#userConfirmPassword").val();

        $.ajax({
            method: "POST",
            url: "../../phpscripts/user-change-password.php",
            data: {
                old_password,
                new_password,
                confirm_new_password,
            },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    $("input, button").prop("disabled", true);

                    $("a")
                        .addClass("disabled")
                        .on("click", function (e) {
                            e.preventDefault();
                        });

                    $("#liveToast .toast-body p")
                        .text(response.message)
                        .addClass("text-success")
                        .removeClass("text-danger");
                    $("#liveToast").toast("show");

                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                } else {
                    $("#liveToast .toast-body p")
                        .text(response.message)
                        .addClass("text-danger")
                        .removeClass("text-success");
                    $("#liveToast").toast("show");
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:", error);
            },
        });
    });
}

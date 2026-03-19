$(function () {
    // Password Toggle
    $(".toggle-password").on("click", function () {
        let target = $($(this).data("target"));
        let icon = $(this).find("i");
        if (target.attr("type") === "password") {
            target.attr("type", "text");
            icon.removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            target.attr("type", "password");
            icon.removeClass("fa-eye-slash").addClass("fa-eye");
        }
    });

    // Registration submission
    $("#registerForm").on("submit", function (e) {
        // prevent the default form submission
        e.preventDefault();

        // get the button
        let btn = $("#registerBtn");

        // change text to loading
        btn.text("Loading...")
            .css({ cursor: "wait", PointerEvents: "none" })
            .prop("disabled", true);

        // submit via AJAX
        $.ajax({
            url: $(this).attr("action"),
            method: $(this).attr("method"),
            data: $(this).serialize(),
            success: function (response) {
                Metro.toast.create(
                    "User successfully registered!",
                    null,
                    3000,
                    "success",
                );

                setTimeout(() => {
                    window.location.href = "/home_page/dashboard";
                }, 2000);
            },
            error: function (xhr) {
                // show error toaster
                let msg = "Registration failed.";

                // if Laravel returns validation errors
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    msg = Object.values(errors).flat().join("<br>");
                }

                Metro.toast.create(msg, null, 5000, "alert");

                btn.prop("disabled", false).text("Register");
            },
        });
    });
});

$(function(){
    // Login
    $("#loginForm").on("submit", function (e) {
        e.preventDefault();

        let btn = $("#loginBtn");

        $.ajax({
            url: $(this).attr("action"),
            method: $(this).attr("method"),
            data: $(this).serialize(),
            beforeSend: function () {
                btn.text("Loading...")
                    .css({ cursor: "wait", pointerEvents: "none" })
                    .prop("disabled", true);
            },
            success: function (response) {
                // show success toaster
                Metro.toast.create(
                    "User successfully logged in!",
                    null,
                    3000,
                    "success",
                );

                // optionally redirect after short delay
                setTimeout(() => {
                    window.location.href = response.redirect;
                }, 1500);
            },
            error: function (xhr) {
                // show error toaster
                let msg = "Login failed.";

                // if Laravel returns validation errors
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    msg = Object.values(errors).flat().join("<br>");
                }

                Metro.toast.create(msg, null, 5000, "alert");

                // reset button
                btn.prop("disabled", false)
                    .text("Login")
                    .css({ cursor: "pointer", pointerEvents: "auto" });
            },
        });
    });
})

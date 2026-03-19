// Logout
$(function () {
    $("#logout").on("click", function (event) {
        // console.log("Logout clicked");
        event.preventDefault();
        Metro.dialog.open("#logoutDialog");
    });

    $("#confirmLogout").on("click", function () {
        $.ajax({
            url: $('meta[name="logout-url"]').attr("content"),
            method: "POST",
            data: { _token: $('meta[name="csrf-token"]').attr("content") },
            beforeSend: function () {
                $("#confirmLogout").css({
                    cursor: "wait",
                    PointerEvents: "none",
                });
            },
            success: function (response) {
                Metro.toast.create(response.message, null, 3000, "success");
                setTimeout(function () {
                    window.location.href = "/login";
                }, 3000);
            },
            error: function () {
                Metro.toast.create("Logout Failed!", null, 3000, "alert");
            },
        });
    });

    // Auto-logout after 30 minutes of inactivity
    let inactivityTime = 30 * 60 * 1000;
    let logoutTimer;

    function resetTimer() {
        clearTimeout(logoutTimer);
        logoutTimer = setTimeout(autoLogout, inactivityTime);
    }

    function autoLogout() {
        $.ajax({
            url: $('meta[name="logout-url"]').attr("content"),
            method: "POST",
            data: { _token: $('meta[name="csrf-token"]').attr("content") },
            complete: function () {
                Metro.toast.create(
                    "Session Expired. Logging out...",
                    null,
                    3000,
                    "warning",
                );
                setTimeout(function () {
                    window.location.href = "/login";
                }, 3000);
            },
        });
    }

    // Reset timer on any of these events
    $(document).on("mousemove keypress click scroll touchstart", resetTimer);

    resetTimer();
});

// CheckBox
//  select all checkboxes
function initCheckboxes() {
    $('#bulkDeleteBtn').addClass('d-none');
    
    $(document).on("change", "#selectAll", function () {
        $(".rowCheckBox").prop("checked", this.checked);
        toggleBulkDelete();
    });

    $(document).on("change", ".rowCheckBox", function () {
        if ($(".rowCheckBox:checked").length === $(".rowCheckBox").length) {
            $("#selectAll").prop("checked", true);
        } else {
            $("#selectAll").prop("checked", false);
        }
        toggleBulkDelete();
    });

    function toggleBulkDelete() {
        if ($(".rowCheckBox:checked").length > 0) {
            $("#bulkDeleteBtn").removeClass("d-none").slideDown();
        } else {
            $("#bulkDeleteBtn").slideUp(function () {
                $(this).addClass("d-none");
            });
        }
    }
}

    // Delete Button
function initDelete(config){
    let deleteId = null;
    let deleteRow = null;

    $(document).on("click", ".deleteBtn", function () {
        // event.preventDefault();
        deleteId = $(this).data("id");
        deleteRow = $(this).closest("tr");
        Metro.dialog.open(config.dialogId);
    });

    // Confirm Delete
    $(document).on("click", "#confirmDelete", function () {
        if (!deleteId) return; //  guard in case id is not set
        $.ajax({
            url: config.deleteUrl + "/" + deleteId,
            method: "POST",
            data: {
                _method: "DELETE",
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                Metro.toast.create(response.message, null, 3000, "success");
                config.table.ajax.reload();
                Metro.dialog.close(config.dialogId);

                deleteIds = null;
                deleteRows = null;
                $("#selectAll").prop("checked", false);
                toggleBulkDelete();
            },
            error: function () {
                Metro.toast.create(
                    "Failed to delete Record!",
                    null,
                    3000,
                    "alert",
                );
            },
        });
    });

    // Bulk Delete fxn
    let deleteIds = null;
    let deleteRows = null;

    $("#bulkDeleteBtn").on("click", function () {
        // event.preventDefault();

        // Collect all checked checkbox IDs and rows
        deleteIds = [];
        deleteRows = [];

        $(".rowCheckBox:checked").each(function () {
            deleteIds.push($(this).closest("tr").find(".deleteBtn").data("id"));
            deleteRows.push($(this).closest("tr"));
        });

        if (deleteIds.length === 0) return;

        // ✅ update dialog content with count
        $(config.bulkDialogId+" .dialog-content").text(
            `Are you sure you want to delete ${deleteIds.length} record(s)?`,
        );

        Metro.dialog.open(config.bulkDialogId);
    });

    $(document).on("click", "#confirmBulkDelete", function () {
        if (!deleteIds) return; //  guard in case id is not set
        $.ajax({
            url: config.bulkDeleteUrl,
            method: "POST",
            data: {
                _method: "DELETE",
                _token: $('meta[name="csrf-token"]').attr("content"),
                ids: deleteIds,
            },
            success: function (response) {
                Metro.toast.create(
                    `${deleteRows.length} record(s) deleted successfully!`,
                    null,
                    3000,
                    "success",
                );
                config.table.ajax.reload();
                Metro.dialog.close(config.bulkDialogId);

                // Reset
                deleteIds = null;
                deleteRows = null;
                $("#selectAll").prop("checked", false);
                toggleBulkDelete();
            },
            error: function () {
                Metro.toast.create(
                    "Failed to delete Records!",
                    null,
                    3000,
                    "alert",
                );
            },
        });
    });
}

// $(function () {
//     // Fetch Departments - New Ticket page
//     function loadDepartments() {
//         $.ajax({
//             url: "/departments/list",
//             method: "GET",
//             success: function (response) {
//                 let select = $("#department_id");
//                 select
//                     .empty()
//                     .append('<option value="">Select Department</option>');

//                 $.each(response, function (index, department) {
//                     select.append(
//                         `<option value="${department.id}">${department.departmentName}</option>`,
//                     );
//                 });
//             },
//             error: function () {
//                 Metro.toast.create(
//                     "Failed to load departments!",
//                     null,
//                     3000,
//                     "alert",
//                 );
//             },
//         });
//     }
//     // // ✅ refresh on button click
//     // $("#refreshDepartments").on("click", function () {
//     //     loadDepartments();
//     // });
// });
// });

// Add New Ticket
$(function () {
    // Fetching Sub-Complaint categories

    $(document).on("change", "#complaintType", function () {
        let selectedCatId = $(this).find(":selected").data("id");
        let subCatTypeSelect = $("#complaintSubType");

        subCatTypeSelect
            .empty()
            .append('<option value="">Select Complaint Sub-Type</option>');

        if (!selectedCatId) return;

        console.log(selectedCatId);
        $.ajax({
            url: '/subcategories/' + selectedCatId,
            method: "GET",
            success: function (response) {
                $.each(response, function (index, subCategory) {
                    subCatTypeSelect.append(
                        `<option value="${subCategory.id}">${subCategory.subCategoryName}</option>`
                    );
                });
            },
            error: function () {
                Metro.toast.create(
                    "Failed to load sub-categories!",
                    null,
                    3000,
                    "alert",
                );
            },
        });
    });

    // New Ticket Submission
    $("#newTicket").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            url: "/new_ticket",
            method: "POST",
            data: $(this).serialize(),
            beforeSend: function () {
                $("#submitBtn")
                    .prop("disabled", true)
                    .text("Loading")
                    .css({ cursor: "wait", pointerEvents: "none" });
            },
            success: function (response) {
                console.log(response);
                Metro.toast.create(response.message, null, 3000, "success");
                // table.ajax.reload(); //  reload DataTable instead of manually appending row

                $("#newTicket")[0].reset();
                $("#submitBtn")
                    .prop("disabled", false)
                    .text("Submit")
                    .css({ cursor: "pointer", pointerEvents: "auto" });
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let msg = Object.values(errors).flat().join("<br/>");
                    Metro.toast.create(msg, null, 3000, "alert");
                } else {
                    Metro.toast.create(
                        xhr.responseJSON.message,
                        null,
                        3000,
                        "alert",
                    );
                }
                // $("#departmentAdd")[0].reset();
                $("#submitBtn")
                    .prop("disabled", false)
                    .text("Submit")
                    .css({ cursor: "pointer", pointerEvents: "auto" });
            },
        });
    });
});

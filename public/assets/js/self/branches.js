$(function () {
    // Branches DataTable
    let table = $("#branchesTable").DataTable({
        ajax: {
            url: "branches/datatable",
            type: "GET",
        },
        columns: [
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function () {
                    return '<input type="checkbox" class="rowCheckBox">';
                },
            },
            { data: "branchName" },
            { data: "region" },
            { data: "created_at" },
            // { data: "updated_at" },
            { data: "actions", orderable: false, searchable: false },
        ],
        order: [[3, "desc"]],
        pageLength: 10,
        scrollX: true,
        lengthMenu: [
        [10, 25, 50, 100, -1],        // ✅ -1 means "All"
        [10, 25, 50, 100, 'All']       // ✅ label shown in dropdown
    ],
        language: {
        search: 'Search:',
        lengthMenu: 'Show _MENU_ entries',
        info: 'Showing _START_ to _END_ of _TOTAL_ entries',
        emptyTable: 'No branches found.',
        zeroRecords: 'No matching records found.',
        paginate: {
            previous: '&laquo;',
            next: '&raquo;'
        }
    }
    });

    initCheckboxes();
    initDelete({
        deleteUrl: "/branches",
        bulkDeleteUrl: "/branches",
        table: table,
        dialogId: "#deleteDialog",
        bulkDialogId: "#bulkDeleteDialog"
    });

    // // Add Branch
    $("#branchAdd").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            url: "/branches",
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
                table.ajax.reload(); // reload DataTable instead of manually appending row

                $("#branchAdd")[0].reset();
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
                $("#submitBtn")
                    .prop("disabled", false)
                    .text("Submit")
                    .css({ cursor: "pointer", pointerEvents: "auto" });
            },
        });
    });
    // });

    // Edit Department
    let editId = null;
    let editRow = null;

    // Open edit dialog
    $(document).on("click", ".editBtn", function () {
        editId = $(this).data("id");
        editRow = $(this).closest("tr");
        $("#editBranchName").val($(this).data("name")); //  pre-fill current name
        $("#editRegion").val($(this).data("region")); 
        Metro.dialog.open("#editDialog");
    });

    // Confirm edit
    $(document).on("click", "#confirmEdit", function () {
        if (!editId) return;
        $.ajax({
            url: "/branches/" + editId,
            method: "POST",
            data: {
                _method: "PUT", // Laravel PUT spoofing
                _token: $('meta[name="csrf-token"]').attr("content"),
                branchName: $("#editBranchName").val(),
                region: $("#editRegion").val(),
            },
            beforeSend: function () {
                $("#confirmEdit")
                    .prop("disabled", true)
                    .text("Updating...")
                    .css({ cursor: "wait", pointerEvents: "none" });
            },
            success: function (response) {
                console.log("Here");
                Metro.toast.create(response.message, null, 3000, "success");
                table.ajax.reload();
                Metro.dialog.close("#editDialog");

                editId = null;
                editRow = null;

                $("#confirmEdit")
                    .prop("disabled", false)
                    .text("Update")
                    .css({ cursor: "pointer", pointerEvents: "auto" });
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let msg = Object.values(errors).flat().join("<br>");
                    Metro.toast.create(msg, null, 3000, "alert");
                } else {
                    Metro.toast.create(
                        "Failed to update branch!",
                        null,
                        3000,
                        "alert",
                    );
                }

                $("#confirmEdit")
                    .prop("disabled", false)
                    .text("Update")
                    .css({ cursor: "pointer", pointerEvents: "auto" });
            },
        });
    });
});
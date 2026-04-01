$(function () {
    // Branches DataTable
    let table = $("#categoriesTable").DataTable({
        ajax: {
            url: "/categories/datatable",
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
            { data: "categoryName" },
            { data: "subCategory" }, //List of Sub-Categories
            { data: "created_at" },
            // { data: "updated_at" },
            { data: "actions", orderable: false, searchable: false },
        ],
        order: [[3, "desc"]],
        pageLength: 10,
        scrollX: true,
        lengthMenu: [
            [10, 25, 50, 100, -1], // ✅ -1 means "All"
            [10, 25, 50, 100, "All"], // ✅ label shown in dropdown
        ],
        language: {
            search: "Search:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            emptyTable: "No branches found.",
            zeroRecords: "No matching records found.",
            paginate: {
                previous: "&laquo;",
                next: "&raquo;",
            },
        },
    });

    initCheckboxes();
    initDelete({
        deleteUrl: "/category",
        bulkDeleteUrl: "/categories",
        table: table,
        dialogId: "#deleteDialog",
        bulkDialogId: "#bulkDeleteDialog",
    });

    // // Add Branch
    $("#categoryAdd").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            url: "/categories",
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

                $("#categoryAdd")[0].reset();
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

    // open dialog with category id
    $(document).on("click", ".addSubCategoryBtn", function () {
        $("#subCategoryParentId").val($(this).data("id")); // ✅ store category id
        $("#newSubCategoryName").val("");
        Metro.dialog.open("#addSubCategoryDialog");
    });

    // confirm add subcategory
    $(document).on("click", "#confirmAddSubCategory", function () {
        let categoryId = $("#subCategoryParentId").val();
        let subCategoryName = $("#newSubCategoryName").val();

        $.ajax({
            url: "/subcategories",
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                category_id: categoryId,
                subCategoryName: subCategoryName,
            },
            beforeSend: function () {
                $("#confirmAddSubCategory")
                    .prop("disabled", true)
                    .text("Adding...")
                    .css({ cursor: "wait", pointerEvents: "none" });
            },
            success: function (response) {
                Metro.toast.create(response.message, null, 3000, "success");
                table.ajax.reload(); // ✅ reload table to show new subcategory
                Metro.dialog.close("#addSubCategoryDialog");
                $("#confirmAddSubCategory")
                    .prop("disabled", false)
                    .text("Add")
                    .css({ cursor: "pointer", pointerEvents: "auto" });
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let msg = Object.values(errors).flat().join("<br>");
                    Metro.toast.create(msg, null, 3000, "alert");
                } else {
                    Metro.toast.create(
                        "Failed to add sub-category!",
                        null,
                        3000,
                        "alert",
                    );
                }
                $("#confirmAddSubCategory")
                    .prop("disabled", false)
                    .text("Add")
                    .css({ cursor: "pointer", pointerEvents: "auto" });
            },
        });
    });
});

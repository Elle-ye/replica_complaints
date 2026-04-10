// const { data } = require("jquery");

$(function () {
    let table = $("#allComplaintsTable").DataTable({
        ajax: {
            url: "all-complaints/datatable",
            type: "GET",
            data: function (d) {
                d.dateStart = $("#dateStart").val();
                d.dateEnd = $("#dateEnd").val();
                d.complaintType = $("#complaintTypeFilter").val();
                d.complaintSubType = $("#complaintSubTypeFilter").val();
                d.originValue = $("#complaintOriginFilter").val();
                d.destinationValue = $("#complaintDestinationFilter").val();
                return d;
            },
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
            { data: "ticketID" },
            { data: "complaintType" },
            { data: "complaintSubType" },
            { data: "complaintSubject" },
            { data: "ticketStatus" },
            { data: "custName" },
            // { data: "staffEmail" },
            { data: "acctNum" },
            { data: "cardNum" },
            // { data: "ageRange" },
            { data: "contactNum" },
            // { data: "channel" },
            { data: "origin" },
            { data: "destination" },
            // { data: "complaintDescription" },
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
            emptyTable: "No complaints found.",
            zeroRecords: "No matching records found.",
            paginate: {
                previous: "&laquo;",
                next: "&raquo;",
            },
        },
    });

    // When Complaint Type changes, update Sub Type dropdown
    $("#complaintTypeFilter").on("change", function () {
        var categoryId = $(this).val();
        var subTypeSelect = $("#complaintSubTypeFilter");

        // Clear current options
        subTypeSelect.empty();
        subTypeSelect.append('<option value="">All Sub Types</option>');

        if (categoryId) {
            // Fetch sub-types for this category
            $.ajax({
                url: "/get-sub-types/" + categoryId,
                type: "GET",
                success: function (data) {
                    $.each(data, function (key, value) {
                        subTypeSelect.append(
                            '<option value="' +
                                value.id +
                                '">' +
                                value.subCategoryName +
                                "</option>",
                        );
                    });
                },
            });
        }
    });

    // Filter Btn
    $("#filterBtn").on("click", function () {
        table.ajax.reload();
    });

    // Reset Btn
    $("#resetBtn").on("click", function () {
        $("#dateStart").val("");
        $("#dateEnd").val("");
        $("#complaintTypeFilter").val("");
        $("#complaintSubTypeFilter").empty();
        $("#complaintSubTypeFilter").append(
            '<option value="">All Sub Types</option>',
        );
        $('#complaintOriginFilter').val('');
        $('#complaintDestinationFilter').val('');
        table.ajax.reload();
    });

    initCheckboxes();

    // Export All
    $('#exportAllBtn').on('click', function(){
        window.location.href = '/export-excel?type=all';
    });

    // Export Filtered records
    $('#exportFilteredBtn').on('click', function(){
        let filters = {
            type: 'filtered',
            dateStart: $('#dateStart').val(),
            dateEnd: $('#dateEnd').val(),
            complaintType: $('#complaintTypeFilter').val(),
            complaintSubType: $('#complaintSubTypeFilter').val(),
            originValue: $('#complaintOriginFilter').val(),
            destinationValue: $('#destinationFilter').val()
        };

        let queryString = $.param(filters);
        window.location.href = '/export-excel?' + queryString;
    });

    // Export Selected (Checkbox)
    $('#exportSelectedBtn').on('click', function(){
        let selectedIds = [];

        $('.rowCheckBox:checked').each(function(){
            let row = $(this).closest('tr');
            let data = table.row(row).data();
            if (data){
                selectedIds.push(data.ticketID);
            }
        });

        if(selectedIds === 0){
            alert('Please select at least one record to export.');
            return;
        }
        
        window.location.href = '/export-excel?type=selected&ids=' + selectedIds.join(',');
    });
    
});

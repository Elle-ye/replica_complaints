$(function(){
    let table = $("#allComplaintsTable").DataTable({
        ajax: {
            url: "all-complaints/datatable",
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
            // { data: "destination" },
            // { data: "complaintDescription" },
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
        emptyTable: 'No complaints found.',
        zeroRecords: 'No matching records found.',
        paginate: {
            previous: '&laquo;',
            next: '&raquo;'
        }
    }
    });

    initCheckboxes();
    // initDelete({
    //     deleteUrl: "/all-complaints",
    //     bulkDeleteUrl: "/all-complaints",
    //     table: table,
    //     dialogId: "#deleteDialog",
    //     bulkDialogId: "#bulkDeleteDialog"
    // });
})
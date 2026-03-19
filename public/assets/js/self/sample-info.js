$(document).ready(function(){

    // CSV Download
    $('#downloadBtn').on('click', function(){
        const checkedBoxes = $('.rowCheckBox:checked');

        const selectedBoxes = checkedBoxes.map(function(){
            return $(this).data('sample-id');
        }).get();

        let url = '/information/info';

        // If table isn't empty
        if (selectedBoxes.length > 0) {
            url += "?sampleInfo=" + selectedBoxes.join(",")
        }

        window.location.href = url
    })
})
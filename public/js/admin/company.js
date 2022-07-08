"use strict";

(function () {
    // code js here
}());

//show modal career
//handler show value checkbox
document.getElementById('select').onclick = function () {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
    let career = [];
    for (var checkbox of checkboxes) {
        career.push(checkbox.value);
    }
    $('.js-select2').val(career).trigger('change');
}

//handler check all check box
$(function () {
    //handler for selectall change
    $('#selectAll').change(function () {
        $("input[name='item-career[]']").prop('checked', $(this).prop('checked'))
    })
    //handler for all checkboxes to refect selectAll status
    $("input[name='item-career[]']").change(function () {
        $("#selectAll").prop('checked', true)
        $("input[name='item-career[]']").each(function () {
            if (!$(this).prop('checked')) {
                $("#selectAll").prop('checked', $(this).prop('checked'));
                return;
            }
        })
    })
})
$("#select").click(function () {
    $("#exampleModalCenterCareer").modal('hide');
});


//show modal Area


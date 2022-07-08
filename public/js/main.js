"use strict";

(function(){
    WOW.prototype.addBox = function (element) {
        this.boxes.push(element);
    };
    var wow = new WOW({
        mobile: false
    });
    wow.init();

    // toastr option
    toastr.options = {
        closeButton: true,
        positionClass: 'toast-bottom-right',
        onclick: null,
        showDuration: 1000,
        hideDuration: 1000,
        timeOut: 10000,
        extendedTimeOut: 1000,
        showEasing: 'swing',
        hideEasing: 'linear',
        showMethod: 'fadeIn',
        hideMethod: 'fadeOut'

    };

    $('.datetimepicker').datetimepicker({
        icons: {
            time:'fa fa-clock-o',
            date:'fa fa-calendar',
            up:'fa fa-chevron-up',
            down:'fa fa-chevron-down',
            previous:'fa fa-chevron-left',
            next:'fa fa-chevron-right',
            today:'fa fa-crosshairs',
            clear:'fa fa-trash-o',
            close:'fa fa-times'
        },
    });
    $('.datepicker').datetimepicker({
        // format: 'DD/MM/YYYY',
        format: 'YYYY/MM/DD',
        icons: {
            time:'fa fa-clock-o',
            date:'fa fa-calendar',
            up:'fa fa-chevron-up',
            down:'fa fa-chevron-down',
            previous:'fa fa-chevron-left',
            next:'fa fa-chevron-right',
            today:'fa fa-crosshairs',
            clear:'fa fa-trash-o',
            close:'fa fa-times'
        },
    });
    $('.timepicker').datetimepicker({
        format: 'HH:mm',
        icons: {
            time:'fa fa-clock-o',
            date:'fa fa-calendar',
            up:'fa fa-chevron-up',
            down:'fa fa-chevron-down',
            previous:'fa fa-chevron-left',
            next:'fa fa-chevron-right',
            today:'fa fa-crosshairs',
            clear:'fa fa-trash-o',
            close:'fa fa-times'
        },
    });
}());

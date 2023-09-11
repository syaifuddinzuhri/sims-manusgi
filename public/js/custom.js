/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

$(window).on('load', function () {
    setTimeout(() => {
        $('#loading').hide();
    }, 500);
})

var APP_URL = "{!! url('/') !!}";
var API_TOKEN = "2y10OzIb3GbtEXSB5dSgsspmulLK0Y5dpmhTDT97VeBAY94GgEAO";
var csrf = $('meta[name="csrf-token"]').attr('content');

function formatDate(date) {
    // Get year, month, and day part from the date
    var year = date.toLocaleString("default", {
        year: "numeric"
    });
    var month = date.toLocaleString("default", {
        month: "2-digit"
    });
    var day = date.toLocaleString("default", {
        day: "2-digit"
    });

    // Generate yyyy-mm-dd date string
    var formattedDate = `${year}-${month}-${day}`;
    return formattedDate;
}

var date = new Date(),
    y = date.getFullYear(),
    m = date.getMonth();
var firstDayOfMonth = new Date(y, m, 1);
var now = new Date();

$(".datepicker").flatpickr({
    dateFormat: "Y-m-d",
});

$(".daterangepicker").flatpickr({
    dateFormat: "Y-m-d",
    mode: "range",
    defaultDate: [formatDate(firstDayOfMonth), formatDate(now)]
});

$(".timepicker").flatpickr({
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true
});

$('.dropify').dropify();

$(function () {
    "use strict";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.fn.serializeObject = function () {
        return this.serializeArray().reduce(function (m, o) {
            m[o.name] = o.value;
            return m;
        }, {})
    };

    $(".form-radio").checkboxradio();
});

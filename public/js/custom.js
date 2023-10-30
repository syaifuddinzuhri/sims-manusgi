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

$(".datepicker-now").flatpickr({
    dateFormat: "Y-m-d",
    defaultDate: formatDate(now)
});

$(".datepicker-year").flatpickr({
    dateFormat: "Y",
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


/* Tanpa Rupiah */
var notRp = $('.not-rp');
notRp.on('keyup', function (e) {
    notRp.val(formatRupiah(this.value));
});

/* Dengan Rupiah */
var withRp = $('.with-rp');
withRp.on('keyup', function (e) {
    withRp.val(formatRupiah(this.value, 'Rp. '));
});

/* Fungsi */
function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        separator = '',
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}


function getMonthsPayment() {
    const months = [
        "january",
        "february",
        "march",
        "april",
        "may",
        "june",
        "july",
        "august",
        "september",
        "october",
        "november",
        "december"
    ];
    // var array = [];
    // months.forEach(element => {
    //     array.push({
    //         label: element,
    //         name:
    //     })
    // });
}

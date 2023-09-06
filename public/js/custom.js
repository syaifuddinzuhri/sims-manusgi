/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

var APP_URL = "{!! url('/') !!}";
var csrf = $('meta[name="csrf-token"]').attr('content');

$(function () {
    "use strict";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });
    $.fn.serializeObject = function () {
        return this.serializeArray().reduce(function (m, o) {
            m[o.name] = o.value;
            return m;
        }, {})
    };
});

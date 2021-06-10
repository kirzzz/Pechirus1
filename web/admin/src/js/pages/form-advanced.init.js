/*
Template Name: Ubold - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Form advanced init js
*/

!function($) {
    "use strict";

    var FormAdvanced = function() {};

    FormAdvanced.prototype.initSelect2 = function() {
        $('[data-toggle="select2"]').select2();
    },

    FormAdvanced.prototype.init = function() {
        var $this = this;
        this.initSelect2();
    },

    $.FormAdvanced = new FormAdvanced, $.FormAdvanced.Constructor = FormAdvanced

}(window.jQuery),
function ($) {
    "use strict";
    $.FormAdvanced.init();
}(window.jQuery);


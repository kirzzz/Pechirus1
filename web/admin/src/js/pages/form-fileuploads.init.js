// Dropzone
!function ($) {
    "use strict";

    var FileUpload = function () {
        this.$body = $("body")
    };

    /* Initializing */
    FileUpload.prototype.init = function () {
        //Dropzone.autoDiscover = false;
    },

        //init fileupload
        $.FileUpload = new FileUpload, $.FileUpload.Constructor = FileUpload

}(window.jQuery),

function ($) {
"use strict";
    $.FileUpload.init()
}(window.jQuery);


if ($('[data-plugins="dropify"]').length > 0) {
    // Dropify
    $('[data-plugins="dropify"]').dropify({
        messages: {
            'default': 'Перетащите файл или нажмите что-бы выбрать',
            'replace': 'Перетащите новый файл или нажмите что-бы выбрать',
            'remove': 'Удалить',
            'error': 'Ой, что-то пошло не так'
        },
        error: {
            'fileSize': 'Ой, файл слишком большой, допустимый размер файла до ({{ value }}).',
            'imageFormat': 'Данный файл не является: ({{ value }} only).'
        }
    });
}
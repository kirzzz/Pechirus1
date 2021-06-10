/*
Template Name: Ubold - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: X-editable init js
*/

$(function(){

    //modify buttons style
    $.fn.editableform.buttons =
        '<button type="submit" style="height: auto;padding: 0 5px;width: auto;margin-right: 5px;" class="btn btn-primary editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button>' +
        '<button type="button" style="height: auto;padding: 0 5px;width: auto;margin-right: 5px;" class="btn btn-danger editable-cancel btn-sm waves-effect"><i class="mdi mdi-close"></i></button>';

    $('.inline-catalog-name').editable({
        validate: function(value) {
            if($.trim(value) == '') return 'Поле обязательно для заполнения';
        },
        mode: 'inline',
        inputclass: 'form-control-sm form-control'
    });

    $('.inline-catalog-status').editable({
        mode: 'inline',
        inputclass: 'form-control-sm form-control',
        source: [
            {value: 0, text: 'Скрыть'},
            {value: 1, text: 'Активный'}
        ],
        display: function(value, sourceData) {
            var colors = {0: "#8c98a5", 1: "#1abc9c"},
                elem = $.grep(sourceData, function(o){return o.value == value;});

            if(elem.length) {
                $(this).text(elem[0].text).css("color", colors[value]);
            } else {
                $(this).empty();
            }
        }
    });

    let json = {'in_stock':null,'hidden':null,'count':null,'status':null,'price':null};
    $('[data-fast-edit-field]').each(function () {
        let source = $(this).attr('data-source');
        let type = $(this).attr('data-type');
        $(this).editable({
            mode: 'inline',
            type: type,
            inputclass: 'form-control-sm form-control',
            source: source,
            showbuttons: source !== ''?false:'left',
            disabled: true,
            display: function(value,sourceData) {
                if(!value){
                    return;
                }else{
                    json[$(this).attr('data-parameter')] = value;
                    if(sourceData !== undefined){
                        let elem = $.grep(sourceData, function(o){return o.value == value;});
                        $(this).text(elem[0].text);
                    }else{
                        $(this).text(value);
                    }
                }
            }
        });
    });

    $("[data-fast-edit-product]").on('click',function () {
        cancel();
        $(this).siblings('[data-fast-edit-product-complete]').toggleClass('d-none');
        $(this).siblings('[data-fast-edit-product-cancel]').toggleClass('d-none');
        $("[data-fast-edit-field='"+$(this).attr('data-fast-edit-product')+"']").editable('toggleDisabled');
    })

    let cancel = function () {
        json = {'in_stock':null,'hidden':null,'count':null,'status':null};
        $("[data-fast-edit-product-complete]").addClass('d-none');
        $("[data-fast-edit-product-cancel]").addClass('d-none');
        $("[data-fast-edit-field]").editable('disable');
    };

    $("[data-fast-edit-product-cancel]").on('click',cancel);

    $("[data-fast-edit-product-complete]").on('click',function () {
        let id = $(this).attr('data-fast-edit-product-complete');
        console.log(json);
        $.ajax({
            type: "POST",
            url: "product-fast-edit",
            data: {'data':json,'id':id},
            success: function(data){
                console.log(data);
                data = JSON.parse(data);
                if(data.success){
                    toast(data['text']);
                }else{
                    toast(data['error']);
                }
            }
        });
        cancel();
    })

    $("[data-catalog-product-visible]").on('click',function () {
        let visible = $(this).attr('data-catalog-product-visible');
        let id = $(this).attr('data-catalog-product-visible-id');
        $.ajax({
            type: "POST",
            url: "functions",
            data: {'visible':visible,'id':id,'function':'catalog-show'},
            success: function(data){
                console.log(data);
                data = JSON.parse(data);
                if(data.success){
                    toast(data['text']);
                }else{
                    toast(data['error']);
                }
            }
        });
    })

    let toast = function (text){
        $toast = $('<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="min-width: 160px">\n' +
            '        <div class="toast-header">\n' +
            '            <h1 class="mr-2"><i class="fad fa-info-circle"></i></h1>\n' +
            '            <strong class="mr-auto ">Действие выполнено</strong>\n' +
            '            <small class="text-muted ml-3">just now</small>\n' +
            '            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">\n' +
            '                <span aria-hidden="true">&times;</span>\n' +
            '            </button>\n' +
            '        </div>\n' +
            '        <div class="toast-body" data-toast-text>\n' +
                            text +
            '        </div>\n' +
            '    </div>');
        $toast.toast({
            animation: true,
            autohide: true,
            delay: 6660
        })
        $('[data-toast-container]').append($toast);
        $toast.toast('show');
    }

    $('.inline-catalog-status, .inline-catalog-name').on('save', function(e, params) {
        if($(this).data('type') === 'select'){
            $(this).closest('li').attr("data-status", params.newValue );
        }else{
            $(this).closest('li').attr("data-name", params.newValue );
        }
        $("#nestable-output").val(window.JSON.stringify($("#nestable_list_3").nestable("serialize")));
    });
});
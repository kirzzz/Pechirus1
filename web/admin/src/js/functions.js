document.addEventListener("DOMContentLoaded", function(event) {
    $("[data-admin-functions]").on('click',function () {
        let function_name = $(this).attr('data-admin-functions');
        let type = $(this).attr('data-steal-type');
        let id = $(this).attr('data-steal-compare-id');
        let th = $(this)
        $.ajax({
            type: "POST",
            url: "functions",
            data: {'type':type,'id':id,'function': function_name},
            success: function(data){
                data = JSON.parse(data);
                if(data.success){
                    toast(data['text'],'Действие выполнено');
                    if(data.hasOwnProperty('data')){
                        if(function_name === 'steal-compare' && data.data.hasOwnProperty('color') && data.data.hasOwnProperty('type')){
                            if(data.data.type === 'one'){

                            }else if(data.data.type === 'all'){

                            }
                        }
                    }
                }else{
                    toast(data['error'],'Ошибка');
                }
            }
        });
    })

    let toast = function (text,header=''){
        $toast = $('<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="min-width: 160px">\n' +
            '        <div class="toast-header">\n' +
            '            <h1 class="mr-2"><i class="fad fa-info-circle"></i></h1>\n' +
            '            <strong class="mr-auto ">'+ (header === ''?'Действие выполнено':header) +'</strong>\n' +
            '            <small class="text-muted ml-3">just now</small>\n' +
            '            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">\n' +
            '                <span aria-hidden="true">&times;</span>\n' +
            '            </button>\n' +
            '        </div>\n' +
            '        <div class="toast-body" data-toast-text>\n' + text +'</div>\n' +
            '    </div>');
        $toast.toast({
            animation: true,
            autohide: true,
            delay: 6660
        })
        $('[data-toast-container]').append($toast);
        $toast.toast('show');
    }
});
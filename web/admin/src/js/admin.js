$(window).on('load', function () {
    if($('#danger-alert-modal').length)
        $('#danger-alert-modal').modal('show');

    console.log($('#success-alert-modal').length);
    console.log($('#success-alert-modal'));
    if($('#success-alert-modal').length)
        $('#success-alert-modal').modal('show');

    if($('#info-alert-modal').length)
        $('#info-alert-modal').modal('show');

    $("#dark-mode-check").trigger('click');

    $("#option-add").on('click',function () {
        $("#options-container").removeClass('d-none');
        $("#options-container tbody").append('<tr><td>'+$("[data-option-product='name']").val()+'</td><td>'+$("[data-option-product='val']").val()+'</td><td><button type="button" data-option-product="delete" class="btn btn-danger btn-xs waves-effect waves-light float-right"><i class="fe-trash"></i></button></td></tr>');
        $(this).closest('.form-group').find('input').val('');
    })

    $(document).on('click','[data-option-product="delete"]',function () {
        $(this).closest('tr').remove();
    })

    $("#product-new").on('submit',function () {
        let myRows = [];
        let headers = ['name','value'];
        let $rows = $("#options-container tbody tr").each(function(index) {
            $cells = $(this).find("td");
            myRows[index] = {};
            console.log($cells);
            $cells.each(function(cellIndex) {
                if(cellIndex !== 2)
                    myRows[index][headers[cellIndex]] = $(this).html();
            });
        });

        var myObj = {};
        myObj.myrows = myRows;
        $("#product-property").val(JSON.stringify(myObj));
    });

    $("[data-catalog-article-open],[data-calaog-back]").on('click',function () {
        $(this).closest('[data-catalog-container]').find('[data-catalog-parent="'+$(this).attr('data-catalog-article-open')+'"]').toggleClass('d-none');
        $(this).closest('[data-catalog-parent]').toggleClass('d-none');
    });

    $("[data-catalog-back]").on('click',function () {
        $(this).closest('[data-catalog-container]').find('[data-catalog-article="'+$(this).attr('data-catalog-back')+'"]').closest('[data-catalog-parent]').toggleClass('d-none');
        $(this).closest('[data-catalog-parent]').toggleClass('d-none');
    });

    $("[data-catalog-click]").on('click',function (e) {
        e.preventDefault();
        $('#select-category').val($(this).attr('data-catalog-click')); // Change the value or make some change to the internal state
        $('#select-category').trigger('change.select2'); // Notify only Select2 of changes
    });
});

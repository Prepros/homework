$('#my_form').on('submit', function(e){
    e.preventDefault();
    // var form_data = $(this).serializeArray();
    $.ajax({
        url: $(this).attr('action'),
        data: {
            form_data: $(this).serialize()
        },
        method: $('#method').val(),
        error:function (xhr, ajaxOptions, thrownError){
            $('.result').html(xhr.responseText);
        }
    }).done(function(data){
        $('.result').html(data);
    });
});

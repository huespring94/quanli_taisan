$('#room-import').on('change', function (e) {
    e.preventDefault();
    var stuff_id = $(this).val();
    $.ajax({
        url: '/amount-stuff-faculty/{stuff_id}',
        type: 'GET',
        dataType: 'html',
        data: {'stuff_id': stuff_id},
        success: function (data) {
            $('.quantity-stuff-faculty').val(data);
        },
        error: function () {
        }
    });
});


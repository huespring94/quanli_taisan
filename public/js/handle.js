$(document).ready(function () {
    $('#fac_import').on('change', function (e) {
        e.preventDefault();
        var stuff_id = $(this).val();
        $.ajax({
            url: '/detail-import/{stuff_id}',
            type: 'GET',
            dataType: 'html',
            data: {'stuff_id': stuff_id},
            success: function (data) {
                $('#detailImport').html('<h1>' + data+ '</h1>');
            },
            error: function () {
            }
        });
    });

});


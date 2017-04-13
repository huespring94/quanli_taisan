$(document).ready(function () {
    $('#fac_import').on('change', function (e) {
        e.preventDefault();
        var stuff_id = $(this).val();
        $.ajax({
            url: '/detail-import/' + stuff_id,
            type: 'GET',
            dataType: 'html',
            data: {},
            success: function (data) {
                $('#detailImport').html(data);
            },
            error: function () {
            }
        });
    });

});


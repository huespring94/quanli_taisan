$(document).ready(function () {
    $('#detail-import-delete').on('click', function (e) {
        e.preventDefault();
//        var detail_id = $(this).val();
        $.ajax({
            url: '/import-store-detail',
            type: 'GET',
            dataType: 'html',
            data: {},
            success: function (data) {
                alert('aaa');
//                alert(detail_id);
//            $('.quantity-stuff').val(data);
            },
            error: function () {
            }
        });
    });
});

//$('#fac_import').on('change', function (e) {
//    e.preventDefault();
//    var stuff_id = $(this).val();
//    $.ajax({
//        url: '/detail-import/{stuff_id}',
//        type: 'GET',
//        dataType: 'html',
//        data: {'stuff_id': stuff_id},
//        success: function (data) {
//            $('#detailImport').html(
//                    '<div class=' + '"box-body">' +
//                    '<table id=' + '"example2"' + 'class=' + '"table table-bordered table-hover">' +
//                    '<thead>' +
//                    '<tr>' +
//                    '<th></th>' +
//                    '<th></th>' +
//                    '<th></th>' +
//                    '<th></th>' +
//                    '</tr>' +
//                    '</thead>' +
//                    '<tbody>' + data + '</tbody>' +
//                    '</table>' +
//                    '</div>');
//        },
//        error: function () {
//        }
//    });
//});



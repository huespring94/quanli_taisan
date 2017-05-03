function myFunction() {
    $.ajax({
        url: '/admin/messages',
        type: 'GET',
        dataType: 'html',
        data: {},
        success: function (data) {
            var num = JSON.parse(data);
            document.getElementById("messages-expire").innerHTML = num.store;
        },
        error: function () {
        }
    });
}

$(document).ready(function () {
    $(".mydata").DataTable();
});




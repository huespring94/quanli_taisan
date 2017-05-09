function myFunction() {
    $.ajax({
        url: '/messages',
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
    $("#mydata").DataTable();
});

$(document).ready(function () {
    $("#mydata-add").DataTable();
});
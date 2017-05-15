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
     $.ajax({
        url: '/amount-request',
        type: 'GET',
        dataType: 'html',
        data: {},
        success: function (data) {
            document.getElementById("messages-request").innerHTML = data;
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
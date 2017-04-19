$(document).ready(function(){
    $(".treeview").click(function(){
//        $(".treeview").addClass("actives");
//        $(this)
        $(this + ":link").addClass("active");
        $(this + ":visited").addClass("active");
    });
});




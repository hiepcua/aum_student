$(function() {
    var $contextMenu = $("#contextMenu");

    $("body").on("contextmenu", "table.list tbody tr", function(e) {
        $contextMenu.css({
            display: "block",
            left: e.pageX,
            top: e.pageY
        });
        var id = $(this).attr('dataid');
        var ids = $(this).attr('dataids');
        $("#right_click_id").val(id);
        $("#right_click_ids").val(ids);
        return false;
    });

    $contextMenu.on("click", "a", function() {
        $contextMenu.hide();
    });

    /* click in out div */
    $('body').click(function() {
        $('#contextMenu').hide();
    });

    $('#contextMenu').click(function(event){
        event.stopPropagation();
    });
    /* end click in out div */
});

;(function ($) {
    $(".js_document_preview").click(function() {
        var url = $(this).attr('src');

        $('#myModal .modal-body').html('<img class="img-responsive" src="' + url + '">');

        $('#myModal').modal();
    });

    $(".js_user_preview").click(function () {

        var user_id = $(this).html();
        var url_string = '/getUser/'+ user_id;

        $.ajax({
            type: "GET",
            url: url_string,
            success: function(result){
                var talent = result.talent;
                $('#myModal .modal-title').html(result.talent);
                $('#myModal').modal();
            }
        });

    })
})(jQuery);
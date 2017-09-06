;(function ($) {
    $(".js_document_preview").click(function() {
        var url = $(this).attr('src');

        $('#myModal .modal-body').html('<img class="img-responsive" src="' + url + '">');

        $('#myModal').modal();
    });
})(jQuery);
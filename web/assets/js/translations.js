;(function ($) {
    $(".js_document_preview").click(function() {
        var url = $(this).attr('src');
        $('#myModal .modal-body').html('<img class="img-responsive" src="' + url + '">');
        $('#myModal').modal();
    });

    $(".js_user_preview").click(function () {

        var task_id = $(this).data('task-id'),
            user_id = $(this).data('user-id'),
            url_string = '/getUser/'+ user_id + '/' + task_id;

        $.ajax({
            type: "GET",
            url: url_string,
            success: function(result){
                $('#myModal .modal-title').html(result.talent)
                $('#myModal .modal-body').html(

                    '<img class="js_document_preview" align="left" width="48" height="48" src="' +
                    result.avatarUrl +
                    '" style="margin-right:10px;">' +
                    '<div>Email: ' + result.email + '</div>' +
                    '<div>Slack: @' + result.user_id + '</div>');
                $('#myModal').modal();
            }
        });
    })

    $(document).ready(function() {
        $('.data-table').dataTable({
            paging: false
        });
    });

})(jQuery);

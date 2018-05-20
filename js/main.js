$(document).ready(function(){
    $('.carousel').carousel({
        interval: 4000
    })

    $(document).on('click', '#quick-reply', function (){
        $('#reply-it').removeClass('d-none');
    })

    $(document).on('click', '.report', function() {
        let bookmark = $(this).data('bookmark');
        let reported_user_id = $(this).data('reported-user-id');
        let thread_id = $(this).data('thread-id');
        $.ajax({
            url: 'admin/includes/ajax_code.php',
            data: {reportPost: true, bookmark: bookmark, reported_user_id: reported_user_id, thread_id: thread_id},
            type: "POST",
            success: function (data) {
                if(!data.error)
                    console.log(data);
            }
        })
    })
});

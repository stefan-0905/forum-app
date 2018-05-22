$(document).ready(function(){
    $('.carousel').carousel({
        interval: 4000
    })

    $(document).on('click', '#quick-reply', function (){
        $('#reply-it').removeClass('d-none');
    })
    $('#reportUserModal').on('show.bs.modal', function(e) {
        let modal = $(this);
        let post_id = e.relatedTarget.dataset['postId'];

        $(document).on('click', '.report', function() {
            $.ajax({
                url: 'admin/includes/ajax_code.php',
                data: {report_post: true, post_id: post_id},
                type: "POST",
                success: function (data) {
                    if(!data.error) {
                        console.log(data);
                        modal.modal('hide');
                    }
                }
            })
        })
    })
});

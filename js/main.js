$(document).ready(function(){
    $('.carousel').carousel({
        interval: 4000
    });
    $(document).on('click', '#quick-reply', function (){
        $('#reply-it').removeClass('d-none');
    });
    $(document).on('click', '.delete-thread', function(e) {
        thread_delete_link = $(this);
        thread_id = thread_delete_link.data('id');

        $.ajax({
            url: 'admin/includes/ajax_code.php',
            data: {delete_thread: true, thread_id: thread_id},
            type: "POST",
            success: function (data) {
                if(!data.error) {
                    console.log(data);
                    let row = thread_delete_link.parent().parent().parent();
                    row.next().remove();
                    row.remove();
                }
            }
        });
    });
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
            });
        });
    });
    let board_settings = '#boardSettingsModal';
    $(board_settings).on('show.bs.modal', function(e) {
        let bulletin = e.relatedTarget.dataset['bulletin'];
        $(".tab-bulletin" + bulletin).addClass('active');
        $(".pane-bulletin" + bulletin).addClass('show').addClass('active').attr('aria-selected', 'true');

        
        $(document).on('click', '.delete-topic', function() {
            let topic = $(this);
            let topic_id = topic.data('id');
            $.ajax({
                url: 'admin/includes/ajax_code.php',
                data: {delete_topic: true, topic_id: topic_id},
                type: "POST",
                success: function (data) {
                    if(!data.error) {
                        console.log(data);
                        topic.parent().parent().remove();

                        let row = $("a[href='topic.php?topic_id="+data+"']").parent().parent().parent().parent().parent();
                        row.next().remove();
                        row.remove();
                    }
                }
            });
        })
    });
    $(board_settings).on('hide.bs.modal', function() {
        $(board_settings+" .nav-link").removeClass('active');
        $(board_settings+" .tab-pane").removeClass('active').removeClass('show');
    })

});

$(document).ready(function(){
    $('.carousel').carousel({
        interval: 4000
    });

    // REPLY
    $(document).on('click', '#quick-reply', function (){
        $('#reply-it').removeClass('d-none');
    });

    // DELETE THREAD
    $(document).on('click', '.delete-thread', function(e) {
        let thread_delete_link = $(this);
        let thread_id = thread_delete_link.data('id');

        $.ajax({
            url: 'admin/includes/api/thread/delete.php?thread_id=' + thread_id,
            type: "DELETE",
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

    // SET RELATED POST_ID ON MODAL
    $('#reportUserModal').on('show.bs.modal', function(e) {
        let post_id = e.relatedTarget.dataset['postId'];
        $('#reportUserModal .report').attr('data-post-id', post_id);
    });
    // REPORT POST
    $(document).on('click', '.report', function() {
        let current_post_id = $(this)[0].dataset['postId'];
        $.ajax({
            url: 'admin/includes/api/report_post/create.php?post_id=' + current_post_id,
            type: "POST",
            success: function (data) {
                if(!data.error) {
                    console.log(data);
                    $('#reportUserModal').modal('hide');
                }
            }
        });
    });

    let board_settings = '#boardSettingsModal';
    // DELETE TOPIC FUNCTIOANALITY
    $(board_settings).on('show.bs.modal', function(e) {
        let bulletin = e.relatedTarget.dataset['bulletin'];
        $(".tab-bulletin" + bulletin).addClass('active');
        $(".pane-bulletin" + bulletin).addClass('show').addClass('active').attr('aria-selected', 'true');

        
        $(document).on('click', '.delete-topic', function() {
            let topic = $(this);
            let topic_id = topic.data('id');
            $.ajax({
                url: 'admin/includes/api/topic/delete.php',
                data: { topic_id: topic_id },
                type: "DELETE",
                success: function (data) {
                    if(!data.error) {
                        topic.parent().parent().remove();

                        let row = $("a[href='topic.php?topic_id="+data.id+"']").parent().parent().parent().parent().parent();
                        row.next().remove();
                        row.remove();
                    }
                }
            });
        })
    });
    // RESET MODAL
    $(board_settings).on('hide.bs.modal', function() {
        $(board_settings+" .nav-link").removeClass('active');
        $(board_settings+" .tab-pane").removeClass('active').removeClass('show');
    })

});


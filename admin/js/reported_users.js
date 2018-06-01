$(document).ready(function (){
    $(document).on('click', '.approve-report', function() {
        let report = $(this);
        let post_id = report.data('post-id');
        let report_id = report.data('report-id');

        $.ajax({
            url: 'includes/api/report_post/delete.php?report_id=' + report_id,
            data: { post_id: post_id },
            type: 'DELETE',
            success: function(data) {
                if(!data.error) {
                    console.log(data.message);
                    report.parent().parent().next().remove();
                    report.parent().parent().remove();
                    let reported_posts = $('#reported-posts');
                    if(reported_posts.children('.row').length < 2) {
                        reported_posts.after("<p id='no-more-reports' class='col col-md-6 alert alert-success'>You successfully dealed with reports. You are done for now.</p>");
                        setTimeout(function(){
                            $('#no-more-reports').remove();
                        }, 1000);
                        reported_posts.remove();
                    }
                }
            }
        })
    });
    $(document).on('click', '.reject-report', function() {
        let report = $(this);
        let report_id = report.data('report-id');

        $.ajax({
            url: 'includes/api/report_post/delete.php?report_id=' + report_id,
            type: "DELETE",
            success: function(data) {
                if(!data.error) {
                    console.log(data.message);
                    $('[data-toggle="tooltip"]').tooltip('hide');
                    report.parent().parent().next().remove();
                    report.parent().parent().remove();
                    let reported_posts = $('#reported-posts');
                    if(reported_posts.children('.row').length < 2) {
                        reported_posts.after("<p id='no-more-reports' class='col col-md-6 alert alert-success'>You successfully dealed with reports. You are done for now.</p>");
                        setTimeout(function(){
                            $('#no-more-reports').remove();
                        }, 1000);
                        reported_posts.remove();
                    }
                }
            }
        })
    })
});
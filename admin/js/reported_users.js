$(document).ready(function (){
    $(document).on('click', '.approve-report', function() {
        let report = $(this);
        let post_id = report.data('post-id');
        let report_id = report.data('report-id');

        $.ajax({
            url: 'includes/ajax_code.php',
            data: {approved_report: true, post_id: post_id, report_id: report_id},
            type: 'POST',
            success: function(data) {
                if(!data.error) {
                    console.log(data);
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
    })
});
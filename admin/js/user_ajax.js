$(document).ready(function() {
    $(document).on('click', '.delete-user', function() {
        // Delete role & update DOM
        let user_id = $(this).attr('data-id');
        $(this).parent().parent().get(0).remove();
        $.ajax({
            url:"includes/ajax_code.php",
            data:{delete_user: true, user_id: user_id},
            type: "POST",
            success: function(data) {
                if(!data.error) {
                    console.log('Successfully deleted ' + data);
                }
            }
        });

    });

});
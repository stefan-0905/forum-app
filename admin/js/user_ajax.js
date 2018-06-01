$(document).ready(function() {
    $(document).on('click', '.delete-user', function() {
        // Delete role & update DOM
        let user_id = $(this).attr('data-id');
        $(this).parent().parent().get(0).remove();
        $.ajax({
            url:"includes/api/user/delete.php?user_id=" + user_id,
            type: "DELETE",
            success: function(data) {
                if(!data.error) {
                    console.log(data.message);
                }
            }
        });

    });

});
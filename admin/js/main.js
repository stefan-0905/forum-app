
$(document).ready(function() {

    $("#create_role").click(function() {
        // Create role & update DOM
        let role_name = $('input[name="role_name"]').val();
        let permissions = $('input[name="selected_permissions[]"]:checked');
        let role_permissions = [];
        for(let i=0;i<permissions.length;i++)
            role_permissions[i] = permissions[i].value;
        $.ajax({
            url:"includes/ajax_code.php",
            data:{create: true, role_name: role_name, role_permissions: role_permissions},
            type: "POST",
            success: function(data) {
                if(!data.error) {
                    let role = JSON.parse(data);
                    $("#role_tb tr:last")
                        .after("<tr><td>" + role.name + "</td><td>"
                            +"<a href='roles.php?role_id="+role.id+"' class='edit-role text-primary'><i class='fa fa-edit'></i></a> "
                            +"<a data-id=" + role.id + " class='delete_role btn btn-sm btn-danger text-light py-0'>Delete</a></td></tr>");
                    //location.reload(true);
                }
            }
        });
    });

    $('#update_role').click(function() {
        // Update Role & update DOM
        let role_name = $('input[name="role_name"]').val();
        let role_id = $('input[type="hidden"]').val();
        let permissions = $('input[name="selected_permissions[]"]:checked');
        let role_permissions = [];
        for(let i=0;i<permissions.length;i++)
            role_permissions[i] = permissions[i].value;
        $.ajax({
            url:"includes/ajax_code.php",
            data:{update: true, role_id: role_id, role_name: role_name, role_permissions: role_permissions},
            type: "POST",
            success: function(data) {
                if(!data.error) {
                    //console.log(JSON.parse(data)[0].name);
                    location.reload(true);
                }
            }
        });
    });

    $(document).on('click', '.delete_role', function() {
        // Delete role & update DOM
        let role_id = $(this).attr('data-id');
        $(this).parent().parent().get(0).remove();
            $.ajax({
                url:"includes/ajax_code.php",
                data:{delete: true, role_id: role_id},
                type: "POST",
                success: function(data) {
                    if(!data.error) {
                        console.log('Successfully deleted ' + data);
                    }
                }
            });

    });
});
$(document).ready(function () {
    $(document).on('click', '.signin', function() {
        let username = $('#user_username').val();
        let password = $('#user_password').val();
        if(username != "" && password != "")
            $.ajax({
                url: "admin/includes/ajax_code.php",
                data: {signin: true, username: username, password: password},
                type: "POST",
                success: function (data) {
                    if(!data.error && data == 'Success')
                        location.reload(true);
                        else $('#signinForm').prev().removeClass('d-none').text(data);
                }
            })
        else $('#signinForm').prev().removeClass('d-none').text('Please enter something in the fields');
    })
})
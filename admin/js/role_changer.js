$(document).ready(function() {

    $(".change-role").click(function() {
        $(this).prev().toggleClass("d-inline-block");
        if(!$(this).children().hasClass("fa-check"))
            $(this).children().removeClass('fa-edit').addClass("fa-check");
            else {
                $(this).children().removeClass('fa-check').addClass("fa-edit");
                let select = $(this).prev()[0];
                let select_value = select.options[select.selectedIndex].value;
                console.log(select_value);
                let user_id = $(this).data("id");
                console.log(user_id);
                $.ajax({
                    url:"includes/ajax_code.php",
                    data:{update_user_role: true, user_id: user_id, role_id: select_value},
                    type: "POST",
                    success: function(data) {
                        if(!data.error) {
                            //let user = JSON.parse(data);
                            // console.log(data);
                            location.reload(true);
                        }
                    }
                });
            }
    })

    

});
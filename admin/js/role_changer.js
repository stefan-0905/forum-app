$(document).ready(function() {

    $(".change-role").click(function() {
        let role_changer = $(this);
        $(this).prev().toggleClass("d-inline-block"); // This refers to change-role button
        if(!$(this).children().hasClass("fa-check")) {
            $(this).children().removeClass('fa-edit').addClass("fa-check");
            $(this).after("<a class='close-rolechanger text-danger'><i class='fa fa-times'></i></a>");
            $(document).on('click', '.close-rolechanger', function (){
                $(this).prev().prev().toggleClass("d-inline-block"); // This refers to .close button
                $(this).prev().children().removeClass('fa-check').addClass("fa-edit");
                $(this).remove();
            })
        } else {
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
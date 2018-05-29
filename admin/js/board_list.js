$(document).ready(function() {
    $(document).on('click', '.edit-title', function() {
        let edit_btn = $(this);
        let edit_section = $(this).parent().next();
        let display = edit_section.prop('style');
        if(display.display == 'none')
        {
            edit_section.show('2500')
            $(document).on('click', '.update-title', function() {
                let board_item_id = $(this).data('item-id');
                let title = $(this).prev().children()[1].value;
                
                if(title !== "") {
                    update_title(board_item_id, title);
                    edit_btn.prev().text(title);
                    edit_section.hide('2500');
                }
            })
        }
        else edit_section.hide('2500');
    })
    $(document).on('click', '#create-item', function() {
        $('#create-form').toggleClass('d-inline-block');
    })
    $(document).on('click', '.delete-item', function() {
        board_item_id = $(this).data('id');
        $.ajax({
            url: "includes/ajax_code.php",
            data: {delete_board_item: true, board_item_id: board_item_id},
            type: "POST",
            success: function(data) {
                if(!data.error){
                    location.reload(true);
                }
            }
        })
    })
})

function update_title(id, title)
{
    $.ajax({
        url: "includes/ajax_code.php",
        data: {update_board_item: true, board_item_id: id, board_title: title},
        type: "POST",
        success: function(data) {
            if(!data.error){
                //location.reload(true);
            }
        }
    })
}
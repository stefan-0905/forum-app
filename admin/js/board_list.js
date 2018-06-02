$(document).ready(function() {
    $(document).on('click', '.edit-title', function() {
        let edit_btn = $(this);
        let edit_section = edit_btn.parent().parent().next();
        let display = edit_section.prop('style');
        if(display.display == 'none')
        {
            edit_section.show('2500')
            $(document).on('click', '.update-title', function() {
                let okay_btn = $(this);
                let board_item_id = $(this).data('item-id');
                let title = $(this).prev().children()[1].value;
                
                if(title !== "") {
                    let this_section = okay_btn.parent().parent();
                    update_title(board_item_id, title);
                    this_section.prev().children()[0].innerText = title;
                    this_section.hide('2500');
                }
            })
        }
        else edit_section.hide('2500');
    });
    $(document).on('click', '#create-item', function() {
        $('#create-form').toggleClass('d-inline-block');
    });
    $(document).on('click', '.delete-item', function() {
        let board_item_id = $(this).data('id');
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
    });
    $(document).on('click', '#add-item', function() {
        let board_item_title = $('#new-item-title').get('0').value;
        $.ajax({
            url: "includes/api/board_list/create.php",
            data: { board_item_title: board_item_title },
            type:  "POST",
            success: function(data) {
                if(!data.error) {
                    location.reload(true);
                }
            }
        })
    })
});

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
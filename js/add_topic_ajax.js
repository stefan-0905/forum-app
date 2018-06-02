$(document).ready(function () {
    $('#addTopicModal').on('show.bs.modal', function(e) {

        let board_item_id = e.relatedTarget.id;

        $(document).on('click', '.add-topic', function() {
            let title = $('#title').val();
            let description = $('#topic_description').val();
            
            if(title != "" && description != "")
                $.ajax({
                    url: "admin/includes/api/topic/create.php",
                    data: {add_topic: true, title: title, description: description, board_item_id: board_item_id},
                    type: "POST",
                    success: function (data) {
                        if(!data.error)
                            location.reload(true);
                        else $('#addTopicForm').prev().removeClass('d-none').text(data);
                    }
                })
            else $('#addTopicForm').prev().removeClass('d-none').text('Please enter something in the fields');
        })
    })
})
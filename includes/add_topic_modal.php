

<div class="modal" id="addTopicModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">Add Topic</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p class="alert alert-danger d-none"></p>
                <form id="addTopicForm" method="POST">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input id="title" name="title" type="text" placeholder="Title" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="topic_description">Description:</label>
                        <textarea placeholder="Description" name="topic_desctiption" id="topic_description" class="d-block w-100"></textarea>
                    </div>
                    <div class="modal-footer pb-0">
                        <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" name="add_topic" class="btn btn-primary add-topic">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
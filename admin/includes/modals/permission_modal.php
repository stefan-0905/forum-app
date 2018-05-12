<?php

if(isset($_POST['save_permission'])) {
    include ('../init.php');
    $new_perm = new Permission();
    $new_perm->name = $_POST['new_permission'];

    if($new_perm->save())
        redirect('../../roles.php');
}
?>

<div class="modal fade" id="createPermission" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createPermissionLabel">Create Permission</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Just name your new permission down below</p>
        <form action="includes/modals/permission_modal.php" method="POST">
        <div class="form-group">
            <label for="new_permission" class="sr-only">New Permission</label>
            <input type="text" class="form-control" id="new-permission" name="new_permission" placeholder="New Permission">
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="save_permission" class="btn btn-primary" value="Save permission">
      </div>
        </form>
      </div>
    </div>
  </div>
</div>
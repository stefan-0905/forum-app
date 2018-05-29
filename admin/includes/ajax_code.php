<?php
require("init.php");

if(isset($_POST['create'])) {
    // Create role & update DOM
        $new_role = new Role();
        $new_role->name = $_POST['role_name'];
        $new_role->save();
        if (isset($_POST['role_permissions']))
            foreach ($_POST['role_permissions'] as $permission) {
                $new_role->saveRolePerm($permission);
            }
        echo json_encode($new_role);
}
if(isset($_POST['update'])) {
    $role = Role::find($_POST['role_id']);
    $role->name = $_POST['role_name'];
    $role->save();
    $role_permissions = Role::getRolePerm($role->id);

    $role_perm_names = array(); // Assigned Permission Names Array
    if (isset($_POST['role_permissions']))
        foreach ($_POST['role_permissions'] as $permission) {
            $role_perm_names[] = Permission::find($permission)->name;
            if (!$role_permissions->hasPerm(Permission::find($permission)->name))
                $role->saveRolePerm($permission);
        }
    $old_perm = array(); // Old Permission Names Array
    foreach ($role_permissions->permissions as $key => $value) $old_perm[] = $key;
    foreach(array_diff($old_perm, $role_perm_names) as $diff_item)
        $role->deleteRolePerm(Permission::find_by_name($diff_item)->id);
}
if(isset($_POST['delete'])) {
    // Delete role & update DOM
    $role = Role::find($_POST['role_id']);
    echo $role->name;
    $role->delete();
}

if(isset($_POST['delete_board_item']))
{
    try {
        if(!$board_item = BoardList::find($_POST['board_item_id']))
            throw new Exception('Ups! Something went wrong');
        if($board_item->delete())
            echo "Successfully deleted item";
    } catch(Exception $ex) {
        redirect("../../error404.php?message=".$ex->getMessage());
    }
}
if(isset($_POST['update_board_item']))
{
    try {
        if(!$board_item = BoardList::find($_POST['board_item_id']))
            throw new Excepetion('Ups! That id doesn\'t exist');
        $board_item->title = trim(strip_tags($_POST['board_title']));
        if($board_item->save())
            echo "Success";
    } catch(Exception $ex) {
        redirect("../../error404.php?message=".$ex->getMessage());
    }
}

if(isset($_POST['delete_user'])) {
    $user = User::find($_POST['user_id']);
    echo $user->id;
    $user->delete();
}

if(isset($_POST['update_user_role'])) {
    $user = User::find($_POST['user_id']);
    $user->setRole($_POST['role_id']);
}

if(isset($_POST['signin'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    //Method to check database user
    $user_found = User::verify_user($username, $password);

    if($user_found) {
        $session->login($user_found);
        echo "Success";
    } else {
        echo "Your password or username is incorrect";
    }
}

if(isset($_POST['add_topic'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    $new_topic = new Topic();
    $new_topic->title = $title;
    $new_topic->description = $description;
    
    if($new_topic->save() && $new_topic->append_to_board($_POST['board_item_id']))
        echo "Success";
        else "Something went wrong, check your input.";
}

if(isset($_POST['report_post'])) {
    global $database;
    $post_id = $_POST['post_id'];
    $user = $session->user_id;
    
    $sql = "INSERT INTO reported_posts(post_id,reported_by) VALUES($post_id,$user)";
    if($database->query($sql))
        echo "Post successfully reported.";
    else echo "Something went wrong with inserting report into database";
}

if(isset($_POST['approved_report'])) 
{
    $reported_post = Post::find($_POST['post_id']);
    $reported_post_info = ReportedPost::find($_POST['report_id']);
    
    if($reported_post->delete())
        if($reported_post_info->delete())
            echo "Post successfully deleted.";
}
if(isset($_POST['reject_report']))
{
    $report_id = ReportedPost::find($_POST['report_id']);
    if($report_id->delete())
        echo "Report rejected.";
}

if(isset($_POST['delete_topic']))
{
    $topic = Topic::find($_POST['topic_id']);
    $topic->deleteRelatedThreadsAndPosts();
    $topic->deleteRelationWithBoardList();
    $topic->delete();
    echo $_POST['topic_id'];
}

if(isset($_POST['delete_thread']))
{
    $thread = thread::find($_POST['thread_id']);
    if($thread->delete())
        echo $_POST['thread_id'];
}

?>
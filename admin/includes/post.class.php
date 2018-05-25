<?php


class Post extends Db_object 
{
    protected static $db_table = 'posts';
    protected static $db_table_fields = array('id', 'thread_id', 'user_id', 'message', 'created_at', 'updated_at');
    public $id;
    public $thread_id;
    public $user_id;
    public $message;
    
    public static function getRelatedPosts($thread_id)
    {
    $sql = "SELECT * FROM posts WHERE thread_id = {$thread_id}";
    $related_posts = self::find_by_query($sql);
    if(!empty($related_posts))
        return $related_posts;
    else return false;
    }
    public static function getUserRelatedPosts($user_id)
    {
        $sql = "SELECT * FROM posts WHERE user_id = $user_id";
        $related_posts = self::find_by_query($sql);
        if(!empty($related_posts))
            return $related_posts;
        else return false;
    }
    public static function getLastPost(int $thread_id)
    {
        $sql = "SELECT * FROM " . self::$db_table . " WHERE thread_id = {$thread_id} ORDER BY created_at DESC LIMIT 1";
        if($result_array = self::find_by_query($sql))
            return array_shift($result_array);
            else return false;
    }
    public static function count_by_topic_id(int $id)
    {
        global $database;

    $sql = "SELECT COUNT(*) FROM threads as t JOIN posts as p ON t.id = p.thread_id WHERE t.topic_id = {$id}";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);

        return array_shift($row);
    }
}


















?>
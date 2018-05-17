<?php


class Post extends Db_object 
{
    protected static $db_table = 'posts';
    protected static $db_table_fields = array('id', 'thread_id', 'user_id', 'message', 'created_at', 'updated_at');
    public $id;
    public $thread_id;
    public $user_id;
    public $message;
    public $created_at;
    public $updated_at;

    public function __construct()
    {
        $this->created_at = date('Y-m-d h:i:sa');
        $this->updated_at = date('Y-m-d h:i:sa');
    }

    public static function getRelatedPosts($thread_id)
    {
    $sql = "SELECT * FROM posts WHERE thread_id = {$thread_id}";
    $related_posts = self::find_by_query($sql);
    if(!empty($related_posts))
        return $related_posts;
        else return false;
    }
}


















?>
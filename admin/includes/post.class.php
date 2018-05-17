<?php


class Post extends Db_object 
{
    protected static $db_table = 'posts';
    protected static $db_table_fields = array('thread_id', 'user_id', 'message', 'created_at', 'updated_at');
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
}


















?>
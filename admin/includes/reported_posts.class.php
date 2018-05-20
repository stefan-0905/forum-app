<?php 


class ReportedPosts extends Db_object 
{
    protected static $db_table = 'reported_posts';
    protected static $db_table_fields = array('thread_id', 'reported_user_id', 'reported_by', 'bookmark');
    public $id;
    public $thread_id;
    public $reported_user_id;
    public $reported_by;
    public $bookmark;

}



?>
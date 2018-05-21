<?php 


class ReportedPost extends Db_object 
{
    protected static $db_table = 'reported_posts';
    protected static $db_table_fields = array('post_id', 'reported_user_id', 'reported_by', 'bookmark');
    public $id;
    public $post_id;
    public $reported_user_id;
    public $reported_by;
    public $bookmark;

}



?>
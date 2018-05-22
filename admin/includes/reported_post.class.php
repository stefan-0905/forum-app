<?php 


class ReportedPost extends Db_object 
{
    protected static $db_table = 'reported_posts';
    protected static $db_table_fields = array('post_id', 'reported_by');
    public $id;
    public $post_id;
    public $reported_by;

}



?>
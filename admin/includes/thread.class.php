<?php 

class Thread extends Db_object 
{
    protected static $db_table = 'threads';
    protected static $db_table_fields = array('id', 'topic_id', 'user_id', 'subject', 'created_at', 'updated_at');
    public $id;
    public $topic_id;
    public $user_id;
    public $subject;
    public $created_at;
    public $updated_at;

    public function __construct()
    {
        $this->created_at = date('Y-m-d h:i:sa');
        $this->updated_at = date('Y-m-d h:i:sa');
    }
    public static function getRelatedThreads($topic_id)
    {
        $sql = "SELECT * FROM threads WHERE topic_id = {$topic_id}";
        if($result_array = self::find_by_query($sql))
            return $result_array;
            else return false;
    }
}


?>
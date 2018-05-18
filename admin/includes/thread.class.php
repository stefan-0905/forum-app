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
        $this->created_at = date('Y-m-d H:i:sa');
        $this->updated_at = date('Y-m-d H:i:sa');
    }
    public static function getRelatedThreads(int $topic_id)
    {
        $sql = "SELECT * FROM threads WHERE topic_id = {$topic_id} ORDER BY created_at DESC";
        if($result_array = self::find_by_query($sql))
            return $result_array;
            else return false;
    }
    public static function getLastThread(int $topic_id)
    {
        $sql = "SELECT * FROM " . self::$db_table . " WHERE topic_id = {$topic_id} ORDER BY created_at DESC LIMIT 1";
        if($result_array = self::find_by_query($sql))
            return array_shift($result_array);
            else return false;
    }
    public static function count_by_topic_id(int $id)
    {
        global $database;

        $sql = "SELECT COUNT(*) FROM " . static::$db_table . " WHERE topic_id = {$id}";
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);

        return array_shift($row);
    }
}


?>
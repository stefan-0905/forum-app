<?php

class Topic extends Db_object 
{
    protected static $db_table = "topics";
    protected static $db_table_fields = array('id','title', 'description','created_at','updated_at');
    public $id;
    public $title;
    public $description;
    public $created_at;
    public $updated_at;

    public function __construct()
    {
        $this->created_at = date('Y-m-d H:i:sa');
        $this->updated_at = date('Y-m-d H:i:sa');
    }
    public function append_to_board($board_item_id)
    {
        global $database;
        $sql = "INSERT INTO board_list_topics(list_id, topic_id) VALUES({$board_item_id}, {$this->id})";
        if($database->query($sql)) 
            return true;
        else return false;
    }
    public static function getRelatedTopics($board_list_id)
    {
        $sql = "SELECT * FROM board_list_topics as blt JOIN topics as t ON blt.topic_id = t.id ";
        $sql .= "WHERE blt.list_id = " . $board_list_id;
        $result = self::find_by_query($sql);
        if($result) return $result;
        else return false;
    }
    
}










?>
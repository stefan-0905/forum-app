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
        $this->created_at = date('Y-m-d h:i:s');
        $this->updated_at = date('Y-m-d h:i:s');
    }
    public function append_to_board($board_item_id)
    {
        global $database;
        $sql = "INSERT INTO board_list_topics(list_id, topic_id) VALUES({$board_item_id}, {$this->id})";
        if($database->query($sql)) 
            return true;
        else return false;
    }
}










?>
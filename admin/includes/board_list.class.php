<?php

class BoardList extends Db_object
{
    protected static $db_table = "board_list";
    protected static $db_table_fields = array('id', 'title', 'created_at', 'updated_at');
    public $id;
    public $title;
    public $list_items;

    public function __construct()
    {
        parent::__construct();
    }
    public function getBoardListItems()
    {
        global $database;
        $sql = "SELECT * FROM board_list_topics as blt JOIN topics as t ON blt.topic_id = t.id ";
        $sql .= "WHERE blt.list_id = " . $this->id;
        $result = $database->query($sql);
        $list_items = array();
        while($row = mysqli_fetch_assoc($result)) {
            $new_assoc = array('id' => $row['id'], 'title' => $row['title'], 'description' => $row['description']);
            $this->list_items[] = $new_assoc;
        }

    }
}








?>
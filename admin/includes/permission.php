<?php

class Permission extends Db_object
{
    protected static $db_table = 'permissions';
    protected static $db_table_fields = array('id','name','created_at','updated_at');
    public $id;
    public $name;
    public $created_at;
    public $updated_at;
    public function __construct()
    {
        $this->created_at = date('Y-m-d h:i:s');
        $this->updated_at = date('Y-m-d h:i:s');
    }
    public static function find_by_name($name) {
        $sql = "SELECT * FROM " . self::$db_table . " WHERE name = '" . $name . "'";
        $result = self::find_by_query($sql);
        return !empty($result) ? array_shift($result) : false;
    }
}
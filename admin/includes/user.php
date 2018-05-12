<?php

class User extends Db_object
{
    protected static $db_table = 'users';
    protected static $db_table_fields = array('email', 'username', 'password', 'created_at', 'updated_at');
    public $id;
    public $email;
    public $username;
    public $password;
    public $created_at;
    public $updated_at;

    public function __construct()
    {
        $this->created_at = date('Y-m-d h:i:s');
        $this->updated_at = date('Y-m-d h:i:s');
    }

    public static function verify_user($username, $password)
    {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . static::$db_table . " WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";

        $result_query = self::find_by_query($sql);
        return !empty($result_query) ? array_shift($result_query) : false;
    }
    public function setRole($role_id) 
    {
        global $database;
        if($this->hasSomeRole()) {
            if(!$role_id === 0) {
                $sql = "UPDATE user_role SET role_id = " . $role_id . " WHERE user_id = " . $this->id;
                echo $sql;
                $database->query($sql);
                return (mysqli_affected_rows($database->connection) == 1) ? true : false;
            } else {
                $sql = "DELETE FROM user_role WHERE user_id = " . $this->id;
                $database->query($sql);
                return (mysqli_affected_rows($database->connection) == 1) ? true : false;
            }
        } else {
            $sql = "INSERT INTO user_role (user_id, role_id) VALUES ('{$this->id}','{$role_id}') ";
            echo $sql;
            return !empty($database->query($sql)) ? true : false;
        }
    }
    public function hasSomeRole()
    {
        global $database;
        $sql = "SELECT * FROM user_role WHERE user_id = " . $this->id;
        echo $sql;
        $role_found = $database->query($sql); 
        return ($role_found->num_rows>0) ? true : false;
    }
}
<?php

class Role extends Db_object
{
    protected static $db_table = 'roles';
    protected static $db_table_fields = array('id','name','created_at','updated_at');
    public $id;
    public $name;
    public $created_at;
    public $updated_at;
    public $permissions;

    public function __construct()
    {
        $this->created_at = date('Y-m-d H:i:sa');
        $this->updated_at = date('Y-m-d H:i:sa');
        $this->permissions = array();
    }
    public static function find_by_name($name) {
        $sql = "SELECT * FROM " . self::$db_table . " WHERE name = '" . $name . "'";
        $result = self::find_by_query($sql);
        return !empty($result) ? array_shift($result) : false;
    }
    public static function check_name($name) {
        global $database;
        $sql = "SELECT * FROM " . self::$db_table . "  WHERE name = '" . $name . "'";
        $checked_name = self::find_by_query($sql);
        return !empty($checked_name) ? true : false;
    }
    public static function check_id($id) {
        global $database;
        $sql = "SELECT * FROM " . self::$db_table . "  WHERE id = " . $id;
        $checked_id = self::find_by_query($sql);
        return !empty($checked_id) ? true : false;
    }
    public static function getRolePerm($role_id) {
        // Return Role Object With Associated Permissions
        global $database;
        $role = new Role();
        $role_id = $database->escape_string($role_id);

        $sql = "SELECT t2.name FROM role_perm as t1 JOIN permissions as t2 ON t1.perm_id = t2.id ";
        $sql .= "WHERE t1.role_id = {$role_id}";
        $result = $database->query($sql);

        while($row = mysqli_fetch_assoc($result)) {
            $role->permissions[$row['name']] = true;
        }
        return $role;
    }
    public function saveRolePerm($perm_id) {
        global $database;
        $sql = "SELECT * FROM role_perm WHERE role_id = " . $this->id;
        $result = $database->query($sql);
        while($row = mysqli_fetch_array($result))
            if($row['perm_id'] == $perm_id)
                return false;

        $sql = "INSERT INTO role_perm (role_id, perm_id) VALUES({$this->id}, ${perm_id})";
        if($database->query($sql))
            return true;
        else return false;
    }
    public function deleteRolePerm($perm_id) {
        global $database;
        $sql = "DELETE FROM role_perm WHERE role_id = '" . $database->escape_string($this->id) . "' AND perm_id = '" . $database->escape_string($perm_id) . "'";
        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }
    public function hasPerm($permission) {
        // Check if a permission is set
         return isset($this->permissions[$permission]);
    }
}

?>
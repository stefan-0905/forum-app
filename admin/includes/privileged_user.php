<?php

class PrivilegedUser extends User
{
    private $roles;

    public function __construct()
    {
        parent::__construct();
    }
    public static function find($id)
    {
        global $database;
        $result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id = $id");
        if(!empty($result_array)) {
            $privUser = array_shift($result_array);
            $privUser->initRoles();
            return $privUser;
        } else {
            return false;
        }
    }
    protected function initRoles()
        // Populate roles array with user associated roles 
    {
        global $database;
        $this->roles = array();

        $sql = "SELECT t1.role_id, t2.name FROM user_role as t1 JOIN roles as t2 ON t1.role_id = t2.id ";
        $sql .= "WHERE t1.user_id = {$this->id}";

        $result = $database->query($sql);
        while($row = mysqli_fetch_assoc($result)) {
            $this->roles[$row['name']] = Role::getRolePerm($row['role_id']);
        }
    }
    public function hasPrivilege($perm)
        // Check if user has specific privilege
    {
        foreach($this->roles as $role) {
            if($role->hasPerm($perm))
                return true;
        }
        return false;
    }
}
<?php

class User extends Db_object
{
    protected static $db_table = 'users';
    protected static $db_table_fields = array('email', 'username', 'password', 'profile_avatar', 'created_at', 'updated_at');
    public $id;
    public $email;
    public $username;
    public $password;
    public $profile_avatar;
    public $created_at;
    public $updated_at;

    public function __construct()
    {
        $this->created_at = date('Y-m-d H:i:sa');
        $this->updated_at = date('Y-m-d H:i:sa');
        $this->profile_avatar = "user_default_blue.png";
    }
    public static function check_username($username)
    {
        global $database;
        $sql = "SELECT * FROM " . static::$db_table . " WHERE username = '" . $username . "'";
        if(!empty(self::find_by_query($sql)))
            return true;
            else return false;
    }
    public static function check_email($email)
    {
        global $database;
        $sql = "SELECT * FROM " . static::$db_table . " WHERE email = '" . $email . "'";
        if(!empty(self::find_by_query($sql)))
            return true;
            else return false;
    }
    public static function verify_user($username, $password)
    {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . static::$db_table . " WHERE ";
        $sql .= "username = '{$username}' ";

        $result_query = self::find_by_query($sql);
        if(!empty($result_query)) {
            $existing_user = array_shift($result_query);
            if(password_verify($password, $existing_user->password))
                return $existing_user;
                else return false;
        }
    }
    public function setRole($role_id) 
    {
        global $database;
        if($this->hasSomeRole()) {
            if(!$role_id === 0) {
                $sql = "UPDATE user_role SET role_id = " . $role_id . " WHERE user_id = " . $this->id;
                $database->query($sql);
                return (mysqli_affected_rows($database->connection) == 1) ? true : false;
            } else {
                $sql = "DELETE FROM user_role WHERE user_id = " . $this->id;
                $database->query($sql);
                return (mysqli_affected_rows($database->connection) == 1) ? true : false;
            }
        } else {
            $sql = "INSERT INTO user_role (user_id, role_id) VALUES ('{$this->id}','{$role_id}') ";
            return !empty($database->query($sql)) ? true : false;
        }
    }
    public function hasSomeRole()
    {
        global $database;
        $sql = "SELECT * FROM user_role WHERE user_id = " . $this->id;
        $role_found = $database->query($sql); 
        return ($role_found->num_rows>0) ? true : false;
    }
    public function saveAvatar($file)
    {
        $target_dir = SITE_ROOT . DS ."img".DS."profile_images" . DS;
        $target_file = $target_dir . basename($file['name']);
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($file['tmp_name']);
        if($check !== false)
        {
            if($file['size'] <= 3000000)
                if($image_file_type='jpg' || $image_file_type='png' || $image_file_type='jpeg' || $image_file_type='gif')
                    if(!file_exists($target_file))
                        if(move_uploaded_file($file['tmp_name'], $target_file)) 
                            $this->profile_avatar = basename($file['name']);
                        else $this->errors[] = 'Could not upload file.';
                    else $this->profile_avatar = basename($file['name']);
                else $this->errors[] = 'Only jpg, jpeg, png and gif are supported.';
            else $this->errors[] = 'This image is too big, use some other.';
        } else $this->errors[] = 'This file is not an image';
    }
}
<?php

class Db_object {
    public static function find_all()
    {
        return static::find_by_query("SELECT * FROM " . static::$db_table);
    }
    public static function find($id)
    {
        global $database;
        $result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id = $id");
        return !empty($result_array) ? array_shift($result_array) : false;
    }
    public static function find_by_query($sql)
    {
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();
        while($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = static::instantiation($row);
        }
        return $the_object_array;
    }

    public static function instantiation($the_record)
    {
        $calling_class = get_called_class();
        $the_user = new $calling_class;

        /* Shorter version of instantiation */
        foreach($the_record as $the_attribute => $value ) {
            if($the_user->has_the_attribute($the_attribute)) {
                $the_user->$the_attribute = $value;
            }
        }

        return $the_user;
    }
    public function has_the_attribute($the_attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }
    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }
    private function create()
    {
        global $database;
        $properties = $this->clean_properties();
        $sql = "INSERT INTO " . static::$db_table . " (" . implode(',', array_keys($properties)) . ") ";
        $sql .= "VALUES('" . implode("','", array_values($properties)) . "')";

        if($database->query($sql)) {
            $this->id =$database->the_insert_id();
            return true;
        } else {
            return false;
        }
    }
    private function properties()
    {
        $properties = array();
        foreach (static::$db_table_fields as $db_field)
            if(property_exists($this, $db_field))
                $properties[$db_field] = $this->$db_field;
        return $properties;
    }
    private function clean_properties()
    {
        global $database;
        $clean_properties = array();
        foreach($this->properties() as $key => $value)
            $clean_properties[$key] = $database->escape_string($value);
        return $clean_properties;
    }
    private function update() {
        global $database;
        $properties = $this->properties();
        $properties_pairs = array();

        foreach($properties as $key => $value) {
            $properties_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .= " WHERE id = " . $database->escape_string($this->id);

        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }
    public function delete()
    {
        global $database;
        $sql = "DELETE FROM " . static::$db_table . " WHERE id = " . $database->escape_string($this->id);
        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    } // delete Method

    public static function count_all()
    {
        global $database;

        $sql = "SELECT COUNT(*) FROM " . static::$db_table;
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);

        return array_shift($row);
    }
}
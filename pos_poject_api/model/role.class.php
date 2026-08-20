<?php
class Role{
    public $id;
    public $name;
    public $description;

    public function __construct($_id, $_name, $_description )
    {
        $this->id= $_id;
        $this->name= $_name;
        $this->description= $_description;
    }


    public static function getAll(){
        global $db;
        $sql = "SELECT * FROM roles";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
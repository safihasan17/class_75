<?php

class User{
    public $name;
    public $age;

    public function __construct($_name, $_age){
        $this->name = $_name;
        $this->age = $_age;
    }
}

$user = new User("Raju ",  25);
echo $user->name;
echo $user->age;
?>

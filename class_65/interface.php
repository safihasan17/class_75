<?php

interface iTest1{
    public function viewInfo();

}

interface iTesr2{
    public function showText();

}

class Childclass implements iTest1, iTesr2{
    public $name = "Mina";
    public $email = "tpasss@example.com";

    public function viewInfo(){
        echo "name: $this->name <br> Email: $this->email <br>";

    }

    public function showText(){
        echo " A static Message <br>";
    }
}

$child = new childClass();
$child ->viewInfo();
$child ->showText();

?>

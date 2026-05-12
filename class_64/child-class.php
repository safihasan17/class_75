<?php

class User{
    public $name;
    public $age;

    public function __construct($_name, $_age){
        $this->name = $_name;
        $this->age = $_age;
    }

    public function test(){
        echo "test from parent class";
    }
}

class Trainee extends User{
    public $course;
    public $year;

    public function __construct($_course,  $_year, $_name, $_age){
        parent:: __construct($_name, $_age);
        $this->course = $_course;
        $this->year = $_year;
    }

    public function info(){
        echo "name : " . $this->name . "<br>";
        echo "age : " . $this->age . "<br>";
        echo "course :" . $this->course . "<br>";
        echo "year : " . $this->year . "<br>";
    }



}

class Academy extends Trainee{
    public $session;
    public function __construct ($_session, $_course, $_year, $_name, $_age){
        parent:: __construct( $_course, $_year, $_name, $_age);
        $this->session = $_session;
    }
    public function info(){
        parent:: info();
        echo "session : " . $this->session . "<br>";

    }
}


$trainee = new Trainee("PHP", 2026, "Raju",25);
$trainee->info();
$trainee -> test();
echo "<br>";
echo "<br>";
$academy = new Academy ( 2020,"PHP",2026, "Raju",25);
$academy->info();
// echo $academy ->session;

?>
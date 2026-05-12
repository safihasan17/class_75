<?php

class User{
    public $name;
    public $age;
    protected $address = "dhaka";
    private $password = "12345";
    static $country = "Bangladesh";

    public function __construct($_name, $_age){
        $this->name = $_name;
        $this->age = $_age;
    }

    final function test(){
        echo "test from parent class";
        echo "<br>";
        echo "password: " . $this->password . "<br>";

    }

    public static function checkage($_age=0){
        if($_age >=18){
            return "You are eligable for vote";
        }else{
            return "You are not  eligable for vote";
        }
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
        echo "Address: " . $this->address . "<br>";
        // echo "password: " . $this->password . "<br>";

    }

    // public function test(){
    //     echo "test from child class";
       
    // }



}

$user = new User("Raju", 25);
// $user->password;


$trainee = new Trainee("PHP", 2026, "Raju",25);
$trainee->info();
$trainee -> test();

echo "<br>";
echo "<br>";
// $academy = new Academy ( 2020,"PHP",2026, "Raju",25);
// $academy->info();
// echo $academy ->session;

echo User::checkage(15);
echo "<br>";
  
echo User::$country;

?>
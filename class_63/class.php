<?php

  class Person {
    public $name = "John";
    public $age = 22;


    public function info(){
        echo "Name:" .$this->name ."<br>";
        echo "Age:" .$this->age ."<br>";

    }
    
  };

   $person =   new Person();
   $person ->info();
   echo $person-> age;
   $person->name = "Raju";
   echo $person -> name;
   echo "<br>";
    $person ->info();


   
   $arr = [1,2,3,4];
   echo "<Pre>";
   print_r($person);
   print_r($arr);
   echo "</pre>";


?>
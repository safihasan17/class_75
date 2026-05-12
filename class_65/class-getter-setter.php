<?php
  
  class person{
     private $name;
     private $age;

    //  public function __get($_name){
    //     return $this->$_name;
    //  }

    //  public function __set($_pname, $_pvalue){
    //     $this-> $_pname = $_pvalue;
    //  }

    public function getage(){
        return $this->age;
    }


    public function setage($_age){
        $this->age = $_age;
    }


  }

  $person = new Person();
//   $person-> name = "john";
//   $person-> age = 25;

//   echo $person->name;
//   echo "<br>";
//   echo $person -> age;


$person -> setage(50);
echo $person->getage();


?>
<?php
  class student{
    public $id;
    public $name;
    public $score;
    public $grade;


    function __construct($_id= null, $_name = "", $_score= "", $_grade=""){
          $this->id = $_id;
          $this->name = $_name;
          $this->score = $_score;
          $this->grade = $_grade;
    }


    function showAll(){
        $file = fopen("files/student.csv" , "r");
        $html ="";
        while($row = fgetcsv($file)){
        //    echo "<pre>";
        //    print_r($file);
        //    echo "</pre>";

        $html .= "<tr>";
        $html .= "<td> $row[0] </td>";
        $html .= "<td> $row[1] </td>";
        $html .= "<td> $row[2] </td>";
        $html .= "<td> $row[3] </td>";
        $html .= "</tr>";


        }

        fclose($file);
        return $html;
       

    }


    function save(){
        $file = fopen("files/student.csv" , "a+");
        fputcsv($file, [$this->id, $this->name, $this->score, $this->grade]);
        fclose($file);
        return "Data save Successfully";

    }


      function reset($_id){
    $file = fopen("files/student.csv" , "r");
       while($row = fgetcsv($file)){
        if($row[0]== $_id){
            return "ID: $row[0], $row[1],$row[2],$row[3],";
        }

       }

       fclose($file);
       return "Data not found";
  }
    
  }




//   $s = new student;
//   echo $s->showAll();
?>
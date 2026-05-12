<?php
class Student{
    public $id;
    public $name;
    public $batch;
    function __construct($_id= null, $_name="", $_batch=""){
        $this->id =$_id;
        $this->name =$_name;
        $this->batch =$_batch;
    }
    


    function showAll(){
        $file = fopen("files/student.csv", "r");
        $html ="";
        while($row = fgetcsv($file)){
            // echo "<pre>";
            // print_r($row);
            // echo "</pre>";
            
            $html .="<tr>";
            $html .= "<td>$row[0]</td>";
            $html .= "<td>$row[1]</td>";
            $html .= "<td>$row[2]</td>";
            $html .="</tr>";

        }
        fclose($file);
        return $html;
    }

    function save(){
          $file = fopen("files/student.csv", "a+");
          fputcsv($file, [$this->id, $this->name, $this->batch]);
          fclose($file);
          return "Data Saved Successfully";
    }

    function reset($_id){
        $file = fopen("files/student.csv", "r");
        while($row = fgetcsv($file)){
            if($row[0]== $_id){
                return "ID: $row[0], <br> Name: $row[1], <br> Batch: $row[2]";
            }
        }
        fclose($file);
        return "Data not Found";
    }
    
}

// $s = new student;
// echo $s->showAll();


?>
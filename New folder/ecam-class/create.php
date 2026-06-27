<?php

require "files/studemt.class.php";

if(isset($_POST["submit"])){
    $id = $_POST["id"];
    $name = $_POST["name"];
    $score = $_POST["score"];
    $grade = $_POST["grade"];

  $s = new student($id, $name, $score, $grade);
  $data =$s->save();


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<nav>
    <a href="create.php">Add student</a>
    |
    <a href="list.php">student </a>
    |
    <a href="search.php"> search</a>
</nav>  <br> <br>
    

<h3>Add Student list</h3>

<h3 style="color:green;" ><?php echo $data ?? ""?></h3>
 <form action="" method="POST">

 <label for="">ID</label>
 <input type="number" name="id" id=""> <br> <br>
 <label for="">Name</label><br>
 <input type="text" name="name" id=""> <br><br>
 <label for="">Score</label> <br>
 <input type="number" name="score" id=""> <br> <br>
 <label for="">Grade</label> <br> 
 <input type="text" name="grade" id=""> <br> <br>

 <button type="submit" name=" submit">submit</button>
 </form>
</body>
</html>
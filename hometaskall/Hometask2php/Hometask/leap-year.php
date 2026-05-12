<?php
  
  $msg = "";

  if(isset($_POST["submit"])){
    $year = (int)$_POST["year"];

    if($year % 400 == 0 ||($year % 4== 0 && $year % 100!=0) ){
        $msg =  $year . " is a leap year";
    }else{
      $msg =  $year . " is  not a leap year";
    };

    
  };

  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<form  method="POST" >
    <input type="number" name="year" id="">
    <input type="submit" name="submit" id="">
</form>

<h2><?php  echo $msg ?></h2>
</body>
</html>
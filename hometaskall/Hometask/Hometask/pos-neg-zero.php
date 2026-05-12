<?php

$msg ="";

if(isset($_POST["submit"])){
   $number = $_POST["number"];


   if($number > 0){
      $msg = $number . " is a positive number";
   }elseif($number < 0){
    $msg = $number . " is a negative number";
   }else{
    $msg = $number . "  is Zero";
   }
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
    
<form method = "POST">
    <input type="number" name="number" id="">
    <input type="submit" name="submit" id="">
</form>

<h2><?php  echo $msg?></h2>
</body>
</html>
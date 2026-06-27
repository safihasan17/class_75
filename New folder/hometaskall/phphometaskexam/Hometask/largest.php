<?php
 $msg ="";

 if(isset($_POST["submit"])){
    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
    $num3 = $_POST["num3"];
    $num4 = $_POST["num4"];
    $num5 = $_POST["num5"];

    if($num1> $num2  &&   $num1>$num3  &&  $num1>$num4  && $num1>$num5){
        $msg = $num1 . " is the largest";
    }elseif($num2> $num1  &&   $num2>$num3  &&  $num2>$num4  && $num3>$num5){
        $msg = $num2 . " is the largest";
    }elseif($num3> $num1  &&   $num3>$num2  &&  $num3>$num4  && $num3>$num5){
        $msg = $num3 . " is the largest";
    }elseif($num4> $num1  &&   $num4>$num2  &&  $num4>$num3  && $num4>$num5){
        $msg = $num4 . " is the largest";
    }else{
        $msg = $num5 . " is the largest"; 
    }
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
    

  <form  method= "POST">

    <input type="number" name="num1" id=""> <br>
    <input type="number" name="num2" id=""><br>
    <input type="number" name="num3" id=""><br>
    <input type="number" name="num4" id=""><br>
    <input type="number" name="num5" id=""><br> <br>
    <input type="submit" name="submit" id=""> 

    <h2><?php echo $msg ?></h2>
  </form>
</body>
</html>
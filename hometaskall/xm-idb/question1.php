<?php 

$msg ="";

if(isset($_POST["submit"])){
    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
    $num3 = $_POST["num3"];


    if($num1> $num2 && $num1> $num3){
        $msg = "The largest number is  " . $num1;
    }elseif($num2> $num1 && $num2> $num3){
         $msg = "The largest number is  " . $num2;
    }else{
        $msg = "The largest number is  " . $num3;
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>largest</title>
</head>
<body>
    

   <form method="POST">
     <input type="number" name="num1" id="">
     <input type="number" name="num2" id="">
     <input type="number" name="num3" id=""> 
     <input type="submit" name="submit" id="">
   </form>

   <h3><?php echo $msg; ?></h3>
</body>
</html>
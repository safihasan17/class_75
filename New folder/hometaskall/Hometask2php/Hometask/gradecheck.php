<?php
 $msg ="";
  if(isset($_POST["submit"])){
     $num = $_POST["num"];


     if($num>0 && $num<=100){
        if($num>=90){
            $msg = "A" ;
        }elseif($num>=80){
            $msg = "B" ;
        }elseif($num>=70){
            $msg = "C" ;
        }else{
            $msg = "F" ;
        }
     }else{
        $msg = "Please provide Valid Score" ;
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
    

   <form method="POST">
    <input type="number" name="num" id="">
    <input type="submit" name="submit" id="">
   </form>

   <h2> <?php  echo $msg ?></h2>
</body>
</html>
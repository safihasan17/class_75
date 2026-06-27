<?php
  
  $msg = "";
  $sum = 0;

  if(isset($_POST["submit"])){
    $num = $_POST["num"];

    for($i=0; $i<=$num; $i++){
        $msg .= $i. " ";
        $sum += $i;
        
        
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
    <input type="number" name="num" id="">
    <input type="submit" name="submit" id="">
</form>

<h2><?php  echo $msg ?></h2>
<h2><?php  echo  "sum: " .$sum ?></h2>
</body>
</html>
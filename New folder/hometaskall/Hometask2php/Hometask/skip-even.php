<?php
  
  $msg = "";

  if(isset($_POST["submit"])){
    $num = $_POST["num"];

    for($i=1; $i<=$num; $i+=2){
        $msg .= $i. "<br>";
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
</body>
</html>
<?php
 $msg = "";
 $msg2 = "";

 if(isset($_POST["submit"])){
    $num = $_POST["num"];

    for($i=1; $i<=$num; $i++){
        for($j=$i; $j>0; $j--){
           $msg .= "*";
        };
        $msg .="<br>";
    };


    for($i=$num; $i>0; $i--){
        for($j=1; $j<=$i; $j++){
           $msg2 .= "*";
        };
        $msg2 .="<br>";
    };


    
 }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factorial</title>
</head>
<body>
    

<form method="POST">

   <input type="number" name="num" id="">
   <input type="submit" name="submit" id="">
</form>
<h2><?php echo $msg ?></h2>
<h2><?php echo $msg2 ?></h2>
</body>
</html>
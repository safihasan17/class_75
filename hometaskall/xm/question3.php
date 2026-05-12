<?php
 $msg = "";

 if(isset($_POST["submit"])){
    $num = $_POST["num"];

    if($num =="A"){
        $msg = "exellent";
    }elseif($num =="B"){
        $msg = "good";
    }elseif($num =="C"){
        $msg = "Fair";
    }elseif($num =="D"){
        $msg = "Poor";
    }elseif($num =="F"){
        $msg = "failure";
    }else{
        $msg = "Please Provide A to F Letter";
    }
    
 }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade</title>
</head>
<body>
    

<form method="POST">

   <input type="text" name="num" id="">
   <input type="submit" name="submit" id="">
</form>
<h2><?php echo $msg ?></h2>
</body>
</html>
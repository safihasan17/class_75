<?php
 $msg = "";

 if(isset($_POST["submit"])){
    $num = $_POST["num"];


    if($num>0){
        $fact =1;
        for($i=$num; $i>0; $i--){
            $fact *=$i;

        }
        $msg = "The factoril of  ". $num. " is " . $fact;
    }else{
        $msg ="Please provide valid Number";
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
</body>
</html>
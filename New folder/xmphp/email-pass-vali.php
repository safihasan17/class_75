<?php
$msg = "";
 if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $num = $_POST["num"];
    $num2 = $_POST["num2"];

    $regex = "/^[a-zA-Z0-9_.]{3,30}[@]{1}[a-zA-Z0-9]{2,20}[.]{1}[a-zA-Z]{2,6}$/";


    if(preg_match($regex ,$email) == 0){
        $msg = "<p style = 'color:red'>Email is not Valid <p>";
    }else{
        $msg = "<p style = 'color:green'>Email is valid<p>";
    }

    if(strlen($num) >= 8){
       $msg2 = "<p style = 'color:green'>Password is  Valid <p>";
    }else{
        $msg2 = "<p style = 'color:red'>Password is not  Valid <p>";
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
    <form action="" method="POST">
        <label for="">Email</label>
        <input type="text" name="email" id=""> <br>  <br>

        <label for="">password</label> 
        <input type="password" name="num" id="">  <br> <br>

        <label for="">Confirm Password</label> 
        <input type="password" name="num2" id=""><br> <br>

        <input type="submit" name="submit" id="" value="submit">

    </form>

    <?php echo $msg ?? "";?>
    <?php echo $msg2 ?? "";?>
</body>
</html>
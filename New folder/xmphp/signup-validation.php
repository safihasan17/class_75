<?php

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $con_pass = $_POST['con_pass'];
    $regex = '/^[a-zA-Z0-9._]{2,50}[@]{1}[a-zA-Z0-9-]{2,50}[.]{1}[a-zA-Z]{2,5}$/';


    if($email == ""){
        $emailerror = "Email is required";
    }elseif(preg_match($regex, $email) == false){
        $emailerror = "Email is not valid";
    }else{
        $emailerror= "";
    }

    if($pass == ""){
        $passerror = "Password is required";
    }elseif(strlen($pass) <8){
        $passerror = "Please give at least 8 characters";
    }else{
        $passerror = "";
    }

    if($con_pass == ""){
        $conpasserror = " confirm Password is required";
    }elseif( $con_pass != $pass){
        $conpasserror = "Password and confirm password does not match";
    }else{
        $conpasserror  = "";
    }

    if($emailerror == "" &&   $passerror == "" &&  $conpasserror  == ""){
        $msg = "Form upload successfully";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .error{
            color: red;
        }

        .success{
            color: green;
        }
    </style>
</head>
<body>
    

   <form action=""method="POST">
    <label for="">Email</label>
    <input type="text" name="email" id=""  value="<?= $email ?? "" ?>"> <br> <br>
    <p class="error"><?= $emailerror ?? "" ?> </p>

    <label for="">Password</label>
    <input type="password" name="pass" id="" value="<?= $pass ?? "" ?>"> <br> <br>
    <p class="error"><?= $passerror ?? "" ?> </p>

    <label for="">Confirm Password</label>
    <input type="password" name="con_pass" id="" value="<?= $con_pass ?? "" ?>"><br> <br>
    <p class="error"><?= $conpasserror ?? "" ?> </p>

    <input type="submit" name="submit" id="" value="submit">

   </form>

  <h3 class="success"><?= $msg ?? "" ;?></h3> 
</body>
</html>
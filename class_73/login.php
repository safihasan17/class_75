<?php 
session_start();
// $_SESSION["username"] = 1;
// unset($_SESSION["username"]); 

if(isset($_SESSION["username"])){
   header("Location: dashbord.php");
}

$pass = "123";
$hash_pass = password_hash($pass, PASSWORD_DEFAULT);
if(isset($_POST["password"])){
    if(password_verify($_POST["password"], $hash_pass)){
        $_SESSION["username"] = 1;
        header("Location: dashbord.php");
    }else{
        $error = "<span style='color:red;'>Invalid Password </span>";
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

    <h2>Login</h2>

  <form action="" method="POST">
    <input type="text" name="username" id=""> <br><br> 
    <input type="password" name="password" id=""> <br><br> 
    <input type="submit" name="submit" id="" value="login"> <br><br> 
 </form>


 <?=  $error ?? ""; ?> 
</body>
</html>
<?php 
session_start();
if(!isset($_SESSION["username"])){
   header("Location: login.php");
};

if(isset($_POST["logout"])){
    session_unset();
    header("Location: login.php");
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
     <nav>
        <a href="dashbord.php">Dashbord</a>
        <a href="report.php">Report</a>
    </nav> 

    <form action="" method="POST">
       <input type="submit" name="logout" value="logout">
    </form>
    
  <h1>Dashbord page</h1>
</body>
</html>
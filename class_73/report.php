<?php
session_start();
if(!isset($_SESSION["username"])){
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
        <a href="logout.php">logout</a>

    </nav> 

    <h2>Report page</h2>
  
   
</body>
</html>
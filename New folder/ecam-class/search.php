<?php
require "files/studemt.class.php";

if(isset($_POST["id"])){
    $s = new Student();
    $res = $s->reset($_POST["id"]);
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
    <a href="create.php">Add student</a>
    |
    <a href="list.php">student </a>
    |
    <a href="search.php"> search</a>
</nav> <br> <br>


<form action="" method = "POST">

<input type="search" name="id" id="">
<button type="submit">submit</button>
</form>

<h3><?php echo  $res ?? ""; ?></h3>
</body>
</html>
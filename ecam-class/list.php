<?php
 require "files/studemt.class.php";

  $s = new student;
  $data =$s->showAll();

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

<table border="2" width="400">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Score</th>
        <th>Grade</th>

        <?php  echo $data ?? ""; ?>
    </tr>
</table>


</body>
</html>
<?php
require_once("confiq.php");

$sql = "
SELECT c.*, t.name AS teacher
FROM teacher AS t, course AS c
WHERE c.teacher_id = t.id 
";

$result= $db->query($sql);
$rows= $result->fetch_all(MYSQLI_ASSOC);

$result_row = $db->query("select * from vw_course");
$new_row = $result_row->fetch_all(MYSQLI_ASSOC);





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1> teacher list free is greater 15000</h1>

<table border="4" width= "400">
    <tr>
        <th>Id</th>
        <th>course_name</th>
        <th>fee</th>
        <th>teacher</th>
       
    </tr>
    <?php foreach($new_row as $item):?>
    <tr>
      <td><?= $item['id'] ; ?></td>
      <td><?= $item['course_name'] ; ?></td>
      <td><?= $item['fee'] ; ?></td>
      <td><?= $item['teacher'] ; ?></td>
    </tr>

    <?php endforeach;?>
</table>




 
<h1>course list</h1>

<table border="4" width= "400">
    <tr>
        <th>Id</th>
        <th>course_name</th>
        <th>fee</th>
        <th>teacher</th>
       
    </tr>
    <?php foreach($rows as $item):?>
    <tr>
      <td><?= $item['id'] ; ?></td>
      <td><?= $item['course_name'] ; ?></td>
      <td><?= $item['fee'] ; ?></td>
      <td><?= $item['teacher'] ; ?></td>
    </tr>

    <?php endforeach;?>
</table>
</body>
</html>
<?php
require_once("confiq.php");

if(isset($_POST["add-teacher"])){
    $name = $_POST['name'];
    $qulaification = $_POST['qulaification'];
    $contact = $_POST['contact'];

    // echo $name . "<br>". $qulaification. "<br>". $contact;

    $db->query("call createteacher('$name', '$qulaification', '$contact')");
}

if(isset($_POST['delete_id'])){
    $id= $_POST['delete_id'];

    $db->query("delete from teacher where id = $id");
}

 $result= $db->query("select * from teacher");
 $row = $result->fetch_all(MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Add new Teacher</h1>
<form action="" method="POST">

Name : <br>
<input type="text" name="name" id=""> <br> <br>
Qualification: <br>
<input type="text" name="qulaification" id=""> <br> <br>
contact_no:
<input type="text" name="contact" id=""> <br> <br>


<input type="submit" name="add-teacher" id="" value="add-new"> 
</form>
    


 
<h1>Teacher list</h1>

<table border="4" width= "400">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>qualification</th>
        <th>contact_no</th>
        <th>Action</th>
    </tr>
    <?php foreach($row as $item):?>
    <tr>
      <td><?= $item['id'] ; ?></td>
      <td><?= $item['name'] ; ?></td>
      <td><?= $item['qualification'] ; ?></td>
      <td><?= $item['contact_no'] ; ?></td>
      <td>
        <form action="" method="POST">
         
         <input type="hidden" name="delete_id" id="" value="<?= $item['id'] ; ?>">
        <button>delete</button>
        </form>
        
      </td>
    </tr>

    <?php endforeach;?>
</table>
</body>
</html>
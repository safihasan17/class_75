<?php
require_once("confiq.php");

if(isset($_POST["add-mfg"])){
    $name = $_POST["name"];
    $address = $_POST["address"];
    $contact = $_POST["contact"];

    // echo $name. "<br>". $address. "<br>". $contact;

$db->query("call createmanufacturer('$name','$address', '$contact')");

}

if(isset($_POST['delete_id'])){
   $id = $_POST["delete_id"];
//    echo $id;
   $db->query("delete from manufactuer where id = $id");
}

 $result = $db->query("select * from manufactuer order by id desc");
 $rows = $result->fetch_all(MYSQLI_ASSOC);


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
    <a href="manufacturer.php">Manufacture List</a>
    <a href="product.php">products</a>
</nav>

<h1>Add new manufacturer</h1>
<form action="" method="POST">
  Name: <br>
  <input type="text" name="name" id=""> <br> <br>
  Address:<br>
  <input type="text" name="address" id=""> <br> <br>
  Contact_no:<br>
  <input type="text" name="contact" id=""> <br> <br>

  <input type="submit" name="add-mfg" id="" value="Add-new">
</form>


<h1>Manufacture List</h1>

<table border="1" width="400">
   
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Address</th>
            <th>Contact no</th>
            <th>action</th>
        </tr>
    
        <?php foreach($rows as $item): ?>

        <tr>
            <td><?= $item['id']; ?></td>
            <td><?= $item['name']; ?></td>
            <td><?= $item['address']; ?></td>
            <td><?= $item['contact_no']; ?></td>

            <td>
                <form action="" method="POST">
                    <input type="hidden" name="delete_id" value="<?= $item['id']; ?>">
                    <button type="submit">Delete</button>

                </form>
            </td>


        </tr>

        
        <?php endforeach?>
      
</table>

</body>
</html>
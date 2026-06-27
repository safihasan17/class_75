<?php
require_once("dbconfiq.php");
if(isset($_POST['add-new'])){
   $name= $_POST['name'];
   $address= $_POST['address'];
   $contact= $_POST['contact'];

   $db->query("call createmanufacturer('$name', '$address', '$contact')");
}

if(isset($_POST['delete_id'])){
    $id= $_POST['delete_id'];

    $db->query("delete from manufactuer where id = $id");
}



$result = $db->query("select * from manufactuer");
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
    <nav>
        <a href="manufacture.php">Manufacture</a>
        <a href="product.php">product</a>
    </nav>
<h1>Add new</h1>
    <form action="" method="POST">
        Name: <br>
        <input type="text" name="name" id=""> <br> <br>
        Address: <br>
        <input type="text" name="address" id=""> <br> <br>
        contact no: <br>
        <input type="text" name="contact" id=""> <br> <br>

        <input type="submit" name="add-new" id="" value="add-new">
    </form>
<h1> manufacture list</h1>
    <table border="2" width="400">
        <tr>
            <th>Id</th>
            <th>name</th>
            <th>address</th>
            <th>Contact no</th>
            <th>action</th>
        </tr>

        <?php foreach($row as $item):?>

            <tr>
                <td><?= $item['id']; ?></td>
                <td><?= $item['name']; ?></td>
                <td><?= $item['address']; ?></td>
                <td><?= $item['contact_no']; ?></td>
                <td>
                    <form action="" method="POST">
                     <input type="hidden" name="delete_id" id="" value="<?= $item['id']; ?>">
                     <button>Delete</button>
                    </form>
                    
                </td>
            </tr>

        <?php endforeach?>
    </table>
</body>
</html>
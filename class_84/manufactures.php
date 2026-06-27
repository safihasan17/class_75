<?php
require_once("db.php");

if(isset($_POST['add-mfg'])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    // echo $name. "<br>". $address;

    $db->query("call createmanufacturer('$name', '$address')");

}

if(isset($_POST["delete_id"])){
   $id = $_POST["delete_id"];
   $db->query("delete from manufactures where id = $id");
}

 $result = $db->query("select * from manufactures order by id desc");
 $rows = $result->fetch_all(MYSQLI_ASSOC);

//  if($result){
    
//     echo "<pre>";
//     print_r($rows);
//     echo "</pre>";

//  }
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
        <a href="manufactures.php">Manufactures</a>
        <a href="products.php">Products</a>
    </nav>

    <h1>Add new manufactures</h1>

    <form action=""method="POST">
      Name: <br>
      <input type="text" name="name" > <br> <br>

      Address: <br>
      <input type="text" name="address" id=""> <br> <br>

      <input type="submit" name="add-mfg" value="Add Manufacturer"> <br> <br>
    </form>



    <h1>Manufactures List</h1>
    <table border="1" width= "400">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Address</th>
            <th>Action</th>
        </tr>

        <?php foreach ($rows as $item):?>
         <tr>
            <td><?=$item['id']; ?></td>
            <td><?=$item['name']; ?></td>
            <td><?=$item['address']; ?></td>

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
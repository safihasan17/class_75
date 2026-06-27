<?php
require_once("db.php");
 $result = $db->query("select p.*, m.name as mfg from products p, manufactures m where p.manufacture_id = m.id");
 $rows = $result->fetch_all(MYSQLI_ASSOC);

//  if($result){
    
//     echo "<pre>";
//     print_r($rows);
//     echo "</pre>";

//  }

$view_result = $db->query("select * from vw_product_list");
$view_rows= $view_result->fetch_all(MYSQLI_ASSOC);

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

    <h1>View Product more than TK 1000</h1>
    <table border="1" width= "400">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>mfg</th>
            <th> price</th>
        </tr>

        <?php foreach ($view_rows as $item):?>
         <tr>
            <td><?=$item['id']; ?></td>
            <td><?=$item['name']; ?></td>
            <td><?=$item['mfg']; ?></td>
            <td><?=$item['price']; ?></td>

            
         </tr>
        
        <?php endforeach?>

    </table>



    <h1>Product List</h1>
    <table border="1" width= "400">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>mfg</th>
            <th> price</th>
        </tr>

        <?php foreach ($rows as $item):?>
         <tr>
            <td><?=$item['id']; ?></td>
            <td><?=$item['name']; ?></td>
            <td><?=$item['mfg']; ?></td>
            <td><?=$item['price']; ?></td>

            
         </tr>
        
        <?php endforeach?>

    </table>
</body>
</html>
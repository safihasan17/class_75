<?php
require_once("dbconfiq.php");
 $sql = "
 select p.*, m.name as mfg
from product as p , manufactuer as m
where p.manufacturer_id = m.id
 ";

 $result = $db->query($sql);
 $rows = $result->fetch_all(MYSQLI_ASSOC);

 $result_new= $db->query("select * from vw_product");
 $row_new = $result_new->fetch_all(MYSQLI_ASSOC);


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

    <h1> View Product price more than 5000</h1>
    <table border="2" width="400">
        <tr>
            <th>Id</th>
            <th>name</th>
            <th>price</th>
            <th>MFG</th>
            
        </tr>

        <?php foreach($row_new as $item):?>

            <tr>
                <td><?= $item['id']; ?></td>
                <td><?= $item['name']; ?></td>
                <td><?= $item['price']; ?></td>
                <td><?= $item['mfg']; ?></td>
                
            </tr>

        <?php endforeach?>
    </table>

  

<h1> product list</h1>
    <table border="2" width="400">
        <tr>
            <th>Id</th>
            <th>name</th>
            <th>price</th>
            <th>Mfg</th>
            
        </tr>

        <?php foreach($rows as $item):?>

            <tr>
                <td><?= $item['id']; ?></td>
                <td><?= $item['name']; ?></td>
                <td><?= $item['price']; ?></td>
                <td><?= $item['mfg']; ?></td>
                
            </tr>

        <?php endforeach?>
    </table>
</body>
</html>